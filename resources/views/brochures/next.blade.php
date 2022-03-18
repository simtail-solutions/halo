@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Brochure Sent</div>
    <div class="card-body text-center">
        <h1>Brochure sent!</h1>
        <p>A Halo brochure has been sent to your customer.
</p>

<p>&nbsp;</p>

<p><a href="{{ route('home') }}" class="btn btn-info">Return to Dashboard</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    </div>
</div>

@include('includes.footer')
@endsection