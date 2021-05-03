@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>User Details</h2>
<a class="btn btn-secondary noprint" href="/users">Back to all users</a>
</div>
</div>
<div class="card-body">

<table class="table table-striped">
<tbody>
<tr class="m-3">
    <th scope="column">Business Name</th>
    <td>{{ $user->businessName }}</td>
</tr>
<tr class="m-3">
    <th scope="column">Contact</th>
    <td>{{ $user->name }}</td>
</tr>
<tr class="m-3">
    <th scope="column">Email</th>
    <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
</tr>
<tr class="m-3">
    <th scope="column">Phone</th>
    <td>{{ $user->phone }}</td>
</tr>
<tr class="m-3">
    <th scope="column">Role</th>
    <td>{{ $user->role }}</td>
</tr>
<tr class="m-3">
    <th scope="column">User Created</th>
    <td>{{ date('d M Y', strtotime($user->created_at ))}}</td>
</tr>
</tbody>
</table>

@foreach($applications as $application)
{{ $application->loanAmount }}
@endforeach

@endsection


