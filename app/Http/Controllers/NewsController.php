<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function showAdminNews()
    {
        $news = News::orderBy('id', 'desc')->get();
        return view('admin.news', compact('news'));
    }

    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = date('Y-m-d-H-i-s') . '.' . $request->picture->extension();
        $request->picture->move(public_path('images/news'), $imageName);

        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        $news->link = $request->link;
        $news->picture = $imageName;
        $news->save();

        return redirect()->route('adminNews')->with('success', 'News added successfully.');
    }

    public function showUserNews()
    {
        $news = News::orderBy('id', 'desc')->get();
        return view('user.news', compact('news'));
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
}
