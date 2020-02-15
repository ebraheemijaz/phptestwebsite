<?php
session_start();
if (isset($_SESSION['usuario'])){
  if($_SESSION['usuario']['tipo'] != "Operador"){
    header('location: ../Admin/');
  }
} else {
    header('location: ../../');
    }
$DBservername = "dbhamse.cgykoqp1l4le.us-east-1.rds.amazonaws.com:3306";
$DBusername = "lance";
$DBpassword = "7201mega";
$MYDB = "dbhamsecon";

$link = mysqli_connect ($DBservername,$DBusername,$DBpassword,$MYDB);
mysqli_set_charset($link,"utf8");
// Check connection
if (mysqli_connect_errno() || !$link)

 {
  echo "Fallo al Conectarse a SQL: " . mysqli_connect_error();
  exit;
  }
 
    
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139134363-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-139134363-1');
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Portal de Consultas Comercializadora Hamse</title>
  <div class="header">
  <img src="../../img/logop.png">
</div> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <h1 class="bvb" >Bienvenido <?php echo $_SESSION ['usuario']['nombres']?></h1>
  
  <a href="../salir.php" class="strong"><strong>Cerrar sesión</strong></a>
  <div align="center">
  <input value="Actualizar" type="button" onclick="document.location.reload();">
  </div>
<!-- <a title="Salir" href="../salir.php"><img src="../../img/boton.png" align= 'right' alt="Logut"  /></a> -->


<p> </p>

  <table class="table">

    <thead>
      <tr>
        <th>FOLIO</th>
        <th>CENTRO DE ENTREGA</th>
        <th>DESTINO</th>
        <th>PRODUCTO</th>
        <th>TURNO</th>
        <th>CLAVE</th>
        <th>TRANSPORTISTA</th>
        <th>CAPACIDAD</th>
        <th>FECHA DE FACTURACION</th>
        <th>ESTADO DEL PEDIDO</th>
        <th>FECHA DEL PEDIDO</th>
      </tr>
    </thead>
    <?php

foreach ($link->query('SELECT consults.* 
FROM consults,usuarios 
 WHERE usuarios.destino = consults.destino and usuarios.id ='. $_SESSION ['usuario']['id'].' order by consults.date desc' )  
as $row)
{ // aca puedes hacer la consulta e iterarla con each. 
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
		}else if($row['Estado_de_atencion']=='CANCELADO, A PETICION DEL CLIENTE'){
    echo'<tr class="canc">'; // printing table row
	}else if($row['Estado_de_atencion']=='CANCELADO, ERROR EN SIMCOT'){
    echo'<tr class="canc">'; // printing table row
  }else if($row['Estado_de_atencion']=='CANCELADO, ERROR EN PROGRAMACION'){
    echo'<tr class="canc">'; // printing table row
  }else if($row['Estado_de_atencion']=='CANCELADO, FALTA DE PRODUCTO'){
    echo'<tr class="canc">'; // printing table row
	  }else {   echo'<tr>'; // printing table row
	  }
?>
    <td>
      <?php echo $row['Folio_pedido'] // aca te faltaba poner los echo para que se muestre el valor de la variable.  ?>
    </td>
    <td>
      <?php
   echo $row['Centro_de_entrega'] ?></td>
    <td>
      <?php
   echo $row['Destino'] ?></td>
    <td><?php
   echo $row['Producto'] ?></td>
    <td><?php
   echo $row['Turno'] ?></td>
    <td><?php
   echo $row['Clave'] ?></td>
    <td><?php
   echo $row['Transportista'] ?></td>
    <td><?php
   echo $row['Capacidad_programada'] ?></td>
    <td><?php
   echo $row['facturacion'] ?></td>
    <td><?php
   echo $row['Estado_de_atencion'] ?></td>
    <td><?php
   echo $row['date'] ?></td>


    <?php
	}
?>
    </tr>

  </table>

  <style>
    .strong {
      display: block;
      font-size: 20px;
      margin-bottom: 10px !important
     
    }

    td {
      text-align: left;
    }

    th {
      line-height: 1
    }

    thead { color: white;
      background-color: #192970;
      
    }

    .yellow {
      color: black;
      font-weight: bold;
      background-color: #e68a00;
      opacity: 0.6;
    }

    .green {
      color: black;
      font-weight: bold;
      background-color: #7aa33d;
      opacity: 0.7;
    }

    .prog {
      color: #4d4d4d;
      font-style: italic;
      background-color: white
    }
	 .canc {
      color: black;
      background-color: #ff6633;
	  opacity: 0.8;
    }
    .header {
      width: 100%; 
                height: 100%; 
                weight: 100%;
                text-align: center;
                object-fit: contain ; 
                position: relative;
}
.bvb {
      color: #f4bd3e;
	  
     
    }
  </style>
</body>

</html>