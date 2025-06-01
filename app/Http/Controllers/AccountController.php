<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
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
            'email' => 'required|string|email|max:255|unique:accounts',
            'username' => 'required|string|max:255|unique:accounts',
            'password' => 'required|string|min:8',
        ]);

        $account = new Account();
        $account->name = $request->name;
        $account->email = $request->email;
        $account->username = $request->username;
        $account->password = Hash::make($request->password);
        $account->save();

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    public function showLoginForm()
    {
        return view('main.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin === 'no') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('adminDashboard');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showSettingsForm()
    {
        return view('user.settings');
    }

    public function showAdminSettingsForm()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:accounts,email,' . Auth::id(),
            'username' => 'required|string|max:255|unique:accounts,username,' . Auth::id(),
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->hasFile('picture')) {
            $imageName = date('Y-m-d-H-i-s') . '.' . $request->picture->extension();
            $request->picture->move(public_path('images/profiles'), $imageName);
            $user->picture = $imageName;
        }

        $user->save();
        History::create([
            'message' => 'Anda memperbarui profil akun anda',
            'info' => 'account',
            'id_acc' => Auth::id(),
        ]);
        if ($user->is_admin === 'yes') {
            return redirect()->route('adminSettings')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('settings')->with('success', 'Profile updated successfully.');
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
        if ($user->is_admin === 'yes') {
            return redirect()->route('adminSettings')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->route('settings')->with('success', 'Password updated successfully.');
        }
    }
}
