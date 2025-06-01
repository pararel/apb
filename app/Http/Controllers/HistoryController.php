<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::where('id_acc', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('user.history', compact('histories'));
    }
}
