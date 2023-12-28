@component('bee-notify::vendor.mail.html.message')
  Thank you for signing up, {{ $user->name }}

  We built sunsport.tv to meet customer satisfaction, bring an ideal experience of watching sport matches.

  In SunSport, we are broadcasting the high quality HD screen with an extremely cheap price.

  If you are interested with our site, please check the price here: https://sunsport.tv/pricing

  @component('mail::button', ['url' => 'https://sunsport.tv/pricing'])
  Register now!
  @endcomponent

  All the best,
  SunSport Service Team.
@endcomponent
