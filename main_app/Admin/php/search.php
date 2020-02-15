<?php 
if(!isset($_POST['search'])) exit('No se recibió el valor a buscar');

require_once 'conexion.php';

function search()
{
  $mysqli = getConnexion();
  $search = $mysqli->real_escape_string($_POST['search']);
  $where="Centro_de_entrega LIKE '%$search%'";
  $s2 = $mysqli->real_escape_string($_POST['s2']);
if($s2!=''){

  $where= "Centro_de_entrega LIKE '%$search%' AND Destino LIKE '%$s2%'";
}
  $query = "SELECT * FROM consults WHERE $where order by date desc";
  $res = $mysqli->query($query);
  
echo '<table class="table table-bordered">';  // opening table tag
echo'  <thead><tr><th>FOLIO</th><th>CENTRO DE ENTREGA</th><th>DESTINO</th><th>PRODUCTO</th><th>TURNO</th>
<th>CLAVE</th><th>TRANSPORTISTA</th><th>CAPACIDAD</th><th>FECHA Y HORA DE FACTURACION</th><th>ESTADO DEL PEDIDO</th>
<th>FECHA DEL PEDIDO</th></tr>  </thead>  <tbody>'; //table headers

  while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
	 if($row['Estado_de_atencion']=='CARGANDO'){
    echo'<tr class="yellow">'; // printing table row
	  }else if($row['Estado_de_atencion']=='FACTURADO'){
    echo'<tr class="green">'; // printing table row
  }else if($row['Estado_de_atencion']=='PROGRAMADO'){
    echo'<tr class="prog">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, CAMBIO DE PRODUCTO'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO,'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, ERROR EN CAPTURA DE DATOS'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, VENCIMIENTO FECHA OPERATIVA'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, CAMBIO DE CAPACIDAD MENOR A MAYOR'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, CLIENTE NO SE PRESENTO'){
    echo'<tr class="canc">'; // printing table row
		}else if($row['Estado_de_atencion']=='CANCELADO, ORDEN DE CONTROL EXCEDIDA'){
    echo'<tr class="canc">'; // printing table row
		}else if($row['Estado_de_atencion']=='CANCELADO, ERROR EN SIMCOT'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, A PETICION DEL CLIENTE'){
    echo'<tr class="canc">'; // printing table row
	  }else {   echo'<tr>'; // printing table row
	  }
    echo '<td>'.$row['Folio_pedido'].'</td><td>'.$row['Centro_de_entrega'].'</td><td>'.$row['Destino'] .'</td>'.
	'</td><td>'.$row['Producto'] .'</td>'.'</td><td>'.$row['Turno'].'</td>' .'</td> <td>'.$row['Clave'].'</td>'.
	'</td>' .'</td><td>'.$row['Transportista'].'</td>' .'</td>' .'</td><td>'.$row['Capacidad_programada'].'</td>'.
	'</td>' .'</td><td>'.$row['facturacion'] .'</td>' .'</td><td>'.$row['Estado_de_atencion'].'</td>
	<td>'.$row['date'].'</td>'; // we are looping all data to be printed till last row in the table
    echo'</tr>'; // closing table row
  }
  echo '  </tbody></table>';  //closing table tag
}

search();