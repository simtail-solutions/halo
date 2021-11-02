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
    <td>{{ ucfirst(trans($user->role)) }}</td>
</tr>
<tr class="m-3">
    <th scope="column">User Created</th>
    <td>{{ date('d M Y', strtotime($user->created_at ))}}</td>
</tr>
</tbody>
</table>
<table class="table table-striped">
<thead class="m-3">
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Name</th>               
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Updated</th>
        <th scope="col">Amount</th>      
        <th scope="col"></th>
    </tr>
</thead>
<tbody>

@foreach($applications as $application)
@if ($application->user_id === $user->id)

    <tr class="m-3 {{ isset($application->category->name) ? $application->category->name : 'Not specified' }}">
        <td>{{ date('d M Y', strtotime($application->created_at ))}}</td>
        <td>
            {{  $application->applicant->apptitle }} {{  $application->applicant->firstname }} {{  $application->applicant->lastname }}
                </td>
        <td>{{ $application->applicant->phone }} </td>
        <td>{{ $application->applicant->email }} </td>
        <td>{{ isset($application->category->name) ? $application->category->name : 'Not specified' }}</td>
        <td>{{ date('d M Y', strtotime($application->updated_at ))}}</td>
        <td>{{"$ " . number_format($application->loanAmount, 0)  }}</td>
        <td><a href="/applications/{{ $application->api_token }}" class="btn btn-primary">Open</a></td>
    </tr>
  

@endif

@endforeach




</tbody>
</table>

<script>

window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});

</script>


@include('includes.footer')
@endsection


