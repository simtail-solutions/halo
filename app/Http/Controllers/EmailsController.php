<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Notification;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\Category;
use App\Models\Email;
use App\Models\Update;
use App\Models\User;

use App\Notifications\FinanceApplicationForm;
use App\Notifications\ApplicationSent;
use App\Notifications\LinkToYourFinanceApplication;
use App\Notifications\ApplicationLink;

use App\Http\Requests\CreateEmailRequest;

use MailchimpMarketing\ApiClient;

class EmailsController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmailRequest $request, Application $application, Category $category)
    {
        $applicant = Applicant::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'treatmentcost' => $request->treatmentcost,
            'dentist' => $request->dentist
        ]);

        $application = $applicant->application()->create([
            'applicant_id' => $applicant->id,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'api_token' => bin2hex(openssl_random_pseudo_bytes(10))
        ]);

        $update = $application->updates()->create([
            'application_id' => $application->id,
            'category_id' => $request->category_id
        ]);

        // Add to Mailchimp
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us13'
        ]);

        $subscriber_hash = md5(strtolower($request->email));

        try {

            $response = $mailchimp->lists->setListMember(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "email_address" => $request->email,
                "status_if_new" => "subscribed",
                "merge_fields" => [
                        "FNAME" => $request->firstname,
                        "LNAME" => $request->lastname,
                        "PHONE" => $request->phone,
                        "TCOST" => $request->treatmentcost,
                        "DNAME" => $request->dentist
                        ]
            ]);

            $response = $mailchimp->lists->updateListMemberTags(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "tags" => [["name" => "EmailLink", "status" => "active"]],
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

        $applicant->save();
        $application->save();
        $update->save();

        $application->applicant->notify(new FinanceApplicationForm($application, $applicant));
        $application->user->notify(new ApplicationSent($application));

        \Notification::route('mail', config('mail.from.address'))->notify(new ApplicationLink($application, $applicant));

        return View('emails.next');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
