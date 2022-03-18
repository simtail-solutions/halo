@extends('layouts.app')

@section('content')
<style>
    .applications-open {
        float:left;
    }

    button.applications-archive {
        background: transparent;
        border: none;
        float:left;
    }
</style>
@if(URL::current() !== route('archived-applications.index'))
<div class="d-flex justify-content-between my-3">
    <div class="d-flex w-50">
<form class="w-100" action="{{ route('applications.index') }}" method="GET" role="search">
                  <input type="text" class="form-control" name="search" placeholder="Search by Last Name, Phone Number, Email Address or Referring Business" value="{{ request()->query('search') }}">
                  <div class="input-group-addon d-none">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                  </div>
                </form>
                <div class="mx-auto p-2" data-toggle="tooltip" title="Include spaces when search Phone Numbers #### ### ###" data-placement="right" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0dcaf0" class="bi bi-question-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
</svg></div>
                </div>
    <a href="{{ route('applications.create') }}" class="btn btn-lg btn-info">New Application</a>
</div>
<form action="{{ route('applications.index') }}" method="GET" role="filter">
<div id="filter-buttons" class="d-flex justify-content-between my-3">
    <a href="?"  class="all-apps {{ (request()->query('term')) == null ? 'active' : '' }}">All Applications</a>
    <a href="?term=1" class="incc {{ (request()->query('term')) == '1' ? 'active' : '' }}">Incomplete</a>
    <a href="?term=2" class="sub {{ (request()->query('term')) == '2' ? 'active' : '' }}">Submitted</a>
    <a href="?term=3"  class="declined {{ (request()->query('term')) == '3' ? 'active' : '' }}">Declined</a>
    <a href="?term=4"  class="wthdrwn {{ (request()->query('term')) == '4' ? 'active' : '' }}">Withdrawn</a>
    <a href="?term=5"  class="aproved {{ (request()->query('term')) == '5' ? 'active' : '' }}">Approved</a>         
    
</div>

</form>
<div class="row my-3">
    <div class="col">
    @if($applications->count() < 0) 
    <h6>No results</h6>
    @elseif($applications->count() === 1)
    <h6>{{ $applications->count() }} result</h6>
    @else
    <h6>{{ $applications->count() }} results </h6>
    @endif
    </div>
</div>
@endif
<div class="card card-default">
@if($applications->count() > 0) 
<table class="table table-striped">
<thead class="m-3">
    <tr>
        <th scope="col">Created</th>
        <th scope="col">Name</th>               
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">@if(URL::current() == route('archived-applications.index')) 
            Archived
            @else
            Status
            @endif
            </th>
            @if(URL::current() !== route('archived-applications.index'))
        <th scope="col">Updated</th>
            @endif
        <th scope="col">Amount</th> 
        @if(auth()->user()->isAdmin())
        <th scope="col">Referred By</th> 
        @endif       
        <th scope="col"></th>
    </tr>
</thead>
<tbody>


@foreach($applications as $application)
@if(auth()->user()->isAdmin() or auth()->user()->id == $application->user_id)

    <tr class="m-3 {{ isset($application->name) ? $application->name : '' }}">
        <td>{{ date('d M Y', strtotime($application->created_at ))}}</td>
        <td>
            {{  $application->apptitle }} {{  $application->firstname }} {{  $application->lastname }}
                </td>
        <td>{{ $application->phone }} </td>
        <td>{{ $application->email }} </td>
        <td>@if($application->deleted_at == NULL) {{ isset($application->name) ? $application->name : 'Not specified' }} 
            @else 
            {{ date('d M Y', strtotime($application->deleted_at ))}}
            @endif</td>
            @if(URL::current() !== route('archived-applications.index'))
        <td>{{ date('d M Y', strtotime($application->updated_at ))}}</td>
            @endif
        <td>@if(isset($application->loanAmount))
            {{ $application->loanAmount  }}
            @else
            N/a
            @endif
        </td>
        @if(auth()->user()->isAdmin())
        <td><a href="/users/profile/{{ $application->id }}">{{ $application->businessName }}</a></td>
        <td class="d-flex justify-content-end">
    @if(URL::current() !== route('archived-applications.index')) 
        <a href="/applications/{{ $application->api_token }}" class="applications-open px-2" alt="View application" title="View Application"><svg xmlns="http://www.w3.org/2000/svg" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16" width="24" height="24" fill="#0dcaf0">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z"></path>
</svg></a>
@endif

@if(URL::current() == route('archived-applications.index')) 
<a href="{{route('applications.restore', $application->id) }}" alt="Restore application" title="Restore" class="px-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#3adcdc" class="bi bi-reply-fill" viewBox="0 0 16 16">
  <path d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z"/>
</svg></a>
@endif

<form action="{{ route('applications.destroy', $application->id) }}" method="POST">
    @csrf 
    @method('DELETE')

    @if(URL::current() !== route('archived-applications.index')) 
    <button type="submit" class="applications-archive" alt="Archive application" title="Achive Application">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" class="bi bi-file-earmark-minus-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6 8.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z"></path>
</svg>
    </button>

    @else
    <button type="submit" class="applications-archive" alt="Delete application" title="Delete Application">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#dc3545" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
</svg>
    </button>
@endif

</form>

</td>
        @endif
 
    </tr>
 
  @endif
@endforeach
</tbody>
</table>
@if($applications->count() > 0) 
{{ $applications->appends(['search' => request()->query('search') ])->appends(['term' => request()->query('term') ])->links() }} 
@endif

<script>

	
	// enable tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

</script>
@endif
</div>
@include('includes.footer')
@endsection

