<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'conectar_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_habitacio'])) {
        $id_habitacio = $_GET['id_habitacio'];

        $sql = "SELECT * FROM Habitacio WHERE id_habitacio = '$id_habitacio'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $habitacio = $result->fetch_assoc();
        } else {
            echo "Habitación no encontrada.";
            exit;
        }
    } else {
        echo "ID de habitación no especificado.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_habitacio'], $_POST['tipus_habitacio'], $_POST['preu_nit'], $_POST['capacitat'], $_POST['descripció'])) {
        $id_habitacio = $_POST['id_habitacio'];
        $tipus_habitacio = $_POST['tipus_habitacio'];
        $preu_nit = $_POST['preu_nit'];
        $capacitat = $_POST['capacitat'];
        $descripcio = $_POST['descripció'];

        $sql = "UPDATE Habitacio SET tipus_habitacio = '$tipus_habitacio', preu_nit = '$preu_nit', capacitat = '$capacitat', descripció = '$descripcio' WHERE id_habitacio = '$id_habitacio'";
        $result = $conn->query($sql);

        if ($result) {
            header ('Location: panel_admin.php');
            exit;
        } else {
            echo "Error al actualizar la habitación: " . $conn->error;
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

label {
  display: block;
  margin-bottom: 10px;
  color: #333;
}

input[type="text"],
input[type="number"],
textarea {
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
  <div class="container">
    <form action="editar_habitacion.php" method="POST">
    <h2>Editar Habitación</h2>
      <input type="hidden" name="id_habitacio" value="<?php echo $habitacio['id_habitacio']; ?>">
      <label for="tipus_habitacio">Tipo de Habitación:</label>
      <input type="text" name="tipus_habitacio" value="<?php echo $habitacio['tipus_habitacio']; ?>" required><br><br>
      <label for="preu_nit">Precio por Noche:</label>
      <input type="number" name="preu_nit" value="<?php echo $habitacio['preu_nit']; ?>" required><br><br>
      <label for="capacitat">Capacidad:</label>
      <input type="number" name="capacitat" value="<?php echo $habitacio['capacitat']; ?>" required><br><br>
      <label for="descripció">Descripción:</label>
      <textarea name="descripció" required><?php echo $habitacio['descripció']; ?></textarea><br><br>
      <input type="submit" value="Guardar Cambios">   
    </form>
  </div>
</body>
</html>




