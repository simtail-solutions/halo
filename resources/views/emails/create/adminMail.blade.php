An application form has been sent to a prospective client.
<br>
<br>
Referrer: {{ $user_business }}<br>
Applicant: {{ $firstname }} {{ $lastname }}<br>
<br>
<a href="{{ route('application.show', $api_token ) }}" class="btn btn-primary">View Application</a>
<br>
