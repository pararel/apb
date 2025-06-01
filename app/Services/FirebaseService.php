<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path('storage/firebase/firebase_credentials.json'));
        $this->database = $factory->createDatabase();
    }

    public function getData($path)
    {
        return $this->database->getReference($path)->getValue();
    }
}
