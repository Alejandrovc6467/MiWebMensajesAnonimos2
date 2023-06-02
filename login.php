<?php
//logica de conexion al administrador

include("config/conexionBD.php");


session_start();

$sentenciaSQL= $conexion->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$listaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los usuarios en una lista, para luego llenar la tabla

if($_POST){//si hay un post (o sea si presionan el boton ingresar con todos los campos llenos)

  foreach($listaUsuarios as $usuario){
    
    if(($_POST['usuario']==$usuario['usuario']) && ($_POST['contrasenia']==$usuario['contrasenia'])){


      $_SESSION['usuario']="ok";
      $_SESSION['nombreUsuario']=$usuario['usuario'];
      header("Location:administrador.php");

      break;//lo freno por si las moscas jajaj creo que cunado lo redireccina al inicio.php se sale automaticamente de aqui, pero no se 

    }else{
      $mensaje="Incorrect user or password";
    } 

    
  } 

}


?>





<?php include("template/header.php"); ?>




<div class="login_container">


    <div class="login_box">

        <h1>Login</h1>
        

        <form class="login_form" method="POST" >
           
            <input class="form_login_input" type="text" name="usuario" id="namePadre" placeholder ="User"  autocomplete required> 
            
            <input class="form_login_input" type="password" name="contrasenia" id="passwd" placeholder="Password"  required/>

            <button class="form_login_button" type="submit" value="Ingresar" class="button">Sign in</button>
          
        </form>

        <?php if(isset($mensaje)){ ?>
            <p class="textMensaje"><?php echo $mensaje; ?></p>
        <?php } ?>


    </div>

</div>





<?php include("template/footer.php"); ?>