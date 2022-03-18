@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Sent to Customer</div>
    <div class="card-body text-center">
        <p>&nbsp;</p>
        <h1>Sent!</h1>

<p>Your client has been sent a link to complete their finance application form online.</p>

<p>You can login to your dashboard and view the progress of all your referrals at anytime.</p>
<p>&nbsp;</p>
<a href="{{ route('applications.index') }}" class="btn btn-info">All Applications</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    </div>
</div>

@include('includes.footer')
@endsection