@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>Profile</h2>

</div>
</div>
<div class="card-body">
<div class="d-flex justify-content-between">
<a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-primary">Update Profile</a>

<a href="" class="btn btn-primary">Update Password</a>


</div>
<table class="table table-striped">
<tbody>
<tr class="m-3">
    <th scope="column">Business Name</th>
    <td>{{ Auth::user()->businessName }}</td>
</tr>
<tr class="m-3">
    <th scope="column">Contact</th>
    <td>{{ Auth::user()->name }}</td>
</tr>
<tr class="m-3">
    <th scope="column">Email</th>
    <td><a href="mailto:{{Auth::user()->email}}">{{ Auth::user()->email }}</a></td>
</tr>
<tr class="m-3">
    <th scope="column">Phone</th>
    <td>{{ Auth::user()->phone }}</td>
</tr>
<tr class="m-3">
    <th scope="column">Role</th>
    <td>{{ ucfirst(trans(Auth::user()->role)) }}</td>
</tr>
<tr class="m-3">
    <th scope="column">User Created</th>
    <td>{{ date('d M Y', strtotime(Auth::user()->created_at ))}}</td>
</tr>
</tbody>
</table>

@include('includes.footer')
@endsection