@extends('layouts.app')

@section('content')


<div class="card card-default">
<div class="card-header">
    {{ !isset($application->applicant) ? 'Start New Application' : 'Update Application' }}
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


@if($application->category_id !== 1)

<div class="p-5 text-center">
<div class="alert alert-danger"><h4>Sorry this link is no longer valid</h4></div>
</div>

@else

<form class="application-form" action="{{ route('applications.update', $application->api_token) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
@csrf
@method ('PUT')


<div id="intro" class="m-3 py-3 px-5">
  
  <div class="row text-center">
        <p>This application should only take a few minutes and will not impact your credit score.<br>Please ensure the application is 
        completed in full and truthfully.<p> 
        <p>Halo makes borrowing more rewarding with flexible loans tailored to your budget helping borrowers get ahead in life and achieve more with their money. <br>It's fairer finance that works for everyone</p>

        <h1 class="p-5">Let's get Started!</h1>
  

  </div>
  
 

  <div class="row">
    <div class="col d-flex justify-content-around">
      <button id="start-button" class="btn btn-lg btn-info">Start Now</button>
    </div>    
  </div>
<script>
   // Start button
document.getElementById('start-button').onclick = function () {
  $('#intro').addClass('d-none');
  $('#form-content').removeClass('d-none');
  $('.form-navigation').removeClass('d-none');

}
</script>

</div>
<div id="form-content" class="d-none">
<div class="form-section">
  

  <div class="row">
   
    @if(isset($application))
    <input type="hidden" name="application_id" id="application_id" value="{{ $application->id }}" >
    <input type="hidden" name="applicant_id" id="applicant_id" value="{{ $application->applicant_id }}" >
    @endif
  </div>
      
  <div class="row m-3">

    <div class="col-lg-3">
      <div class="form-group">
        <label class="" for="loanAmount">Dental Treatment Cost</label>
        <input type="text" class="form-control" name="loanAmount" data-type="currency" id="loanAmount" placeholder="$2,000 to $50,000 (optional)" value="{{ isset($application) ? $application->loanAmount : '' }}" >
      </div>
    </div>

    <div class="col-lg-1">
      <div class="form-group">
        <label class="" for="apptitle">Title</label>
        @if(isset($application->applicant))
        <input type="text" class="form-control"id="apptitle"  name="apptitle" value="{{ $application->applicant->apptitle }}"  >
        @endif
        @if(!isset($application->applicant))
          <select class="form-control" id="apptitle"  name="apptitle" value=" "  required>
          <option value="" disabled selected hidden> </option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Ms">Ms</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
            <option value="Prof">Prof</option>
            <option value="Sir">Sir</option>
          </select>
          @endif
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="first_name">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder=""  value="{{ isset($application) ? $application->applicant->firstname : '' }}"  required>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="last_name">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder=""  value="{{ isset($application) ? $application->applicant->lastname : '' }}"  required>
      </div>
    </div>
      
  </div>

  <div class="row m-3">
      
  <div class="col-lg-4">
      <div class="form-group">
        <label class=" " for="dob">Date of Birth</label>
      <div class="row mx-0">
        <select class="form-control d-inline col mr-1" id="birth_day" name="birth_day" required>
        <option value="" disabled selected hidden>Day</option>
        <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
        </select>
        <select class="form-control d-inline col mr-1" id="birth_month" name="birth_month" required>
            <option value="" disabled selected hidden>Month</option>
            <option>JAN</option>
            <option>FEB</option>
            <option>MAR</option>
            <option>APR</option>
            <option>MAY</option>
            <option>JUN</option>
            <option>JUL</option>
            <option>AUG</option>
            <option>SEP</option>
            <option>OCT</option>
            <option>NOV</option>
            <option>DEC</option>
          </select>
        <input type="text" class="form-control d-inline col" id="birth_year" name="birth_year" size="4" maxlength="4" placeholder="Year">
      </div>
      </div>            
    </div>


    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="dependants">Number of Dependants</label>
          <select class="form-control" id="dependants" name="dependants" value="{{ isset($applicant) ? $applicant->dependants : '' }}" required>
            <option value="" disabled selected hidden> </option>  
            <option>0</option>
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
        <label class="" for="status">Marital Status</label>
          <select class="form-control" id="status" name="status" value="{{ isset($applicant) ? $applicant->status : '' }}" required>
          <option value="" disabled selected hidden> </option>
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
      
    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="phone">Mobile Number</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ isset($application) ? $application->applicant->phone : '' }}" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($application) ? $application->applicant->email : '' }}" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="employment">Employment Status</label>
          <select class="form-control" id="employment" name="employment" value="{{ isset($application) ? $application->employment : '' }}" required>
          <option value="" disabled selected hidden></option>
          <option id="fullTime">Full Time</option>
            <option id="partTime">Part Time</option>
            <option id="casual">Casual</option>
            <option id="selfEmployed">Self Employed</option>
            <option id="contract">Contract</option>
            <option id="pension">Pension</option>
            <option id="unemployed">Unemployed</option>
            <option id="centrelink">Centrelink</option>
            <option id="other">Other</option>
          </select>
      </div>
    </div>
      
  </div>

  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group" id="DLnumber">
        <label class="" for="DLnumber">Drivers Licence Number</label>
        <input type="text" class="form-control" id="DLnumber" name="DLnumber" value="{{ isset($applicant) ? $applicant->DLnumber : '' }}"  placeholder="" 
        >
      </div> 
      <div  class="form-group">
      <input type="checkbox" id="currentDL" name="currentDL" value=""><label for="drivers_check" class="long-label"> I don't have a drivers licence</label>        
      </div>  
    </div>

    

    <div class="col-lg-6">
      <div class="form-group">
        <label class="" for="MCnumber">Medicare Card Number</label>
        <input type="text" class="form-control" id="MCnumber" name="MCnumber" value="{{ isset($applicant) ? $applicant->MCnumber : '' }}"
        placeholder="">
      </div>
    </div>

    

  </div>
  @if(isset($application->applicant))
  <div class="row m-3">

  <div class="col-lg-6">
    <div class="form-group">
        <label for="DLimage" class="DLimage file-upload-label">Upload a copy of your Drivers Licence</label>
        <input type="file" class="form-control form-control-file-upload" name="DLimage" id="DLimage">
        </div> 
      
  </div>

  <div class="col-lg-6">
    <div class="form-group">
        <label for="MCimage" class="form-label file-upload-label">Upload a copy of your Medicare Card</label>
        <input type="file" class="form-control form-control-file-upload" name="MCimage" id="MCimage">
        </div>
</div>

  </div>
  @endif

  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group">
        <label class="" for="address">Street Address</label>
        <input type="text" name="streetaddress" id="streetaddress" class="form-control" placeholder="Start typing address">
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="residentialType">Residential Type</label>
          <select class="form-control" id="residentialType" name="residentialType" value="{{ isset($application) ? $application->residentialType : '' }}" required>
            <option value="" disabled selected hidden> </option>
            <option id="renting">Renting</option>
            <option id="mort">Mortgage</option>
            <option id="boarding">Boarding</option>
            <option id="parents">Living with parents</option>
            <option id="outright">Own home outright</option>
            <option id="resOther">Other</option>
          </select>
      </div>
      <div  class="form-group d-none" id="homeowner">
        <input type="checkbox" id="isHomeowner" name="isHomeowner" value=" " ><label for="isHomeowner" class="long-label"> Applicant is a homeowner</label>
      </div> 
    </div>

    <div class="col-lg-2">
      <div class="form-group">
        <label class="" for="address_period">Duration</label>
        <div class="row mx-0">
        <select class="form-control d-inline col mr-1" id="resTimeY" name="resTimeY" required>
            <option value="" disabled selected hidden>Years</option>
            <option id="oneYear">1 yr</option>
            <option>2 yrs</option>
            <option>3 yrs</option>
            <option>4 yrs</option>
            <option id="resTimeY5">5+ yrs</option>
          </select>
          <select class="form-control d-inline col" id="resTimeM" name="resTimeM" required>
            <option value="" disabled selected hidden>Months</option>
            <option id="resTimeM0">0 mth</option>
            <option>1 mth</option>
            <option>2 mths</option>
            <option>3 mths</option>
            <option>4 mths</option>
            <option>5 mths</option>
            <option>6 mth</option>
            <option>7 mths</option>
            <option>8 mths</option>
            <option>9 mths</option>
            <option>10 mths</option>
            <option>11 mths</option>
          </select>
        </div>    
      </div>
    </div>
  </div>

  <script>

    // 0 months selected when 5+ years selected
    $("#resTimeY").change(function() {
      if ($(this).find("option:selected").attr("id") == "resTimeY5") {
          $("#resTimeM0").attr('selected', true);
      } 
    });

    $("#residentialType").change(function() {
        if ($(this).find("option:selected").attr("id") == "mort" || $(this).find("option:selected").attr("id") == "outright") {
            $("#homeowner").addClass("d-none");
        } else  {
                $("#homeowner").removeClass("d-none");
        } 
    });

</script>

    <div class="row m-3 d-none" id="previous-address">
      
    <div class="col-lg-12">
      <div class="form-group">
        <label class="" for="address">Previous Address</label>
        <input type="text" name="otherAddress" id="otherAddress" class="form-control" placeholder="Start typing previous address">
        <label class="long-label">Minimum of two years residential address required</label>
      </div>
    </div>
  </div>

  <div class="row mx-3">

      
  <span class="my-4 d-flex justify-content-center">
        
        <label id="sample" class="form-check-label mr-5" for="defaultCheck1">
          <input type="checkbox" id="acceptance" name="acceptance" value="" required>
            &nbsp;&nbsp;I have read, understood and agree to the terms
          </label>
         
        </span>
    
    
</div>
<div class="m-2">
<hr>
</div>

    <script>
    $("#resTimeY").change(function() {
        if ($(this).find("option:selected").attr("id") == "oneYear") {
            $("#previous-address").removeClass("d-none");
        } else if ($(this).find("option:selected").attr("id") !== "oneYear") {
            $("#previous-address").addClass("d-none");
        } 
    });


      $('#currentDL').click(function(){
        if($(this).prop("checked") == true){
        //alert("you checked checkbox.");
        $("#DLnumber").addClass("d-none");
        $("#DLimage").addClass("d-none");
        $(".DLimage").addClass("d-none");
      }else if($(this).prop("checked") == false){
        //alert("you unchecked checkbox.");
        $("#DLnumber").removeClass("d-none");
        $("#DLimage").removeClass("d-none");
        $(".DLimage").removeClass("d-none");
        }
    });

    $("#employment").change(function() {
        if ($(this).find("option:selected").attr("id") == "centrelink") {
          $('#next').on('click', function() {
              $('#sorry').show()
              $('.cat-submitted').remove();
              });
            } 
        });

        // shows modal box if employment criteria not met
$("#employment").change(function() {
    if ($(this).find("option:selected").attr("id") == "centrelink" || $(this).find("option:selected").attr("id") == "unemployed" || $(this).find("option:selected").attr("id") == "pension") {
      $('#next').on('click', function() {
          $('#sorry').show()
          $('.cat-submitted').remove();
          });
        } 
    });

    // modal
$('#sorry').on('shown.bs.modal', function () {
  $('#next').trigger('focus')
})

    $('#acceptance').click(function(){
        if($(this).prop("checked") == true){
        $("#next").attr('disabled', false);
        // alert("you checked checkbox.");
      }else if($(this).prop("checked") == false){
        $("#next").attr('disabled', true);
        // alert("you unchecked checkbox.");
        }
    });

    



</script>





</div>

<div class="form-section">

<div class="row m-3">

      <div class="col-lg-3">
          <div class="form-group">
            <label class="" for="occupation">Occupation</label>
            <input type="text" class="form-control" id="occupation" name="occupation" placeholder="" value="{{ isset($applicant) ? $applicant->occupation : '' }}" >
          </div>
        </div>
        
        <div class="col-lg-3">
          <div class="form-group">
            <label class="" for="employername">Employer Name</label>
            <input type="text" class="form-control" id="employername" name="employername" placeholder="" value="{{ isset($applicant) ? $applicant->employername : '' }}" >
          </div>
        </div>

        <div class="col-lg-3">
          <div class="form-group">
            <label class="" for="employercontactnumber">Employer Contact Number</label>
            <input type="text" class="form-control" id="employercontactnumber" name="employercontactnumber" placeholder="" value="{{ isset($applicant) ? $applicant->employercontactnumber : '' }}" >
          </div>
        </div>

        <div class="col-lg-3">
        <div class="form-group">
          <label for="empTimeCurrent">Duration</label>
        <div class="row mx-0">
        <select class="form-control d-inline col" id="empTimeY" name="empTimeY">
          <option value="" disabled selected hidden>Years</option>
            <option id="oneYearEmp">1 yr</option>
            <option>2 yrs</option>
            <option>3 yrs</option>
            <option>4 yrs</option>
            <option id="empTimeY5">5+ yrs</option>
          </select>
          <select class="form-control d-inline col" id="empTimeM" name="empTimeM">
            <option value="" disabled selected hidden>Months</option>
            <option id="empTimeM0">0 mth</option>
            <option>1 mth</option>
            <option>2 mths</option>
            <option>3 mths</option>
            <option>4 mths</option>
            <option>5 mths</option>
            <option>6 mth</option>
            <option>7 mths</option>
            <option>8 mths</option>
            <option>9 mths</option>
            <option>10 mths</option>
            <option>11 mths</option>
          </select>
        </div>
      </div>
      </div>

</div>

<div class="row m-3">

</div>

<div id="previous-employment" class="row m-3 previous-employment d-none">

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="prevOccupation">Previous Occupation</label>
        <input type="text" class="form-control" id="prevOccupation" name="prevOccupation" placeholder=""  value="{{ isset($application) ? $application->prevOccupation : '' }}" >
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="prevEmployer">Previous Employer Name</label>
        <input type="text" class="form-control" id="prevEmployer" name="prevEmployer" placeholder=""  value="{{ isset($application) ? $application->prevEmployer : '' }}" >
      </div>
    </div>

    <div class="col-lg-4">
    <div class="form-group">
      <label for="empTimePrev">Duration</label>
    <div class="row mx-0">
        <select class="form-control d-inline col" id="prevEmployerTimeY" name="prevEmployerTimeY" >
          <option value="" disabled selected hidden>Years</option>
            <option>1 yr</option>
            <option>2 yrs</option>
            <option>3 yrs</option>
            <option>4 yrs</option>
            <option id="empTimePrevY5">5+ yrs</option>
          </select>
          <select class="form-control d-inline col" id="prevEmployerTimeM" name="prevEmployerTimeM">
            <option value="" disabled selected hidden>Months</option>
            <option id="empTimePrevM0">0 mth</option>
            <option>1 mth</option>
            <option>2 mths</option>
            <option>3 mths</option>
            <option>4 mths</option>
            <option>5 mths</option>
            <option>6 mth</option>
            <option>7 mths</option>
            <option>8 mths</option>
            <option>9 mths</option>
            <option>10 mths</option>
            <option>11 mths</option>
          </select>
        </div>
    </div>
    </div>

</div>

<script>

  // selects 0 months when 5+ years
$("#empTimeY").change(function() {
  if ($(this).find("option:selected").attr("id") == "empTimeY5") {
      $("#empTimeM0").attr('selected', true);
  } 
});

$("#empTimeY").change(function() {
        if ($(this).find("option:selected").attr("id") == "oneYearEmp") {
            $("#previous-employment").removeClass("d-none");
        } else if ($(this).find("option:selected").attr("id") !== "oneYear") {
            $("#previous-employment").addClass("d-none");
        } 
    });

    $("#residentialType").change(function() {
        if ($(this).find("option:selected").attr("id") == "outright") {
            $("#rentPayable").addClass("d-none");
        } else  {
                $("#rentPayable").removeClass("d-none");
        } 
    });

    // hide mortgage
$("#residentialType").change(function() {
  if ($(this).find("option:selected").attr("id") == "outright") {
      $("#rentPayable").addClass("invisible");
  } else  {
          $("#rentPayable").removeClass("invisible");
  } 
});

// Set months to 0 when 5+ years is selected
$("#empTimePrevY").change(function() {
      if ($(this).find("option:selected").attr("id") == "empTimePrevY5") {
          $("#empTimePrevM0").attr('selected', true);
      } 
  });




</script>



<div class="row m-3">
           
<div class="col-lg-3">
      <div class="form-group">
        <label class="" for="income">Income Amount <span class="badge bg-primary rounded-circle m-1" data-toggle="tooltip" title="After tax - your take home income" data-placement="top" >?</span></label> 
        <input type="text" class="form-control" id="income" name="income" data-type="currency" placeholder="" value="{{ isset($application) ? $application->income : '' }}"> 
      </div>
    </div>
    
    <div class="col-lg-3">
      <div class="form-group">
        <label class="" for="incomeFreq">Frequency</label>
          <select class="form-control" id="incomeFreq" name="incomeFreq" placeholder="" value="{{ isset($application) ? $application->incomeFreq : '' }}" >
            <option value="" disabled selected hidden></option>
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly">Fortnightly</option>
            <option value="Monthly">Monthly</option>
            <option value="Annually">Annually</option>
          </select>
      </div>
    </div>    

      <div class="col-lg-3 d-none partner-income">
        <div class="form-group">
          <label class="" for="partnerIncome">Partner Income</label>
          <input type="text" class="form-control" id="partnerIncome" data-type="currency"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" name="partnerIncome" placeholder="" value="{{ isset($application) ? $application->partnerIncome : '' }}">
        </div>
      </div>


      <div class="col-lg-3 d-none partner-income">
        <div class="form-group">
          <label class="" for="partnerIncomeFreq">Frequency</label>
            <select class="form-control" id="partnerIncomeFreq" name="partnerIncomeFreq" placeholder="" value="{{ isset($application) ? $application->partnerIncomeFreq : '' }}">
            <option value="" disabled selected hidden> </option>
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly">Fortnightly</option>
            <option value="Monthly">Monthly</option>
            <option value="Annually">Annually</option>
            </select>
        </div>
      </div>
    
</div>

<div class="row m-3">
  <div class="col">
  Please upload your two (2) most recent payslips
  </div>
</div>

<div class="row m-3">
  <div class="col-lg-6">
  <div class="form-group">
        <label for="payslip1" class="payslip1 file-upload-label">Upload Payslip...</label>
        <input type="file" class="form-control form-control-file-upload" name="payslip1" id="payslip1">
        </div> 
  </div>
  <div class="col-lg-6">
    <div class="form-group">
        <label for="payslip2" class="payslip2  file-upload-label">Upload Payslip...</label>
        <input type="file" class="form-control form-control-file-upload" name="payslip2" id="payslip2">
        </div> 
  </div>
</div>


<div class="row m-3" id="rentPayable">

<div class="col-lg-4">
    <div class="form-group">
      <label class="" for="rentMortgageBoard">Rent, Mortgage</label>
      <input type="text" class="form-control" id="rentMortgageBoard" data-type="currency" name="rentMortgageBoard" placeholder="" value="{{ isset($application) ? $application->rentMortgageBoard : '' }}">
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label class="" for="rentFreq">Frequency</label>
        <select class="form-control" id="rentFreq" name="rentFreq" value="{{ isset($application) ? $application->rentFreq : '' }}" >
            <option value="" disabled selected hidden> </option>
            <option value="Weekly">Weekly</option>
            <option value="Fortnightly">Fortnightly</option>
            <option value="Monthly">Monthly</option>
        </select>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label class="" for="rentShared">Shared?</label>
        <select class="form-control" id="rentShared" name="rentShared" value="{{ isset($application) ? $application->rentShared : '' }}" >
          <option value="" disabled selected hidden></option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
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
<p class="credit-card-table">List all credit cards - include store cards and zero balance cards.</p>
<p class="no-cards d-none">No credit cards to show.</p>
        

</div>


<table class="table table-striped credit-card-table m-3">

<tbody id="creditCardContainer">

</tbody>
</table>
<div class="m-3"><a href="#" class="btn btn-transparent credit-card-table" id="addRow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#0dcaf075" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a> <span id="hideMe1"><label class="credit-card-table my-2" for="no-credit-cards"><input type="checkbox" id="noCards" class="m-2" name="noCards" value="" > I don't have any Credit Cards</label></span></div>

<script type="text/javascript">

    let i = 1;

    document.getElementById('addRow').onclick = function () {
    let template = `<td>
      <div class="form-group">
      <label for="financeCompany-${i}" class="">Finance Company name #${i}</label>
      <input type="text" class="form-control" id="financeCompany-${i}" name="creditCards[${i}][financeCompany]" value="" placeholder="" />
      </div> 
      </td>
      <td>
      <div class="form-group">
      <label for="creditLimit-${i}" class="">Credit limit</label>
      <input type="text" class="form-control" data-type="currency" id="creditLimit-${i}" name="creditCards[${i}][creditLimit]" value="" placeholder="$" />
      </div>  
      </td>
      <td>
      <div class="form-group">
      <label for="consolidate-${i}" class="">Consolidate?</label>
      <select class="form-control" name="creditCards[${i}][consolidate]" id="consolidate-${i}">
      <option value="" disabled selected hidden> </option>
      <option value="yes">Yes</option>
      <option value="no">No</option>
      </select>
      </div>  
      </td>
      <td><a href="#" class="btn btn-transparent rounded-circle remove fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a></td>`;
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
  
      $('#noCards').click(function(){
        if($(this).prop("checked") == true){
        //alert("you checked checkbox.");
        $(".credit-card-table").addClass("d-none")
        $(".no-cards").removeClass("d-none");
      }else if($(this).prop("checked") == false){
        //alert("you unchecked checkbox.");
        $(".credit-card-table").removeClass("d-none");
        }
    });

    $('#addRow').click(function(){
      $('#hideMe1').addClass('d-none');
    })

      
</script>


<div class="m-5 credit-card-table">
<hr>
</div>

<div class="row m-3">

<h3>Personal Loans</h3>
<p class="personal-loan-table">List all secured and unsecured loans.</p>
<p class="no-loans d-none">No unsecured loans.</p>

</div>

<table class="table table-striped personal-loan-table m-3">

<tbody id="personalLoanContainer">

</tbody>
</table>
<div class="m-3"><a href="#" class="btn btn-transparent personal-loan-table" id="addPL"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#0dcaf075" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a> <span id="hideMe2"><label for="no-personal-loans" class="personal-loan-table my-3"><input type="checkbox" id="noLoans" name="noLoans" class="m-2" value="" > I don't have any Personal Loans</label></span></div>

<script type="text/javascript">

    let p = 1;

    document.getElementById('addPL').onclick = function () {
    let template = `<td>
<div class="form-group">
      <label for="financeCompanyPL-${p}" class="">Finance Company name</label>
      <input type="text" class="form-control" name="personalLoans[${p}][financeCompany]" id="financeCompanyPL-${p}" value="" placeholder="" />
    </div> 
  </td>
<td>
<div class="form-group">
      <label for="balance-${p}" class="">Balance</label>
      <input type="text" class="form-control" data-type="currency" name="personalLoans[${p}][balance]" id="balance-${p}" value="" placeholder="$" />
    </div>    
  </td>
<td>
<div class="form-group">
      <label for="repayment-${p}" class="">Repayment</label>
      <input type="text" class="form-control" data-type="currency" name="personalLoans[${p}][repayment]" id="repayment-${p}" value="" placeholder="$" />
    </div>   
  </td>

<td>
<div class="form-group">
      <label for="frequency-${p}" class="">Frequency</label>
      <select class="form-control" name="personalLoans[${p}][frequency]" id="frequency-${p}">
      <option value="" disabled selected hidden> </option>
      <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div></td>
<td>
<div class="form-group">
      <label for="consolidatePL-${p}" class="">Consolidate? </label>
        <select class="form-control" name="personalLoans[${p}][consolidate]" id="consolidatePL-${p}" >
        <option value="" disabled selected hidden> </option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>
    </div></td>
<td>
<div class="form-group">
      <label for="jointLoanPL-${p}" class="">Joint? </label>
        <select class="form-control" name="personalLoans[${p}][joint]" id="jointPL-${p}" >
        <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</td>
<td>
  <a href="#" class="btn btn-transparent rounded-circle fw-bold removePL"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
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
  
      $('#noLoans').click(function(){
        if($(this).prop("checked") == true){
        //alert("you checked checkbox.");
        $(".personal-loan-table").addClass("d-none")
        $(".no-loans").removeClass("d-none");
      }else if($(this).prop("checked") == false){
        //alert("you unchecked checkbox.");
        $(".personal-loan-table").removeClass("d-none");
        }
    });

    $('#addPL').click(function(){
      $('#hideMe2').addClass('d-none');
    })
      
</script>

<div class="m-5 personal-loan-table">
<hr>
</div>

<div id="showMortgages" class="d-none">
<div class="row m-3">

<h3>Mortgages</h3>
<p class="mortgages-table">List all mortgages and investment loans.</p>
<p class="mortgage-none d-none">No mortgages or investment loans.</p>
</div>

<table class="table table-striped mortgages-table m-3">

<tbody id="mortgageContainer">
<!--tr>
<td>
  <div class="form-group">
      <label for="financeCompanyM-1" class=" ">Finance Company name</label>
      <input type="text" class="form-control" name="mortgages[1][financeCompany]" id="financeCompanyM-1" value="" placeholder="" />
    </div>  
  </td>
  <td>
  <div class="form-group">
      <label for="balanceM-11" class="">Balance</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[1][balance]" id="balanceM-1" value="" placeholder="$" />
    </div>    
  </td>
  <td>
  <div class="form-group">
      <label for="repaymentM-1" class="">Repayment</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[1][repayment]" id="repaymentM-1" value="" placeholder="$" />
    </div>   
  </td>
  <td>
  <div class="form-group">
      <label for="frequencyM-1" class="">Frequency</label>
      <select class="form-control" name="mortgages[1][frequency]" id="frequencyM-1">
      <option value="" disabled selected hidden> </option>
        <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div>
  </td>
  <td>
  <div class="form-group">
      <label for="investmentProperty-1" class="">Investment? </label>
      <select class="form-control" name="mortgages[1][investmentProperty]" id="investmentProperty-1" >
      <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>
  </td>
  <td>
   <div class="form-group">
      <label for="jointM-1" class="">Joint? </label>
        <select class="form-control" name="mortgages[1][joint]" id="jointM-1" >
        <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</td>
<td>
  <a href="#" class="btn btn-transparent rounded-circle fw-bold removeM"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</td>
</tr-->
</tbody>
</table>
<div class="m-3"><a href="#" class="btn btn-transparent mortgages-table" id="addM"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#0dcaf075" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a> <span class="" id="hideMe3"><label for="no-mortgages" class="mortgages-table my-3"><input type="checkbox" id="noMortgages" class="m-2" name="noMortgages" class="mortgages-table" 
value="" > I don't have any Mortgages or Investment Loans</label></span></div>

<div class="m-5 mortgages-table">
<hr>
</div>
</div>

<script type="text/javascript">

    let m = 1;

    document.getElementById('addM').onclick = function () {
    let template = `<td>
  <div class="form-group">
      <label for="financeCompanyM-${m}" class="">Finance Company name</label>
      <input type="text" class="form-control" name="mortgages[${m}][financeCompany]" id="financeCompanyM-${m}" value="" placeholder="" />
    </div>  
  </td>
  <td>
  <div class="form-group">
      <label for="balanceM-${m}1" class="">Balance</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[${m}][balance]" id="balanceM-${m}" value="" placeholder="$" />
    </div>    
  </td>
  <td>
  <div class="form-group">
      <label for="repaymentM-${m}" class="">Repayment</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[${m}][repayment]" id="repaymentM-${m}" value="" placeholder="$" />
    </div>   
  </td>
  <td>
  <div class="form-group">
      <label for="frequencyM-${m}" class="">Frequency</label>
      <select class="form-control" name="mortgages[${m}][frequency]" id="frequencyM-${m}">
      <option value="" disabled selected hidden> </option>
        <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div>
  </td>
  <td>
  <div class="form-group">
      <label for="investmentProperty-${m}" class="">Investment? </label>
      <select class="form-control" name="mortgages[${m}][investmentProperty]" id="investmentProperty-${m}" >
      <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>
  </td>
  <td>
   <div class="form-group">
      <label for="jointM-${m}" class="">Joint? </label>
        <select class="form-control" name="mortgages[${m}][joint]" id="jointM-${m}" >
        <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</td>
<td>
  <a href="#" class="btn btn-transparent rounded-circle fw-bold removeM"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
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
  
      $('#noMortgages').click(function(){
        if($(this).prop("checked") == true){
         $(".mortgages-table").addClass("d-none")
         $(".mortgage-none").removeClass("d-none")
        }
     
    });

    $('#isHomeowner').click(function(){
        if($(this).prop("checked") == true ){
         $("#showMortgages").removeClass("d-none")
         $("#hideMe3").addClass("d-none")
        }
     
    });

     $("#residentialType").change(function() {
        if ($(this).find("option:selected").attr("id") == "mort" || $(this).find("option:selected").attr("id") == "outright") {
          $("#showMortgages").removeClass("d-none")
          $("#hideMe3").addClass("d-none")
        } 
    });

// || $("#residentialType").find("option:selected").attr("id") == "mort"
     

// format currency start
$("input[data-type='currency']").on({
  keyup: function() {
    formatCurrency($(this));
  },
  blur: function() { 
    formatCurrency($(this), "blur");
  }
});


function formatNumber(n) {
// format number 1000000 to 1,234,567
return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
// appends $ to value, validates decimal side
// and puts cursor back in right position.

// get input value
var input_val = input.val();

// don't validate empty input
if (input_val === "") { return; }

// original length
var original_len = input_val.length;

// initial caret position 
var caret_pos = input.prop("selectionStart");

// check for decimal
if (input_val.indexOf(".") >= 0) {

// get position of first decimal
// this prevents multiple decimals from
// being entered
var decimal_pos = input_val.indexOf(".");

// split number by decimal point
var left_side = input_val.substring(0, decimal_pos);
var right_side = input_val.substring(decimal_pos);

// add commas to left side of number
left_side = formatNumber(left_side);

// validate right side
right_side = formatNumber(right_side);

// On blur make sure 2 numbers after decimal
if (blur === "blur") {
right_side += "00";
}

// Limit decimal to only 2 digits
right_side = right_side.substring(0, 2);

// join number by .
input_val = "$" + left_side + "." + right_side;

} else {
// no decimal entered
// add commas to number
// remove all non-digits
input_val = formatNumber(input_val);
input_val = "$" + input_val;

// final formatting
if (blur === "blur") {
input_val += ".00";
}
}

// send updated string to input
input.val(input_val);

// put caret back in the right position
var updated_len = input_val.length;
caret_pos = updated_len - original_len + caret_pos;
input[0].setSelectionRange(caret_pos, caret_pos);
}
// format currency end
      
</script>




    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="sorry">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-5">
      <div class="modal-header">
        <h5 class="modal-title">We're Sorry</h5>

      </div>
      <div class="modal-body">
        <p>You do not qualify for funding through this portal.</p>  
        <p>We do have options tailored more to your needs, please contact us on ### to discuss.</p>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="category_id" id="category_id" value="1">
        <button type="submit" class="btn btn-info">Save and Close</button>
        
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="category_id" id="category_id" class="cat-submitted" value="2">



<div class="form-navigation d-none">
  <div class="d-flex justify-content-center">
<button type="button" class="previous btn btn-lg btn-info mx-1">Previous</button>
<button id="next" type="button"  class="next btn-lg btn btn-info mx-1 show-modal" disabled>Next</button>
<button type="submit"  class="btn-lg btn btn-info success mx-1">Submit</button>
</div>
</div>


                  



</form>

@endif


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

<script>
  // enable tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

</script>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyCtIer4xqMGyBnHt_M2IyDaFLNZEEKwgcM&libraries=places&callback=initAutocomplete" type="text/javascript"></script>

<script>
google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {
var input = document.getElementById('streetaddress');
var streetaddress = new google.maps.places.Autocomplete(input);
streetaddress.addListener('place_changed', function() {
var place = streetaddress.getPlace();
});
var input = document.getElementById('otherAddress');
var otherAddress = new google.maps.places.Autocomplete(input);
otherAddress.addListener('place_changed', function() {
var place = otherAddress.getPlace();
});
}

        const isNumericInput = (event) => {
            const key = event.keyCode;
            return ((key >= 48 && key <= 57) || // Allow number line
                (key >= 96 && key <= 105) // Allow number pad
            );
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            // Input must be of a valid number format or a modifier key, and not longer than ten digits
            if(!isNumericInput(event) && !isModifierKey(event)){
                event.preventDefault();
            }
        };

        const formatToPhone = (event) => {
            if(isModifierKey(event)) {return;}

            const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
            const areaCode = input.substring(0,4);
            const middle = input.substring(4,7);
            const last = input.substring(7,10);

            if(input.length > 6){event.target.value = `${areaCode} ${middle} ${last}`;}
            else if(input.length > 3){event.target.value = `${areaCode} ${middle}`;}
            else if(input.length > 0){event.target.value = `${areaCode}`;}
        };

        const inputElement = document.getElementById('phone');
        inputElement.addEventListener('keydown',enforceFormat);
        inputElement.addEventListener('keyup',formatToPhone);

        const inputElement2 = document.getElementById('employercontactnumber');
        inputElement2.addEventListener('keydown',enforceFormat);
        inputElement2.addEventListener('keyup',formatToPhone);

        
// format medicare number
const formatToMedicare = (event) => {
  if(isModifierKey(event)) {return;}

  const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
  const first = input.substring(0,4);
  const middle = input.substring(4,9);
  const last = input.substring(9,10);

  if(input.length > 6){event.target.value = `${first} ${middle} ${last}`;}
  else if(input.length > 3){event.target.value = `${first} ${middle}`;}
  else if(input.length > 0){event.target.value = `${first}`;}
};

const inputElement3 = document.getElementById('MCnumber');
inputElement3.addEventListener('keydown',enforceFormat);
inputElement3.addEventListener('keyup',formatToMedicare);



</script>

@endsection

