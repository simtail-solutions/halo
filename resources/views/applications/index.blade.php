@extends('layouts.app')

@section('content')
<span class="badge bg-danger w-50">Admin users can see ALL applications, Referrers can only see their own referral applications (to be implemented)</span>
<div class="d-flex justify-content-between m-3">
<form class="" action="" method="GET" role="search">
                  <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->query('search') }}">
                  <div class="input-group-addon d-none">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                  </div>
                </form>
    <a href="{{ route('applications.create') }}" class="btn btn-success">New Application</a>
</div>
<div class="d-flex justify-content-between m-3">
    <a class="btn btn-primary filter-button all-apps">All Applications</a>
    <a class="btn btn-secondary inc">Incomplete</a>
    <a class="btn btn-secondary filter-button sub">Submitted</a>
    <a class="btn btn-secondary filter-button dec">Declined</a>
    <a class="btn btn-secondary filter-button wth">Withdrawn</a>
    <a class="btn btn-secondary filter-button apr">Approved</a>
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

@foreach($applications as $application)
    <tr class="m-3 {{ $application->category }}">
        <td>{{ date('d M Y', strtotime($application->created_at ))}}</td>
        <td>
            {{  $application->applicant->apptitle }} {{  $application->applicant->firstname }} {{  $application->applicant->lastname }}
                </td>
        <td>{{ $application->applicant->phone }} </td>
        <td>{{ $application->applicant->email }} </td>
        <td>{{ $application->category }}</td>
        <td>{{ date('d M Y', strtotime($application->updated_at ))}}</td>
        <td>{{"$ " . number_format($application->loanAmount, 0)  }}</td>
        @if(auth()->user()->isAdmin())
        <td>{{ $application->user->businessName }}</td>
        <td><a href="/applications/{{ $application->id }}" class="btn btn-primary">Open</a></td>
        @endif
    </tr>
@endforeach
</tbody>
</table>
{{ $applications->links() }}
<script>

	jQuery(document).ready(function($) {
        $('.inc').click(function() {
            $('.Incomplete').removeClass('d-none');
            $('.Submitted').addClass('d-none');
            $('.Declined').addClass('d-none');
            $('.Withdrawn').addClass('d-none');
            $('.Approved').addClass('d-none');
            });
        $('.sub').click(function() {
            $('.Incomplete').addClass('d-none');
            $('.Submitted').removeClass('d-none');
            $('.Declined').addClass('d-none');
            $('.Withdrawn').addClass('d-none');
            $('.Approved').addClass('d-none');
            });
        $('.dec').click(function() {
            $('.Incomplete').addClass('d-none');
            $('.Submitted').addClass('d-none');
            $('.Declined').removeClass('d-none');
            $('.Withdrawn').addClass('d-none');
            $('.Approved').addClass('d-none');
            });
        $('.wth').click(function() {
            $('.Incomplete').addClass('d-none');
            $('.Submitted').addClass('d-none');
            $('.Declined').addClass('d-none');
            $('.Withdrawn').removeClass('d-none');
            $('.Approved').addClass('d-none');
            });
        $('.apr').click(function() {
            $('.Incomplete').addClass('d-none');
            $('.Submitted').addClass('d-none');
            $('.Declined').addClass('d-none');
            $('.Withdrawn').addClass('d-none');
            $('.Approved').removeClass('d-none');
            });
        $('.all-apps').click(function() {
            $('.Incomplete').removeClass('d-none');
            $('.Submitted').removeClass('d-none');
            $('.Declined').removeClass('d-none');
            $('.Withdrawn').removeClass('d-none');
            $('.Approved').removeClass('d-none');
            });
        });
	
	

</script>



@endif

</div>

@endsection

