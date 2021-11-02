@extends('layouts.app')

@section('content')

<div class="card card-default">
<div class="card-header">
  Customer Referral
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

<form class="application-form" action="{{ route('applicants.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-section">
  
  <div class="row">
    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
  </div>
      
  <div class="row m-3">

    

  <div class="row m-3">
    <div class="col-lg-1">
      <div class="form-group">
        <label for="repayment">Title</label>
          <select class="form-control" id="apptitle"  name="apptitle" value=""  required>
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
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"  value=" "  required>
      </div>
    </div>

    <div class="col-3">
      <div class="form-group">
        <label for="middlename">Middle Name</label>
        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name"  value=" " >
      </div>
    </div>

    <div class="col-4">
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
        <input type="number" class="form-control" id="phone" name="phone" placeholder="" required>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="">
      </div>
    </div>
      
  </div>

  

<div class="form-navigation">
<input type="hidden" name="category_id" id="category_id" value="1">
<button type="submit"  class="btn btn-primary success float-right">Send to client</button>
</div>

<script type="text/javascript">
                  $('.dob').datepicker({  
                    format: 'dd-mm-yyyy'
                  });
                  </script>


                  
         
</form>
<p>&nbsp;</p>
<p>This is a quick referral form where referrers can enter customers details.</p>
<p>The customer will be then sent a link to the application with these details pre-filled.</p>
<p>Upon submission, this form will redirect to a page advising the referrer of what steps have been taken.</p>
</div></div>
@include('includes.footer')
@endsection

