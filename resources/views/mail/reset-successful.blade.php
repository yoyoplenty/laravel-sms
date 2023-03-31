@component("mail::message")

# Hello {{$user->firstname}},

Your Password Reset was successful

@component('mail::subcopy')
Thanks for using Haim Sms
@endcomponent

Thanks, <br>
{{ config('app.name') }}

@endcomponent
