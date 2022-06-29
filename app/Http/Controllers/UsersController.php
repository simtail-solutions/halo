<?php

namespace App\Http\Controllers;
use DB;


use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Application;
use App\Models\Applicant;
use App\Http\Requests\Users\CreateUserRequest;
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

    public function trashed(User $user) 
        {
            /**
             * Display a list of all archived applications.
             *
             * @return \Illuminate\Http\Response
             */

            // $trashed = User::withTrashed()
            // ->where('deleted_at', '!=', null)
            // ->paginate(5);

            // return view('users.index')->withUsers($trashed);

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request, User $user)
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

        $thisUser = $request->user->id;

        $applications = DB::table('applications')    
                ->where('user_id', '=', $thisUser )           
                ->join('applicants', 'applicants.id', 'applications.applicant_id')
                ->join('categories', 'categories.id', 'applications.category_id')
                ->select('applications.*', 'applicants.apptitle', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name')
                ->paginate(10);

        return view('users.profile')
        ->with('user', $user)
        ->with('applications', $applications);

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
        
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'businessName' => $request->businessName,
            'abn' => $request->abn,
            'phone' => $request->phone
        ]);

        $user->save();

        session()->flash('success', 'User updated successfully');

        return redirect()->back();
        
    }

    public function activate(User $user, Request $request)
    {
        
        
        $user->update([
            'activated' => $request->activated
        ]);

        $user->save();

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

    public function makeAdmin(User $user) 
    {
        $user->role = 'admin';

        $user->save();

        session()->flash('success', 'User made admin successfully');

        return redirect(route('users.index'));

    }

    public function removeAdmin(User $user) 
    {
        $user->role = 'referrer';

        $user->save();

        session()->flash('success', 'User admin privileges removed');

        return redirect(route('users.index'));

    }
}
