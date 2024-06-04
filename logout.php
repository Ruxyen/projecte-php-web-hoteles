<?php

session_start(); // Inicia o reanuda una sesión existente, permitiendo acceder a las variables de sesión.

session_destroy(); // Elimina todos los datos de la sesión actual y cierra la sesión.

header('Location: login.php'); // Envía una cabecera HTTP al navegador para redirigir al usuario a la página "login.php".

exit;