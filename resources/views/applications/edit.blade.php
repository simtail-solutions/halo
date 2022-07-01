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



@if($application->category->name !== "Incomplete")

<div class="p-5 text-center">
<div class="alert alert-danger"><h4>Sorry this link is no longer valid</h4></div>
</div>

@else

<form class="application-form" action="{{ route('applications.update', $application->api_token) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
@csrf
@method ('PUT')


<div id="intro" class="m-3 py-3 px-5">
  
  <div class="row text-center">
        <p>Please ensure the application is completed in full and truthfully.</p>
        <p>Once the application is complete HALO's customer support team will be in contact providing your obligation free quote.</p>
        <p>Halo makes borrowing more flexible with loans tailored to your budget helping you achieve your treatment sooner.</p>
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
        <label class="" for="loanAmount">Treatment Cost</label>
        <input type="text" class="form-control" name="loanAmount" data-type="currency" id="loanAmount" placeholder="$2,000 to $70,000 (estimate if unknown)" value="{{ isset($application) ? $application->loanAmount : '' }}" >
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

    <div class="col-lg-1">
      <div class="form-group">
        <label class="" for="gender">Gender</label>
          <select class="form-control" id="gender"  name="gender" required>
          <option value="" disabled selected hidden> </option>
            <option {{ ($application->applicant->gender) == 'Male' ? 'selected' : '' }} value="Male">Male</option>
            <option {{ ($application->applicant->gender) == 'Female' ? 'selected' : '' }} value="Female">Female</option>
            <option {{ ($application->applicant->gender) == 'Non-binary' ? 'selected' : '' }} value="Non-binary">Non-binary</option>
            <option {{ ($application->applicant->gender) == 'Trans' ? 'selected' : '' }} value="Trans">Trans</option>
            <option {{ ($application->applicant->gender) == 'Other' ? 'selected' : '' }} value="Other">Other</option>
          </select>
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
        <option {{ ($application->applicant->birth_day) == '01' ? 'selected' : '' }} value="01">01</option>
            <option {{ ($application->applicant->birth_day) == '02' ? 'selected' : '' }} value="02">02</option>
            <option {{ ($application->applicant->birth_day) == '03' ? 'selected' : '' }} value="03">03</option>
            <option {{ ($application->applicant->birth_day) == '04' ? 'selected' : '' }} value="04">04</option>
            <option {{ ($application->applicant->birth_day) == '05' ? 'selected' : '' }} value="05">05</option>
            <option {{ ($application->applicant->birth_day) == '06' ? 'selected' : '' }} value="06">06</option>
            <option {{ ($application->applicant->birth_day) == '07' ? 'selected' : '' }} value="07">07</option>
            <option {{ ($application->applicant->birth_day) == '08' ? 'selected' : '' }} value="08">08</option>
            <option {{ ($application->applicant->birth_day) == '09' ? 'selected' : '' }} value="09">09</option>
            <option {{ ($application->applicant->birth_day) == '10' ? 'selected' : '' }} value="10">10</option>
            <option {{ ($application->applicant->birth_day) == '11' ? 'selected' : '' }} value="11">11</option>
            <option {{ ($application->applicant->birth_day) == '12' ? 'selected' : '' }} value="12">12</option>
            <option {{ ($application->applicant->birth_day) == '13' ? 'selected' : '' }} value="13">13</option>
            <option {{ ($application->applicant->birth_day) == '14' ? 'selected' : '' }} value="14">14</option>
            <option {{ ($application->applicant->birth_day) == '15' ? 'selected' : '' }} value="15">15</option>
            <option {{ ($application->applicant->birth_day) == '16' ? 'selected' : '' }} value="16">16</option>
            <option {{ ($application->applicant->birth_day) == '17' ? 'selected' : '' }} value="17">17</option>
            <option {{ ($application->applicant->birth_day) == '18' ? 'selected' : '' }} value="18">18</option>
            <option {{ ($application->applicant->birth_day) == '19' ? 'selected' : '' }} value="19">19</option>
            <option {{ ($application->applicant->birth_day) == '20' ? 'selected' : '' }} value="20">20</option>
            <option {{ ($application->applicant->birth_day) == '21' ? 'selected' : '' }} value="21">21</option>
            <option {{ ($application->applicant->birth_day) == '22' ? 'selected' : '' }} value="22">22</option>
            <option {{ ($application->applicant->birth_day) == '23' ? 'selected' : '' }} value="23">23</option>
            <option {{ ($application->applicant->birth_day) == '24' ? 'selected' : '' }} value="24">24</option>
            <option {{ ($application->applicant->birth_day) == '25' ? 'selected' : '' }} value="25">25</option>
            <option {{ ($application->applicant->birth_day) == '26' ? 'selected' : '' }} value="26">26</option>
            <option {{ ($application->applicant->birth_day) == '27' ? 'selected' : '' }} value="27">27</option>
            <option {{ ($application->applicant->birth_day) == '28' ? 'selected' : '' }} value="28">28</option>
            <option {{ ($application->applicant->birth_day) == '29' ? 'selected' : '' }} value="29">29</option>
            <option {{ ($application->applicant->birth_day) == '30' ? 'selected' : '' }} value="30">30</option>
            <option {{ ($application->applicant->birth_day) == '31' ? 'selected' : '' }} value="31">31</option>
        </select>
        <select class="form-control d-inline col mr-1" id="birth_month" name="birth_month" required>
            <option value="" disabled selected hidden>Month</option>
            <option {{ ($application->applicant->birth_month) == 'JAN' ? 'selected' : '' }} value="JAN">JAN</option>
            <option {{ ($application->applicant->birth_month) == 'FEB' ? 'selected' : '' }} value="FEB">FEB</option>
            <option {{ ($application->applicant->birth_month) == 'MAR' ? 'selected' : '' }} value="MAR">MAR</option>
            <option {{ ($application->applicant->birth_month) == 'APR' ? 'selected' : '' }} value="APR">APR</option>
            <option {{ ($application->applicant->birth_month) == 'MAY' ? 'selected' : '' }} value="MAY">MAY</option>
            <option {{ ($application->applicant->birth_month) == 'JUN' ? 'selected' : '' }} value="JUN">JUN</option>
            <option {{ ($application->applicant->birth_month) == 'JUL' ? 'selected' : '' }} value="JUL">JUL</option>
            <option {{ ($application->applicant->birth_month) == 'AUG' ? 'selected' : '' }} value="AUG">AUG</option>
            <option {{ ($application->applicant->birth_month) == 'SEP' ? 'selected' : '' }} value="SEP">SEP</option>
            <option {{ ($application->applicant->birth_month) == 'OCT' ? 'selected' : '' }} value="OCT">OCT</option>
            <option {{ ($application->applicant->birth_month) == 'NOV' ? 'selected' : '' }} value="NOV">NOV</option>
            <option {{ ($application->applicant->birth_month) == 'DEC' ? 'selected' : '' }} value="DEC">DEC</option>
          </select>
        <input type="text" class="form-control d-inline col" id="birth_year" name="birth_year" size="4" maxlength="4" value="{{ isset($application) ? $application->applicant->birth_year : '' }}" placeholder="Year">
      </div>
      </div>            
    </div>


    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="dependants">Number of Dependants</label>
          <select class="form-control" id="dependants" name="dependants" value="{{ isset($applicant) ? $applicant->dependants : '' }}" required>
            <option value="" disabled selected hidden> </option>  
            <option {{ ($application->applicant->dependants) == '0' ? 'selected' : '' }} value="0">0</option>
            <option {{ ($application->applicant->dependants) == '1' ? 'selected' : '' }} value="1">1</option>
            <option {{ ($application->applicant->dependants) == '2' ? 'selected' : '' }} value="2">2</option>
            <option {{ ($application->applicant->dependants) == '3' ? 'selected' : '' }} value="3">3</option>
            <option {{ ($application->applicant->dependants) == '4' ? 'selected' : '' }} value="4">4</option>
            <option {{ ($application->applicant->dependants) == '5' ? 'selected' : '' }} value="5">5</option>
            <option {{ ($application->applicant->dependants) == '5+' ? 'selected' : '' }} value="5+">5+</option>
          </select>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="status">Marital Status</label>
          <select class="form-control" id="status" name="status" value="{{ isset($applicant) ? $applicant->status : '' }}" required>
          <option value="" disabled selected hidden> </option>
            <option {{ ($application->applicant->status) == 'Single' ? 'selected' : '' }} value="Single" id="single">Single</option>
            <option {{ ($application->applicant->status) == 'Married' ? 'selected' : '' }} value="Married"  id="married">Married</option>
            <option {{ ($application->applicant->status) == 'De Facto' ? 'selected' : '' }} value="De Facto"  id="defacto">De Facto</option>
            <option {{ ($application->applicant->status) == 'Separated' ? 'selected' : '' }} value="Separated"  id="separated">Seperated</option>
            <option {{ ($application->applicant->status) == 'Divorced' ? 'selected' : '' }} value="Divorced"  id="divorced">Divorced</option>
            <option {{ ($application->applicant->status) == 'Widowed' ? 'selected' : '' }} value="Widowed"  id="widowed">Widowed</option>
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
      
    <div class="col-lg-3">
      <div class="form-group">
        <label class="" for="phone">Mobile Number</label>
        <input type="text" class="form-control" id="phone" onKeyUp=check() minlength="12" name="phone" value="{{ isset($application) ? $application->applicant->phone : '' }}" placeholder="" required>
      </div>
      <div id="warning" class="mx-3">

      </div>
    </div>
    <script>
      function check() {
            stringLength = document.getElementById('phone').value.length;
            if (stringLength <= 11) {
                document.getElementById('warning').innerText = "Add more digits"
            } else {
                document.getElementById('warning').innerText = ""
            }
        }
    </script>

    <div class="col-lg-3">
      <div class="form-group">
        <label class="" for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($application) ? $application->applicant->email : '' }}" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="form-group">
        <label class="" for="employment">Employment Status</label>
          <select class="form-control" id="employment" name="employment" value="" required>
          <option value="" disabled selected hidden></option>
          <option {{ ($application->employment) == 'Full Time' ? 'selected' : '' }} value="Full Time"  id="fullTime">Full Time</option>
            <option {{ ($application->employment) == 'Part Time' ? 'selected' : '' }} value="Part Time" id="partTime">Part Time</option>
            <option {{ ($application->employment) == 'Casual' ? 'selected' : '' }} value="Casual" id="casual">Casual</option>
            <option {{ ($application->employment) == 'Self Employed' ? 'selected' : '' }} value="Self Employed" id="selfEmployed">Self Employed</option>
            <option {{ ($application->employment) == 'Contract' ? 'selected' : '' }} value="Contract" id="contract">Contract</option>
            <option {{ ($application->employment) == 'Pension' ? 'selected' : '' }} value="Pension" id="pension">Pension</option>
            <option {{ ($application->employment) == 'Unemployed' ? 'selected' : '' }} value="Unemployed" id="unemployed">Unemployed</option>
            <option {{ ($application->employment) == 'Centrelink' ? 'selected' : '' }} value="Centrelink" id="centrelink">Centrelink</option>
            <option {{ ($application->employment) == 'Other' ? 'selected' : '' }} value="Other" id="other">Other</option>
          </select>
      </div>
    </div>
    
    <div class="col-lg-3">
          <div class="form-group">
            <label class="" for="occupation">Occupation</label>
            <input type="text" class="form-control" id="occupation" name="occupation" placeholder="" value="{{ isset($applicant) ? $application->applicant->occupation : '' }}" >
          </div>
        </div>

  </div>

  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group" id="DLnumber"  >
        <label class="" for="DLnumber">Drivers Licence Number</label>
        <input type="text" class="form-control" id="DLnumber" name="DLnumber" value="{{ isset($applicant) ? $application->applicant->DLnumber : '' }}"  placeholder="" 
        >
      </div> 
      <div  class="form-group">
      <input type="checkbox" id="currentDL" name="currentDL" value="0" ><label for="drivers_check" class="long-label"> I don't have a drivers licence</label>        
      </div>  
    </div>

    

    <div class="col-lg-6">
      <div class="form-group">
        <label class="" for="MCnumber">Medicare Card Number</label>
        <input type="text" class="form-control" id="MCnumber" name="MCnumber" value="{{ isset($applicant) ? $application->applicant->MCnumber : '' }}"
        placeholder="">
      </div>
    </div>

    

  </div>
  @if(isset($application->applicant))

  <div class="row m-3">
  @if(!isset($application->applicant->DLimage))
  <div class="col-lg-6">
    <div class="form-group">
        <label for="DLimage" class="DLimage file-upload-label">Upload a copy of your Drivers Licence</label>
        <input type="file" class="form-control form-control-file-upload" name="DLimage" id="DLimage">
        </div> 
      
  </div>
@endif
@if(!isset($application->applicant->MCimage))
  <div class="col-lg-6">
    <div class="form-group">
        <label for="MCimage" class="form-label file-upload-label">Upload a copy of your Medicare Card</label>
        <input type="file" class="form-control form-control-file-upload" name="MCimage" id="MCimage">
        </div>
</div>
@endif
  </div>
  @endif

  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group">
        <label class="" for="address">Street Address</label>
        <input type="text" name="streetaddress" id="streetaddress" class="form-control" placeholder="Start typing address" value="{{ isset($applicant) ? $application->applicant->streetaddress : '' }}">
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label class="" for="residentialType">Residential Type</label>
          <select class="form-control" id="residentialType" name="residentialType" value="{{ isset($application) ? $application->residentialType : '' }}" required>
            <option value="" disabled selected hidden> </option>
            <option {{ ($application->residentialType) == 'Renting' ? 'selected' : '' }} value="Renting" id="renting">Renting</option>
            <option {{ ($application->residentialType) == 'Mortgage' ? 'selected' : '' }} value="Mortgage" id="mort">Mortgage</option>
            <option {{ ($application->residentialType) == 'Boarding' ? 'selected' : '' }} value="Boarding" id="boarding">Boarding</option>
            <option {{ ($application->residentialType) == 'Living with parents' ? 'selected' : '' }} value="Living with parents" id="parents">Living with parents</option>
            <option {{ ($application->residentialType) == 'Own home outright' ? 'selected' : '' }} value="Own home outright" id="outright">Own home outright</option>
            <option {{ ($application->residentialType) == 'Other' ? 'selected' : '' }} value="Other" id="resOther">Other</option>
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
            <option {{ ($application->resTimeY) == '1 yr' ? 'selected' : '' }} value="1 yr" id="oneYear">1 yr</option>
            <option {{ ($application->resTimeY) == '2 yrs' ? 'selected' : '' }} value="2 yrs" >2 yrs</option>
            <option {{ ($application->resTimeY) == '3 yrs' ? 'selected' : '' }} value="3 yrs" >3 yrs</option>
            <option {{ ($application->resTimeY) == '4 yrs' ? 'selected' : '' }} value="4 yrs" >4 yrs</option>
            <option {{ ($application->resTimeY) == '5+ yrs' ? 'selected' : '' }} value="5+ yrs"  id="resTimeY5">5+ yrs</option>
          </select>
          <select class="form-control d-inline col" id="resTimeM" name="resTimeM" required>
            <option value="" disabled selected hidden>Months</option>
            <option {{ ($application->resTimeM) == '0 mth' ? 'selected' : '' }} value="0 mth" id="resTimeM0">0 mth</option>
            <option {{ ($application->resTimeM) == '1 mth' ? 'selected' : '' }} value="1 mth">1 mth</option>
            <option {{ ($application->resTimeM) == '2 mths' ? 'selected' : '' }} value="2 mths">2 mths</option>
            <option {{ ($application->resTimeM) == '3 mths' ? 'selected' : '' }} value="3 mths">3 mths</option>
            <option {{ ($application->resTimeM) == '4 mths' ? 'selected' : '' }} value="4 mths">4 mths</option>
            <option {{ ($application->resTimeM) == '5 mths' ? 'selected' : '' }} value="5 mths">5 mths</option>
            <option {{ ($application->resTimeM) == '6 mths' ? 'selected' : '' }} value="6 mths">6 mth</option>
            <option {{ ($application->resTimeM) == '7 mths' ? 'selected' : '' }} value="7 mths">7 mths</option>
            <option {{ ($application->resTimeM) == '8 mths' ? 'selected' : '' }} value="8 mths">8 mths</option>
            <option {{ ($application->resTimeM) == '9 mths' ? 'selected' : '' }} value="9 mths">9 mths</option>
            <option {{ ($application->resTimeM) == '10 mths' ? 'selected' : '' }} value="10 mths">10 mths</option>
            <option {{ ($application->resTimeM) == '11 mths' ? 'selected' : '' }} value="11 mths">11 mths</option>
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

    <div class="row m-3 {{ ($application->resTimeY) == '1 yr' ? ' ' : 'd-none' }}" id="previous-address">
      
    <div class="col-lg-12">
      <div class="form-group">
        <label class="" for="address">Previous Address</label>
        <input type="text" name="otherAddress" id="otherAddress" class="form-control" value="{{ isset($application) ? $application->otherAddress : '' }}" placeholder="Start typing previous address">
        <label class="long-label">Minimum of two years residential address required</label>
      </div>
    </div>
  </div>

  <div class="row mx-3">

      
  <span class="my-4 d-flex justify-content-center">
        
        <label id="sample" class="form-check-label mr-5" for="defaultCheck1">
          <input type="checkbox" id="acceptance" name="acceptance" value="" required>
            &nbsp;&nbsp;I have read, understood and agree to the <a href="#terms" id="click-terms" data-toggle="modal" data-target="#terms">terms</a>
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

    // $("#employment").change(function() {
    //     if ($(this).find("option:selected").attr("id") == "centrelink") {
    //       $('#next').on('click', function() {
    //           $('#sorry').show()
    //           $('.cat-submitted').remove();
    //           });
    //         } 
    //     });

        // shows modal box if employment criteria not met
$("#employment").change(function() {
    if ($(this).find("option:selected").attr("id") == "centrelink" || $(this).find("option:selected").attr("id") == "unemployed" || $(this).find("option:selected").attr("id") == "pension") {
      $('#next').on('click', function() {
        var required = $('input,textarea,select').filter('[required]:visible').length;
            if (required === 0) {
              $('#sorry').show()
              $('.cat-submitted').remove();
              $('.save-later').remove();  
            }
            return required  
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
        
        <div class="col-lg-8">
          <div class="form-group">
            <label class="" for="employername">Employer Name</label>
            <input type="text" class="form-control" id="employername" name="employername" placeholder="" value="{{ isset($applicant) ? $application->applicant->employername : '' }}" >
          </div>
        </div>


        <div class="col-lg-4">
        <div class="form-group">
          <label for="empTimeCurrent">Duration</label>
        <div class="row mx-0">
        <select class="form-control d-inline col" id="empTimeY" name="empTimeY">
          <option value="" disabled selected hidden>Years</option>
            <option {{ ($application->empTimeY) == '1 yr' ? 'selected' : '' }} value="1 yr" id="oneYearEmp">1 yr</option>
            <option {{ ($application->empTimeY) == '2 yrs' ? 'selected' : '' }} value="2 yrs">2 yrs</option>
            <option {{ ($application->empTimeY) == '3 yrs' ? 'selected' : '' }} value="3 yrs">3 yrs</option>
            <option {{ ($application->empTimeY) == '4 yrs' ? 'selected' : '' }} value="4 yrs">4 yrs</option>
            <option {{ ($application->empTimeY) == '5+ yrs' ? 'selected' : '' }} value="5+ yrs" id="empTimeY5">5+ yrs</option>
          </select>
          <select class="form-control d-inline col" id="empTimeM" name="empTimeM">
            <option value="" disabled selected hidden>Months</option>
            <option {{ ($application->empTimeM) == '0 mth' ? 'selected' : '' }} value="0 mth" id="empTimeM0">0 mth</option>
            <option {{ ($application->empTimeM) == '1 mth' ? 'selected' : '' }} value="1 mth" >1 mth</option>
            <option {{ ($application->empTimeM) == '2 mths' ? 'selected' : '' }} value="2 mths" >2 mths</option>
            <option {{ ($application->empTimeM) == '3 mths' ? 'selected' : '' }} value="3 mths" >3 mths</option>
            <option {{ ($application->empTimeM) == '4 mths' ? 'selected' : '' }} value="4 mths" >4 mths</option>
            <option {{ ($application->empTimeM) == '5 mths' ? 'selected' : '' }} value="5 mths" >5 mths</option>
            <option {{ ($application->empTimeM) == '6 mths' ? 'selected' : '' }} value="6 mths" >6 mth</option>
            <option {{ ($application->empTimeM) == '7 mths' ? 'selected' : '' }} value="7 mths" >7 mths</option>
            <option {{ ($application->empTimeM) == '8 mths' ? 'selected' : '' }} value="8 mths" >8 mths</option>
            <option {{ ($application->empTimeM) == '9 mths' ? 'selected' : '' }} value="9 mths" >9 mths</option>
            <option {{ ($application->empTimeM) == '10 mths' ? 'selected' : '' }} value="10 mths" >10 mths</option>
            <option {{ ($application->empTimeM) == '11 mths' ? 'selected' : '' }} value="11 mths" >11 mths</option>
          </select>
        </div>
      </div>
      </div>

</div>

<div class="row m-3">

</div>

<div id="previous-employment" class="row m-3 previous-employment {{ ($application->prevOccupation) !== 'NULL' ? '' : 'd-none' }}">

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
            <option {{ ($application->prevEmployerTimeY) == '1 yr' ? 'selected' : '' }} value="1 yr" >1 yr</option>
            <option {{ ($application->prevEmployerTimeY) == '2 yrs' ? 'selected' : '' }} value="2 yrs" >2 yrs</option>
            <option {{ ($application->prevEmployerTimeY) == '3 yrs' ? 'selected' : '' }} value="3 yrs" >3 yrs</option>
            <option {{ ($application->prevEmployerTimeY) == '4 yrs' ? 'selected' : '' }} value="4 yrs" >4 yrs</option>
            <option {{ ($application->prevEmployerTimeY) == '5+ yrs' ? 'selected' : '' }} value="5+ yrs"  id="empTimePrevY5">5+ yrs</option>
          </select>
          <select class="form-control d-inline col" id="prevEmployerTimeM" name="prevEmployerTimeM">
            <option value="" disabled selected hidden>Months</option>
            <option {{ ($application->prevEmployerTimeM) == '0 mth' ? 'selected' : '' }} value="0 mth"  id="empTimePrevM0">0 mth</option>
            <option {{ ($application->prevEmployerTimeM) == '1 mth' ? 'selected' : '' }} value="1 mth">1 mth</option>
            <option {{ ($application->prevEmployerTimeM) == '2 mths' ? 'selected' : '' }} value="2 mths">2 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '3 mths' ? 'selected' : '' }} value="3 mths">3 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '4 mths' ? 'selected' : '' }} value="4 mths">4 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '5 mths' ? 'selected' : '' }} value="5 mths">5 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '6 mths' ? 'selected' : '' }} value="6 mths">6 mth</option>
            <option {{ ($application->prevEmployerTimeM) == '7 mths' ? 'selected' : '' }} value="7 mths">7 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '8 mths' ? 'selected' : '' }} value="8 mths">8 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '9 mths' ? 'selected' : '' }} value="9 mths">9 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '10 mths' ? 'selected' : '' }} value="10 mths">10 mths</option>
            <option {{ ($application->prevEmployerTimeM) == '11 mths' ? 'selected' : '' }} value="11 mths">11 mths</option>
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
        <label class="" for="income">After Tax Income</label> 
        <input type="text" class="form-control" id="income" name="income" data-type="currency" placeholder="" value="{{ isset($application) ? $application->income : '' }}"> 
      </div>
    </div>
    
    <div class="col-lg-3">
      <div class="form-group">
        <label class="" for="incomeFreq">Frequency</label>
          <select class="form-control" id="incomeFreq" name="incomeFreq" placeholder="" value="{{ isset($application) ? $application->incomeFreq : '' }}" >
            <option value="" disabled selected hidden></option>
            <option {{ ($application->incomeFreq) == 'Weekly' ? 'selected' : '' }} value="Weekly">Weekly</option>
            <option {{ ($application->incomeFreq) == 'Fortnightly' ? 'selected' : '' }} value="Fortnightly">Fortnightly</option>
            <option {{ ($application->incomeFreq) == 'Monthly' ? 'selected' : '' }} value="Monthly">Monthly</option>
            <option {{ ($application->incomeFreq) == 'Annually' ? 'selected' : '' }} value="Annually">Annually</option>
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
            <option {{ ($application->partnerIncomeFreq) == 'Weekly' ? 'selected' : '' }}  value="Weekly">Weekly</option>
            <option {{ ($application->partnerIncomeFreq) == 'Fortnightly' ? 'selected' : '' }} value="Fortnightly">Fortnightly</option>
            <option {{ ($application->partnerIncomeFreq) == 'Monthly' ? 'selected' : '' }} value="Monthly">Monthly</option>
            <option {{ ($application->partnerIncomeFreq) == 'Annually' ? 'selected' : '' }} value="Annually">Annually</option>
            </select>
        </div>
      </div>
    
</div>
@if(!isset($application->applicant->payslip1))
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
@endif

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
            <option {{ ($application->rentFreq) == 'Weekly' ? 'selected' : '' }} value="Weekly">Weekly</option>
            <option {{ ($application->rentFreq) == 'Fortnightly' ? 'selected' : '' }} value="Fortnightly">Fortnightly</option>
            <option {{ ($application->rentFreq) == 'Monthly' ? 'selected' : '' }} value="Monthly">Monthly</option>
        </select>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-group">
      <label class="" for="rentShared">Shared?</label>
        <select class="form-control" id="rentShared" name="rentShared" value="{{ isset($application) ? $application->rentShared : '' }}" >
          <option value="" disabled selected hidden></option>
          <option {{ ($application->rentShared) == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
          <option {{ ($application->rentShared) == 'No' ? 'selected' : '' }} value="No">No</option>
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
    <p>All loans and credit cards will show on a customer's credit file. Please ensure all liabilities in your name are disclosed. It'll make the application faster and easier to assess.</p>
  </div>

<div class="row m-3">

<h3>Credit Cards</h3>
<p class="credit-card-table">List all credit cards - include store cards and zero balance cards.</p>
<p class="no-cards d-none">No credit cards to show.</p>
        

</div>


<!--table class="table table-striped credit-card-table m-3"-->

<div id="creditCardContainer" class="mx-3">

      </div>
</table>
<div class="m-3"><a href="#" class="btn btn-transparent credit-card-table" id="addRow"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#0dcaf075" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a> <span id="hideMe1"><label class="credit-card-table my-2" for="no-credit-cards"><input type="checkbox" id="noCards" class="m-2" name="noCards" value="" > I don't have any Credit Cards</label></span></div>

<script type="text/javascript">

    let i = 1;

    document.getElementById('addRow').onclick = function () {
    let template = `<div class="col-lg-3 mb-2">
      <div class="form-group">
      <label for="financeCompany-${i}" class="">Finance Company name #${i}</label>
      <input type="text" class="form-control" id="financeCompany-${i}" name="creditCards[${i}][financeCompany]" value="" placeholder="" />
      </div> 
      </div>
      <div class="col-lg-3 mb-2">
      <div class="form-group">
      <label for="creditLimit-${i}" class="">Credit limit</label>
      <input type="text" class="form-control" data-type="currency" id="creditLimit-${i}" name="creditCards[${i}][creditLimit]" value="" placeholder="$" />
      </div>  
      </div>
      <div class="col-lg-2 mb-2">
      <div class="form-group">
      <label for="consolidate-${i}" class="">Consolidate?</label>
      <select class="form-control" name="creditCards[${i}][consolidate]" id="consolidate-${i}">
      <option value="" disabled selected hidden> </option>
      <option value="yes">Yes</option>
      <option value="no">No</option>
      </select>
      </div>  
      </div>
      <div class="col-lg-3 col-sm-10 mb-2">
      <div class="form-group">
      <label for="amount_owing-${i}" class="">Amount Owing</label>
      <input type="text" class="form-control" data-type="currency" id="amount_owing-${i}" name="creditCards[${i}][amount_owing]" value="" placeholder="$" />
      </div>  
      </div>
      <div class="col-lg-1 col-sm-2 mb-2"><a href="#" class="btn btn-transparent rounded-circle remove fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a></div>`;
    let container = document.getElementById('creditCardContainer');
    let tr = document.createElement('div');
    tr.classList.add('row', 'pt-2');
    tr.innerHTML = template;
    container.appendChild(tr);      
    i++;
  };

  $('#creditCardContainer').on('click', '.remove', function(){
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
<p class="personal-loan-table">List all unsecured personal loans.</p>
<p class="no-loans d-none">No unsecured loans.</p>

</div>

<!--table class="table table-striped personal-loan-table m-3"-->

<div id="personalLoanContainer" class="mx-3">

  </div>
<!--/table-->
<div class="m-3"><a href="#" class="btn btn-transparent personal-loan-table" id="addPL"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#0dcaf075" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a> <span id="hideMe2"><label for="no-personal-loans" class="personal-loan-table my-3"><input type="checkbox" id="noLoans" name="noLoans" class="m-2" value="" > I don't have any Personal Loans</label></span></div>

<script type="text/javascript">

    let p = 1;

    document.getElementById('addPL').onclick = function () {
    let template = `<div class="col-lg-3 mb-2">
<div class="form-group">
      <label for="financeCompanyPL-${p}" class="">Finance Company name</label>
      <input type="text" class="form-control" name="personalLoans[${p}][financeCompany]" id="financeCompanyPL-${p}" value="" placeholder="" />
    </div> 
  </div>
<div class="col-lg-2 mb-2">
<div class="form-group">
      <label for="balance-${p}" class="">Balance</label>
      <input type="text" class="form-control" data-type="currency" name="personalLoans[${p}][balance]" id="balance-${p}" value="" placeholder="$" />
    </div>    
  </div>
<div class="col-lg-2 col-md-6 mb-2">
<div class="form-group">
      <label for="repayment-${p}" class="">Repayment</label>
      <input type="text" class="form-control" data-type="currency" name="personalLoans[${p}][repayment]" id="repayment-${p}" value="" placeholder="$" />
    </div>   
  </div>

<div class="col-lg-2 col-md-6 mb-2">
<div class="form-group">
      <label for="frequency-${p}" class="">Frequency</label>
      <select class="form-control" name="personalLoans[${p}][frequency]" id="frequency-${p}">
      <option value="" disabled selected hidden> </option>
      <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div></div>
<div class="col-lg-1 col-md-6 mb-2">
<div class="form-group">
      <label for="consolidatePL-${p}" class="">Consolidate? </label>
        <select class="form-control" name="personalLoans[${p}][consolidate]" id="consolidatePL-${p}" >
        <option value="" disabled selected hidden> </option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>
    </div></div>
<div class="col-lg-1 col-md-4 col-sm-10 mb-2">
<div class="form-group">
      <label for="jointLoanPL-${p}" class="">Joint? </label>
        <select class="form-control" name="personalLoans[${p}][joint]" id="jointPL-${p}" >
        <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</div>
<div class="col-lg-1 col-md-2 col-sm-2 mb-2">
  <a href="#" class="btn btn-transparent rounded-circle fw-bold removePL"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</div>`;
    let container = document.getElementById('personalLoanContainer');
    let tr = document.createElement('div');
    tr.classList.add('row', 'pt-2');
    tr.innerHTML = template;
    container.appendChild(tr);      
    p++;
  };

  $('#personalLoanContainer').on('click', '.removePL', function($e){
        $e.preventDefault();
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

    $('#addPL').click(function($e){
      $e.preventDefault();
      $('#hideMe2').addClass('d-none');
    })
      
</script>

<div class="m-5 personal-loan-table">
<hr>
</div>

<div class="row m-3">

<h3>Secured Loans</h3>
<p class="secured-loan-table">List all loans secured to car or asset.</p>
<p class="no-sloans d-none">No secured loans.</p>

</div>

<!--table class="table table-striped secured-loan-table m-3"-->

<div id="securedLoanContainer" class="mx-3">

  </div>
<!--/table-->
<div class="m-3"><a href="#" class="btn btn-transparent secured-loan-table" id="addSL"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#0dcaf075" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a> <span id="hideMe22"><label for="no-secured-loans" class="secured-loan-table my-3"><input type="checkbox" id="noSLoans" name="noSLoans" class="m-2" value="" > I don't have any Secured Loans</label></span></div>

<script type="text/javascript">

    let s = 1;

    document.getElementById('addSL').onclick = function () {
    let template = `<div class="col-lg-3 mb-2">
<div class="form-group">
      <label for="financeCompanySL-${s}" class="">Finance Company name</label>
      <input type="text" class="form-control" name="securedLoans[${s}][financeCompany]" id="financeCompanySL-${s}" value="" placeholder="" />
    </div> 
  </div>
<div class="col-lg-2 col-md-6 mb-2">
<div class="form-group">
      <label for="balanceSL-${s}" class="">Balance</label>
      <input type="text" class="form-control" data-type="currency" name="securedLoans[${s}][balance]" id="balance-${s}" value="" placeholder="$" />
    </div>    
  </div>
<div class="col-lg-2 col-md-6 mb-2">
<div class="form-group">
      <label for="repaymentSL-${s}" class="">Repayment</label>
      <input type="text" class="form-control" data-type="currency" name="securedLoans[${s}][repayment]" id="repayment-${s}" value="" placeholder="$" />
    </div>   
  </div>

<div class="col-lg-2 col-md-6 mb-2">
<div class="form-group">
      <label for="frequencySL-${s}" class="">Frequency</label>
      <select class="form-control" name="securedLoans[${s}][frequency]" id="frequency-${s}">
      <option value="" disabled selected hidden> </option>
      <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div></div>
    <div class="col-lg-2 col-md-4 col-sm-10 mb-2"
<div class="form-group">
      <label for="assetValueSL-${s}" class="">Asset Value</label>
      <input type="text" class="form-control" data-type="currency" name="securedLoans[${s}][asset_value]" id="assetValue-${s}" value="" placeholder="$" />
    </div>   
  </div>

<div class="col-lg-1 col-md-2 col-sm-2 mb-2">
  <a href="#" class="btn btn-transparent rounded-circle fw-bold removeSL"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</div>`;
    let container = document.getElementById('securedLoanContainer');
    let tr = document.createElement('div');
    tr.classList.add('row', 'pt-2');
    tr.innerHTML = template;
    container.appendChild(tr);      
    s++;
  };

  $('#securedLoanContainer').on('click', '.removeSL', function($e){
      $e.preventDefault();
        $(this).parent().parent().remove();
        s--;
      });
  
      $('#noSLoans').click(function(){
        if($(this).prop("checked") == true){
        //alert("you checked checkbox.");
        $(".secured-loan-table").addClass("d-none")
        $(".no-sloans").removeClass("d-none");
      }else if($(this).prop("checked") == false){
        //alert("you unchecked checkbox.");
        $(".secured-loan-table").removeClass("d-none");
        }
    });

    $('#addSL').click(function($e){
      $e.preventDefault();
      $('#hideMe22').addClass('d-none');
    })
      
</script>

<div class="m-5 secured-loan-table">
<hr>
</div>


<div id="showMortgages" class="d-none">
<div class="row m-3">

<h3>Mortgages</h3>
<p class="mortgages-table">List all mortgages and investment loans.</p>
<p class="mortgage-none d-none">No mortgages or investment loans.</p>
</div>


<div id="mortgageContainer" class="mx-3">


  </div>


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
    let template = `<div class="col-lg-4 mb-2">
  <div class="form-group">
      <label for="financeCompanyM-${m}" class="">Finance Company name</label>
      <input type="text" class="form-control" name="mortgages[${m}][financeCompany]" id="financeCompanyM-${m}" value="" placeholder="" />
    </div>  
  </div>
  <div class="col-lg-4 col-md-6 mb-2">
  <div class="form-group">
      <label for="balanceM-${m}1" class="">Balance</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[${m}][balance]" id="balanceM-${m}" value="" placeholder="$" />
    </div>    
  </div>
  <div class="col-lg-4 col-md-6 mb-2">
  <div class="form-group">
      <label for="value-${m}1" class="">Property Value</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[${m}][home_value]" id="home_value-${m}" value="" placeholder="$" />
    </div>    
  </div>
  <div class="col-lg-3 col-md-6 mb-2">
  <div class="form-group">
      <label for="repaymentM-${m}" class="">Repayment</label>
      <input type="text" class="form-control" data-type="currency" name="mortgages[${m}][repayment]" id="repaymentM-${m}" value="" placeholder="$" />
    </div>   
  </div>
  <div class="col-lg-3 col-md-6 mb-2">
  <div class="form-group">
      <label for="frequencyM-${m}" class="">Frequency</label>
      <select class="form-control" name="mortgages[${m}][frequency]" id="frequencyM-${m}">
      <option value="" disabled selected hidden> </option>
        <option value="Weekly">Weekly</option>
        <option value="Fortnightly">Fortnightly</option>
        <option value="Monthly">Monthly</option>
      </select>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-2">
  <div class="form-group">
      <label for="investmentProperty-${m}" class="">Investment? </label>
      <select class="form-control" name="mortgages[${m}][investmentProperty]" id="investmentProperty-${m}" >
      <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>
  </div>
  <div class="col-lg-2 col-md-4 col-sm-10 mb-2">
   <div class="form-group">
      <label for="jointM-${m}" class="">Joint? </label>
        <select class="form-control" name="mortgages[${m}][joint]" id="jointM-${m}" >
        <option value="" disabled selected hidden> </option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        </select>
    </div>    
</div>
<div class="col-lg-1 col-md-2 col-sm-2 mb-2">
  <a href="#" class="btn btn-transparent rounded-circle fw-bold removeM"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#dc354555" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</div>`;
    let container = document.getElementById('mortgageContainer');
    let tr = document.createElement('div');
    tr.classList.add('row', 'pt-2');
    tr.innerHTML = template;
    container.appendChild(tr);      
    m++;
  };

  $('#mortgageContainer').on('click', '.removeM', function($e){
        $e.preventDefault();
        $(this).parent().parent().remove();
        p--;
      });

  $('#addM').click(function($e){
      $e.preventDefault();
  })
  
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

      @include('partials.declined')

      </div>
      <div class="modal-footer">
      <input type="hidden" name="category_id" id="category_id" value="3">
        <button type="submit" class="btn btn-info">Save and Close</button>
        
      </div>
    </div>
  </div>
</div>



<input type="hidden" name="category_id" id="category_id" class="cat-submitted" value="2">
<input type="hidden" name="category_id" class="save-later" id="category_id" value="1">


<div class="form-nav-buttons">
  <div class="d-flex justify-content-center">
  <div class="save-button mx-1">
      <button id="save-button" type="submit" class="btn btn-lg btn-light mx-1 d-none">Save + Exit</button>
    </div>
    <div class="form-navigation d-none">
      <button type="button" class="previous btn btn-lg btn-info mx-1">Previous</button>
      <button id="next" type="button"  class="next btn-lg btn btn-info mx-1 show-modal" disabled>Next</button>
      <button type="submit"  class="btn-lg btn btn-info success mx-1" id="form-submit">Submit</button>
    </div>

</div>
</div>


<script>
    $('#form-submit').on('click', function() {
          $('.save-later').remove();
          });

    $('#next').on('click', function() {
          $('#save-button').removeClass('d-none');
          });
</script>


                  



</form>

<div class="modal" tabindex="-1" role="dialog" id="terms">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-5">
      <div class="modal-header">
        <h5 class="modal-title">Customer Disclosure &amp; Consent</h5>
      
      </div>
      <div class="modal-body">
        
      @include('partials.terms')

      </div>
      <div class="modal-footer">
        <button  id="close-terms" type="button" data-dismiss="modal" class="btn btn-info close">Close and continue</button>
        
      </div>
    </div>
  </div>
</div>

<script>
      // terms modal box
      $('#click-terms').click(function(){
        $('#terms').show();
      })

      $('#close-terms').click(function() {
        $('#terms').hide();
      })
    </script>

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

<script src="https://maps.google.com/maps/api/js?key={{config('services.google.maps')}}&libraries=places&callback=initAutocomplete" type="text/javascript"></script>

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

