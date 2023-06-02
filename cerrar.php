<?php


session_start();//invoco al session star (es una regla fija para poder trabajar con sesiones)
session_destroy();//luego destruyo todas las variables de sesion que habia creado y de esa forma ya no me va a permitir entrar si no ingreseo las contrasenia  y user de nuevo
header('Location:index.php');// y luego direcciono al index.php,   por si quisiera volver a entrar pero desde otro perfil


?>