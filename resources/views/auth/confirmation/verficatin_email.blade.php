@component('mail::message')
# Welcome {{ $user->name }}

Thanks for registering your school on our site, please activate your account by "Activate DMSZar Account" button, and enjoy our service. 

@component('mail::button', ['url' => url('/verifyemail/'.$user->email_token)])
Activate DMSZar Account
@endcomponent

Thanks,<br>
DMSZar Team
@endcomponent
