@component("mail::message")

# Hello {{$user->firstname}},

Click on the Link Below to Reset you password,

@component('mail::button', ['url' => 'localhost:8000/api/v1/reset_password/'. $data])
Reset Password
@endcomponent

@component('mail::subcopy')
Thanks for using Haim Sms
@endcomponent

Thanks, <br>
{{ config('app.name') }}

@endcomponent
