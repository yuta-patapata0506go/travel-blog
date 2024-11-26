<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;  // 修正: Illuminate\Http\Request をインポート
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle the user login process.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Check user status
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user && $user->status != 0) { 
            return false; // Do not allow login if status is not 0
        }

        // Attempt authentication if the user is not disabled
        return Auth::attempt($credentials, $request->filled('remember'));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Include soft-deleted users in the search
    $user = \App\Models\User::withTrashed()->where('email', $request->email)->first();

        // Error message for soft-deleted users
        if ($user && $user->trashed()) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __('auth.suspended_account'), // Account suspended
                ]);
        }

        if ($user && $user->status == 1) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __('auth.suspended_account'), // Account suspended
                ]);
        }

        if ($user && $user->status == 2) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __('auth.deleted_account'), // Account deleted
                ]);
        }

        // Default error message
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => __('auth.failed'),
            ]);
    }
}
