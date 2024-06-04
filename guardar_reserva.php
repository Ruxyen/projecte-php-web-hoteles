<?php 

require_once 'conectar_bd.php';

$dni = $_POST['dni'];

$sql_client = "SELECT id_client FROM Client WHERE dni = '$dni'";
$result_client = $conn->query($sql_client);
if ($result_client->num_rows > 0) {
    $row_client = $result_client->fetch_assoc();
    $id_client = $row_client['id_client'];
} else {
    // Si no se encuentra ningún registro con el dni proporcionado, mostrar un mensaje de error
   
    echo "<script>alert('No se encontró ningún registro de cliente con el DNI proporcionado,  asegurate que el DNI es correcto'); window.location.href = 'reserva.php';</script>";
    exit;
}

$data_entrada = $_POST['data_entrada'];
$data_sortida = $_POST['data_sortida'];

// Consulta la tabla "Reserva" para verificar si existe alguna reserva con las mismas fechas
$sql_reserva = "SELECT * FROM Reserva WHERE data_entrada = '$data_entrada' AND data_sortida = '$data_sortida'";
$result_reserva = $conn->query($sql_reserva);
if ($result_reserva->num_rows > 0) {
    // Si se encuentra una reserva con las mismas fechas, muestra un mensaje de "Reserva duplicada, error" y detén la ejecución del código.
    echo "<script>alert('Ya has reservado para estas fechas!'); window.location.href = 'reserva.php';</script>";
    exit;
}

$sql = "SELECT MAX(id_reserva) as ultimo_id FROM Reserva"; // Consulta SQL para obtener el último valor de 'id_reserva' en la tabla 'Reserva'.

$result = $conn->query($sql); // Ejecuta la consulta SQL y guarda el resultado.

if ($result->num_rows > 0) { // Verifica si hay al menos un registro en el resultado.

    $row = $result->fetch_assoc(); // Obtiene el registro como un array asociativo.

    $ultimo_id = $row['ultimo_id']; // Guarda el valor de 'ultimo_id' en la variable $ultimo_id.

} else { // Si no hay registros en el resultado.
    echo "<script>alert('No se encontraron registros en la tabla Reserva'); window.location.href = 'reserva.php';</script>";
    exit;
}

$ultimo_id_string = strval($ultimo_id+1); // Incrementa el valor de $ultimo_id en 1 y lo convierte a string.

$num_persones = $_POST['num_persones'];
$select_habitacio = $_POST['select_habitacio'];

// Consulta SQL para obtener el ID de habitación basado en el tipo seleccionado
$sql_habitacion = "SELECT id_habitacio FROM Habitacio WHERE tipus_habitacio = '$select_habitacio'";
$result_habitacion = $conn->query($sql_habitacion);

if ($result_habitacion->num_rows > 0) {
  $row_habitacion = $result_habitacion->fetch_assoc();
  $id_habitacio = $row_habitacion['id_habitacio'];
} else {
  // Si no se encuentra ningún registro de habitación con el tipo seleccionado, mostrar un mensaje de error
  echo "<script>alert('No se encontró ninguna habitación con el tipo seleccionado'); window.location.href = 'reserva.php';</script>";
  exit;
}

// Insertar los datos en la tabla
$sql = "INSERT INTO Reserva (id_reserva, data_entrada, data_sortida, num_persones, id_habitacio, tipus_habitacio, id_client) VALUES ('$ultimo_id_string','$data_entrada', '$data_sortida', $num_persones , '$id_habitacio', '$select_habitacio', '$id_client')";

if ($conn->query($sql) === TRUE) {
  echo "<form method='get' action='reserva.php'>";
  echo "La reserva se ha guardado correctamente"; // Muestra un mensaje indicando que el registro fue exitoso.
  echo "<input type='submit' value='Volver'>";
  echo "</form>";
} else {
  echo "<script>alert('Algún campo establecido en el formulario de la reserva es incorrecto, inténtelo de nuevo'); window.location.href = 'reserva.php';</script>";
}




// Cerrar la conexión
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/reserved.png"/>
    <title>Reserva Realizada</title>
    <style>

        div{
            background-color: red;
            font-size:35px;
        
        }
        
        form,div{
            display:flex;
            position:relative;
            margin-top:380px;
            margin-left:410px;
            font-size:35px;
            border:3px solid black;
            width:20%;
            text-align:center;
            justify-content: center;
            padding:10px;
            border-radius:15px;
        }

        input[type="submit"] {

            background-color:#b99663;
            border-radius:15px;
            color:white;
            font-size:20px;
            font-weight:bold;
            width:50%;

        }


    </style>
</head>
<body background="img/reserva-realizada.png">
    
</body>
</html>