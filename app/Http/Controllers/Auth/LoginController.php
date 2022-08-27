<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

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
        $this->validateLogin($request);


        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->attemptLogin($request)) {

            if(!auth()->user()->is_active) {

                $string_message = "User is not active !!!";
                Session::flush();
                Auth::logout();
                return redirect()->back()->withInput($request->all())->with('status', $string_message);

            }else {

                if(auth()->user()->is_logged_in == 1) {

                    $string_message = "User already logged in please contact your admin !!!";
                    Session::flush();
                    Auth::logout();
                    return redirect()->back()->withInput($request->all())->with('status', $string_message);

                }

                if ($this->attemptLogin($request)) {

                    $user_id = auth()->user()->id;
                    $user_obj = User::find($user_id);
                    $user_obj->is_logged_in = 1;
                    $user_obj->save();

                    if ($request->hasSession()) {
                        $request->session()->put('auth.password_confirmed_at', time());
                    }

                    return $this->sendLoginResponse($request);
                }

                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);

            }

        }
        
    }

    public function logout(Request $request)
    {

        $user_id = auth()->user()->id;
        $user_obj = User::find($user_id);
        $user_obj->is_logged_in = 0;
        $user_obj->save();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

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
        $this->middleware('guest')->except('logout');
    }
}
