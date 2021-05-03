@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-body">
<form action="{{ route('users.update-profile') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <form-group>
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    </form-group>
                    
                    <form-group>
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    </form-group>

                    <form-group>
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role" value="{{ $user->role }}">
                            <option value="referrer">Referrer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </form-group>

                    <form-group>
                        <label for="businessName">Business Name</label>
                        <input type="text" class="form-control" name="businessName" id="businessName" value="{{ $user->businessName }}">
                    </form-group>

                    <form-group>
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                    </form-group>

                    <button type="submit" class="btn btn-success">Update Profile</button>
                    
                    </form>
</div>
</div>

@endsection

