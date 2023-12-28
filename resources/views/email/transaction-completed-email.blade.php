@component('bee-notify::vendor.mail.html.message')

  # New login to your account

  Hi , we detected a new login on {{ config('app.name') }}.

  Browser:
  Operating system:
  Position:
  IP:

  If it was you, you can safely ignore this email. If it wasn't you, change your password to help protect your account.

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
