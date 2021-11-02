@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-body">
<table class="table table-striped">
<thead class="m-3">
    <tr>
        <th scope="col">Business Name</th>
        <th scope="col">Contact Name</th>
        <th scope="col">Email</th>               
        <th scope="col">Phone</th>        
        <th scope="col">Role</th>        
        <th scope="col">Created</th>
        <th></th>         
    </tr>
</thead>
@foreach($users as $user)
<tr class="m-3">
    <td>{{ $user->businessName }}</td>
    <td>{{ $user->name }}</td>
    <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
    <td><a href="tel:{{ $user->phone }}" class="">{{preg_replace('~.*(\d{4})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{3}).*~', '$1 $2 $3', $user->phone )}}</a></td>
    <td>{{ ucfirst(trans($user->role)) }}</td>
    <td>{{ date('d M Y', strtotime($user->created_at ))}}</td>
    <td><a href="/users/profile/{{ $user->id }}" class="btn btn-primary">Open</a></td>
</tr>
@endforeach
</tbody>
</table>

{{ $users->links() }}

</div>
</div>
@include('includes.footer')
@endsection
