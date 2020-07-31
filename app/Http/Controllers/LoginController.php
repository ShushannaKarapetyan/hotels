<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'resetPasswordForm', 'resetPassword']);
    }

    /**
     * @return Factory|View
     */
    public function resetPasswordForm()
    {
        return view('auth.reset_password');
    }

    /**
     * @param PasswordUpdateRequest $request
     * @return RedirectResponse|Redirector
     */
    public function resetPassword(PasswordUpdateRequest $request)
    {
        $admin = $this->guard()->user();

        $admin->password = bcrypt($request->password);
        $admin->save();

        flash('Password has been successfully changed.', 'success');

        return redirect('/');
    }
}
