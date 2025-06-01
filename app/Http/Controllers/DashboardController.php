<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\Post;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $latestTarget = Target::where('id_acc', Auth::id())
            ->whereColumn('countDays', '<', 'days')
            ->orderBy('created_at', 'desc')
            ->first();

        $latestPost = Post::where('id_account', '!=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->first();

        $latestNews = News::orderBy('created_at', 'desc')->first();

        return view('user.dashboard', compact('latestTarget', 'latestPost', 'latestNews'));
    }
}
