@component('bee-notify::vendor.mail.html.message')
  Dear Customer,
  Have you trouble signing in?

  Resetting your password is easy.

  Just press the button below and follow the instructions. We’ll have you up and running in no time.
  @component('mail::button', ['url' => $url])
    Reset Password
  @endcomponent

  If you did not make this request then please ignore this email.

  Best regards,
  SunSport Support Team.
@endcomponent
