<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        if ($user !== null) {
            return view('profile', compact('user'));
        }
    }

    public function settings()
    {
        $user = Auth::user();
        if ($user === null) {
            return back();
        }

        $userSettings = UserSettings::where('user_id', $user->id)->first();
        if ($userSettings === null) {
            $userSettings = UserSettings::create([
                'user_id' => $user->id,
                'notification_days_before' => 1,
                'notification_days_after' => 7,
            ]);
        }

        return view('settings', compact('user', 'userSettings'));
    }

    public function users()
    {
        $user = Auth::user();
        return view('table.users', compact('user'));
    }

    public function categories()
    {
        $user = Auth::user();
        return view('table.categories', compact('user'));
    }

    public function timelineEvents()
    {
        $user = Auth::user();
        return view('table.timelineEvents', compact('user'));
    }

    public function timelineEventCategories()
    {
        $user = Auth::user();
        return view('table.timelineEventCategories', compact('user'));
    }

    public function userSettings()
    {
        $user = Auth::user();
        return view('table.userSettings', compact('user'));
    }
}
