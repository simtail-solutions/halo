@extends('layouts.app')

@section('content')
<style>

@media print {
    .noprint { display: none; }
    .col-md-9 { width: 100%; }
}
    
</style>


<div class="row">
<div class="col-md-9">
<div class="card">
<div class="card-header">
<div class="d-flex justify-content-between">
<h2>Application Details</h2>
<a class="btn btn-secondary noprint" href="/applications">Back to all applications</a>
</div>
</div>
<div class="card-body">
<p>Referred by: @if (isset($application->user->businessName)) 
                     {{ $application->user->businessName }} 
                @else
                    {{ $application->user->name }}
                @endif</p>
<table class="table table-striped">
<tbody>
<thead>
<tr>
<th scope="row" class="text-uppercase">Finance Required</th>
</tr>
</thead>
<tr>
<th scope="col">Dental Treatment Cost</th>
<td>{{ $application->loanAmount }}</td>
</tr>
<tr>
<th scope="col">Loan Term</th>
<td>{{ $application->loanTerm }}</td>
</tr>
<tr>
<th scope="col">Repayment Frequency</th>
<td>{{ $application->frequency }}</td>
</tr>
<tr>
<th scope="row" class="text-uppercase">Applicant Details</th>
</tr>
<tr>
<th>Name</th>
<td>{{$application->applicant->apptitle}} {{$application->applicant->firstname}} {{$application->applicant->middlename}} {{$application->applicant->lastname}} </td>
</tr>
<tr>
<th scope="col">Address</th>
<td>{{$application->applicant->streetaddress}} {{$application->applicant->suburb}} {{$application->applicant->state}} {{$application->applicant->postcode}}</td>
</tr>
<tr>
<th scope="col">Date of Birth</th>
<td>{{$application->applicant->birth_day}} / {{$application->applicant->birth_month}} / {{$application->applicant->birth_year}}</td>
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
<td>{{$application->applicant->phone}}</td>
</tr>
<tr>
<th scope="col">Email</th>
<td>{{$application->applicant->email}}</td>
</tr>
<tr>
<th scope="col">Drivers Licence Number</th>
<td>{{$application->applicant->currentDL}}
    {{$application->applicant->DLnumber}}<br>
    <a href="{{asset('storage/'.$application->applicant->DLimage)}}" target="_blank">Copy of drivers licence</a><br>
    <span class="badge bg-danger w-50">Download to be disabled after application approved / declined / withdrawn</span>
</td>
</tr>
<tr>
<th scope="col">Medicare Number</th>
<td>{{$application->applicant->MCnumber}}
<br>
    <a href="{{asset('storage/'.$application->applicant->MCimage)}}" target="_blank">Copy of medicare card</a>
    <br>
    <span class="badge bg-danger w-75">Download to be disabled after application approved / declined / withdrawn</span></td>
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
<td>{{$application->resTimeY}} years, {{$application->resTimeM}} months</td>
</tr>
<tr>
<th scope="col">Previous addresses</th>
<td>Show previous addresses here (if applicable)</td>
</tr>
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
<td>{{$application->empTimeY}} years, {{$application->empTimeM}} months</td>
</tr>
<tr>
<th scope="col">Previous Employment</th>
<td>Show previous employment here (if applicable)</td>
</tr>
<tr>
<th scope="row" class="text-uppercase">Income</th>
<td></td>
</tr>
<tr>
<th scope="col">Applicants Income</th>
<td>{{$application->income}} / {{$application->incomeFreq}}</td>
</tr>
@if(isset($application->partnerIncome))
<tr>
<th scope="col">Partners Income</th>
<td>{{$application->partnerIncome}} / {{$application->partnerIncomeFreq}}</td>
</tr>
@endif
<tr>
<th scope="col">Rent / Mortgage</th>
<td>{{$application->rentMortgageBoard}} / {{$application->rentFreq}}</td>
</tr>
<tr>
<th scope="col">Shared?</th>
<td>{{$application->rentShared}}</td>
</tr>
<tr>
<th scope="row" class="text-uppercase">Other Debts</th>
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
    {{ $creditCard->creditLimit }}   
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
    {{ $personalLoan->balance }}  
  </td>
  <td>
   {{ $personalLoan->repayment }}   
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
<div class="col-md-3 noprint">
<div class="my-5">
@foreach($application->categories->reverse() as $category)
@endforeach

@if($application->hasCategory($category->id)) 
<h3>Application Status</h3>
<h4>{{ $category->name }}</h4>
<p>&nbsp;</p>                     
@endif 

@if ($category->name === "Incomplete")
<button class="btn btn-primary">Send to client</button>
@endif
              
@if ($category->name !== "Incomplete")
<p><button class="btn btn-primary"onClick="window.print()">Print Application</button></p>
@endif
</div>

<div class="my-5 order-2">

<h3>Application history</h3>
<p>Created: {{ date('d M Y', strtotime($application->created_at ))}}</p>
<p>Last updated: {{ date('d M Y', strtotime($category->updated_at ))}}</p>

@foreach($application->categories as $category)

@if($application->id == $category->application_id)
@if($category->name !== "Incomplete")
<div class="card my-3">
    <div class="card-header">
        {{ $category->name }}
    </div>
    <div class="card-body">
        @if($category->name !== "Approved")
        @if($category->name !== "Submitted")
        <p><strong>Reason:</strong> {{$category->reason}}</p>
        @endif
        @endif
        @if($category->notes !== NULL)
        <p><strong>Notes:</strong> {{$category->notes}}</p>        
        @endif
        <p><strong>Date:</strong> {{ date('d M Y', strtotime($category->updated_at ))}}</p>
    </div>
</div>
@endif
@endif
@endforeach
</div>

@foreach($application->categories->reverse() as $category)
@endforeach
<div class="my-5 order-1">
@if ($category->name !== "Incomplete")
@if ($category->name !== "Approved")
<h3>Update Application</h3>
    <form class="category-update" action="{{ route('categories.store', $application) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="application_id" id="application_id" value="{{ $application->id }}" />
        <div class="form-group">
            <label for="name">Approve / Withdraw / Decline</label>
                <select class="form-control" name="name" id="name" value="">
                    <option value="Approved" id="approve">Approve</option>
                    <option value="Declined" id="decline">Decline</option>
                    <option value="Withdrawn" id="withdraw">Withdraw</option>                    
                </select>
        </div>

  
        <div class="form-group d-none" id="withdrawlReason" >
            <label for="reason">Reason for Withdrawl</label>
                <select class="form-control" name="reason"value="">
                    <option value="None">N/a</option>
                    <option value="Unable to contact customer">Unable to contact customer</option>
                    <option value="Customer not proceeding">Customer not proceeding</option>                  
                </select>
        </div>

        <div class="form-group d-none" id="declineReason" >
            <label for="reason">Reason for Decline</label>
                <select class="form-control" name="reason"value="">
                    <option value="None">N/a</option>
                    <option value="Credit score">Credit score</option>
                    <option value="Credit history">Credit history</option>
                    <option value="Banking conduct">Banking conduct</option> 
                    <option value="Affordability">Affordability</option> 
                    <option value="Other">Other</option>                   
                </select>
        </div>

        <div class="form-group">
        <label for="notes">Admin notes</label>
        <input type="text" class="form-control" name="notes" id="notes" placeholder="" value="" >
      </div>

<button type="submit" class="btn btn-primary">Update</button>
    </form>
@endif
    @endif

    



    
</div>




</div>


</div>
<script>
    $("#name").change(function() {
        if ($(this).find("option:selected").attr("id") == "approve") {
            $("#withdrawlReason").addClass("d-none");
                $("#declineReason").addClass("d-none");
        } else if ($(this).find("option:selected").attr("id") == "withdraw") {
                $("#withdrawlReason").removeClass("d-none");
                $("#declineReason").addClass("d-none");
        } else if ($(this).find("option:selected").attr("id") == "decline") {
                $("#declineReason").removeClass("d-none");
                $("#withdrawlReason").addClass("d-none");
        } 
    });

</script>


@endsection