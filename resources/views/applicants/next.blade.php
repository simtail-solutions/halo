@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Thank you</div>
    <div class="card-body">
        <p>Submitting this form generates an email to the client with a link to complete the form.
</p>

<p>This page will also include details about the process, what to expect etc</p>

<p>"Quick Customer Referral" and "Send Application to client" follows the same process with different messaging to client/referrer.</p>

    </div>
</div>

@include('includes.footer')
@endsection