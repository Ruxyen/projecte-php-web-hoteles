<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'conectar_bd.php';

$sql = "SELECT MAX(id_habitacio) as ultimo_id FROM Habitacio"; // Consulta SQL para obtener el último valor de 'id_client' en la tabla 'Client'.

$result = $conn->query($sql); // Ejecuta la consulta SQL y guarda el resultado.

if ($result->num_rows > 0) { // Verifica si hay al menos un registro en el resultado.

    $row = $result->fetch_assoc(); // Obtiene el registro como un array asociativo.

    $ultimo_id = $row['ultimo_id']; // Guarda el valor de 'ultimo_id' en la variable $ultimo_id.

} else { // Si no hay registros en el resultado.

    echo "No se encontraron registros en la tabla Habitacio"; // Muestra un mensaje indicando que no se encontraron registros.
}


$ultimo_id_string = strval($ultimo_id + 1); // Incrementa el valor de $ultimo_id en 1 y lo convierte a string.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipus_habitacio = $_POST['tipus_habitacio'];
    $preu_nit = $_POST['preu_nit'];
    $capacitat = $_POST['capacitat'];
    $descripcio = $_POST['descripcio'];

    $sql = "INSERT INTO Habitacio (id_habitacio,tipus_habitacio, preu_nit, capacitat, descripció) VALUES ('$ultimo_id_string','$tipus_habitacio', '$preu_nit', '$capacitat', '$descripcio')";
    $result = $conn->query($sql);

    if ($result) {
        header('Location: panel_admin.php');
    } else {
        echo "Error al agregar la habitación: " . $conn->error;
    }
}

$conn->close();
?>
