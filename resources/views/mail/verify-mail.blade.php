@component("mail::message")

# Hello {{$user->firstname}} {{$user->lastname}},

Click on the Link Below to Verify your email address,

@component('mail::button', ['url' => 'localhost:8000/api/v1/confirm_email/'. $data])
Confirm Email
@endcomponent

@component('mail::subcopy')
Thanks for using Haim Sms
@endcomponent

Thanks, <br>
{{ config('app.name') }}

@endcomponent
