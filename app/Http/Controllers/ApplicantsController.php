<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Applicant;

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
        return view('applicants.create')->with('applicants', Applicant::all())->with('applications', Application::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateApplicantRequest $request)
    {
        $applicant = Applicant::create([
            'apptitle' => $request->apptitle,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            // 'status' => $request->status,
            // 'dependants' => $request->dependants,
            // 'streetaddress' => $request->streetaddress,
            // 'suburb' => $request->suburb,
            // 'state' => $request->state,
            // 'postcode' => $request->postcode,
            'phone' => $request->phone,
            'email' => $request->email,
            // 'DOB' => $request->DOB,
            // 'currentDL' => $request->currentDL,
            // 'DLnumber' => $request->DLnumber,
            // 'MCnumber' => $request->MCnumber,
            // 'occupation' => $request->occupation,
            // 'employername' => $request->employername,
            // 'employercontactnumber' => $request->employercontactnumber
        ]);
        dd($request->all());
        //return redirect(route('applications.create', $applicant->id));
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
