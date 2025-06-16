<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\History;

class AccountController extends Controller
{
    public function showSignupForm()
    {
        return view('main.signup');
    }
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $accessToken = $this->getAccessToken();
        $projectId = 'emonic-e9f58';
        $collection = 'admin';

        // 🔍 Cek apakah email sudah ada
        $emailCheck = [
            'structuredQuery' => [
                'from' => [['collectionId' => $collection]],
                'where' => [
                    'fieldFilter' => [
                        'field' => ['fieldPath' => 'email'],
                        'op' => 'EQUAL',
                        'value' => ['stringValue' => $request->email],
                    ]
                ]
            ]
        ];

        $emailResponse = Http::withToken($accessToken)->post("https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents:runQuery", $emailCheck);
        if (!empty($emailResponse->json()[0]['document'])) {
            return back()->withErrors(['email' => 'Email already exists.']);
        }

        // 🔍 Cek apakah username sudah ada
        $usernameCheck = [
            'structuredQuery' => [
                'from' => [['collectionId' => $collection]],
                'where' => [
                    'fieldFilter' => [
                        'field' => ['fieldPath' => 'username'],
                        'op' => 'EQUAL',
                        'value' => ['stringValue' => $request->username],
                    ]
                ]
            ]
        ];

        $usernameResponse = Http::withToken($accessToken)->post("https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents:runQuery", $usernameCheck);
        if (!empty($usernameResponse->json()[0]['document'])) {
            return back()->withErrors(['username' => 'Username already exists.']);
        }

        // 📤 Data yang akan disimpan
        $newAccount = [
            'fields' => [
                'name' => ['stringValue' => $request->name],
                'email' => ['stringValue' => $request->email],
                'username' => ['stringValue' => $request->username],
                'password' => ['stringValue' => Hash::make($request->password)],
                'status' => ['stringValue' => 'no'],
            ],
        ];

        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

        $response = Http::withToken($accessToken)->post($url, $newAccount);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Registration completed. Kindly wait until your account is approved.');
        } else {
            return back()->withErrors(['error' => 'Failed to register account.']);
        }
    }
    public function showLoginForm()
    {
        return view('main.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $accessToken = $this->getAccessToken();
        $projectId = 'emonic-e9f58';
        $collection = 'admin';

        // 🔍 Query untuk cari akun berdasarkan username
        $query = [
            'structuredQuery' => [
                'from' => [['collectionId' => $collection]],
                'where' => [
                    'fieldFilter' => [
                        'field' => ['fieldPath' => 'username'],
                        'op' => 'EQUAL',
                        'value' => ['stringValue' => $request->username],
                    ]
                ]
            ]
        ];

        $response = Http::withToken($accessToken)->post("https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents:runQuery", $query);
        $documents = $response->json();

        // 🔎 Cek apakah user ditemukan
        if (empty($documents[0]['document'])) {
            return back()->withErrors(['username' => 'Account not found.']);
        }

        $userData = $documents[0]['document']['fields'];

        // 🔐 Verifikasi password
        if (!Hash::check($request->password, $userData['password']['stringValue'])) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        // ✅ Cek status akun
        if ($userData['status']['stringValue'] !== 'yes') {
            return back()->withErrors(['username' => 'Your account is not approved yet.']);
        }
        $uid = $documents[0]['document']['name'];
        $uid = basename($uid);
        // 🔓 Simpan data login ke session Laravel (tanpa model User)
        session([
            'firebase_user' => [
                'uid' => $uid,
                'name' => $userData['name']['stringValue'],
                'email' => $userData['email']['stringValue'],
                'username' => $userData['username']['stringValue'],
            ]
        ]);

        return redirect()->route('adminDashboard');
    }
    public function logout()
    {
        session()->forget('firebase_user');
        return redirect()->route('login');
    }
    public function showUsers()
{
    $projectId = 'emonic-e9f58';
    $collection = 'user';
    $accessToken = $this->getAccessToken();

    $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

    $response = Http::withToken($accessToken)->get($url);

    $users = [];

    if ($response->successful()) {
        $documents = $response->json()['documents'] ?? [];

        foreach ($documents as $doc) {
            $fields = $doc['fields'];
            $documentName = $doc['name']; // Contoh: projects/emonic-e9f58/databases/(default)/documents/user/abc123uid
            $uid = basename($documentName); // Mengambil 'abc123uid'

            $users[] = [
                'uid' => $uid,
                'email' => $fields['email']['stringValue'] ?? '',
                'name' => $fields['name']['stringValue'] ?? '',
            ];
        }
    }

    return view('admin.dashboard', ['users' => $users]);
}

    public function deleteUser($uid)
{
    $accessToken = $this->getAccessToken();
    $projectId = 'emonic-e9f58';
    $collection = 'user';

    $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}/{$uid}";

    $response = Http::withToken($accessToken)->delete($url);

    if ($response->successful()) {
        return redirect()->route('adminDashboard')->with('success', 'User deleted successfully.');
    } else {
        return back()->withErrors(['delete' => 'Failed to delete user.']);
    }
}

    public function showAdminSettingsForm()
    {
        return view('admin.settings');
    }
    public function updateProfile(Request $request)
    {
        // Validasi hanya memeriksa format jika diisi
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'username' => 'nullable|string|max:255',
        ]);

        $firebaseUser = session('firebase_user');
        $uid = $firebaseUser['uid'] ?? null;

        if (!$uid) {
            return redirect()->route('adminSettings')->withErrors(['auth' => 'Unauthorized access.']);
        }

        $accessToken = $this->getAccessToken();
        $projectId = 'emonic-e9f58'; // Ganti dengan project ID kamu
        $collection = 'admin';
        $documentPath = "projects/{$projectId}/databases/(default)/documents/{$collection}/{$uid}";

        // Ambil data lama terlebih dahulu dari Firestore
        $docResponse = Http::withToken($accessToken)->get("https://firestore.googleapis.com/v1/{$documentPath}");

        if (!$docResponse->successful()) {
            return redirect()->route('adminSettings')->withErrors(['error' => 'Failed to fetch current data.']);
        }

        $currentData = $docResponse->json()['fields'];

        // Ambil data baru atau fallback ke data lama
        $newName = $request->name ?? $currentData['name']['stringValue'] ?? '';
        $newEmail = $request->email ?? $currentData['email']['stringValue'] ?? '';
        $newUsername = $request->username ?? $currentData['username']['stringValue'] ?? '';

        // Siapkan data untuk update
        $updateData = [
            'fields' => [
                'name' => ['stringValue' => $newName],
                'email' => ['stringValue' => $newEmail],
                'username' => ['stringValue' => $newUsername],
            ]
        ];

        $updateFields = 'name,email,username';
        $response = Http::withToken($accessToken)->patch(
            "https://firestore.googleapis.com/v1/{$documentPath}?updateMask.fieldPaths=name&updateMask.fieldPaths=email&updateMask.fieldPaths=username",
            $updateData
        );

        if ($response->successful()) {
            return redirect()->route('adminSettings')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('adminSettings')->withErrors(['error' => 'Failed to update profile.']);
        }
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
            'current_password' => 'required|string',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        History::create([
            'message' => 'Anda memperbarui kata sandi akun anda',
            'info' => 'account',
            'id_acc' => Auth::id(),
        ]);
        return redirect()->route('adminSettings')->with('success', 'Password updated successfully.');
    }
    private function getAccessToken()
    {
        $keyFile = storage_path('firebase/firebase_credentials.json');
        $jsonKey = json_decode(file_get_contents($keyFile), true);

        $jwt = new \Firebase\JWT\JWT;

        $now = time();
        $token = [
            "iss" => $jsonKey['client_email'],
            "scope" => "https://www.googleapis.com/auth/datastore",
            "aud" => "https://oauth2.googleapis.com/token",
            "iat" => $now,
            "exp" => $now + 3600,
        ];

        $jwtClient = \Firebase\JWT\JWT::encode($token, $jsonKey['private_key'], 'RS256');

        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwtClient,
        ]);

        return $response->json()['access_token'];
    }
}
