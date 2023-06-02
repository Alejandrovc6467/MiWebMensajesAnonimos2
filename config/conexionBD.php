<?php



$host ="localhost";
$bd = "epiz_33033278_alejandroWebsite";
$usuario = "root";
$contrasenia ="";


try{

    //(servidor, nombre usuario, contrasenia, nombre base de datos )
    $conexion =  new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia); 

}catch(Exception $ex){

    echo $ex->getMessage(),"  No se conecto a la base de datos";
}


?>