@extends('layouts.app')

@section('content')
<style>

@media print {
    .noprint { display: none; }
    .col-md-9 { width: 100%; }
    #noprint { display: none; }
}
    
</style>


<div class="row">
<div class="col">
<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>Application Details</h2>
<a class="btn btn-lg btn-info noprint" href="{{ route('applications.index') }}">Back to all applications</a>
</div>
</div>
<div class="card-body">
<p><a href="{{ route('users.show', $application->user->id ) }}" class="">
                Referred by: @if (isset($application->user->businessName)) 
                     {{ $application->user->businessName }} 
                @else
                    {{ $application->user->name }}
                @endif</a></p>
<table class="table table-striped">
<tbody>
<thead>
<tr>
<th scope="row" class="text-uppercase">Finance Required</th>
</tr>
</thead>
<tr>
<th scope="col">Dental Treatment Cost</th>
<td>
@if(isset($application->loanAmount))    
{{ $application->loanAmount   }}
@else
Not specified
@endif
</td>
</tr>
<tr>
<th scope="row" class="text-uppercase">Applicant Details</th>
</tr>
<tr>
<th>Name</th>
<td>{{$application->applicant->apptitle}} {{$application->applicant->firstname}} {{$application->applicant->lastname}} </td>
</tr>
<tr>
<th scope="col">Address</th>
<td>{{$application->applicant->streetaddress}} {{$application->applicant->suburb}} {{$application->applicant->state}} {{$application->applicant->postcode}}</td>
</tr>
<tr>
<th scope="col">Date of Birth</th>
<td>{{$application->applicant->birth_day}} {{$application->applicant->birth_month}} {{$application->applicant->birth_year}}</td>
</tr>
<tr>
<th scope="col">Number of Dependants</th>
<td>{{$application->applicant->dependants}}</td>
</tr>
<tr>
<th scope="col">Marital Status</th>
<td>{{$application->applicant->status}}</td>
</tr>
<tr>
<th scope="col">Mobile Number</th>
<td><a href="tel:{{$application->applicant->phone}}" class="">{{preg_replace('~.*(\d{4})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{3}).*~', '$1 $2 $3', $application->applicant->phone)}}</a></td>
</tr>
<tr>
<th scope="col">Email</th>
<td><a href="mailto:{{ $application->applicant->email }}" class="">{{$application->applicant->email}}</a></td>
</tr>
<tr>
<th scope="col">Drivers Licence Number</th>
<td>{{ isset($application->applicant->DLnumber) ? $application->applicant->DLnumber : 'No Drivers license'}}
@if(isset($application->applicant->DLimage))
<span class="supporting" style="float:right;">
<a href="{{asset('storage/'.$application->applicant->DLimage)}}" target="_blank">
    <img src="{{asset('storage/'.$application->applicant->DLimage)}}" alt="Drivers License" style="border-radius:25px;max-height:250px;">
</a>
</span>    
    @endif
</td>
</tr>
<tr>
<th scope="col">Medicare Number</th>
<td>{{$application->applicant->MCnumber}}
    @if(isset($application->applicant->MCimage))
<span class="supporting" style="float:right;">
        <a href="{{ asset('storage/'.$application->applicant->MCimage)}}" target="_blank">
            <img src="{{ asset('storage/'.$application->applicant->MCimage)}}" title="medicare image" style="border-radius: 25px; max-height:250px;"/>
</a>
</span>
@endif</td>
</tr>
<tr>
<th scope="col">Employment Status</th>
<td>{{$application->employment}}</td>
</tr>
<tr>
<th scope="col">Residential Type</th>
<td>{{$application->residentialType}}</td>
</tr>
<tr>
<th scope="col">Time at current address</th>
<td>{{$application->resTimeY}} {{ isset($application->resTimeM) ? $application->resTimeM : '' }}</td>
</tr>
@if(isset($application->otherAddress))
<tr>    
<th scope="col">Previous addresses</th>
<td>{{ $application->otherAddress }}</td>
</tr>
@endif
<tr>
<th scope="col">Current Occupation</th>
<td>{{$application->applicant->occupation}}</td>
</tr>
<tr>
<th scope="col">Employer Name</th>
<td>{{$application->applicant->employername}}</td>
</tr>
<tr>
<th scope="col">Employer Contact number</th>
<td>{{$application->applicant->employercontactnumber}}</td>
</tr>
<tr>
<th scope="col">Time with current employer</th>
<td>{{$application->empTimeY}} {{ isset($application->empTimeM) ? $application->empTimeM : '' }}</td>
</tr>
@if(isset($application->prevOccupation))
<tr>
<th scope="col">Previous Employment</th>
<td>{{ $application->prevOccupation }} - {{$application->prevEmployer}}, {{$application->prevEmployerTimeY}} {{$application->prevEmployerTimeM}}</td>
</tr>
@endif
<tr>
<th scope="row" class="text-uppercase">Income</th>
<td></td>
</tr>
<tr>
<th scope="col">Applicants Income</th>
<td>{{ $application->income }} / {{$application->incomeFreq}}</td>
</tr>
@if(isset($application->partnerIncome))
<tr>
<th scope="col">Partners Income</th>
<td>{{ $application->partnerIncome }} / {{$application->partnerIncomeFreq}}</td>
</tr>
@endif
@if(isset($application->applicant->payslip1))
<tr>
<th scope="col">Payslips</th>
<td>    
<span class="supporting" style="padding-right: 15px;">
        <a href="{{ asset('storage/'.$application->applicant->payslip1)}}" target="_blank">
            View Payslip
</a>
</span>
@if(isset($application->applicant->payslip2))
|<span class="supporting" style="padding-left: 15px;">
        <a href="{{ asset('storage/'.$application->applicant->payslip2)}}" target="_blank">
            View Payslip
</a>
</span>
@endif
</td>
</tr>
@endif
<tr>
<th scope="col">Rent / Mortgage</th>
<td>{{ $application->rentMortgageBoard   }} / {{$application->rentFreq}}</td>
</tr>
<tr>
<th scope="col">Shared?</th>
<td>{{$application->rentShared}}</td>
</tr>
<tr>
<th scope="row" class="text-uppercase">Other Debts</th>
<td></td>
</tr>
<tr>
<th scope="col">Credit Cards</th>
<td></td>
</tr>
<tr>
<td colspan="2">
@if (count($application->creditCards) > 0)
    <table class="table">
    <thead>
    <th>Finance Company</th>
    <th>Credit Limit</th>
    <th>Consolidate?</th>
    </thead>
    <tbody>
    @foreach($application->creditCards as $creditCard)
    <tr>
    <td>
    {{ $creditCard->financeCompany }}
    </td>
    <td>
    {{"$ " . number_format($creditCard->creditLimit, 0)  }}   
    </td>
    <td>
    {{ $creditCard->consolidate }}
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>

    @else

    <div>No credit cards to show</div>
    @endif
    </td>
</tr>

<tr>
<th scope="col">Personal Loans</th>
<td></td>
</tr>
<tr>
<td colspan="2">
@if (count($application->personalLoans) > 0)
<table class="table">
<thead>
<th>Finance Company</th>
<th>Balance</th>
<th>Repayment</th>
<th>Frequency</th>
<th>Consolidate?</th>
<th>Joint Loan?</th>
</thead>
<tbody>
@foreach($application->personalLoans as $personalLoan)
<tr>
  <td>
    {{ $personalLoan->financeCompany}} 
  </td>
  <td>
  {{"$ " . number_format($personalLoan->balance, 0)  }}  
  </td>
  <td>
  {{"$ " . number_format($personalLoan->repayment, 0)  }}   
  </td>
  <td>
    {{ $personalLoan->frequency }}
  </td>
  <td>
    {{ $personalLoan->consolidate }}
  </td>
  <td>
    {{ $personalLoan->joint }}    
</td>
</tr>
@endforeach
</tbody>
</table>

@else

<div>No personal loans to show</div>
@endif
</td>
</tr>
<tr>
<th scope="col">Mortgages</th>
<td></td>
</tr>
<tr>
<td colspan="2">
@if (count($application->mortgages) > 0)

<table class="table">
<thead>
<th>Finance Company</th>
<th>Balance</th>
<th>Repayment</th>
<th>Frequency</th>
<th>Investment Property?</th>
<th>Joint Loan?</th>
</thead>
<tbody>
@foreach($application->mortgages as $mortgage)
<tr>
  <td>
  {{ $mortgage->financeCompany }}  
  </td>
  <td>
  {{ $mortgage->balance }}    
  </td>
  <td>
  {{ $mortgage->repayment }}
  </td>
  <td>
  {{ $mortgage->frequency }}
  </td>
  <td>
  {{ $mortgage->investmentProperty }}
  </td>
  <td>
   {{ $mortgage->joint }}   
</td>
</tr>
@endforeach
</tbody>
</table>

@else

<div>No mortgages to show</div>
@endif
</td>
</tr>
</tbody>
</table>

</div>
</div>

</div>
<div id="noprint" class="col-md-3 noprint">
<div class="my-3">

<h3>Application Status: <span class="application-status">{{ $application->category->name }}</span></h3>
<p>&nbsp;</p>                     
 

@if ($application->category->name === "Incomplete")
<form class="" action="{{-- {{ route('application.resendEmail', $application->api_token) }} --}}" method="POST" enctype="multipart/form-data">
@csrf
@method ('GET')
<button class="btn btn-info" type="submit">Send to client</button>
</form>
<!--a href="/applications/{{ $application->api_token }}/edit">Update Application</a-->
@endif
              
@if ($application->category->name !== "Incomplete")
<p><button class="btn btn-info"onClick="window.print()">Print Application</button></p>
@endif
</div>

<div class="my-5 order-2">

<h3>History</h3>
<p class="application-history">Created: {{ date('d M Y', strtotime($application->created_at ))}}<br>
Last updated: {{ date('d M Y', strtotime($application->updated_at ))}}</p>

@foreach($application->updates->reverse() as $update)

@if($application->id == $update->application_id)
@if($application->category->name !== "Incomplete")
<div class="card my-3">
    <div class="card-header category-update-header">
        {{ $update->category->name }}
    </div>
    <div class="card-body">
        @if($application->category->name !== "Approved")
        @if($application->category->name !== "Submitted")
        <p><strong>Reason:</strong> @if($application->category->name == "Declined") {{ $update->reasonDe }} @endif
        @if($application->category->name == "Withdrawn") {{ $update->reasonWd }} @endif</p>
        @endif
        @endif
        @if($update->notes !== NULL)
        <p><strong>Notes:</strong> {{$update->notes}}</p>        
        @endif
        <p><strong>Date:</strong> {{ date('d M Y', strtotime($update->created_at ))}}</p>
    </div>
</div>
@endif
@endif
@endforeach
</div>

@foreach($application->updates->reverse() as $update)
@endforeach
<div class="my-5 order-1">
@if ($application->category->name !== "Incomplete")
@if ($application->category->name !== "Approved")
<h3>Update Status</h3>
    <form class="category-update application-form" action="{{ route('updates.store', $application, $category ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method ('PUT')
    <input type="hidden" name="application_id" id="application_id" value="{{ $application->id }}" />
        <div class="form-group my-1">
            <label for="category_id">Approve / Withdraw / Decline</label>
                <select class="form-control" name="category_id" id="category_id" value="">
                @foreach($categories->reverse()->slice(0, 3) as $category)
                    <option value="{{ $category->id }}" id="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach                   
                </select>
        </div>

        

        <div class="form-group d-none my-1" id="declineReason" >
            <label for="reasonDe">Reason for Decline</label>
                <select class="form-control" name="reasonDe" value="">
                    <option value="None">N/a</option>
                    <option value="Credit score">Credit score</option>
                    <option value="Credit history">Credit history</option>
                    <option value="Banking conduct">Banking conduct</option> 
                    <option value="Affordability">Affordability</option> 
                    <option value="Other">Other</option>                   
                </select>
        </div>

        <div class="form-group d-none my-1" id="withdrawlReason" >
            <label for="reasonWd">Reason for Withdrawl</label>
                <select class="form-control" name="reasonWd" value="">
                    <option value="None">N/a</option>
                    <option value="Unable to contact customer">Unable to contact customer</option>
                    <option value="Customer not proceeding">Customer not proceeding</option>                  
                </select>
        </div>

        <div class="form-group my-1">
        <label for="notes">Admin notes</label>
        <input type="text" class="form-control" name="notes" id="notes" placeholder="" value="" >
      </div>

<button type="submit" class="btn btn-info my-3">Update</button>
    </form>
@endif
    @endif

    



    
</div>




</div>


</div>
<script>
    $("#category_id").change(function() {
        if ($(this).find("option:selected").attr("id") == "5") {
            $("#withdrawlReason").addClass("d-none");
                $("#declineReason").addClass("d-none");
        } else if ($(this).find("option:selected").attr("id") == "4") {
                $("#withdrawlReason").removeClass("d-none");
                $("#declineReason").addClass("d-none");
        } else if ($(this).find("option:selected").attr("id") == "3") {
                $("#declineReason").removeClass("d-none");
                $("#withdrawlReason").addClass("d-none");
        } 
    });

</script>

@include('includes.footer')
@endsection