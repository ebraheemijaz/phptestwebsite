<?php
session_start();
if (isset($_SESSION['usuario'])){
  if($_SESSION['usuario']['tipo'] != "Admin"){
    header('location: ../Usuario/');
  }
} else {
    header('location: ../../');
    }
?>

<!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
	 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     
     <title>Portal de Consultas Comercializadora Hamse </title>
     <div class="header">
  <img src="../../img/logop.png">
</div>
    
   </head>
   <body>
   <div class="container">
   
   <div class="row">
    <div class="col-md-12">
<h1 class="bvb">Bienvenido <?php echo $_SESSION ['usuario']['nombres']?></h1>
<a href="../salir.php" class="strong"><strong>Cerrar sesión</strong></a>

    <h1 >Busqueda de Embarques </h1>
    
  </div> </div>
  
  <div class="row" style='margin-top:15px'>
    <div class="col-md-3">
      <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-search" aria-hidden="true"></span></span>
<select onchange="get_option();setTimeout(search(),100);"  class="form-control" id="first_filter">
  <?php
  require_once 'php/conexion.php';

    $mysqli = getConnexion();
  $query = "SELECT Centro_de_entrega FROM consults order by id asc";
  $res = $mysqli->query($query);

  $Centro_de_entrega=array();
while($row=$res->fetch_array(MYSQLI_ASSOC)){

  $Centro_de_entrega[]=$row['Centro_de_entrega'];
}

  $Centro_de_entrega=array_filter(array_unique($Centro_de_entrega));
echo '<option value="">Elegir TAD</option>';

 foreach($Centro_de_entrega as $Cen) {
    echo '<option>'.($Cen);
    echo'</option>'; 
  }
  ?>
</select>

<select onchange="search();" id="second_filter" class="form-control">
<?php
echo '<option value="">Elegir Destino</option>';

  ?>

</select>

      </div>
    </div> <div class="col-md-9"></div>
  </div>
  
  
  <div class="row" style='margin-top:15px'>
    <div class="col-md-12 " id="result">
    </div>
    </div>
</div>


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
	.canc {
      color: black;
      background-color: #ff6633;
	  opacity: 0.8;
    }

</style>

<script type="text/javascript" src="js/index.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
 </html>