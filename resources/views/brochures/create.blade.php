@extends('layouts.app')

@section('content')

<div class="card card-default">
<div class="card-header">
Send Pretty Penny Finance Brochure to Client</div>

<div class="card-body">

@guest
<div class="p-5 text-center">
<div class="alert alert-danger">You need to be logged in to access this page - <a href="{{ route('login') }}">Login</a> here, or <a href="{{ route('register') }}">Register</a> as a new referrer.</div>
</div>
  
@endguest
@auth


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row m-3">
      <div class="col mx-3">
        <p>If your customer has requested a little more information, <strong>Email Brochure to Customer</strong> is a great way to provide them all the info they require.</p>
        <ol>
          <li>Simply enter your customers details and submit!</li>
          <li>An email containing our eBrochure will be sent to the customer. The email will also contain our contact details and a link to apply when they're ready.</li>
          <li>If the customer has decided to proceed and has submitted the application, you'll be able to track it in your Pretty Penny portal account.</li>
        </ol>
      </div>
    </div>

<form class="brochure-form application-form" action="{{ route('brochures.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
@csrf

<div class="form-section-brochure">
  
  <div class="row">
    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
  </div>
      
  <div class="row m-3">

    

  <div class="row m-3">
    <div class="col-6">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"  value=" "  required>
      </div>
    </div>

    <div class="col-6">
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"  value=" "  required>
      </div>
    </div>
      
  </div>

  
  <div class="row m-3">
      
    <div class="col-lg-6">
      <div class="form-group">
        <label for="phone">Mobile Number</label>
        <input type="text" class="form-control" onKeyUp=check() minlength="12" id="phone" name="phone" placeholder="" required>
      </div>
      <div id="warning" class="mx-3">

      </div>
    </div>
    <script>
      function check() {
            stringLength = document.getElementById('phone').value.length;
            if (stringLength <= 11) {
                document.getElementById('warning').innerText = "Not enough digits!"
            } else {
                document.getElementById('warning').innerText = ""
            }
        }
    </script>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="">
      </div>
    </div>
      
  </div>

    <div class="row mx-3">

      
      <span class="my-4 d-flex justify-content-center">
        
      <label id="sample" class="form-check-label mr-5" for="defaultCheck1">
        <input type="checkbox" id="acceptance" name="acceptance" value="" required>
          &nbsp;&nbsp;Clicking "Submit" confirms you've obtained the customer's consent to provide their contact details to Pretty Penny Finance
        </label>
       
      </span>
    
</div>
  

<div class="form-navigation d-flex justify-content-center">
<input type="hidden" name="category_id" id="category_id" value="1">
<button type="submit"  class="btn btn-lg btn-info success m-3">Submit</button>
</div>                
         
</form>

<script>
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
</script>

</div></div>



@include('includes.footer')
@endauth
@endsection

