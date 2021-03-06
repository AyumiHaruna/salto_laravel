<div class="container-fluid footer">
  <div class="row">
    <div class="col-sm-6" id="form-left">
      <div class="row">
        <div class="col-md-12" id="title">
          Contacto:
        </div>
        <div class="col-2 text-right forElmLeft">
          <img src="{{ asset('img/info/icon_location.png') }}" alt="">
        </div>
        <div class="col-10 forElmLeft">
          Saltum <br>
          Av. Constituyentes #357 col. Daniel Garza. <br>
          Del. Miguel Hidalgo, Ciudad de México
        </div>

        <div class="col-2 text-right forElmLeft">
          <img src="{{ asset('img/info/icon_phone.png') }}" alt="">
        </div>
        <div class="col-10 forElmLeft">
          5276-6415 <br>
          01 800 2148-000
        </div>

        <div class="col-2 text-right forElmLeft">
          <img src="{{ asset('img/info/whatsapp_icon.png') }}" alt="">
        </div>
        <div class="col-10 forElmLeft">
          Whatsapp: <br>
          55 1399-5158
        </div>

        <div class="col-2 text-right forElmLeft">
          <img src="{{ asset('img/info/icon_mail.png') }}" alt="">
        </div>
        <div class="col-10 forElmLeft">
          contacto@saltum.org
        </div>

      </div>
    </div>
    <div class="col-sm-6" id="form-right">
      <div class="row">
        <form id="formContacto" action="#" method="post">
          <div class="col-md-12" id="title">
              Suscríbete:
          </div>
          <div class="col-md-12 forElmRight">
            Ingresa tu correo electrónico para recibir nuestros contenidos
          </div>
          <div class="col-md-12 forElmRight">
            <input type="text" name="" class="form-control" id="sus-mail">
          </div>
          <div class="col-md-12 text-right forElmRight">
            <button type="button" name="button" class="btn hoverButton" id="susSubBtn" onclick="suscribeValidator()">Enviar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-12 text-center" id="redes">
      <div> Síguenos: </div>
      <div>
        <a href="https://www.facebook.com/Saltum-181631609143753/" target="_blank"> <img src="{{ asset('img/info/iconfb.png') }}" alt="Facebook"> </a>
        <a href="https://www.instagram.com/saltum_coaching/" target="_blank"> <img src="{{ asset('img/info/icon_ig.png') }}" alt="Instagram"> </a>
        <a href="https://www.youtube.com/channel/UCXJyb2dNLGFg19lf8RDBg0g" target="_blank"> <img src="{{ asset('img/info/icon_youtube.png') }}" alt="youtube"> </a>
        <a href="https://plus.google.com/b/101277098629356156166/101277098629356156166" target="_blank"> <img src="{{ asset('img/info/icon_googleplus.png') }}" alt="Google+"> </a>
      </div>
      <div class="">
        <a href="#" class="avisoPriv"  onclick="return false;">Aviso de Privacidad</a>
      </div>
    </div>
  </div>
</div>

<!-- Analytics script -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-121185116-1');
</script>

<!-- AdWords -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-799579531');
</script>

<script type="text/javascript">
  var SubscriptionUrl =" {{ url('/suscribeNews') }}";
</script>

<script src="{{ asset('js/mainFunctions.js') }}"></script>
