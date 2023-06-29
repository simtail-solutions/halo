@component('mail::message')
# Hello {{ $applicantFirstName }}

We are delighted you've requested a Pretty Penny Brochure from {{ $referrer }}.

Pretty Penny Finance provide an obligation free quote that doesn't affect your credit file.

@component('mail::button', ['url' => $downloadLink])
Download Our Brochure
@endcomponent

If you'd like to get the ball rolling the application should only take a few minutes.

@component('mail::button', ['url' => $applyLink])
Apply Here
@endcomponent

Please ensure the application is completed in full and truthfully. We will require a few documents 
to confirm your income and ID:

- Medicare Card and Drivers Licence (Passport if licence not available)
- Two (2) most recent payslips

**Please note - blurry copies will not be accepted**.

Thanks,<br>
{{ config('app.name') }}
@endcomponent