@extends('layouts.app')

@section('content')
<div class="card card-default">
<div class="card-header">Benefits to the Practice</div>
<div class="card-body p-5">

<h2 class="mb-3">Pretty Penny Dental Payment Plans</h2>
<h3 style="line-height:1.5">We provide a simple, innovative financial product that delivers real value to your clients helping grow the financial wellness of your business</h3>
<div class="row py-4">
<div class="col-lg-6">
<ul>
<!-- <li>We cover treatment costs from $2,000 to $50,000</li> -->
<li>Our partnership philosophy is cashflow, revenue and support</li>
<li>There is absolutely no cost to your practice for our service</li>
<li>We provide free in-practice and website marketing</li>
<li>Rates from 7.5% (comparison 8.7%)</li>
<li>We offer all types of financne for dental staff - cars, homes, debt consolidations, anything!</li>
<li>Industry leading personal and business loans for dental professionals</li>
<li>If your practice is accredited with Pretty Penny Finance, we can fund you directly</li>
<li>Loans up to $50,000 typically approved same day</li>
<li>Pretty Penny Finance is trusted by dental professionals Australia wide</li>
<li>Hassle free, we hand the application from submission to approval</li>
</ul></div>
<div class="col-lg-6 py-4 d-flex justify-content-around">
<div class="dashboard p-5" style="border-radius: 50%;width: 275px;">
    <a href="#">
        <div class="d-flex h-75 align-items-center justify-content-center">
            <img src="http://127.0.0.1:8000/img/brochure-2.png" alt="">
        </div>
        <div class="d-flex h-25 align-items-center justify-content-center">
            <strong>Download eBrochure</strong>
        </div>
        </a>
    </div>
</div>
<div id="benefits-btn" class="d-flex justify-content-between m-3">
    <a href="/applications/create" class="btn btn-lg btn-info">Start Application</a>
    <a class="btn btn-lg btn-secondary inc">Request Pretty Penny Finance Brochures</a>
    <a href="/applicants/create" class="btn btn-lg btn-secondary filter-button sub">Email Application to Customer</a>
    <a href="/contact" class="btn btn-lg btn-secondary filter-button dec">Contact us</a>
</div>
</div></div>

@include('includes.footer')
@endsection

