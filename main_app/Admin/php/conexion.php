<?php 
function getConnexion()
{
  $mysqli = new Mysqli('dbhamse.cgykoqp1l4le.us-east-1.rds.amazonaws.com:3306', 'lance', '7201mega', 'dbhamsecon');
  if($mysqli->connect_errno) exit('Error en la conexión: ' . $mysqli->connect_errno);
  $mysqli->set_charset('utf8');
  return $mysqli;
}