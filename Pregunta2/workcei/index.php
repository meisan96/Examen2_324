<?php
	include "cabecera.inc.php";
?>
<div class="login-page">
  <div class="form">
    
    <form class="login-form" method="POST" action="controlusuario.php">
      <input type="text" placeholder="usuario" name="usuario" />
      <input type="password" placeholder="password" name="password" />
      <button type="submit" name="login">login</button>
      <p class="message">FCPN <a href="#">Registro de CEI</a></p>
    </form>
  </div>
</div>
<?php
	include "pie.inc.php";
?>