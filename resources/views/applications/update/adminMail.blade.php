The incomplete application for {{ $firstname }} {{ $lastname }} has now been finalised and submitted by the applicant.
<br>
<br>
Referrer: {{ $user }}<br>
<br>
<a href="{{ route('application.show', $api_token ) }}" class="btn btn-primary">View Updated Application</a>
<br>