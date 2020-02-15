<?php
if(!isset($_POST['search'])) exit();

  require_once 'conexion.php';

  $mysqli = getConnexion(); 
 $search = $mysqli->real_escape_string($_POST['search']);

  $query2 = "SELECT Destino FROM consults where Centro_de_entrega like '%$search%' order by Destino+0 asc";
  $res2 = $mysqli->query($query2);
  $Destino=array();

  while($row2=$res2->fetch_array(MYSQLI_ASSOC)){

  $Destino[]=$row2['Destino'];
}
  $Destino=array_filter(array_unique($Destino));
echo '<option value="">Elegir Destino</option>';

  foreach($Destino as $des) {
    echo '<option>'.($des);
    echo'</option>'; 
  }