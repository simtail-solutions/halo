@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between m-3">
    <div class="d-flex w-50">
<form class="w-100" action="" method="GET" role="search">
                  <input type="text" class="form-control" name="search" placeholder="Search by Last Name, Phone Number, Email Address or Referring Business" value="{{ request()->query('search') }}">
                  <div class="input-group-addon d-none">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                  </div>
                </form>
                <span class="badge bg-primary rounded-circle m-1 p-2" data-toggle="tooltip" title="Include spaces when search Phone Numbers #### ### ###" data-placement="right" >?</span>
                </div>
    <a href="{{ route('applications.create') }}" class="btn btn-success">New Application</a>
</div>
<div class="d-flex justify-content-between m-3">
    <a href="?search="  class="btn btn-primary filter-button all-apps">All Applications</a>
    <a href="?search=incomplete" class="btn btn-secondary incc">Incomplete</a>
    <a href="?search=submitted" class="btn btn-secondary filter-button submitted">Submitted</a>
    <a href="?search=declined"  class="btn btn-secondary filter-button declined">Declined</a>
    <a href="?search=withdrawn"  class="btn btn-secondary filter-button wthdrwn">Withdrawn</a>
    <a href="?search=approved"  class="btn btn-secondary filter-button aproved">Approved</a>
</div>
<div class="card card-default">

@if($applications->count() > 0) 
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
        @if(auth()->user()->isAdmin())
        <th scope="col">Referred By</th> 
        @endif       
        <th scope="col"></th>
    </tr>
</thead>
<tbody>


@foreach($applications->reverse() as $application)
@if(auth()->user()->isAdmin() or auth()->user()->id == $application->user_id)

    <tr class="m-3 {{ isset($application->category->name) ? $application->category->name : '' }}">
        <td>{{ date('d M Y', strtotime($application->created_at ))}}</td>
        <td>
            {{  $application->applicant->apptitle }} {{  $application->applicant->firstname }} {{  $application->applicant->lastname }}
                </td>
        <td>{{ $application->applicant->phone }} </td>
        <td>{{ $application->applicant->email }} </td>
        <td> {{ isset($application->category->name) ? $application->category->name : 'Not specified' }}  </td>
        <td>{{ date('d M Y', strtotime($application->updated_at ))}}</td>
        <td>{{"$ " . number_format($application->loanAmount, 0)  }}</td>
        @if(auth()->user()->isAdmin())
        <td><a href="/users/profile/{{ $application->user->id }}">{{ $application->user->businessName }}</a></td>
        <td><a href="/applications/{{ $application->api_token }}" class="btn btn-primary">Open</a></td>
        @endif
    </tr>
    
  @endif
@endforeach
</tbody>
</table>
 {{ $applications->appends(['search' => request()->query('search') ])->links() }}
<script>

	// jQuery(document).ready(function($) {
    //     $('.inc').click(function() {
    //         $('.Incomplete').removeClass('d-none');
    //         $('.Submitted').addClass('d-none');
    //         $('.Declined').addClass('d-none');
    //         $('.Withdrawn').addClass('d-none');
    //         $('.Approved').addClass('d-none');
    //         });
    //     $('.sub').click(function() {
    //         $('.Incomplete').addClass('d-none');
    //         $('.Submitted').removeClass('d-none');
    //         $('.Declined').addClass('d-none');
    //         $('.Withdrawn').addClass('d-none');
    //         $('.Approved').addClass('d-none');
    //         });
    //     $('.dec').click(function() {
    //         $('.Incomplete').addClass('d-none');
    //         $('.Submitted').addClass('d-none');
    //         $('.Declined').removeClass('d-none');
    //         $('.Withdrawn').addClass('d-none');
    //         $('.Approved').addClass('d-none');
    //         });
    //     $('.wth').click(function() {
    //         $('.Incomplete').addClass('d-none');
    //         $('.Submitted').addClass('d-none');
    //         $('.Declined').addClass('d-none');
    //         $('.Withdrawn').removeClass('d-none');
    //         $('.Approved').addClass('d-none');
    //         });
    //     $('.apr').click(function() {
    //         $('.Incomplete').addClass('d-none');
    //         $('.Submitted').addClass('d-none');
    //         $('.Declined').addClass('d-none');
    //         $('.Withdrawn').addClass('d-none');
    //         $('.Approved').removeClass('d-none');
    //         });
    //     $('.all-apps').click(function() {
    //         $('.Incomplete').removeClass('d-none');
    //         $('.Submitted').removeClass('d-none');
    //         $('.Declined').removeClass('d-none');
    //         $('.Withdrawn').removeClass('d-none');
    //         $('.Approved').removeClass('d-none');
    //         });
    //     });
	
	// enable tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

</script>
@endif
</div>
@include('includes.footer')
@endsection

