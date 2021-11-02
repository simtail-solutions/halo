@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>User Details</h2>
<a class="btn btn-secondary noprint" href="/users">Back to all users</a>
<a class="btn btn-secondary noprint" href="/users/profile/{{ $user->id }}/edit">Edit User</a>
</div>
</div>
<div class="card-body">

@if (count($errors))
      @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
      @endforeach
     @endif    
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('update-password.update',[$users->id,$users->slug]) }}" method="post">
           @csrf
           @method('PATCH')

                   
                      <div class="form-group">
                          <input type="password" id="oldpassword" class="form-control col-md-7 col-xs-12"  placeholder="Enter old password" name="oldpassword"> 
                      </div>

                      <div class="form-group">
                          <input type="password" id="newpassword" placeholder="Enter new password" class="form-control col-md-7 col-xs-12" name="newpassword"> 
                      </div>

                      <div class="form-group">
                          <input type="password" id="password_confirmation"  class="form-control col-md-7 col-xs-12" placeholder="Enter password confirmation"  name="password_confirmation"> 
                      </div>

                      <button type="submit" class="btn btn-primary">Update</button>
                     
                    </form>    





@include('includes.footer')
@endsection


