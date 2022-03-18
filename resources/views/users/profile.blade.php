@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>User Details</h2>
<a class="noprint" href="{{route('users.index')}}">Back to all users</a>
</div>
<div class="d-flex justify-content-end">
@if(auth()->user()->id !== $user->id)
<a class="btn btn-secondary noprint mx-2" href="{{ route('users.edit', $user->id) }}">Edit User</a>
@endif
@if(!$user->isAdmin())
                    
                    <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-success mx-2">Make Admin</button>
                    </form>

                    @elseif(auth()->user()->id !== $user->id)
                    <form action="{{ route('users.remove-admin', $user->id) }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-danger mx-2">Remove Admin</button>
                    </form>
                @endif

@if(auth()->user()->id !== $user->id)
<form action="{{ route('users.activate', $user->id) }}" method="POST">
    @csrf 
    @method('PUT')
    @if ($user->activated == 1)
    <button type="submit" class="btn btn-primary users-inactive" alt="Deactivate User" title="Deactivate user" name="activated" id="activated" value="0">
        Deactivate User
    </button>
    @else
    <button type="submit" class="btn btn-info users-inactive" alt="Activate User" title="Activate user" name="activated" id="activated" value="1">
        Activate User
    </button>
    @endif
</form>
@endif
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
    <th scope="column">Industry</th>
    <td>{{ $user->industry }}</td>
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

<tr class="m-3">
    <th scope="column">Status</th>
    <td>@if($user->activated == 1)
        Active
        @else
        <span style="font-style:italic;">Inactive</span>
        @endif
    </td>
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
    <div class="row m-3">
    <h6>Total Referrals: {{ $applications->count() }}</h6>
    </div>

@foreach($applications as $application)

<tr class="m-3 {{ isset($application->name) ? $application->name : 'Not specified' }}">
        <td>{{ date('d M Y', strtotime($application->created_at ))}}</td>
        <td>
            {{  $application->apptitle }} {{  $application->firstname }} {{  $application->lastname }}
                </td>
        <td>{{ $application->phone }} </td>
        <td>{{ $application->email }} </td>
        <td>{{ isset($application->name) ? $application->name : 'Not specified' }}</td>
        <td>{{ date('d M Y', strtotime($application->updated_at ))}}</td>
        <td>{{ $application->loanAmount  }}</td>
        <td>@if($application->deleted_at == null)
            <a href="{{ route('application.show', $application->api_token) }}" class="" alt="Open" title="Open"><svg xmlns="http://www.w3.org/2000/svg" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16" width="24" height="24" fill="#0dcaf0">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z"></path>
</svg></a>@endif</td>
    </tr>

@endforeach




</tbody>
</table>
{{ $applications->links() }}
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


