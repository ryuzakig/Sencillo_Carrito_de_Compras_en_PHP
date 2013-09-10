<?php
require("class.phpmailer.php");
session_start();
if(isset($_SESSION['carrito'])){
$compras=$_SESSION['carrito'];
$pedido ="Pedido de productos Yume-Tec. <br><br>";
$total=0;
for($i=0;$i<=count($compras)-1;$i++){
if($compras[$i]!= NULL){
$pedido .= $compras[$i]['nombre']." ***** ".$compras[$i]['precio']." x " . $compras[$i]['cantidad'].
" Total: ".$compras[$i]['precio']*$compras[$i]['cantidad']." Dolares <br>";
$total= $total + $compras[$i]['precio']*$compras[$i]['cantidad'];

}

}
$pedido .= "<br><br>Total: " . $total;
$nombre = $_POST['nombre'];
$correo= $_POST['email'];
$pedido .="<br><br>De: ".$nombre;
$asunto="Pedido Tienda YUME-TEC";
$empresa="YUME-TEC | ";
$correo_empresa="contacto@programacionphp.liriosdesaron.net";

$mail = new PHPMailer();
$mail->Host = "http://programacionphp.liriosdesaron.net/";
$mail->From = $correo_empresa;
$mail->FromName = $empresa;
$mail->Subject = $asunto;
$mail->AddAddress($correo,"Compra a nombre ".$nombre);
$mail->AddAddress("saul.1519@gmail.com","Copia de Pedido ");
$mail->Body = $pedido;
$mail->AltBody = "YUME TEC\nprobando PHPMailer\n\nSaludos";
/*$mail->AddAttachment("images/foto.jpg", "foto.jpg");*/
$mail->Send();

}

?>
<!DOCTYPE html>
<html>
<body>
<h1>Usted est&aacute; siendo redirigido a la plataforma de pago... espere un momento</h1>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="pago" id="pago">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="josue_bl@hotmail.com">
<input type="hidden" name="item_name" value="YUME-TEC">
<input type="hidden" name="item_number" value="FM">
<input type="hidden" name="amount" value="<? echo $total;?>">
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="lc" value="ES">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
      <!--</form>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="pago" id="pago">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="BFSV96GA6P97S">
<input type="hidden" name="amount" value="<? echo $total;?>">
<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
</form>-->
<script >
	  function someter(){
	  	document.pago.submit();
	  }
	  someter();
	  
	  </script>
</body>




</html>
