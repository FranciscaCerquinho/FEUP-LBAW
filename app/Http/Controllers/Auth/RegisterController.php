<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Google_Client;
use GuzzleHttp;
use Auth;

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
    protected $redirectTo = '/auctions';

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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'contact' => 'required|string|min:9|max:17',
            'address' => 'required|string|min:6',
            'country' => 'required|string|min:6',
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
            'firstname' => $data['firstName'],
            'lastname' => $data['lastName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'contact' => $data['contact'],
            'address' => $data['address'],
            'country' => $data['country'],
            'photo'=> 'perfil_blue.png',
            'isbanned'=> '0',
        ]);
    }

    public function googleRegister(Request $request){

        $user = User::where('email',$request->email)->first();

        if($user==null){
            $names = explode(" ", $request->input('name'));
      

            // Get $id_token via HTTPS POST.

            $id_token = $request->id;
            $CLIENT_ID ='11137190996-6ss9a8v4ucn1l65qm7dmifljuv9jecvv.apps.googleusercontent.com';
            $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
            $client->setHttpClient(new GuzzleHttp\Client(['verify'=>false]));
            $payload = $client->verifyIdToken($id_token);
       
            if ($payload) {
            $userid = $payload['sub'];
            // If request specified a G Suite domain:
            //$domain = $payload['hd'];
            } else {
                return null;
            }
            $user = User::create([
                'firstname' => $names[0],
                'lastname' => $names[1],
                'email' => $request->email,
                'password' => $userid,
                'photo'=> $request->photo,
                'isbanned'=> '0',
            ]);
            $user->save();
            Auth::login($user);
        }
        else{
            Auth::login($user); 
        }
        return $user;
    }
}
