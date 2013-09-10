<?php require_once('Connections/tienda.php'); ?>
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
             header("location:cat_procesadores.php?login=true");
				echo '<script type=\"text/javascript\">alert(\"Gracias Por Registrarse\");</script>';

         }
}

	}else{
		$_SESSION["usuario"];
		
		}
		
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_listado = 9;
$pageNum_listado = 0;
if (isset($_GET['pageNum_listado'])) {
  $pageNum_listado = $_GET['pageNum_listado'];
}
$startRow_listado = $pageNum_listado * $maxRows_listado;

mysql_select_db($database_tienda, $tienda);
$query_listado = "SELECT * FROM productos WHERE id_cat=1";
$query_limit_listado = sprintf("%s LIMIT %d, %d", $query_listado, $startRow_listado, $maxRows_listado);
$listado = mysql_query($query_limit_listado, $tienda) or die(mysql_error());
$row_listado = mysql_fetch_assoc($listado);

if (isset($_GET['totalRows_listado'])) {
  $totalRows_listado = $_GET['totalRows_listado'];
} else {
  $all_listado = mysql_query($query_listado);
  $totalRows_listado = mysql_num_rows($all_listado);
}
$totalPages_listado = ceil($totalRows_listado/$maxRows_listado)-1;

$queryString_listado = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_listado") == false && 
        stristr($param, "totalRows_listado") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_listado = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_listado = sprintf("&totalRows_listado=%d%s", $totalRows_listado, $queryString_listado);
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
            	<div class="FL"><img src="img/procesadores.jpg"/></div>
                <div class="FR"></div>
        </div>
        <div class="productos" id="productos">
        <br />
    <br><table width="100%" height="100%" border="1" align="center">
	<?php 
	$contador=0;
	
	do { 
	if ($contador==0){
		?>
        <tr>
        <?php
        }
		$contador++;
		?>
          <td><a href="detalles.php?id_producto=<?php echo $row_listado['id_producto']; ?>"><img src="imagenes/productos/<?php echo $row_listado['imagen']; ?>" width="200" height="200"></a>            
            <h3><?php echo $row_listado['nombre']; ?></h3>
            <p>$<?php echo $row_listado['precio']; ?><br>
            </p>
            <form name="form1" method="post" action="carrito.php">
              <input type="image" name="imageField" id="imageField" src="imagenes/comprar.gif">
              <input name="nombre" type="hidden" id="nombre" value="<?php echo $row_listado['nombre']; ?>">
              <input name="precio" type="hidden" id="precio" value="<?php echo $row_listado['precio']; ?>">
              <input name="cantidad" type="hidden" id="cantidad" value="1">
            </form>
            <p>              <br>
            </p>
          <p>&nbsp;</p></td>
            <?
			if ($contador==3){
				$contador=0;
		?>
        </tr><br>
        <?
			}
			?>
      
      <?php } while ($row_listado = mysql_fetch_assoc($listado)); ?>
      </table></div>
      <div id="paginacion">
  <table width="255" border="0"  align="center" >
    <tr>
      <td><?php if ($pageNum_listado > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, 0, $queryString_listado); ?>">Primero</a>
          <?php } // Show if not first page ?></td>
      <td> <?php if ($pageNum_listado > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, max(0, $pageNum_listado - 1), $queryString_listado); ?>">Anterior</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_listado < $totalPages_listado) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, min($totalPages_listado, $pageNum_listado + 1), $queryString_listado); ?>">Siguiente</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_listado < $totalPages_listado) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_listado=%d%s", $currentPage, $totalPages_listado, $queryString_listado); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
   	</div>

    <div id="pie">
    <p>Copyright 2011 - YUME | TEC. Hecho por Jaime Lainez, Jeronimo Castaneda y Saul Guardado</p>
    </div>
    </div>
</body>
</html>
