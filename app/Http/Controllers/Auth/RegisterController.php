<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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

        $subscriber_hash = md5(strtolower($data['email']));

        try {

            $response = $mailchimp->lists->setListMember(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "email_address" => $data['email'],
                "status_if_new" => "subscribed",
                "merge_fields" => [
                        "FNAME" => $data['name'],
                        "PHONE" => $data['phone'],
                        "BNAME" => $data['businessName']
                        ]
            ]);

            $response = $mailchimp->lists->updateListMemberTags(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "tags" => [["name" => $data['industry'], "status" => "active"]],
            ]);

        } catch (\GuzzleHttp\Exception\ClientException $e)  {
            /**
             * be wary that mailchimp rejects emails like testing@testing.com.au and dont provide very descriptive warnings. it
             * wasnt until I added a try/catch block and outputted the response that I was able to see the error message. until
             * then all we got was a 400 error which was truncated and it broke the flow of the application.
             * 
             * uncomment the below if you need to debug mailchimp
             */

            Log::warning('Mailchimp Error: ' . $e->getResponse()->getBody()->getContents());
            
            //echo '<pre>' . var_export($e->getResponse()->getBody()->getContents()).'</pre>';
            //$errors[] = $e->getMessage();
        }

        return $user;
       
    }
}
