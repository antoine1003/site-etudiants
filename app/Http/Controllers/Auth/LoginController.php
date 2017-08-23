<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jrean\UserVerification\Traits\VerifiesUsers;
use App\Http\Requests\LoginRequest;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Support\Facades\Hash;

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
    use VerifiesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    protected $maxAttempts = 5;
    protected $delayMinutes = 1; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('main.login');
    }

    public function login(LoginRequest $request)
    {
     
        if ($this->hasTooManyLoginAttempts($request)) {
            flash(trans('alerts.front.maxattempt',['minutes' => $delayMinutes]))->error();
            return redirect('/login');
        }

        $u = User::where('email', $request->email)->first();

        if (isset($u)) {
            if (Hash::check($request->password, $u->password))
            {
                $is_verified = User::where('email', $request->email)->first()->verified;
                if ($is_verified == 1) {
                    $request->session()->regenerate(); 
                    $this->clearLoginAttempts($request);
                    return redirect('/dashboard');
                }
                else
                {
                    flash(trans('alerts.front.emailpending', ['email' => md5($request->email)]));
                    return redirect('/login');
                }
            }
            else 
            {
                flash(trans('alerts.front.badcredentials'))->error();
                return redirect('/login');
            }
        }
         else 
        {
            flash(trans('alerts.front.badcredentials'))->error();
            return redirect('/login');
        }

        
    }

    public function logout()
    {
        Auth::logout();
        flash(trans('alerts.front.logoutsuccess'))->success();
        return redirect('/login');
    }

    public function resendVerification($email)
    {
        $user = User::where(DB::raw('md5(email)'),'=',$email)->first();
        if (isset($user)) {
            try {
                UserVerification::generate($user);
                UserVerification::send($user, trans('alerts.mails.mail_subject_verif'));
                flash(trans('alerts.mails.resendsuccess',['email' => $user->email]))->success();
                return redirect('/login');
            } catch (Exception $e) {
                flash($e->getMessage())->error();
                return redirect('/login');
            }
        }
        else
        {
            flash(trans('alerts.mails.resenderror',['email' => $email]))->warning();
            return redirect('/login');
        }
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(LoginRequest $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts, $this->delayMinutes
        );
    }  
}