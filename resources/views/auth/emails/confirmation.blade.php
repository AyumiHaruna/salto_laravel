<h2>Hola {{ $name }}</h2>

Da click en el siguiente enlace para validar tu cuenta: <br>
<h3>
  <a href="{{ url( '/accountVallidation/'.$id.'/'.$confirmation_code ) }}"> Validar Cuenta </a>
</h3>
