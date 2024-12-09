<?php
// Mostramos la sesion
session_start();
//Distruimos la sesion
session_destroy();
//Nos lleva al login

header('Location: ../constancia.php');
?>