<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class FirebaseController extends Controller
{
    public function showFeedbacks()
    {
        
        return view('firebase.dashboard', compact('feedbacks'));
    }
    public function showAdminSettingsForm()
    {
        return view('firebase.settings');
    }
    public function showAdminNews()
    {
        return view('firebase.news');
    }
    public function getUsers()
    {
        $projectId = 'emonic-e9f58';
        $collection = 'user';
        $accessToken = $this->getAccessToken();

        $url = "https://firestore.googleapis.com/v1/projects/{$projectId}/databases/(default)/documents/{$collection}";

        $response = Http::withToken($accessToken)->get($url);

        $documents = $response->json()['documents'] ?? [];

        $users = [];
        foreach ($documents as $doc) {
            $fields = $doc['fields'];
            $users[] = [
                'name' => $fields['name']['stringValue'] ?? '',
                'email' => $fields['email']['stringValue'] ?? '',
                'profilePicture' => $fields['profilePicture']['stringValue'] ?? null,
                'userId' => $fields['userId']['stringValue'] ?? '',
            ];
        }

        return view('firebase.dashboard', compact('users'));
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
