<?php

$servername = "localhost"; // Define la variable `$servername` con el valor "localhost", que indica que la base de datos se encuentra en el mismo servidor que el script.
$username = "root"; // Define la variable `$username` con el valor "root", que es el nombre de usuario para acceder a la base de datos.
$password = ""; // Define la variable `$password` con una cadena vacía, lo que indica que no se requiere contraseña para acceder a la base de datos.
$dbname = "bd_reservas_hotel"; // Define la variable `$dbname` con el valor "bd_reservas_hotel", que es el nombre de la base de datos a la que se quiere conectar.

$conn = new mysqli($servername, $username, $password, $dbname); // Crea un nuevo objeto `mysqli` llamado `$conn` utilizando las variables previamente definidas para establecer una conexión con la base de datos.

if ($conn->connect_error) { // Verifica si hay algún error en la conexión.
    die("Error de conexión: " . $conn->connect_error); // Si hay un error, muestra un mensaje de "Error de conexión" y termina la ejecución del script.
}

?>