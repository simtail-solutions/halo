@extends('layouts.app')

@section('content')

<div class="card card-default">
<div class="card-header">
  Email Application
</div>

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

<form class="application-form" action="{{ route('emails.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-section-email">
  
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
        <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="">
      </div>
    </div>
      
  </div>

  

<div class="form-navigation d-flex justify-content-center">
<input type="hidden" name="category_id" id="category_id" value="1">
<button type="submit"  class="btn btn-info btn-lg success m-3">Email Application to Client</button>
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

