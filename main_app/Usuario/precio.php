<?php
session_start();
if (isset($_SESSION['usuario'])){
  if($_SESSION['usuario']['tipo'] != "Usuario"){
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
  <a class="button" href="index.php">Embarques</a>
  <a class="button" href="precio.php">Precios</a>
  </div>

  
<!-- <a title="Salir" href="../salir.php"><img src="../../img/boton.png" align= 'right' alt="Logut"  /></a> -->


<p> </p>

  <table class="table">

    <thead>
      <tr>
        <th>CENTRO DE ENTREGA</th>
        <th>DESTINO</th>
        <th>PRODUCTO</th>
        <th>VIGENTE DESDE</th>
        <th>PRECIO</th>
        </tr>
    </thead>
    <?php

foreach ($link->query('SELECT precio_.* 
FROM precio_,usuarios 
 WHERE usuarios.destino = precio_.Destino and usuarios.id ='. $_SESSION ['usuario']['id'].' order by precio_.id asc' )  
as $row)
{ // aca puedes hacer la consulta e iterarla con each. 
  if($row['Estado_de_atencion']=='CARGANDO'){
    echo'<tr class="yellow">'; // printing table row
	  }else if($row['Producto']=='32025-GASOLINA 87 OCT'){
    echo'<tr class="green">'; // printing table row
  }else if($row['Producto']=='34015-DIESEL AUTOM'){
    echo'<tr class="prog">'; // printing table row
	}else if($row['Producto']=='32026-GASOLINA 91 OCT'){
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
	  }else {   echo'<tr>'; // printing table row
	  }
?>
    <td>
      <?php echo $row['centro'] // aca te faltaba poner los echo para que se muestre el valor de la variable.  ?>
    </td>
    <td>
      <?php
   echo $row['Destino'] ?></td>
    <td>
      <?php
   echo $row['Producto'] ?></td>
    <td><?php
   echo $row['vigente'] ?></td>
    <td><?php
   echo $row['precio_de'] ?></td>
   
    


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
      color: white ;
      font-style: bold;
      background-color: #313030
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
    
    .button {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    padding: 13px 58px;
    border: 1px solid #172565;
    border-radius: 0px;
    background: #3f67ff;
    background: -webkit-gradient(linear, left top, left bottom, from(#3f67ff), to(#172565));
    background: -moz-linear-gradient(top, #3f67ff, #172565);
    background: linear-gradient(to bottom, #3f67ff, #172565);
    -webkit-box-shadow: #4c7cff 0px 0px 0px 0px;
    -moz-box-shadow: #4c7cff 0px 0px 0px 0px;
    box-shadow: #4c7cff 0px 0px 0px 0px;
    text-shadow: #0d1538 1px 1px 0px;
    font: normal normal bold 20px verdana;
    color: #f5f5f5;
    text-decoration: none;
}
.button:hover,
.button:focus {
    border: 1px solid #192970;
    background: #4c7cff;
    background: -webkit-gradient(linear, left top, left bottom, from(#4c7cff), to(#1c2c79));
    background: -moz-linear-gradient(top, #4c7cff, #1c2c79);
    background: linear-gradient(to bottom, #4c7cff, #1c2c79);
    color: #f5f5f5;
    text-decoration: none;
}
.button:active {
    background: #172565;
    background: -webkit-gradient(linear, left top, left bottom, from(#172565), to(#172565));
    background: -moz-linear-gradient(top, #172565, #172565);
    background: linear-gradient(to bottom, #172565, #172565);
}


  </style>
</body>

</html>