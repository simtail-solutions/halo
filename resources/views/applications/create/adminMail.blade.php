A new application for finance has been submitted.
<br>
<br>
Referrer: {{ $user }}<br>
Applicant: {{ $firstname }} {{ $lastname }}<br>
<br>
<a href="{{ route('application.show', $api_token ) }}" class="btn btn-primary">View Application</a>
<br>
