<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function login(Request $request)
    {


        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
 //         'g-recaptcha-response' => 'required|captcha',
        ]);

        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('user.home'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));


    }
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserLoginForm()
    {

        {
            session()->remove('url.intended');
//            session(['url.intended' => url('user/index')]);
        }

        return view('layouts.site1.signin');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    protected function loggedOut(Request $request)
    {

        $this->guard('auth:user')->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/user/login');

    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/tickets/all';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }


}
