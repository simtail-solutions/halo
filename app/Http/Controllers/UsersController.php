<?php

namespace App\Http\Controllers;
use DB;


use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Application;
use App\Models\Applicant;
use App\Http\Requests\Users\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // index.blade.php
        return view('users.index')
            ->with('users', User::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Application $applications, Applicant $applicants, Request $request)
    {
        // if (Application::where('user_id', $user->id)->exists()) {
        //     $applications = 'true';
        // }
        // Application::where(function($query) { 
        //     $query->has('user_id');
        // })->find(1);
        //$application = $applicant->application()
        //$applications = $user->application();

        // public function currentUser(Request $request){
        //     $thisUser = $request->input('id');
        //   }

        //$thisUser = Input::get('id');
        $thisUser = $request->input('id');

        $applications = DB::table('applications')
                ->where('user_id', '=', '%' . $thisUser . '%')
                ->get();

        return view('users.profile')
        ->with('user', $user)
        ->with('applicants', Applicant::all())
        ->with('applications', Application::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.update-profile')->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        // update.blade.php
        $user = auth()->user();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'businessName' => $request->businessName,
            'phone' => $request->phone
        ]);

        session()->flash('success', 'User updated successfully');

        return redirect()->back();
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
