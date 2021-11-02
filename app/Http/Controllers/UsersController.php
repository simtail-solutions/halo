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
    public function index(User $user)
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

        $thisUser = $request->input('id');

        $applications = DB::table('applications')
                ->where('user_id', '=', '%' . $thisUser . '%')
                ->get();

        return view('users.profile')
        ->with('user', $user)
        ->with('applicants', Applicant::all())
        ->with('applications', Application::paginate(10));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        // update.blade.php
        //$user = auth()->user();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'businessName' => $request->businessName,
            'phone' => $request->phone
        ]);

        $user->save();

        session()->flash('success', 'User updated successfully');

        return redirect()->back();
        
        //dd(request()->all());

        //return view('users.index'); // generates error: $user not defined
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
