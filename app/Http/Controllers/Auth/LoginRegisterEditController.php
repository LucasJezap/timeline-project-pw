<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsEditRequest;
use App\Http\Requests\UserAuthenticateRequest;
use App\Http\Requests\UserChangeRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Models\UserSettings;
use App\Traits\Upload;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterEditController extends Controller
{
    use Upload, AuthorizesRequests, ValidatesRequests;

    public function register()
    {
        return view('auth.register');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $request->validated();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(UserAuthenticateRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->with('message', 'You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard')
            ->with('message', 'You have logged out successfully!');
    }

    public function change()
    {
        return view('auth.change');
    }

    public function changePassword(UserChangeRequest $request): RedirectResponse
    {
        $request->validated();

        $user = Auth::user();
        $isLogged = $user !== null;
        if (!$isLogged) {
            $user = User::where('email', $request['email'])->first();
        }

        if ($user === null) {
            return back()->withErrors(['User not found']);
        }

        $validCredentials = Hash::check($request['old_password'], $user->getAuthPassword());

        if (!$validCredentials) {
            return back()->withErrors(['Wrong old password']);
        }

        $user->password = $request['new_password'];
        $user->save();

        if ($isLogged) {
            return redirect()->route('settings')->with('success', 'Password changed');
        }

        return redirect()->route('login')->with('success', 'Password changed');
    }

    public function editProfile(UserEditRequest $request): RedirectResponse
    {
        $request->validated();

        $user = Auth::user();
        if ($user === null) {
            return redirect()->route('profile')->withErrors(['User error']);
        }

        $user->name = $request['name'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->phone = $request['phone'];
        $user->company = $request['company'];
        $user->save();

        return redirect()->route('profile')->with('success', 'Saved');
    }

    public function uploadAvatar(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user === null) {
            return redirect()->route('profile')->withErrors(['User error']);
        }

        if ($request->hasFile('file')) {
            $path = $this->UploadFile($request->file('file'), "profile", $user->id);//use the method in the trait
            $user->avatar = $path;
            $user->save();

            return redirect()->route('profile')->with('success', 'Saved');
        }

        return redirect()->route('profile');
    }

    public function editSettings(SettingsEditRequest $request): RedirectResponse
    {
        $request->validated();

        $user = Auth::user();
        if ($user === null) {
            return redirect()->route('settings')->withErrors(['User error']);
        }

        $userSettings = UserSettings::where('user_id', $user->id)->first();

        if ($userSettings === null) {
            return redirect()->route('settings')->withErrors(['User settings error']);
        }

        $userSettings->notification_days_before = $request['notification_days_before'];
        $userSettings->notification_days_after = $request['notification_days_after'];
        $userSettings->save();

        return redirect()->route('settings')->with('success', 'Saved');
    }
}
