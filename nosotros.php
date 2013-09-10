<?php
session_start();
if(!isset($_SESSION["usuario"])){
require_once('Connections/tienda.php'); 
     mysql_select_db($database_tienda) or die ("No se encuentra la base de datos especificada");
if (isset($_POST['log'])){
$nickname=$_POST['log'];
$contrasena=$_POST['pwd'];
$valido=true;
 $consulta2="SELECT * FROM usuario where nickname='$nickname' AND contrasena='$contrasena'";
         $result=mysql_query($consulta2) or die (mysql_error());
         $filasn= mysql_num_rows($result);
         if ($filasn<=0 || isset($_GET['nologin']) ){
             
             $valido=false;
         }else{
        $rowsresult=mysql_fetch_array($result);          
        $_SESSION['idusuario']= $rowsresult['idusuario'];
             $valido=true;
             //guardamos en sesion el carnet del usuario ya que ese es el identificados en la base de datos
             $_SESSION["usuario"]=$nickname;
             header("location:nosotros.php?login=true");
				echo '<script type=\"text/javascript\">alert(\"Gracias Por Registrarse\");</script>';

         }
}

	}else{
		$_SESSION["usuario"];
		
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
            	<div class="FL"><img src="img/nosotros.jpg"/></div>      
      </div>
<div id="historia" style=" clear:left; line-height:40px; font-size:18px; text-align:center">
<br />
<p>YUME TEC fue fundada en noviembre de 2011 Por Jaime Lainez, Jeronimo Castaneda y Saul Guardado con la iniciativa de ofrecer el servicio de venta  de equipo de computo a todas las personas de la zona de chalatenango.</p><br></div><br />
<div id="mision" class="mi_vi">
<h1>Mision</h1><br>
<p>Brindar asesor&iacute;a y soluciones a  las necesidades del mercado Salvadore&ntilde;o en el &aacute;rea de la inform&aacute;tica, a trav&eacute;s de una administraci&oacute;n profesional con productos de calidad y valor agregado a los servicios que ofrecemos.</p></div>
<div id="vision" class="mi_vi">
<h1>Vision</h1> <br>
<p>Llegar a ser la Empresa l&iacute;der en la asesor&iacute;a y venta de soluciones inform&aacute;ticas, maximizando nuestros esfuerzos, minimizando sus costos y actualiz&aacute;ndonos con tecnolog&iacute;a de &uacute;ltima generaci&oacute;n.</p>
   	  </div>

    
    </div>
    <div id="pie" >
    <p>Copyright 2011 - YUME | TEC. Hecho por Jaime Lainez, Jeronimo Castaneda y Saul Guardado</p>
    </div>
</body>
</html>
