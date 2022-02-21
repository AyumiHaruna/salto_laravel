<h2>Hola {{ $data['name'] }}</h2>

Da click en el siguiente enlace para validar tu cuenta: <br>
<h3>
  <a href="{{ url('/accountVallidation/'.$data['id'].'/'.$data['confirmation_code']) }}"> Validar Cuenta </a>
</h3>
