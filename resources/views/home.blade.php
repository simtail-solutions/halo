@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    Hi {{ Auth::user()->name }} 
                        @if (isset(Auth::user()->businessName)) <span> - </span> {{ Auth::user()->businessName }} 
                        @endif

                        <ul>
                            <li><a href="/applications/create">Start Application</a></li>
                            <li><a href="/applicants/create">Quick Customer Referral</a></li>
                            <li><a href="#">Email Application to Customer</a></li>
                            <li><a href="#">Email HALO Brochure to Customer</a></li>
                            <li><a href="#">Print Application</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        </ul>
                
                    {{ __('You are logged in!') }}
                </div>
                
            </div>
            
        </div>
        <div class="col-md-4">
                    <div class="badge badge-danger w75">Instructions for using this portal
                    Video etc</div>
                    </div>
    </div>
    

    
</div>

@include('includes.footer')

@endsection

