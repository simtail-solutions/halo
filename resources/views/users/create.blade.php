@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
    <div class="d-flex justify-content-between">
<h2>User Profile</h2>
<a class="btn btn-secondary noprint" href="javascript:history.back()">Back</a>
</div>
    </div>
<div class="card-body">
<form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <form-group>
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="">
                    </form-group>
                    
                    <form-group>
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="">
                    </form-group>

                    <form-group>
                        <label for="businessName">Business Name</label>
                        <input type="text" class="form-control" name="businessName" id="businessName" value="">
                    </form-group>

                    <form-group>
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="">
                    </form-group>

                    <button type="submit" class="btn btn-success my-3">Add User</button>
                    
                    </form>
</div>
</div>

@include('includes.footer')
@endsection