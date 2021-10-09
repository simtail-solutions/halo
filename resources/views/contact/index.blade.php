@extends('layouts.app')

@section('content')
<div class="card card-default">
<div class="card-header">Contact</div>
<div class="card-body">
<div class="row m-3">
    <div class="col-md-5" style="border-right: 1px solid #ccc;">
Contact details and custom content here
    </div>
    <div class="col-md-7">

<form class="contact-form" method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
@csrf

<div class="form-group row my-1">
    <div class="col-lg-4">
        <label for="firstName">First Name</label>
    </div>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required >
    </div>
  </div>


<div class="form-group row my-1">
    <div class="col-lg-4">
        <label for="lastName">Last Name</label>
    </div>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required >
    </div>
  </div>

<div class="form-group row my-1">
    <div class="col-lg-4">
        <label for="email">Email</label>
    </div>
    <div class="col-lg-8">
        <input type="email" class="form-control" name="email" id="email" placeholder="" value="" required >
    </div>
  </div>


<div class="form-group row my-1">
    <div class="col-lg-4">
        <label for="phone">Phone</label>
    </div>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="phone" id="phone" placeholder="" value="">
    </div>
  </div>


<div class="form-group row my-1">
    <div class="col-lg-4">
        <label for="message">Message</label>
    </div>
    <div class="col-lg-8">
        <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
    </div>
  </div>

<div class="form-group row my-1">
    <div class="col-lg-4"></div>
    <div class="col-lg-8">
        <button type="submit"  class="btn btn-success float-right">Send message</button>
    </div>



</form>

</div>
</div>

</div></div>

@endsection