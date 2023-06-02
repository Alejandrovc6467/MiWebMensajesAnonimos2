

<?php


include("config/conexionBD.php");



/**  /////////////////////  esto pertenece al registro de ingresos ////////////////////////// */

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Costa_Rica'));
    $fechaYhoraHistorial = $Object->format("d-m-Y h:i:s a"); 
    
    $ip="";
    $procendenteDePagina ="";
    $agenteUsuario = "";

    /* ➡️➡️➡️➡️➡️➡️ descomentar esto antes de subirlo al hosting
    $ip = $_SERVER['REMOTE_ADDR'];
    $procendenteDePagina = $_SERVER['HTTP_REFERER'];
    $agenteUsuario = $_SERVER['HTTP_USER_AGENT'];

    //Envio de datos si presino el boton registar
    $sentenciaSQL = $conexion->prepare("INSERT INTO historialingresos (fechaYhoraHistorial,ip,procendenteDePagina,agenteUsuario) VALUES (:fechaYhoraHistorial,:ip,:procendenteDePagina,:agenteUsuario);");
    $sentenciaSQL->bindParam(':fechaYhoraHistorial',$fechaYhoraHistorial);
    $sentenciaSQL->bindParam(':ip',$ip);
    $sentenciaSQL->bindParam(':procendenteDePagina',$procendenteDePagina);
    $sentenciaSQL->bindParam(':agenteUsuario',$agenteUsuario);
    $sentenciaSQL->execute();
    */

/**  ///////////////////// FIN DE  esto pertenece al registro de ingresos ////////////////////////// */



$ubicacion =(isset($_POST['ubicacion']))?$_POST['ubicacion']:"";

$mensaje =(isset($_POST['mensaje']))?$_POST['mensaje']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";


switch($accion){

  case"Enviar":

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Costa_Rica'));
    $fechaYhora = $Object->format("d-m-Y h:i:s a");  

    $ip= $_SERVER['REMOTE_ADDR'];
    $agenteUsuario = $_SERVER['HTTP_USER_AGENT'];


    //Envio de datos si presino el boton registar
    $sentenciaSQL = $conexion->prepare("INSERT INTO mensajesanonimos (mensaje,fechaYhora,ip,agenteUsuario) VALUES (:mensaje,:fechaYhora,:ip,:agenteUsuario);");
    $sentenciaSQL->bindParam(':mensaje',$mensaje);
    $sentenciaSQL->bindParam(':fechaYhora',$fechaYhora);
    $sentenciaSQL->bindParam(':ip',$ip);
    $sentenciaSQL->bindParam(':agenteUsuario',$agenteUsuario);
    $sentenciaSQL->execute();



    //limpio los campos una vez que los registre
    $mensaje ="";
    

  break;

}


$sentenciaSQL= $conexion->prepare("SELECT * FROM mensajesanonimos");
$sentenciaSQL->execute();
$listaMensajes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los bovino en una lista, para luego llenar la tabla


?>


<section class="sectionPrincipal" id="sectionPrincipal" data-aos="fade-right" data-aos-duration="1500">

        <div class="sectionPrincipal_socialLinks">
            <div class="container_sectionPrincipal_socialLinks">

                <a href="https://github.com/Alejandrovc6467" target="_blank" ><i class="fa-brands fa-github"></i></a>
                <a href="https://www.instagram.com/alejandrovc177/?hl=es-la" target="_blank" ><i class="fa-brands fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/send?phone=+50664670196&text=Hola, visité tu sitio web! :)" target="_blank" ><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.linkedin.com/in/luisalejandrovasquezcordero" target="_blank" ><i class="fa-brands fa-linkedin-in"></i></a>

            </div>
        </div>

        <div class="sectionPrincipal_info">
            
            <div class="container_sectionPrincipal_info">
                <p class="sectionPrincipal_text_1">Hola! Soy</p>
                <p class="sectionPrincipal_text_2">Alejandro Vasquez</p>
                <p class="sectionPrincipal_text_3">Desarrollador web Front-end</p>
                <p class="sectionPrincipal_text_4">Estudiante de Informática Empresarial en la Universidad de Costa Rica. Apasionado por los diseños intuitivos y estéticamente agradables, busco crear proyectos que brinden la mejor experiencia para el usuario.</p>
                <div class="sectionPrincipal_info_contaniner_buttoms">
                    <a href="https://api.whatsapp.com/send?phone=+50664670196&text=Hola, visité tu sitio web! :)"><button class="contact_button">Contacto</button></a>
                </div>
            </div>
           
        </div>

        <div class="sectionPrincipal_chat">
            
            <div class="chat">

                <span class="chat_contador"><?php echo sizeof($listaMensajes);?></span>

                <div class="chat_listaMensajes">

                    <div class="chat_listasMensajes_container" id="chat_listasMensajes_container" >

                        <?php  for ($i = sizeof($listaMensajes)-1; $i > -1 ; $i--){ ?>

                            <div class="chat_mensaje">
                                <p class="fechaHora"><?php echo $listaMensajes[$i]['fechaYhora']; ?></p>
                                <br>
                                <p class="chat_text"><?php echo $listaMensajes[$i]['mensaje']; ?></p>
                            </div>

                        <?php } ?>
                    
                    </div>    

                </div>

                <div class="chat_formulario">

                    <form method="POST">

                        <textarea type="textarea"  value="<?php echo $mensaje ?>" class="textarea" id="mensaje" name="mensaje" rows="4" cols="50"   placeholder ="Escribe un mensaje anónimo"  required ></textarea> 
                       
                        <button class="chat_button"  type="submit" name="accion" value="Enviar" class="button"  onclick="getLocation()"><span style="--item:1"><i class="fa-solid fa-paper-plane"></i></span></button>
                       
                    </form>

                </div>

            </div>

        </div>
      
    </section>