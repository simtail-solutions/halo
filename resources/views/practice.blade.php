@extends('layouts.app')

@section('content')
<div class="card card-default">
<div class="card-header">Benefits to the Practice</div>
<div class="card-body">
<!--strong>Make content editable by admin</strong-->
<h2>HALO Dental Payment Plans</h2>
<h3>We provide a simple, innovative financial product that delivers real value to your clients helping grow the financial wellness of your business</h3>
<div class="row">
<div class="col-md-6">
<ul>
<li>We cover treatment costs from $2,000 to $50,000</li>
<li>Our partnership philosophy is cashflow, revenue and support</li>
<li>There is absolutely no cost to your practice for our service</li>
<li>We provide free in-practice and website marketing</li>
<li>Rates from 7.5% (comparison 8.7%)</li>
<li>We offer all types of financne for dental staff - cars, homes, anything!</li>
<li>Industry leading personal and business loans for dental professionals</li>
<li>If you practice is accredited with HALO, we can fund you directly</li>
<li>Loans up to $50,000 typically approved same day</li>
<li>HALO is trusted by dental professionals Australia wide</li>
<li>Hassle free, we hand the application from submission to approval</li>
</ul></div>
<div class="col-md-6">
<a href="#">E Brochure - download or preview from here</a></div>
</div>
<div class="d-flex justify-content-between m-3">
    <a href="/applications/create" class="btn btn-secondary">Start Application</a>
    <a class="btn btn-secondary inc">Request Halo Brochures</a>
    <a href="/applicants/create" class="btn btn-secondary filter-button sub">Email Application to Customer</a>
    <a href="/contact" class="btn btn-secondary filter-button dec">Contact us</a>
</div>
</div></div>

@include('includes.footer')
@endsection

