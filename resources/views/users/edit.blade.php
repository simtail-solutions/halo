@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
    <div class="d-flex justify-content-between">
<h2>User Profile</h2>
<a class="btn btn-lg btn-secondary noprint" href="javascript:history.back()">Back</a>
</div>
    </div>
<div class="card-body">
<form class="application-form" action="{{ route('users.update', $user->id) }}" method="POST">
@csrf
@method('PUT')

<div class="row m-3">
    <div class="col-md-6">
        <form-group>
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
        </form-group>
    </div>
<div class="col-md-6">
    <form-group>
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
    </form-group>
</div>
</div>

<div class="row m-3">
<div class="col-md-6">
    <form-group>
        <label for="businessName">Business Name</label>
        <input type="text" class="form-control" name="businessName" id="businessName" value="{{ $user->businessName }}">
    </form-group>
</div>
<div class="col-md-6">
    <form-group>
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
    </form-group>
</div>
</div>

<div class="row m-3">
    <div class="col">
        <button type="submit" class="btn btn-lg btn-info">Update</button>
    </div>
</div>

</form>
</div>
</div>
@include('includes.footer')
@endsection