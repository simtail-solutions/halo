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
<th scope="row" class="text-uppercase">Reference Details</th>
</tr>
<tr>
<th scope="col">Reference Name</th>
<td>{{$application->referenceName}}</td>
</tr>
<tr>
<th scope="col">Reference Phone</th>
<td>{{$application->referencePhone}}</td>
</tr>
<tr>
<th scope="col">Reference Suburb</th>
<td>{{$application->referenceSuburb}}</td>
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

<h3>Application Status</h3>
{{ $application->category }}
<p>&nbsp;</p>
<p><button class="btn btn-primary"onClick="window.print()">Print Application</button></p>
</div>
<div class="my-5">
@if ($application->category === "Submitted")
<h3>Update Application</h3>
    <form class="category-update" action=" " method="PUT" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="category">Approve / Withdraw / Decline</label>
                <select class="form-control" name="category" id="category" value="">
                    <option value="approve" id="approve">Approve</option>
                    <option value="decline" id="decline">Decline</option>
                    <option value="withdraw" id="withdraw">Withdraw</option>                    
                </select>
        </div>

  
        <div class="form-group d-none" id="withdrawlReason" >
            <label for="reason">Reason for Withdrawl</label>
                <select class="form-control" name="reason"value="">
                    <option value="noContact">Unable to contact customer</option>
                    <option value="notProceeding">Customer to proceeding</option>                  
                </select>
        </div>

        <div class="form-group d-none" id="declineReason" >
            <label for="reason">Reason for Decline</label>
                <select class="form-control" name="reason"value="">
                    <option value="creditScore">Credit score</option>
                    <option value="creditHistory">Credit history</option>
                    <option value="bankingConduct">Banking conduct</option> 
                    <option value="affordability">Affordability</option> 
                    <option value="other">Other</option>                   
                </select>
        </div>

<button class="btn btn-primary">Update</button>
    </form>
    <span class="badge bg-danger w-100">Update button not working yet</span>
    @endif

    @if ($application->category === "Incomplete")
    <button class="btn btn-primary">Send to client</button>
    @endif

    
</div>
<div class="my-5">
<h3>Application history</h3>
<p>Created: {{ date('d M Y', strtotime($application->created_at ))}}</p>
<p>Last updated: {{ date('d M Y', strtotime($application->updated_at ))}}</p>
</div>




</div>


</div>
<script>
    $("#category").change(function() {
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