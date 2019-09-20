<?php

namespace Bimenu\Http\Controllers\Auth;

use Bimenu\User;
use Bimenu\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'sicil' => ['required', 'string', 'max:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Bimenu\User
     */
    protected function create(array $data)
    {
        return User::create([
            'registration_no' => $data['registration_no'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'room_floor' => $data['room_floor'],
            'room_no' => $data['room_no'],
            'seller' => $data['seller'],
            'seller_floor' => $data['seller_floor'],
            'notification_token'=>$data['notification_token'],
            'coins'=>$data['coins'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
