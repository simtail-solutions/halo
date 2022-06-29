@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>All Users</h2>
</div>
</div>
<div class="card-body">
<table class="table table-striped">
<thead class="m-3">
    <tr>
        <th scope="col">Business Name</th>
        <th scope="col">Industry</th>
        <th scope="col">Email</th>               
        <th scope="col">Phone</th>        
        <th scope="col">Role</th>        
        <th scope="col">Created</th>
        <th></th>    
        <th></th>     
    </tr>
</thead>
@foreach($users as $user)
<tr class="m-3">
    <td>{{ $user->businessName }}</td>
    <td>{{ $user->industry }}</td>
    <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
    <td><a href="tel:{{ $user->phone }}" class="">{{preg_replace('~.*(\d{4})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{3}).*~', '$1 $2 $3', $user->phone )}}</a></td>
    <td>{{ ucfirst(trans($user->role)) }}</td>
    <td>{{ date('d M Y', strtotime($user->created_at ))}}</td>
    <td><a href="{{ route('users.show',$user->id) }}" class="" title="Open" alt="open"><svg xmlns="http://www.w3.org/2000/svg" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16" width="24" height="24" fill="#9dd8c3">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z"></path>
</svg></a>
</td>
</tr>
@endforeach
</tbody>
</table>

{{ $users->links() }}

</div>
</div>
@include('includes.footer')
@endsection
