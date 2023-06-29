<?php
session_start();
//validacion de seguridad
if (!isset($_SESSION['id_user'])){
    header("Location: login.php");
}
