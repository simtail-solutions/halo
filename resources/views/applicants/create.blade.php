@extends('layouts.app')

@section('content')

<div class="card card-default">
<div class="card-header">
  Customer Referral
</div>

@guest
<div class="p-5 text-center">
<div class="alert alert-danger">You need to be logged in to access this page - <a href="{{ route('login') }}">Login</a> here, or <a href="{{ route('register') }}">Register</a> as a new referrer.</div>
</div>
  
@endguest

@auth


@include('partials.referral')



@include('includes.footer')
@endauth
@endsection

