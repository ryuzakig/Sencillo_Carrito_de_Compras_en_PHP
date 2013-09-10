<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header("location:nuevo_usuario.php?nologin=false");
    
}
$_SESSION["usuario"];
if(isset($_SESSION['carrito'])){
	$compras=$_SESSION['carrito'];

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YUME | TEC , Tu Solución</title>
<link href="css/estilo.css" type="text/css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
<script src="jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>  
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="js/slide.js" type="text/javascript"></script>

</head>
<body>
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Bienvendio a Yume|TEC</h1>
				<h2>Tienda especializada en articulos informaticos</h2>		
				<p class="grey">Gracias por visitarnos, si aun no es miembro puede registrarse en este panel.Y si ya es miembro puede entrar con sus datos correspondientes!</p>
				
			</div>
			<div class="left">
				<!-- Login Form -->
				  <?php
          if ( ! empty($_SESSION["usuario"]) ) {
            echo '<a href="cerrar_sesion.php">Cerrar Sesion</a> ';
          } else {
            echo '
            <form class="clearfix" action="index2.php" method="post">
          <h1>Miembros</h1>
          <label class="grey" for="log">Usuario:</label>
          <input class="field" type="text" name="log" id="log" value="" size="23" />
          <label class="grey" for="pwd">Contraeña:</label>
          <input class="field" type="password" name="pwd" id="pwd" size="23" />
                <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Recordarme</label>
              <div class="clear"></div>
          <input type="submit" name="submit" value="Entrar" class="bt_login" />
          <a class="lost-pwd" href="#">¿A perdido su contraseña?</a>
        </form>
            ';
          }
        ?>
			</div>
			
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Hola <?php if (!isset($_SESSION["usuario"])) {
			echo "Invitado";}else {echo $_SESSION["usuario"];} ?></li>
			<li class="sep">|</li>
			<li id="toggle">
        <a id="open" class="open" href="#"><?php if (!isset($_SESSION["usuario"])) {
      echo "Entrar";}else {echo "Salir"; } ?></a>
        <a id="close" style="display: none;" class="close" href="#">Cerrar Panel</a>      
      </li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div>
<div id="total">


   	<div id="contenido">
	    	<div id="cabecera">
            <div id="nav">
    	<ul>
        <li><a href="index2.php" class="main">Inicio</a></li>
        <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
         <li><a href="nosotros.php" class="main">Nosotros</a></li>
         <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
          <li><a href="categorias.php" class="main">Productos</a></li>
          <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
           <li><a href="contacto.php" class="main">Contacto</a></li>
           <li><img src="img/naviseparator.gif" alt="" width="40" height="13" /></li>
           <li><a href="carrito.php" class="main">Carrito</a></li>
        </ul>
	</div>
            	<div class="FL"></div>
                <div class="FR"></div>
        </div>
        <div class="categorias">
 <br>
 <p align="center">Bienvenido: <?php echo $_SESSION["usuario"]; ?></p><br />
 <p align="center">Este es el resumen de su compra, verifique su pedido e ingrese sus datos</p>
   
      <br>
      <form method="post" action="final.php">
    <table width="90%"  height="90%"border="1" align="center" id="tablacarrito">
<tr align="center" style="background-color:#fff; color:#000">
  <td>&nbsp;</td>
  <td align="right">Nombre:</td>
  <td><label for="nombre"></label>
    <input type="text" name="nombre" id="nombre" size="50" value="<?php echo $_SESSION["usuario"]; ?>" required></td>
  <td>&nbsp;</td>
</tr>
<tr align="center" style="background-color:#fff; color:#000">
  <td height="39">&nbsp;</td>
  <td align="right">E-Mail:</td>
  <td><label for="email"></label>
    <input type="email"  name="email" id="email" size="50" required></td>
  <td>&nbsp;</td>
</tr>
<tr align="center" style="background-color:#008fbe; color:#fff">
    <td width="27%" height="28" >PRODUCTO</td>
    <td width="18%" >PRECIO</td>
    <td width="37%" >CANTIDAD</td>
    <td width="18%" >TOTAL</td>
  </tr>
  <?php
  if(isset($_SESSION['carrito'])){
	  $total=0;

for($i=0;$i<=count($compras)-1;$i++){
	
	if($compras[$i]!=NULL){
	
  ?>
  <tr align="center">
    <td><?php echo $compras[$i]['nombre']; ?></td>
    <td><?php echo $compras[$i]['precio']; ?></td>
    <td><?php echo $compras[$i]['cantidad'];?></td>
    <td>
	<?php echo $compras[$i]['cantidad'] * $compras[$i]['precio'];?>
    </td>
  </tr>
  <?php
  $total= $total+($compras[$i]['cantidad'] * $compras[$i]['precio']);
}
  }
  }
  
  ?>
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><p>&nbsp;</p>
      <p>TOTAL A PAGAR::</p></td>
    <td><p>&nbsp;</p>
    <p><?php if(isset($_SESSION['carrito'])){ echo "$ ".$total." Dolares ";}?></p>
    </td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Enviar pedido a PayPal"></td>
  </tr>
    </table>
    </form>
</div>
        </div>

    <div id="pie">
    <p>Copyright 2011 - YUME | TEC. Hecho por Jaime Lainez, Jeronimo Castaneda y Saul Guardado</p>
    </div>
    </div>
</body>
</html>
