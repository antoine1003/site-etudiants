<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    protected $redirectAfterVerification = '/login';
    
    protected $redirectIfVerified = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'ville' => $data['ville'],
            'password' => bcrypt($data['password']),
            'date_inscription' => Carbon::now()
        ]);
    }

    public function showRegistrationForm()
    {
        return view('main.register');
    }

    public function register(RegisterRequest $request)
    {
        
        $user = $this->create($request->all());

        event(new Registered($user));

        //$this->guard()->login($user);

        UserVerification::generate($user);

        UserVerification::send($user, trans('mails.verification.title'));

        flash(trans('alerts.mails.verification_mail_send',['usermail' => $request->email]))->success();
        //TODO : Si multilingue LaravelLocalization::getCurrentLocale().$this->redirectPath()
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
