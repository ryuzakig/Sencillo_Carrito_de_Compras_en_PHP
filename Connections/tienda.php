<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_tienda = "localhost";
$database_tienda = "tienda";
$username_tienda = "root";
$password_tienda = "";
$tienda = mysql_pconnect($hostname_tienda, $username_tienda, $password_tienda) or trigger_error(mysql_error(),E_USER_ERROR); 
?>