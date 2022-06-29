<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use MailchimpMarketing\ApiClient;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'businessName' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:10', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'abn' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'industry' => ['required', 'string'],
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'businessName' => $data['businessName'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'abn' => $data['abn'],
            'password' => Hash::make($data['password']),
            'industry' => $data['industry'],
        ]);
        
        // Add to Mailchimp
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us13'
        ]);

        $response = $mailchimp->lists->setListMember(config('services.mailchimp.lists.test'), $data['email'], [
            "email_address" => $data['email'],
            "status_if_new" => "subscribed",
            "merge_fields" => [
                    "FNAME" => $data['name'],
                    "PHONE" => $data['phone'],
                    "BNAME" => $data['businessName']
                    ]
        ]);

        $response = $mailchimp->lists->updateListMemberTags(config('services.mailchimp.lists.test'), $data['email'], [
            "tags" => [["name" => $data['industry'], "status" => "active"]],
        ]);

        return $user;
       
    }
}
