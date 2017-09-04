<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jrean\UserVerification\Traits\VerifiesUsers;
use App\Http\Requests\LoginRequest;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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


    protected $maxAttempts = 5;
    protected $lockoutTime = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','logoutGet']);
    }

    public function showLoginForm()
    {
        return view('main.login');
    }

    public function login(LoginRequest $request)
    {
     
        if ($this->hasTooManyLoginAttempts($request)) {
            flash(trans('alerts.front.maxattempt',['minutes' => $this->lockoutTime]))->warning();
            return redirect('/login');
        }

        $this->incrementLoginAttempts($request);    

        $u = User::where('email', $request->email)->first();

        if (isset($u)) {            
            if (Hash::check($request->password, $u->password))
            {
                $is_verified = User::where('email', $request->email)->first()->verified;
                if ($is_verified == 1) {
                    //$is_blocked = User::where('email', $request->email)->first()->is_blocked;
                    if (!$u->isBlocked()) {
                        $request->session()->regenerate(); 
                        $this->clearLoginAttempts($request);
                        Auth::login($u);
                        if ($u->hasRole(['prof','eleve','parent'])) {
                            return redirect()->route('user.dashboard');
                        }
                        else
                        {
                            return redirect()->route('user.welcome',['id' => 1]);
                        }
                    }
                    else
                    {
                        $blockage = $u->getCurrentBlockage();
                        $blockageStart = Carbon::parse($blockage->time_start);
                        if ($blockage != NULL) {
                            flash(trans('alerts.front.userisblocked', ['support_mail' => config('custom_settings.mails.contact'), 'date_blocage' => $blockageStart->format('d/m/Y')]))->warning();
                        return redirect('/login');
                        }
                        
                        //return redirect('/login');
                    }
                    
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

    public function logoutGet()
    {
        Auth::logout();
        flash(trans('alerts.front.logoutsuccess'))->success();
        return redirect()->route('login');
    }   


    public function resendVerification($email)
    {
        $user = User::where(DB::raw('md5(email)'),'=',$email)->first();
        if (isset($user)) {
            try {
                UserVerification::generate($user);
                UserVerification::send($user, trans('mails.verification.title'));
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
            $this->throttleKey($request), $this->maxAttempts, $this->lockoutTime
        );
    }  
}