<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin'); //If user is not logged in then he can't access this page
    }

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
        //
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
        $users = Admin::find(Auth::user()->id);
        return view('users.updatepassword',compact('users'));
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
        $this->validate($request, [
 
            'oldpassword' => 'required',
            'newpassword' => 'required',
            ]);
     
     
     
           $hashedPassword = Auth::user()->password;
     
           if (\Hash::check($request->oldpassword , $hashedPassword )) {
     
             if (!\Hash::check($request->newpassword , $hashedPassword)) {
     
                  $users =admin::find(Auth::user()->id);
                  $users->password = bcrypt($request->newpassword);
                  admin::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
     
                  session()->flash('message','password updated successfully');
                  return redirect()->back();
                }
     
                else{
                      session()->flash('message','new password can not be the old password!');
                      return redirect()->back();
                    }
     
               }
     
              else{
                   session()->flash('message','old password doesn\'t match ');
                   return redirect()->back();
                 }
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
