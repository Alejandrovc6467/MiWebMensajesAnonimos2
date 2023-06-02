<?php  

//Esta es la logica de login, este codigo php

//para ingresar a toas las paginas que contengan esta cabecera.php (todas) va aser necesario que este logeado
session_start();
  if(!isset($_SESSION['usuario'])){//le estoy diciendo a la cabecera y por lo cual a todas las paginas (porque todas tienen la cabecera)
    // que busquen esta variable 'usuario' y  si no existe pues que me redireccione al index.php
    header("Location:../index.php");
    //Me envia imediatamnete al index  y todo lo qu esta en este fichero no lo hace termina el flujo aqui si entro a este if
  }else{

    //en caso de si esxistir y ser igual a "ok" que me imprima el "nombreUsuario" (lo estoy guardando en la variable $nombreUsuario)
    if($_SESSION['usuario']=="ok"){
        $nombreUsuario=$_SESSION["nombreUsuario"];
    }
  }


// aqui en la pestania administrador icluyo la cabecera administrador que en vez de tener la opcion login tiene la opcion salir
?>








<?php 

include("config/conexionBD.php");


$mensajeConfirmacion = "";

$idIngreso =(isset($_POST['idIngreso']))?$_POST['idIngreso']:"";
$idMensaje =(isset($_POST['idMensaje']))?$_POST['idMensaje']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";


// aqui el mismo codigo que esta al final del switch para tener actualizado la variable $listaRazas para cunado entre al modificar o la buscar (Esto poeria hacerlo en metodo para no escribir las mismas lineas de codigo, pero bueno son tres lineas me dio pereza jajaj)
$sentenciaSQL= $conexion->prepare("SELECT * FROM historialingresos");
$sentenciaSQL->execute();
$listaIngresos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los bovino en una lista, para luego llenar la tabla


// aqui el mismo codigo que esta al final del switch para tener actualizado la variable $listaRazas para cunado entre al modificar o la buscar (Esto poeria hacerlo en metodo para no escribir las mismas lineas de codigo, pero bueno son tres lineas me dio pereza jajaj)
$sentenciaSQL= $conexion->prepare("SELECT * FROM mensajesanonimos");
$sentenciaSQL->execute();
$listaMensajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los bovino en una lista, para luego llenar la tabla

// HACER ESTO EN UN METODO PARA NO TENER QUE ESCRIBIRLO DOS VECES (AQUI Y ABAJO)

switch($accion){


        
    case "Borrar Ingreso":

    

      //aqui pues borro el que escogi de la tabla de "ingresos"
      $sentenciaSQL= $conexion->prepare("DELETE FROM historialingresos WHERE id=:idIngreso");
      $sentenciaSQL->bindParam(':idIngreso',$idIngreso);
      $sentenciaSQL->execute();
              

      $mensajeConfirmacion="Historial de ingreso borrado correctamente";


    break;




    case "Borrar Mensaje":



      //aqui pues borro el que escogi de la tabla de "ingresos"
      $sentenciaSQL= $conexion->prepare("DELETE FROM mensajesanonimos WHERE id=:idMensaje");
      $sentenciaSQL->bindParam(':idMensaje',$idMensaje);
      $sentenciaSQL->execute();
                
  
      $mensajeConfirmacion="Mensaje borrado correctamente";


    break;  


}    


// aqui el mismo codigo que esta al final del switch para tener actualizado la variable $listaRazas para cunado entre al modificar o la buscar (Esto poeria hacerlo en metodo para no escribir las mismas lineas de codigo, pero bueno son tres lineas me dio pereza jajaj)
$sentenciaSQL= $conexion->prepare("SELECT * FROM historialingresos");
$sentenciaSQL->execute();
$listaIngresos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los bovino en una lista, para luego llenar la tabla

// aqui el mismo codigo que esta al final del switch para tener actualizado la variable $listaRazas para cunado entre al modificar o la buscar (Esto poeria hacerlo en metodo para no escribir las mismas lineas de codigo, pero bueno son tres lineas me dio pereza jajaj)
$sentenciaSQL= $conexion->prepare("SELECT * FROM mensajesanonimos");
$sentenciaSQL->execute();
$listaMensajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los bovino en una lista, para luego llenar la tabla





?>










<?php include("template/headerAdministrador.php"); ?>


<link rel="stylesheet" href="cssMine/administrador.css?89">





<!--  inicio html componentes y etiquetas-->

<h1 class="h1admin" >Administrador <?php echo $nombreUsuario; ?></h1>


<br><h4 class="h4admin" ><?php echo $mensajeConfirmacion; ?></h4><br>





<h4 class="h4admin">Lista ingresos <?php echo sizeof($listaIngresos);?></h4>


<div class="tabla">

<table class="table">

  <thead>
    <tr>
      <th>ID</th>
      <th>Fecha/Hora</th>
      <th>IP</th>
      <th>Procedente Pagina</th>
      <th>Agente usuario</th>
      <th>Acciones</th>
    </tr>
  </thead>

  <tbody>


 

  

  <?php $tam = sizeof($listaIngresos); ?>

  

  <?php  for ($i = $tam-1; $i > -1 ; $i--){ ?>
    <!--Cargo los datos de la base de datos a la tabla-->


    <tr>
     
      <td> <?php echo $listaIngresos[$i]['id']; ?> </td>
      <td> <?php echo $listaIngresos[$i]['fechaYhoraHistorial']; ?> </td>
      <td> <?php echo $listaIngresos[$i]['ip']; ?> </td>
      <td> <?php echo $listaIngresos[$i]['procendenteDePagina']; ?> </td>
      <td> <?php echo $listaIngresos[$i]['agenteUsuario']; ?> </td>
      <td>

        <form method="post">

            <!--Esto input solo porque estaba igualarlo el valor del input por defecto del id (porque como estoy recorriendo toda la lista pues tengo que obtener ese valor de la columna y para asi borrar al que es en switch)--->
            <input type="hidden" name="idIngreso" id="idIngreso" value="<?php echo $listaIngresos[$i]["id"]; ?>"> 
            <input type="submit"  name="accion" value="Borrar Ingreso"  class="botonBorrar">

        </form>
        
      </td>

    </tr>
    

<?php } ?>

  

  

  
  
</tbody>

</table>


</div>








<br><br><br><br>
<h4 class="h4admin" >Lista Mensajes <?php echo sizeof($listaMensajes);?></h4>


<div class="tabla">

<table class="table">

  <thead>
    <tr>
      <th>ID</th>
      <th>Mensaje</th>
      <th>Fecha/Hora</th>
      <th>IP</th>
      <th>Agente usuario</th>
      <th>Acciones</th>
    </tr>
  </thead>

  <tbody>


 

  

  <?php $tam = sizeof($listaMensajes); ?>

  

  <?php  for ($i = $tam-1; $i > -1 ; $i--){ ?>
    <!--Cargo los datos de la base de datos a la tabla-->


    <tr>
     
      <td> <?php echo $listaMensajes[$i]['id']; ?> </td>
      <td> <textarea type="textarea"   class="textareaTabla"  rows="2" cols="15"   placeholder ="<?php echo $listaMensajes[$i]['mensaje']; ?>" ></textarea>    </td>
      <td> <?php echo $listaMensajes[$i]['fechaYhora']; ?> </td>
      <td> <?php echo $listaMensajes[$i]['ip']; ?> </td>
      <td> <?php echo $listaMensajes[$i]['agenteUsuario']; ?> </td>
      <td>

        <form method="post">

            <!--Esto input solo porque estaba igualarlo el valor del input por defecto del id (porque como estoy recorriendo toda la lista pues tengo que obtener ese valor de la columna y para asi borrar al que es en switch)--->
            <input type="hidden" name="idMensaje" id="idMensaje" value="<?php echo $listaMensajes[$i]["id"]; ?>"> 
            <input type="submit"  name="accion" value="Borrar Mensaje"  class="botonBorrar">

        </form>
        
      </td>

    </tr>
    

<?php } ?>

  

  

  
  
</tbody>

</table>


</div>






<?php include("template/footer.php"); ?>