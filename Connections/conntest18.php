<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conntest18 = "localhost";
$database_conntest18 = "tpqidb";
$username_conntest18 = "root";
$password_conntest18 = "12345678";
$conntest18 = mysql_pconnect($hostname_conntest18, $username_conntest18, $password_conntest18) or trigger_error(mysql_error(),E_USER_ERROR); 
?>