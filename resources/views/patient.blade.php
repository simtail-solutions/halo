@extends('layouts.app')

@section('content')
<div class="card card-default">
<div class="card-header">Benefits to the Patient</div>
<div class="card-body p-5">

<h2 class="mb-3">Pretty Penny Dental Payment Plans</h2>
<h3>A Healthy Payment Alternative for your Dental Treatment</h3>
<div class="row py-4">
<div class="col-lg-6">
<ul>
<li>Unsecured Personal Loans from $2,000 to $63,000</li>
<li>Secured Personal Loans from $50,000 to $70,000</li>
<!-- <li>Purpose - dental cost and debt consolidation upon request</li> -->
<li>Repayment Terms from 6 months to 7 years</li>
<li>Fortnightly or Monthly repayments</li>
<li>We provide an obligation free quote that won’t affect your credit file</li>
<li>Quotes are personalised and based on your credit score</li>
<li>Rates starting from 5.95% (comparison rate 6.4%)</li>
<li>Loans up to $50,000 typically approved same day</li>
<li>No upfront out of pocket costs</li>
<li>No early repayment fees</li>
<li>Applicants must be employed</li>
<li>Applicants must be over the age of 18</li>
<!-- <li>In most circumstances we simply confirm ID and income</li>
<li>Hassle free, we hand the application from submission to approval</li> -->
</ul></div>
<div class="col-lg-6 py-5 d-flex justify-content-around">
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
</div>
<div id="benefits-btn" class="d-flex justify-content-between m-3">
    <a href="/applications/create" class="btn btn-lg btn-info">Start Application</a>
    <a href="/applicants/create" class="btn btn-lg btn-secondary inc">Quick Customer Referral</a>
    <a href="/applicants/create" class="btn btn-lg btn-secondary filter-button sub">Email Application to Customer</a>
    <a class="btn btn-lg btn-secondary filter-button dec">Email Brochure to customer</a>
</div>
</div></div>

@include('includes.footer')

@endsection