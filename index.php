<?php
  session_start();
  if (isset($_SESSION['usuario'])){
    if($_SESSION['usuario']['tipo'] == "Admin"){
      header ('Location: main_app/Admin/');

    } else if($_SESSION['usuario']['tipo'] == "Usuario") {
      header ('Location: main_app/Usuario/');

    }
  }
  
?>

<!DOCTYPE html>
<html lang="es">
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
    <title>Portal de Consultas Hamse</title>
    <link rel="stylesheet" href="css/main.css">


  </head>
 
<body>

   <div class="main" >
    <form action="" id="formLg">
        <input type="text" name="usuariolg"  placeholder="Usuario" required>
        <input type="password" name="passlg"  placeholder="Contraseña"  required>
        <input type="submit" class="botonlg"  value="Iniciar Sesion" >
     </form>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
  </body>
  
  <div class="error">
      <span>Datos de ingreso no válidos, inténtelo de nuevo  por favor</span>
 
</div>

</html>
