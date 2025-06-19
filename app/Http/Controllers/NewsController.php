<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function showAdminNews()
    {
        $accessToken = $this->getAccessToken();
        $projectId = 'emonic-e9f58';
        $collection = 'news';

        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

        $response = Http::withToken($accessToken)->get($url);

        $newsList = [];

        if ($response->successful()) {
            $documents = $response->json()['documents'] ?? [];

            foreach ($documents as $doc) {
                $fields = $doc['fields'] ?? [];
                $documentName = $doc['name']; // e.g., projects/emonic-e9f58/databases/(default)/documents/news/abc123
                $uid = basename($documentName); // Mengambil "abc123" dari URL

                $newsList[] = [
                    'uid' => $uid,
                    'title' => $fields['title']['stringValue'] ?? '',
                    'category' => $fields['category']['stringValue'] ?? '',
                    'content' => $fields['content']['stringValue'] ?? '',
                    'imageUrl' => $fields['imageUrl']['stringValue'] ?? '',
                    'createdAt' => $fields['createdAt']['stringValue'] ?? '',
                ];
            }
        }

        return view('admin.news', ['newsList' => $newsList]);
    }


    public function storeNews(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'content' => 'required|string',
            'imageUrl' => 'required|string',
            'title' => 'required|string',
        ]);

        $accessToken = $this->getAccessToken();
        $projectId = 'emonic-e9f58'; // Ganti sesuai project ID kamu
        $collection = 'news';

        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

        // Format waktu: 22 May 2025 at 14:05:12 UTC +7
        $uploadTime = Carbon::now('Asia/Jakarta')->format('d F Y \a\t H:i:s \U\T\C +7');

        $data = [
            'fields' => [
                'category' => ['stringValue' => $request->category],
                'content' => ['stringValue' => $request->content],
                'imageUrl' => ['stringValue' => $request->imageUrl],
                'title' => ['stringValue' => $request->title],
                'createdAt' => ['stringValue' => $uploadTime],
                'averageRating' => ['integerValue' => 0],
                'likes' => ['integerValue' => 0],
                'totalRatings' => ['integerValue' => 0],
            ]
        ];

        $response = Http::withToken($accessToken)->post($url, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'News posted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to post news.']);
        }
    }



    public function destroy($uid)
    {
        $accessToken = $this->getAccessToken();
        $projectId = 'emonic-e9f58';
        $collection = 'news';

        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}/{$uid}";

        $response = Http::withToken($accessToken)->delete($url);

        if ($response->successful()) {
            return redirect()->route('adminNews')->with('success', 'News deleted successfully.');
        } else {
            return back()->withErrors(['delete' => 'Failed to delete news.']);
        }
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
