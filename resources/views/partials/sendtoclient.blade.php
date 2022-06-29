<form class="" action="{{-- {{ route('application.resendEmail', $application->api_token) }} --}}" method="POST" enctype="multipart/form-data">
@csrf
@method ('GET')
<button class="btn btn-info" type="submit">Send to client</button>
</form>
<!--comment out when testing complete-->
<a href="/applications/{{ $application->api_token }}/edit">Update Application</a>
<!--comment out above when testing complete-->