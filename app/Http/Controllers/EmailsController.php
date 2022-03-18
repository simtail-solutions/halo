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

use App\Http\Requests\CreateEmailRequest;

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
        //return view('emails.create')->with('applicants', Applicant::all())->with('applications', Application::all())->with('categories', Category::all());
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


        $applicant->save();
        $application->save();
        $update->save();

        $application->applicant->notify(new FinanceApplicationForm($application, $applicant));
        $application->user->notify(new ApplicationSent($application));

         //  Send mail to admin 
         \Mail::send('emails.create.adminMail', array( 
            'firstname' => $request['firstname'], 
            'lastname' => $request['lastname'],
            'api_token' => $application['api_token'],
            'user_business' => $application->user->businessName,
            'email' => $request['email']),  
            function($message) use ($request){ 
                $message->from($request->email); 
                $message->to('admin@admin.com', 'Admin')->subject('Application form sent to client from' . ' ' . ($request->user()->businessName)); 
                }); 


        //dd($request->all());
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

//     public function resendEmail(Applicant $applicant, Application $application) {

//         //$applicant = Applicant::all()->where('id', $id)->get();

//         Notification::send($application->applicant, new LinkToYourFinanceApplication($application, $applicant));

//         /* $applicant = Applicant::get([
//             'firstname' => $request->firstname,
//             'email' => $request->email
//         ]);

//         $application = $applicant->application()->get([
//             'applicant_id' => $request->applicant->id,
//             'user_id' => $request->applicant->user_id,
//             'category_id' => $request->category_id,
//             'api_token' => $request->api_token
//         ]);

//         $user = $application->user()->get([
//             'businessName' => $request->businessName,
//         ]);

//         $applicantFirstName = $this->applicant->firstname;
//         $referrer = $this->application->user->businessName;
//         $applyLink = $this->application->api_token;
        
//         $application->applicant->notify(new LinkToYourFinanceApplication($application, $applicant));

//         dd(request()->all());
//  */
//         session()->flash('success', 'Application link resent to customer');

//         //return redirect()->back();


//         // $applicant = Applicant::create([
//         //     'firstname' => $request->firstname,
//         //     'lastname' => $request->lastname,
//         //     'phone' => $request->phone,
//         //     'email' => $request->email
//         // ]);

//         // $application = $applicant->application()->create([
//         //     'applicant_id' => $applicant->id,
//         //     'user_id' => auth()->id(),
//         //     'category_id' => $request->category_id,
//         //     'api_token' => bin2hex(openssl_random_pseudo_bytes(10))
//         // ]);

//         // $update = $application->updates()->create([
//         //     'application_id' => $application->id,
//         //     'category_id' => $request->category_id
//         // ]);


//         // $applicant->save();
//         // $application->save();
//         // $update->save();

//         // $application->applicant->notify(new FinanceApplicationForm($application, $applicant));
//         // $application->user->notify(new ApplicationSent($application));
//     }
}
