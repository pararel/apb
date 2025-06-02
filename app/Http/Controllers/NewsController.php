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
        return view('admin.news');
    }

    public function storeNews(Request $request)
    {
        $request->validate([
        'category' => 'required|string',
        'content' => 'required|string',
        'imageUrl' => 'required|string',
        'sourceUrl' => 'required|string',
        'subtitle' => 'required|string',
        'subtitleContent' => 'required|string',
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
            'sourceUrl' => ['stringValue' => $request->sourceUrl],
            'subtitle' => ['stringValue' => $request->subtitle],
            'subtitleContent' => ['stringValue' => $request->subtitleContent],
            'title' => ['stringValue' => $request->title],
            'createdAt' => ['stringValue' => $uploadTime],
            'type' => ['stringValue' => 'standard'],
        ]
    ];

    $response = Http::withToken($accessToken)->post($url, $data);

    if ($response->successful()) {
        return redirect()->back()->with('success', 'News posted successfully.');
    } else {
        return redirect()->back()->withErrors(['error' => 'Failed to post news.']);
    }
    }


    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if (file_exists(public_path('images/news/' . $news->picture))) {
            unlink(public_path('images/news/' . $news->picture));
        }
        $news->delete();
        return redirect()->route('adminNews')->with('success', 'News deleted successfully.');
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
