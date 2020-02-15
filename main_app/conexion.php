<?php
$mysqli=new mysqli('dbhamse.cgykoqp1l4le.us-east-1.rds.amazonaws.com:3306','lance','7201mega','dbhamsecon');
if ($mysqli->connect_errno)
 {
   echo "Error al conectarse con My SQL debido al error".$mysqli->connect_error;  
}
 ?>
