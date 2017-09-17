Hi, {{ $username }}

<p>We warmly welcomes you in the new technology world of crossover.</p>

<p>Please click below link and verify your account.</p>

<p><i><a href="{{ url('/user/verify/'.base64_encode($email).'/'.$verification_code) }}">Verify My Account</a></i></p>

<p></p>
Regards,<br />
Crossover news team.