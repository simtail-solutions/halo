Hello {{ $user }}<br>
Email: {{$email_address}}
<br><br>
Your patient {{ $firstname }} {{ $lastname }} has successfully submitted their application for finance.
<br><br>
You can login at any time to check the progress of all your referral applications.
<br><br>
<a href="{{ route('applications.index') }}">Log in</a>
<br><br>
Regards
Halo Finance