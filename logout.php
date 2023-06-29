<?php
session_start();
if(isset($_SESSION['id_user'])) {
    session_destroy();
    header('Location: index.php');
}
else {
    echo "Usuario no registrado, registrate para obtener beneficios";
    echo '<a href="register.php">Registro</a>';
}
