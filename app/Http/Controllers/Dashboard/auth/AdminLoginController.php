<?php

namespace App\Http\Controllers\Dashboard\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Auth;
class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('checkAuth');
    }
    public function index()
    {
        return $this->render('backend.dashboard.auth.login');
    }
    
    public function login(Request $request)
    {
         $this->validateLogin($request);

         // If the class is using the ThrottlesLogins trait, we can automatically throttle
         // the login attempts for this application. We'll key this by the username and
         // the IP address of the client making these requests into this application.
         if ($this->hasTooManyLoginAttempts($request)) {
                 $this->fireLockoutEvent($request);

                 return $this->sendLockoutResponse($request);
         }

        $usernameCheck = User::where('email', $request->email)->first();

        if($usernameCheck)
        {
            if(\Hash::check($request->password, $usernameCheck->password))
            {
                $this->guard()->login($usernameCheck);
                return redirect(url('/admin'));
            }else{
                $errors = ['password' => trans('auth.password')];
            }
        }else{
            $errors = [$this->username() => trans('auth.user_name')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        $this->incrementLoginAttempts($request);

        return redirect()->back()
                     ->withInput($request->only($this->username(), 'remember'))
                     ->withErrors($errors);
    }
}
