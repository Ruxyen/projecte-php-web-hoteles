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
    echo "Error: no se encontró ningún registro de cliente con el DNI proporcionado";
    exit;
}



// Consultar las reservas del cliente

$sql = "SELECT * FROM Reserva WHERE id_client = $id_client";
$resultado = $conn->query($sql);

// Si hay resultados, mostrarlos en una tabla
if ($resultado->num_rows > 0) {

    echo '<table>';
    echo '<tr><th>ID Reserva</th><th>Fecha de entrada</th><th>Fecha de salida</th><th>Num. personas</th><th>ID Habitación</th><th>Tipus habitació</th></tr>';
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['id_reserva'] . '</td><td>' . $row['data_entrada'] . '</td><td>' . $row['data_sortida'] . '</td><td>' . $row['num_persones'] . '</td><td>' . $row['id_habitacio'] . '</td><td>' . $row['tipus_habitacio'] . '</td></tr>';
    }
    echo '</table>';

} else {
    echo '<div id="no_reserva">No tienes reservas.</div>';
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
    <link rel="icon" type="image/png" href="img/llave-room.png"/>
    <title>Mis Reservas</title>
    <style>
        html,
        body {
          
            
            margin-bottom:20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #296e83;
        }

       
        table {
            margin-top:40px;
            padding: 10px;
            text-align: center;
            justify-content: center;
            border-radius: 15px;
            background-color: white;
            box-shadow: 5px 5px 5px 5px white;
            border-radius: 5px;
            font-size: 18px;
        }

        tr,
        td,
        th {
            border: 1px solid black;
            padding: 15px;
            border-radius: 15px;
            margin-top:2px;
            

        }

        th {
            background-color: black;
            color: white;
        }

        nav-option logout,
        a {
            position: fixed;
            display: flex;
            top: 50px;
            left: 50px;
            width: 20px;
            height: 20px;
            color: white;
        }

        nav-option logout,
        span {
            position: fixed;
            display: flex;
            top: 150px;
            left: 55px;
            width: 20px;
            height: 20px;
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        #no_reserva{
            color:white;
            font-size:50px;
        }



    </style>
</head>

<body>
    <div class="nav-option logout">
        <a id="logout" href="reserva.php"><img src="img/icons/logout-icon.png" class="nav-img" alt="logout" width="80"
                height="80"></a>
        <span>Regresar</span>
    </div>
</body>

</html>