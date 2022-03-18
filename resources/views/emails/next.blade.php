@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Application sent to customer</div>
    <div class="card-body text-center">
    <p>&nbsp;</p>
        <h1>Application Sent!</h1>
        <p>We have sent your client a link to complete an online application form for finance.
</p>

<p>You can track referral applications from your Dashboard, you will also receive a notification when the form has been completed.</p>
<p>&nbsp;</p>
<p><a href="{{ route('applications.index') }}" class="btn btn-info">View all Referrals</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    </div>
</div>

@include('includes.footer')
@endsection
