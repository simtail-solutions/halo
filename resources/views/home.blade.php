@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center text-center">
    <div class="col-md-10 offset-md-1">

                <h1>{{ __('Dashboard') }}</h1>


                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
@auth                   
Hello  
@if (isset(Auth::user()->businessName))   
    {{ Auth::user()->businessName }}<span>,</span> 
{{ __('welcome back!') }}
@endif
@endauth

@guest
 Please <a href="{{ route('login') }}" class="">login</a> or <a href="{{ route('register') }}" class="">register</a> to use all the features of this portal
@endguest
<div class="row align-items-center my-4">
    <div class="col-lg-4 col-md-6 dashboard p-5">
        <a href="{{ route('applications.create') }}">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="{{ URL::asset('/img/start-2.png') }}" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Start Application</strong>
        </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 dashboard p-5">
    <a href="{{ route('applicants.create') }}">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="{{ URL::asset('/img/quick-2.png') }}" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Quick Customer Referral</strong>
        </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 dashboard p-5">
    <a href="{{ route('emails.create') }}">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="{{ URL::asset('/img/email-2.png') }}" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Email Application to Customer</strong>
        </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6 dashboard p-5">
    <a href="{{ route('brochures.create') }}">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="{{ URL::asset('/img/brochure-2.png') }}" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Email HALO Brochure to Customer</strong>
        </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 dashboard p-5">
    <a href="{{ URL::asset('/img/Application-Pad.pdf') }}" target="_blank">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="{{ URL::asset('/img/print-2.png') }}" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Printable Application Form</strong>
        </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 dashboard p-5">
    <a href="{{ route('contact.index') }}">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="{{ URL::asset('/img/contact-2.png') }}" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Contact Us</strong>
        </div>
        </a>
    </div>
</div>

                 
                
                   

            
        </div>

    </div>
    

    
</div>

@include('includes.footer')

@endsection

