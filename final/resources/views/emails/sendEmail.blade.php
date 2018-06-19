Hello <i>{{ $user->firstname }} {{ $user->lastname}}</i>,
<p>You are receiving this email because we received a password reset request for your account. Click the button below to reset your password:</p>

<div>
  <a role="button" href="http://lbaw1756.lbaw-prod.fe.up.pt/password/reset/{{$token}}"> Reset Password</a>
</div>

Thank You,
<br/> TopBid
