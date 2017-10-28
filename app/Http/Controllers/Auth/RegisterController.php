<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivationService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $activationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest');
//	 $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
	 $this->activationService = $activationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


public function register(Request $request)
{
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
        $this->throwValidationException(
            $request, $validator
        );
    }

    $user = $this->create($request->all());

    $this->activationService->sendActivationMail($user);

    return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
}


public function authenticated(Request $request, $user)
{
    if (!$user->activated) {
        $this->activationService->sendActivationMail($user);
        auth()->logout();
        return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
    }
    return redirect()->intended($this->redirectPath());
}
public function activateUser($token)
{
    if ($user = $this->activationService->activateUser($token)) {
        auth()->login($user);
        return redirect($this->redirectPath());
    }
    abort(404);
}

}
