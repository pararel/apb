<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\History;
use App\Models\Favorite;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function showCommunity()
    {
        $posts = Post::with(['account', 'comments'])->orderBy('id', 'desc')->get();
        foreach ($posts as $post) {
            $post->is_favorite = Favorite::where('id_acc', Auth::id())->where('id_post', $post->id)->exists();
        }
        return view('user.community', compact('posts'));
    }

    public function showAdminCommunity()
    {
        $posts = Post::with(['account', 'comments'])->orderBy('id', 'desc')->get();
        foreach ($posts as $post) {
            $post->is_favorite = Favorite::where('id_acc', Auth::id())->where('id_post', $post->id)->exists();
        }
        return view('admin.community', compact('posts'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->content = $request->content;
        $post->id_account = Auth::id();
        $post->save();

        $user = Auth::user();
        $user->incrementPosts();
        History::create([
            'message' => 'Anda mengunggah postingan di komunitas.',
            'info' => 'post',
            'id_acc' => Auth::id(),
        ]);
        if (Auth::user()->is_admin === 'yes') {
            return redirect()->route('adminCommunity')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('community')->with('success', 'Profile updated successfully.');
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $favorites = Favorite::where('id_post', $post->id)->get();
        foreach ($favorites as $favorite) {
            $user = $favorite->account;
            $user->decrementLikes();
        }
        History::create([
            'message' => 'Anda menghapus unggahan anda.',
            'info' => 'post',
            'id_acc' => Auth::id(),
        ]);
        $postOwner = $post->account;
        $postOwner->decrementPostLiked($post->likes());
        $post->delete();

        $user = Auth::user();
        $user->decrementPosts();
        if (Auth::user()->is_admin === 'yes') {
            return redirect()->route('adminCommunity')->with('success', 'Posts deleted successfully.');
        } else {
            return redirect()->route('community')->with('success', 'Posts deleted successfully.');
        }
    }

    public function toggleFavorite($postId)
    {
        $post = Post::findOrFail($postId);
        $favorite = Favorite::where('id_acc', Auth::id())->where('id_post', $postId)->first();
        $user = Auth::user();
        $postOwner = $post->account;
        if ($favorite) {
            $favorite->delete();
            $user->decrementLikes();
            $post->decrementLikes();
            $postOwner->decrementPostLiked(1);
            History::create([
                'message' => 'Anda menghapus postingan ' . $post->account->username . ' dari favorit',
                'info' => 'post',
                'id_acc' => Auth::id(),
            ]);
            $message = 'Removed from favorites successfully.';
        } else {
            Favorite::create([
                'id_acc' => Auth::id(),
                'id_post' => $postId,
            ]);
            $user->incrementLikes();
            $post->incrementLikes();
            $postOwner->incrementPostLiked(1);
            $message = 'Added to favorites successfully.';

            History::create([
                'message' => 'Anda menyimpan postingan ' . $post->account->username . ' ke favorit',
                'info' => 'post',
                'id_acc' => Auth::id(),
            ]);
        }
        if (Auth::user()->is_admin === 'yes') {
            return redirect()->route('adminCommunity')->with('success', $message);
        } else {
            return redirect()->route('community')->with('success', $message);
        }
    }

    public function addComment(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $request->validate(['reply' => 'required|string',]);
        $comment = new Comment();
        $comment->reply = $request->reply;
        $comment->id_acc = Auth::id();
        $comment->id_post = $postId;
        $comment->save();
        $post->incrementComments();
        History::create([
            'message' => 'Anda menambah komen anda di postingan ' . $post->account->username . '.',
            'info' => 'post',
            'id_acc' => Auth::id(),
        ]);
        if (Auth::user()->is_admin === 'yes') {
            return redirect()->route('adminCommunity')->with('success', 'Comment added successfully.');
        } else {
            return redirect()->route('community')->with('success', 'Comment added successfully.');
        }
    }

    public function destroyComment($id)
    {

        $comment = Comment::findOrFail($id);
        $post = $comment->post;
        if ($comment->id_acc == Auth::id()) {
            $comment->delete();
            $post->decrementComments();
            History::create([
                'message' => 'Anda menghapus komen anda dari postingan ' . $post->account->username . '.',
                'info' => 'post',
                'id_acc' => Auth::id(),
            ]);
            if (Auth::user()->is_admin === 'yes') {
                return redirect()->route('adminCommunity')->with('success', 'Comment deleted successfully.');
            } else {
                return redirect()->route('community')->with('success', 'Comment deleted successfully.');
            }
        }
    }
}
