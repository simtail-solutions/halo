<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\Category;
use App\Models\Update;
use App\Models\User;
use App\Notifications\PleaseCompleteApplication;
use App\Notifications\QuickReferralSent;

use App\Http\Requests\Applicants\CreateApplicantRequest;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applicants.create')->with('applicants', Applicant::all())->with('applications', Application::all())->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateApplicantRequest $request, Application $application, Category $category, User $user)
    {
        $applicant = Applicant::create([
            'apptitle' => $request->apptitle,
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

        $application->applicant->notify(new PleaseCompleteApplication($application, $applicant));
        $application->user->notify(new QuickReferralSent($application));

         //  Send mail to admin 
         \Mail::send('applicants.create.adminMail', array( 
            'firstname' => $request['firstname'], 
            'lastname' => $request['lastname'],
            'api_token' => $application['api_token'],
            'user_business' => $application->user->businessName,
            'email' => $request['email']),  
            function($message) use ($request){ 
                $message->from($request->email); 
                $message->to('admin@admin.com', 'Admin')->subject('Quick Referral from' . ' ' . ($request->user()->businessName)); 
                }); 

        //dd($request->all());
        return View('applicants.next');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
