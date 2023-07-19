<?php  include("config/conexionBD.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM imagenes");
$sentenciaSQL->execute();
$listaImagenes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);//con esta fetch  almaceno todos los bovino en una lista, para luego llenar la tabla

?>

<div class="sectionGalery">

    <h1 class="sectionAbout_title">Gallery</h1>
    <br>

    <div class="gallery">

        <?php $tam = sizeof($listaImagenes); ?>

        <?php  for ($i = $tam-1; $i > -1 ; $i--){ ?>
                
                <img width="150px" src="uploads/<?php echo $listaImagenes[$i]['id']; ?>.jpeg"   onclick="openFulImg(this.src)"  alt="imagen no encontrada">

        <?php } ?>

    </div>
          
</div>