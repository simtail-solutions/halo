@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Thank you</div>
    <div class="card-body">
        <p>Submitting this form generates an email to the client with a link to complete the form.
</p>

<p>This page will also include details about the process, what to expect etc</p>

<p>This will be the same process as "Send Application to client" however can have different messaging on this page and in the email to the client.</p>

    </div>
</div>

@include('includes.footer')
@endsection