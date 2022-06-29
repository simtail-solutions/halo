<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'email' => $request->email
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

        $response = $mailchimp->lists->setListMember(config('services.mailchimp.lists.test'), $request->email, [
            "email_address" => $request->email,
            "status_if_new" => "subscribed",
            "merge_fields" => [
                    "FNAME" => $request->firstname,
                    "LNAME" => $request->lastname,
                    "PHONE" => $request->phone
                    ]
        ]);

        $response = $mailchimp->lists->updateListMemberTags(config('services.mailchimp.lists.test'), $request->email, [
            "tags" => [["name" => "EmailLink", "status" => "active"]],
        ]);


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
