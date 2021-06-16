@extends('layouts.app')

@section('content')
<style>
  .form-section {
    display:none;
  }
  .form-section.current {
    display: inherit;
  }
  .parsley-errors-list {
    margin: 2px 0 3px;
    padding: 0;
    list-style-type: none;
    color:red;
  }
  </style>
<div class="card card-default">
<div class="card-header">
    {{ !isset($application) ? 'Start New Application' : 'Update Application' }}
</div>
<div class="card-body">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



<form class="application-form" action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-section">
  
  <div class="row m-3 p-3 text-center">
        <p>This application should only take a few minutes and will not impact your credit score. Please ensure the application is 
        completed in full and truthfully. Halo makes borrowing more rewarding with flexible loans tailored to your budget 
        helping borrowers get ahead in life and achieve more with their money. It's fairer finance that works for everyone</p>

        <h1 class="p-5">Let's get Started!</h1>
        Referred by: {{ Auth::user()->id }} {{ Auth::user()->name }}  

  </div>
  
  <div class="row">
    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
  </div>
      
  <div class="row m-3">

    <div class="col-lg-4">
      <div class="form-group">
        <label for="loanAmount">Dental Treatment Cost</label>
        <input type="text" class="form-control" name="loanAmount" id="loanAmount" placeholder="$2,000 to $50,000" value="{{ isset($application) ? $application->loanAmount : '' }}" required >
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="loanTerm">Loan Term</label>
        <select class="form-control" name="loanTerm" id="loanTerm" value="{{ isset($application) ? $application->loanTerm : '' }}"  required>
            <option></option>
            <option value="6 mnths">6 mnths</option>
            <option value="1 year">1 year</option>
            <option value="2 years">2 years</option>
            <option value="3 years">3 years</option>
            <option value="4 years">4 years</option>
            <option value="5 years">5 years</option>
            <option value="6 years">6 years</option>
            <option value="7 years">7 years</option>
        </select>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="frequency">Repayment Frequency</label>
        <select class="form-control" id="frequency" name="frequency" value="{{ isset($application) ? $application->frequency : '' }}" required>
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly" selected="selected">Fortnightly</option>
            <option value="Monthly">Monthly</option>
        </select>
      </div>
    </div>

  </div>

  <div class="row m-3">
    <div class="col-lg-1">
      <div class="form-group">
        <label for="repayment">Title</label>
          <select class="form-control" id="apptitle"  name="apptitle" value="{{ isset($applicant) ? $applicant->apptitle : '' }}"  required>
          <option></option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
            <option value="Prof">Prof</option>
            <option value="Sir">Sir</option>
          </select>
      </div>
    </div>

    <div class="col-4">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"  value="{{ isset($applicant) ? $applicant->firstname : '' }}"  required>
      </div>
    </div>

    <div class="col-3">
      <div class="form-group">
        <label for="middlename">Middle Name</label>
        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name"  value="{{ isset($applicant) ? $applicant->middlename : '' }}" >
      </div>
    </div>

    <div class="col-4">
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"  value="{{ isset($applicant) ? $applicant->lastname : '' }}"  required>
      </div>
    </div>
      
  </div>

  <div class="row m-3">
      
    <div class="col-lg-4">
      <div class="form-group">
        <label for="dob">Date of Birth</label>
      <div class="w-100">
        <input type="text" class="form-control d-inline w-25" id="birth_day" name="birth_day" size="2" maxlength="2" placeholder="DD">
        <input type="text" class="form-control d-inline w-25" id="birth_month" name="birth_month" size="2" maxlength="2" placeholder="MM">
        <input type="text" class="form-control d-inline w-25" id="birth_year" name="birth_year" size="4" maxlength="4" placeholder="YYYY">
      </div>
      </div>            
    </div>

    <script>
        // flatpickr('#dob', {
        //     enableTime: true,
        //     enableSeconds: true
        // })
    </script>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="dependants">Number of Dependants</label>
          <select class="form-control" id="dependants" name="dependants" value="{{ isset($applicant) ? $applicant->dependants : '' }}" required>
            <option selected="selected">0</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>5+</option>
          </select>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="status">Marital Status</label>
          <select class="form-control" id="status" name="status" value="{{ isset($applicant) ? $applicant->status : '' }}" required>
            <option></option>
            <option id="single">Single</option>
            <option id="married">Married</option>
            <option id="defacto">De Facto</option>
            <option id="separated">Seperated</option>
            <option id="divorced">Divorced</option>
            <option id="widowed">Widowed</option>
          </select>
      </div>
    </div>
      
  </div>

  <script>
    $("#status").change(function() {
        if ($(this).find("option:selected").attr("id") == "married" || $(this).find("option:selected").attr("id") == "defacto") {
            $(".partner-income").removeClass("d-none");
        } else  {
                $(".partner-income").addClass("d-none");
        } 
    });

</script>

  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group">
        <label for="phone">Mobile Number</label>
        <input type="number" class="form-control" id="phone" name="phone" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="" required>
      </div>
    </div>
      
  </div>

  <div class="row m-3">
      
    <div class="col-lg-3">
      <div class="form-group" id="DLnumber">
        <label for="DLnumber">Drivers License Number (conditional)</label>
        <input type="number" class="form-control" id="DLnumber" name="DLnumber" value="{{ isset($applicant) ? $applicant->DLnumber : '' }}"  placeholder="" 
        >
      </div> 
      <div class="form-group">
      <label for="DLimage">Upload copy of Drivers Licence</label>
      <input type="file" class="form-control" name="DLimage" id="DLimage">
      </div> 
    </div>

    <div class="col-lg-3">
      <div  class="form-group">
        <label for="drivers_check">I don't have a drivers licence</label>
        <input type="checkbox" id="currentDL" name="currentDL" value="{{ isset($applicant) ? $applicant->currentDL : '' }}" >
      </div>      
    </div>

    <div class="col-lg-3">
      <div class="form-group">
        <label for="MCnumber">Medicare Card Number</label>
        <input type="number" class="form-control" id="MCnumber" name="MCnumber" value="{{ isset($applicant) ? $applicant->MCnumber : '' }}"
        placeholder="">
      </div>
      <div class="form-group">
      <label for="MCimage">Upload copy of Medicare Card</label>
      <input type="file" class="form-control" name="MCimage" id="MCimage">
      </div> 
    </div>

    <div class="col-lg-3">
      <div class="form-group">
        <label for="employment">Employment Status</label>
          <select class="form-control" id="employment" name="employment" value="{{ isset($application) ? $application->employment : '' }}" placeholder="">
            <option>Full Time</option>
            <option>Part Time</option>
            <option>Casual</option>
            <option>Self Employed</option>
            <option>Contract</option>
            <option>Pension</option>
            <option>Unemployed</option>
            <option id="centrelink">Centrelink</option>
            <option>Other</option>
          </select>
      </div>
    </div>

  </div>

  <div class="row m-3">
      
    <div class="col-lg-8">
      <div class="form-group">
        <label for="address">Street Address</label>
        <input type="text" class="form-control" id="streetaddress" name="streetaddress" value="{{ isset($applicant) ? $applicant->streetaddress : '' }}" placeholder="">
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="suburb">Suburb</label>
        <input type="text" class="form-control" id="suburb" name="suburb" value="{{ isset($applicant) ? $applicant->suburb : '' }}" placeholder="">
      </div>
    </div>

  </div>

  <div class="row m-3">

    <div class="col-lg-3">
      <div class="form-group">
        <label for="state">State</label>
        <select class="form-control" id="state" name="state" value="{{ isset($applicant) ? $applicant->state : '' }}" placeholder="">
            <option>ACT</option>
            <option>NSW</option>
            <option>NT</option>
            <option>QLD</option>
            <option>SA</option>
            <option>TAS</option>                
            <option>VIC</option>
            <option selected="selected">WA</option>
          </select>
        </div>
    </div>

    <div class="col-lg-3">
      <div class="form-group">
        <label for="postcode">Postcode</label>
        <input type="number" class="form-control" id="postcode" name="postcode" value="{{ isset($applicant) ? $applicant->postcode : '' }}" placeholder="">
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="residentialType">Residential Type</label>
          <select class="form-control" id="residentialType" name="residentialType" value="{{ isset($application) ? $application->residentialType : '' }}" placeholder="">
            <option></option>
            <option>Renting</option>
            <option>Mortgage</option>
            <option>Boarding</option>
            <option>Living with parents</option>
            <option>Own home outright</option>
            <option>Other</option>
          </select>
      </div>
    </div>

    <div class="col-lg-2">
      <div class="form-group">
        <label for="address_period">Time at address</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Years" id="resTimeY" name="resTimeY" value="{{ isset($application) ? $application->resTimeY : '' }}"  />  
          <input type="text" class="form-control" placeholder="Months" id="resTimeM" name="resTimeM" value="{{ isset($application) ? $application->resTimeM : '' }}"  />
        </div>    
      </div>
    </div>

  </div>

  <div class="row m-3">
    <p>* If current address is less than 2 years, another section will open "Previous Residential Address" below this section</p>
    <p>
          * Disclaimer and Acceptance added here 
          <span class="ml-4">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label mr-5" for="defaultCheck1">
              I have read, understood and agree to the terms
            </label>
          </span>
        </p>
        <p> 
          * if unemployed or Centerlink has been selected they wont be able to proceed past this point. A notification will explain why, but after T&C's are accepted as we want their info
        </p>
  </div>
  <div class="m-5">
<hr>
</div>
</div>

<div class="form-section">

<div class="row m-3">

      <div class="col-lg-3">
          <div class="form-group">
            <label for="occupation">Occupation</label>
            <input type="text" class="form-control" id="occupation" name="occupation" placeholder="" value="{{ isset($applicant) ? $applicant->occupation : '' }}" >
          </div>
        </div>
        
        <div class="col-lg-3">
          <div class="form-group">
            <label for="employername">Employer Name</label>
            <input type="text" class="form-control" id="employername" name="employername" placeholder="" value="{{ isset($applicant) ? $applicant->employername : '' }}" >
          </div>
        </div>

        <div class="col-lg-3">
          <div class="form-group">
            <label for="employercontactnumber">Employer Contact Number</label>
            <input type="text" class="form-control" id="employercontactnumber" name="employercontactnumber" placeholder="" value="{{ isset($applicant) ? $applicant->employercontactnumber : '' }}" >
          </div>
        </div>

      <div class="col-lg-3">
        <div class="form-group">
          <label for="empTimeCurrent">Time with current employer</label>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="years" id="empTimeY" name="empTimeY" value="{{ isset($application) ? $application->empTimeY : '' }}" />  
            <input type="text"  class="form-control" placeholder="months" id="empTimeM" name="empTimeM" value="{{ isset($application) ? $applicant->empTimeM : '' }}" />
        </div>
      </div>
      </div>

</div>

<div class="row m-3">
<p>* If current employment is less than 2 years, another section will open "Previous Employment" below this section</p>
</div>

<div class="row m-3 previous-employment d-none">

    <div class="col-lg-4">
      <div class="form-group">
        <label for="prevOccupation">Previous Occupation</label>
        <input type="text" class="form-control" id="prevOccupation" name="prevOccupation" placeholder=""  value="{{ isset($application) ? $application->prevOccupation : '' }}" >
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="prevEmployer">Previous Employer Name</label>
        <input type="text" class="form-control" id="prevEmployer" name="prevEmployer" placeholder=""  value="{{ isset($application) ? $application->prevEmployer : '' }}" >
      </div>
    </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label for="empTimePrev">Time with previous employer</label>
      <div class="input-group">
        <input type="text"  class="form-control" placeholder="years" id="prevEmployerTimeY" name="prevEmployerTimeY"  value="{{ isset($application) ? $application->prevEmployerTimeY : '' }}" />  
        <input type="text" class="form-control" placeholder="months" id="prevEmployerTimeM" name="prevEmployerTimeM"  value="{{ isset($application) ? $application->prevEmployerTimeM : '' }}"  />
    </div>
    </div>
    </div>

</div>

<div class="row m-3">
           
    <div class="col-lg-3">
      <div class="form-group">
        <label for="income">Income Amount</label>
        <input type="text" class="form-control" id="income" name="income" placeholder="" value="{{ isset($application) ? $application->income : '' }}">
      </div>
    </div>
    
    <div class="col-lg-3">
      <div class="form-group">
        <label for="incomeFreq">Income Frequency</label>
          <select class="form-control" id="incomeFreq" name="incomeFreq" placeholder="" value="{{ isset($application) ? $application->incomeFreq : '' }}">
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly">Fortnightly</option>
            <option value="Monthly">Monthly</option>
            <option value="Annually">Annually</option>
          </select>
      </div>
    </div>    

      <div class="col-lg-3 d-none partner-income">
        <div class="form-group">
          <label for="partnerIncome">Partner Income</label>
          <input type="text" class="form-control" id="partnerIncome" name="partnerIncome" placeholder="" value="{{ isset($application) ? $application->partnerIncome : '' }}">
        </div>
      </div>


      <div class="col-lg-3 d-none partner-income">
        <div class="form-group">
          <label for="partnerIncomeFreq">Partner Income Frequency</label>
            <select class="form-control" id="partnerIncomeFreq" name="partnerIncomeFreq" placeholder="" value="{{ isset($application) ? $application->partnerIncomeFreq : '' }}">
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly">Fortnightly</option>
            <option value="Monthly">Monthly</option>
            <option value="Annually">Annually</option>
            </select>
        </div>
      </div>
    
</div>

<div class="row m-3">

<div class="col-lg-4">
    <div class="form-group">
      <label for="rentMortgageBoard">Rent, Mortgage</label>
      <input type="number" class="form-control" id="rentMortgageBoard" name="rentMortgageBoard" placeholder="$" value="{{ isset($application) ? $application->rentMortgageBoard : '' }}">
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label for="rentFreq">Frequency</label>
        <select class="form-control" id="rentFreq" name="rentFreq" placeholder="" value="{{ isset($application) ? $application->rentFreq : '' }}">
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly">Fortnightly</option>
            <option value="Monthly">Monthly</option>
        </select>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label for="rentShared">Shared?</label>
        <select class="form-control" id="rentShared" name="rentShared" value="{{ isset($application) ? $application->rentShared : '' }}">
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
    </div>
  </div>

</div>

<div class="row m-3">

  <div class="col-lg-4">
    <div class="form-group">
      <label for="referenceName">Reference Name</label>
      <input type="text" class="form-control" id="referenceName" name="referenceName" placeholder="" value="{{ isset($application) ? $application->referenceName : '' }}">
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label for="referencePhone">Reference Phone</label>
      <input type="number" class="form-control" id="referencePhone" name="referencePhone" placeholder="" value="{{ isset($application) ? $application->referencePhone : '' }}">
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label for="referenceSuburb">Reference Suburb</label>
      <input type="text" class="form-control" id="referenceSuburb" name="referenceSuburb" placeholder="" value="{{ isset($application) ? $application->referenceSuburb : '' }}">
    </div>

  </div>

</div>
<div class="m-5">
<hr>
</div>

</div>

<div class="form-section">

<div class="row m-3">

<h3>Credit Cards</h3>
<p>List all credit cards - include store cards and zero balance cards.</p>


</div>


<table class="table table-striped credit-card-table">
<thead>
<th>Finance Company</th>
<th>Credit Limit</th>
<th>Consolidate?</th>
<th></th>
</thead>
<tbody id="creditCardContainer">

</tbody>
</table>
<div><a href="#" class="btn btn-info" id="addRow">Add Credit Card</a></div>

<script type="text/javascript">

    let i = 1;

    document.getElementById('addRow').onclick = function () {
    let template = `<td>
      <div class="form-group">
      <label for="financeCompany-${i}" class="visually-hidden">Finance Company name #${i}</label>
      <input type="text" class="form-control" id="financeCompany-${i}" name="creditCards[${i}][financeCompany]" value="" placeholder="Finance Company Name" />
      </div> 
      </td>
      <td>
      <div class="form-group">
      <label for="creditLimit-${i}" class="visually-hidden">Credit limit</label>
      <input type="text" class="form-control" id="creditLimit-${i}" name="creditCards[${i}][creditLimit]" value="" placeholder="$" />
      </div>  
      </td>
      <td>
      <div class="form-group">
      <label for="consolidate-${i}" class="visually-hidden">Consolidate this card?</label>
      <select class="form-control" name="creditCards[${i}][consolidate]" id="consolidate-${i}">
      <option value="yes">Yes</option>
      <option value="no">No</option>
      </select>
      </div>  
      </td>
      <td><a href="#" class="btn btn-danger rounded-circle remove fw-bold">X</a></td>`;
    let container = document.getElementById('creditCardContainer');
    let tr = document.createElement('tr');
    tr.innerHTML = template;
    container.appendChild(tr);      
    i++;
  };

  $('tbody').on('click', '.remove', function(){
        $(this).parent().parent().remove();
        i--;
      });
  
      
</script>


<div class="m-5">
<hr>
</div>

<div class="row m-3">

<h3>Personal Loans</h3>
<p>List all secured and unsecured loans.</p>

</div>

<table class="table table-striped">
<thead>
<th>Finance Company</th>
<th>Balance</th>
<th>Repayment</th>
<th>Frequency</th>
<th>Consolidate?</th>
<th>Joint Loan?</th>
<th></th>
</thead>
<tbody id="personalLoanContainer">

</tbody>
</table>
<div><a href="#" class="btn btn-info" id="addPL">Add Personal Loan</a></div>

<script type="text/javascript">

    let p = 1;

    document.getElementById('addPL').onclick = function () {
    let template = `<td>
<div class="form-group">
      <label for="financeCompanyPL-${p}" class="visually-hidden">Finance Company name</label>
      <input type="text" class="form-control" name="personalLoans[${p}][financeCompany]" id="financeCompanyPL-${p}" value="" placeholder="Finance Company Name" />
    </div> 
  </td>
<td>
<div class="form-group">
      <label for="balance-${p}" class="visually-hidden">Balance</label>
      <input type="text" class="form-control" name="personalLoans[${p}][balance]" id="balance-${p}" value="" placeholder="$" />
    </div>    
  </td>
<td>
<div class="form-group">
      <label for="repayment-${p}" class="visually-hidden">Repayment</label>
      <input type="text" class="form-control" name="personalLoans[${p}][repayment]" id="repayment-${p}" value="" placeholder="$" />
    </div>   
  </td>

<td>
<div class="form-group">
      <label for="frequency-${p}" class="visually-hidden">Frequency</label>
      <select class="form-control" name="personalLoans[${p}][frequency]" id="frequency-${p}">
        <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div></td>
<td>
<div class="form-group">
      <label for="consolidatePL-${p}" class="visually-hidden">Consolidate this loan? </label>
        <select class="form-control" name="personalLoans[${p}][consolidate]" id="consolidatePL-${p}" >
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>
    </div></td>
<td>
<div class="form-group">
      <label for="jointLoanPL-${p}" class="visually-hidden">Joint loan? </label>
        <select class="form-control" name="personalLoans[${p}][joint]" id="jointPL-${p}" >
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</td>
<td>
  <a href="#" class="btn btn-danger rounded-circle fw-bold removePL">X</a>
</td>`;
    let container = document.getElementById('personalLoanContainer');
    let tr = document.createElement('tr');
    tr.innerHTML = template;
    container.appendChild(tr);      
    p++;
  };

  $('tbody').on('click', '.removePL', function(){
        $(this).parent().parent().remove();
        p--;
      });
  
      
</script>

<div class="m-5">
<hr>
</div>

<div class="row m-3">

<h3>Mortgages</h3>
<p>List all mortgages and investment loans.</p>

</div>

<table class="table table-striped">
<thead>
<th>Finance Company</th>
<th>Balance</th>
<th>Repayment</th>
<th>Frequency</th>
<th>Investment Property?</th>
<th>Joint Loan?</th>
<th></th>
</thead>
<tbody id="mortgageContainer">

</tbody>
</table>
<div><a href="#" class="btn btn-info" id="addM">Add Mortgage Loan</a></div>

<div class="m-5">
<hr>
</div>


<script type="text/javascript">

    let m = 1;

    document.getElementById('addM').onclick = function () {
    let template = `<td>
  <div class="form-group">
      <label for="financeCompanyM-${m}" class="visually-hidden">Finance Company name</label>
      <input type="text" class="form-control" name="mortgages[${m}][financeCompany]" id="financeCompanyM-${m}" value="" placeholder="Finance Company Name" />
    </div>  
  </td>
  <td>
  <div class="form-group">
      <label for="balanceM-${m}1" class="visually-hidden">Balance</label>
      <input type="text" class="form-control" name="mortgages[${m}][balance]" id="balanceM-${m}" value="" placeholder="$" />
    </div>    
  </td>
  <td>
  <div class="form-group">
      <label for="repaymentM-${m}" class="visually-hidden">Repayment</label>
      <input type="text" class="form-control" name="mortgages[${m}][repayment]" id="repaymentM-${m}" value="" placeholder="$" />
    </div>   
  </td>
  <td>
  <div class="form-group">
      <label for="frequencyM-${m}" class="visually-hidden">Frequency</label>
      <select class="form-control" name="mortgages[${m}][frequency]" id="frequencyM-${m}">
        <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div>
  </td>
  <td>
  <div class="form-group">
      <label for="investmentProperty-${m}" class="visually-hidden">Investment Property? </label>
      <select class="form-control" name="mortgages[${m}][investmentProperty]" id="investmentProperty-${m}" >
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>
  </td>
  <td>
   <div class="form-group">
      <label for="jointM-${m}" class="visually-hidden">Joint loan? </label>
        <select class="form-control" name="mortgages[${m}][joint]" id="jointM-${m}" >
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</td>
<td>
  <a href="#" class="btn btn-danger rounded-circle fw-bold removeM">X</a>
</td>`;
    let container = document.getElementById('mortgageContainer');
    let tr = document.createElement('tr');
    tr.innerHTML = template;
    container.appendChild(tr);      
    m++;
  };

  $('tbody').on('click', '.removeM', function(){
        $(this).parent().parent().remove();
        p--;
      });
  
      
</script>





</div>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">We're Sorry...</h5>
       
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You do not qualify for funding through this portal.  We do have options tailored more to your needs, please contact us on ### to discuss.</p>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="category" id="category" value="Incomplete">
        <button type="submit" class="btn btn-primary">Save changes</button>
        
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="category" id="category" value="Submitted">

<div class="form-navigation">
<button type="button" class="previous btn btn-info float-left">Previous</button>
<button id="next" type="button"  class="next btn btn-info float-right show-modal">Next</button>
<button type="submit"  class="btn-btn success float-right">Submit</button>
</div>


                  



</form>
</div></div>
<script type="text/javascript">
                  $('.dob').datepicker({  
                    format: 'dd-mm-yyyy'
                  });
                  </script>

<script type="text/javascript">
$(function () {
  var $sections = $('.form-section');

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $sections
      .removeClass('current')
      .eq(index)
        .addClass('current');
    // Show only the navigation buttons that make sense for the current section:
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [type=submit]').toggle(atTheEnd);
  }

  function curIndex() {
    // Return the current index by looking at which section has the class 'current'
    return $sections.index($sections.filter('.current'));
  }

  // Previous button is easy, just go back
  $('.form-navigation .previous').click(function() {
    navigateTo(curIndex() - 1);
  });

  // Next button goes forward iff current block validates
  $('.form-navigation .next').click(function() {
    $('.application-form').parsley().whenValidate({
      group: 'block-' + curIndex()
    }).done(function() {
      navigateTo(curIndex() + 1);
    });
  });

  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
  $sections.each(function(index, section) {
    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
  });
  navigateTo(0); // Start at the beginning
});




</script>

@endsection

