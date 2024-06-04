<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'conectar_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_reserva'])) {
        $id_reserva = $_GET['id_reserva'];

        $sql = "SELECT * FROM Reserva WHERE id_reserva = '$id_reserva'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $reserva = $result->fetch_assoc();
        } else {
            echo "Reserva no encontrada.";
            exit;
        }
    } else {
        echo "ID de reserva no especificado.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_reserva'], $_POST['data_entrada'], $_POST['data_sortida'], $_POST['num_persones'], $_POST['id_habitacio'], $_POST['id_Client'])) {
        $id_reserva = $_POST['id_reserva'];
        $data_entrada = $_POST['data_entrada'];
        $data_sortida = $_POST['data_sortida'];
        $num_persones = $_POST['num_persones'];
        $id_habitacio = $_POST['id_habitacio'];
        $id_Client = $_POST['id_Client'];

        $sql = "UPDATE Reserva SET data_entrada = '$data_entrada', data_sortida = '$data_sortida', num_persones = '$num_persones', id_habitacio = '$id_habitacio', id_Client = '$id_Client' WHERE id_reserva = '$id_reserva'";
        $result = $conn->query($sql);

        if ($result) {
            header ('Location: panel_admin.php');
            exit;
        } else {
            echo "Error al actualizar la reserva: " . $conn->error;
            exit;
        }
    } else {
        echo "Faltan datos del formulario.";
        exit;
    }
} else {
    echo "Método no válido.";
    exit;
}

$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
    
<title>Editar Reserva</title>
<style>
    body {
  background-color: #f2f7fc;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  width: 400px;
  padding: 20px;
  background-color: #fff;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
}

label {
  display: block;
  margin-bottom: 10px;
  color: #333;
}

input[type="date"],
input[type="number"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #3498db;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #2980b9;
}
</style>
</head>
<body>
<!-- Formulario para editar la reserva -->
<div class="container">
<form action="editar_reserva.php" method="POST">
<h2>Editar Reserva</h2>
    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
    <label for="data_entrada">Fecha de Entrada:</label>
    <input type="date" name="data_entrada" value="<?php echo $reserva['data_entrada']; ?>" required><br><br>
    <label for="data_sortida">Fecha de Salida:</label>
    <input type="date" name="data_sortida" value="<?php echo $reserva['data_sortida']; ?>" required><br><br>
    <label for="num_persones">Número de Personas:</label>
    <input type="number" name="num_persones" value="<?php echo $reserva['num_persones']; ?>" required><br><br>
    <label for="id_habitacio">ID de Habitación:</label>
    <input type="number" name="id_habitacio" value="<?php echo $reserva['id_habitacio']; ?>" required><br><br>
    <label for="id_Client">ID de Cliente:</label>
    <input type="number" name="id_Client" value="<?php echo $reserva['id_Client']; ?>" required><br><br>
    <input type="submit" value="Guardar Cambios">
</form>
</div>
</body>
</html>




