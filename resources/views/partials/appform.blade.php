


<div class="form-section">
  
  <div class="row m-3 p-3 text-center">
        <p>This application should only take a few minutes and will not impact your credit score. Please ensure the application is 
        completed in full and truthfully. Pretty Penny Finance makes borrowing more rewarding with flexible loans tailored to your budget 
        helping borrowers get ahead in life and achieve more with their money. It's fairer finance that works for everyone</p>

        <h1 class="p-5">Let's get Started!</h1>
  

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
        @if(isset($application->applicant))
        <input type="text" class="form-control"id="apptitle"  name="apptitle" value="{{ $application->applicant->apptitle }}"  >
        @endif
        @if(!isset($application->applicant))
          <select class="form-control" id="apptitle"  name="apptitle" value=" "  required>
          <option ></option>
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

    <div class="col-4">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"  value="{{ isset($application) ? $application->applicant->firstname : '' }}"  required>
      </div>
    </div>
    <div class="col-3">
      <div class="form-group">
        <label for="middlename">Middle Name</label>
        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name"  value="{{ isset($application) ? $application->applicant->middlename : '' }}" >
      </div>
    </div>

    <div class="col-4">
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"  value="{{ isset($application) ? $application->applicant->lastname : '' }}"  required>
      </div>
    </div>
      
  </div>

  <div class="row m-3">
      
    <div class="col-lg-4">
      <div class="form-group">
        <label for="dob">Date of Birth</label>
      <div class="w-100">
        <select class="form-control d-inline w-25" id="birth_day" name="birth_day" value="" placeholder="">
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
        <select class="form-control d-inline w-25" id="birth_month" name="birth_month" value="" placeholder="">
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
        <input type="text" class="form-control d-inline w-25" id="birth_year" name="birth_year" size="4" maxlength="4" placeholder="1980">
      </div>
      </div>            
    </div>


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
        <input type="text" class="form-control" id="phone" name="phone" value="{{ isset($application) ? $application->applicant->phone : '' }}" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($application) ? $application->applicant->email : '' }}" placeholder="" required>
      </div>
    </div>
      
  </div>

  <div class="row m-3">
      
    <div class="col-lg-4">
      <div class="form-group" id="DLnumber">
        <label for="DLnumber">Drivers License Number (conditional)</label>
        <input type="text" class="form-control" id="DLnumber" name="DLnumber" value="{{ isset($applicant) ? $applicant->DLnumber : '' }}"  placeholder="" 
        >
      </div> 
      <div  class="form-group">
        <label for="drivers_check"><input type="checkbox" id="currentDL" name="currentDL" value=" " > I don't have a drivers licence</label>        
      </div> 
    </div>

    

    <div class="col-lg-4">
      <div class="form-group">
        <label for="MCnumber">Medicare Card Number</label>
        <input type="text" class="form-control" id="MCnumber" name="MCnumber" value="{{ isset($applicant) ? $applicant->MCnumber : '' }}"
        placeholder="">
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="employment">Employment Status</label>
          <select class="form-control" id="employment" name="employment" value="{{ isset($application) ? $application->employment : '' }}" placeholder="">
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
  @if(isset($application->applicant))
  <div class="row m-3">

  <div class="col-lg-6">
    <div class="form-group">
        <label for="DLimage">Upload copy of Drivers Licence</label>
        <input type="file" class="form-control" name="DLimage" id="DLimage">
        </div> 
      
  </div>

  <div class="col-lg-6">
    <div class="form-group">
        <label for="MCimage">Upload copy of Medicare Card</label>
        <input type="file" class="form-control" name="MCimage" id="MCimage">
        </div>
</div>

  </div>
  @endif

  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group">
        <label for="address">Street Address</label>
        <input type="text" name="streetaddress" id="streetaddress" class="form-control" placeholder="Start typing address">
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
        <label for="residentialType">Residential Type</label>
          <select class="form-control" id="residentialType" name="residentialType" value="{{ isset($application) ? $application->residentialType : '' }}" placeholder="">
            <option></option>
            <option id="renting">Renting</option>
            <option id="mort">Mortgage</option>
            <option id="boarding">Boarding</option>
            <option id="parents">Living with parents</option>
            <option id="outright">Own home outright</option>
            <option id="resOther">Other</option>
          </select>
      </div>
      <div  class="form-group d-none" id="homeowner">
        <label for="isHomeowner"><input type="checkbox" id="isHomeowner" name="isHomeowner" value=" " > Applicant is a homeowner</label>
      </div> 
    </div>

    <div class="col-lg-2">
      <div class="form-group">
        <label for="address_period">Time at address</label>
        <div class="input-group">
        <select class="form-control" id="resTimeY" name="resTimeY" value="" placeholder="">
            <option></option>
            <option id="oneYear">1 yr</option>
            <option>2 yrs</option>
            <option>3 yrs</option>
            <option>4 yrs</option>
            <option>5+ yrs</option>
          </select>
          <select class="form-control" id="resTimeM" name="resTimeM" value="" placeholder="">
            <option></option>
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
        <label for="address">Previous Address</label>
        <input type="text" name="otherAddress" id="otherAddress" class="form-control" placeholder="Start typing address">
      </div>
    </div>
  </div>

  <div class="row mx-3">

      
      <span class="ml-4">
        
        <input type="checkbox" id="acceptance" name="acceptance" value="" required>
        <label id="sample" class="form-check-label mr-5" for="defaultCheck1">
          I have read, understood and agree to the terms
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
      }else if($(this).prop("checked") == false){
        //alert("you unchecked checkbox.");
        $("#DLnumber").removeClass("d-none");
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
        <select class="form-control" id="empTimeY" name="empTimeY" value="" placeholder="">
            <option></option>
            <option id="oneYearEmp">1 yr</option>
            <option>2 yrs</option>
            <option>3 yrs</option>
            <option>4 yrs</option>
            <option>5+ yrs</option>
          </select>
          <select class="form-control" id="empTimeM" name="empTimeM" value="" placeholder="">
            <option></option>
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
        <select class="form-control" id="prevEmployerTimeY" name="prevEmployerTimeY" value="" placeholder="">
            <option></option>
            <option>1 yr</option>
            <option>2 yrs</option>
            <option>3 yrs</option>
            <option>4 yrs</option>
            <option>5+ yrs</option>
          </select>
          <select class="form-control" id="prevEmployerTimeM" name="prevEmployerTimeM" value="" placeholder="">
            <option></option>
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

</script>



<div class="row m-3">
           
    <div class="col-lg-3">
      <div class="form-group">
        <label for="income">Income Amount <span class="badge bg-primary rounded-circle m-1" data-toggle="tooltip" title="After tax - your take home income" data-placement="top" >?</span></label> 
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

<div class="row m-3" id="rentPayable">

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

<div class="m-5">
<hr>
</div>

</div>

<div class="form-section">

<div class="row m-3">

<h3>Credit Cards</h3>
<p class="credit-card-table">List all credit cards - include store cards and zero balance cards.</p>
<p class="no-cards">No credit cards to show.</p>
        

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
<div><a href="#" class="btn btn-info credit-card-table" id="addRow">Add Credit Card</a> <label class="credit-card-table" for="no-credit-cards"><input type="checkbox" id="noCards" name="noCards" value="" > I don't have any Credit Cards</label></div>

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
      
</script>


<div class="m-5 credit-card-table">
<hr>
</div>

<div class="row m-3">

<h3>Personal Loans</h3>
<p class="personal-loan-table">List all secured and unsecured loans.</p>
<p class="no-loans d-none">No unsecured loans.</p>

</div>

<table class="table table-striped personal-loan-table">
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
<div><a href="#" class="btn btn-info personal-loan-table" id="addPL">Add Personal Loan</a> <label for="no-personal-loans" class="personal-loan-table"><input type="checkbox" id="noLoans" name="noLoans" value="" > I don't have any Personal Loans</label></div>

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

<table class="table table-striped mortgages-table">
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
<div><a href="#" class="btn btn-info mortgages-table" id="addM">Add Mortgage Loan</a> <label for="no-mortgages" class="mortgages-table"><input type="checkbox" id="noMortgages" name="noMortgages" class="mortgages-table" 
value="" > I don't have any Mortgages or Investment Loans</label></div>

<div class="m-5 mortgages-table">
<hr>
</div>
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
  
      $('#noMortgages').click(function(){
        if($(this).prop("checked") == true){
         $(".mortgages-table").addClass("d-none")
         $(".mortgage-none").removeClass("d-none")
        }
     
    });

    $('#isHomeowner').click(function(){
        if($(this).prop("checked") == true ){
         $("#showMortgages").removeClass("d-none")
         //$(".mortgage-none").removeClass("d-none")
        }
     
    });

     $("#residentialType").change(function() {
        if ($(this).find("option:selected").attr("id") == "mort" || $(this).find("option:selected").attr("id") == "outright") {
          $("#showMortgages").removeClass("d-none")
        } 
    });

// || $("#residentialType").find("option:selected").attr("id") == "mort"

    // $("#residentialType").change(function() {
    //     if ($(this).find("option:selected").attr("id") == "mort" || $(this).find("option:selected").attr("id") == "outright") {
    //         $("#homeowner").addClass("d-none");
    //     } else  {
    //             $("#homeowner").removeClass("d-none");
    //     } 
    // });


      
</script>





</div>

<div class="modal" tabindex="-1" role="dialog" id="sorry">
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
      <input type="hidden" name="category_id" id="category_id" value="1">
        <button type="submit" class="btn btn-primary">Save changes</button>
        
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="category_id" id="category_id" class="cat-submitted" value="2">



<div class="form-navigation">
<button type="button" class="previous btn btn-info float-left">Previous</button>
<button id="next" type="button"  class="next btn btn-info float-right show-modal" disabled>Next</button>
<button type="submit"  class="btn-btn btn btn-info success float-right">Submit</button>
</div>


                  



</form>