<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'conectar_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_cliente'])) {
        $id_cliente = $_GET['id_cliente'];

        $sql = "SELECT * FROM Client WHERE id_client = '$id_cliente'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $cliente = $result->fetch_assoc();
        } else {
            echo "Cliente no encontrado.";
            exit;
        }
    } else {
        echo "ID de cliente no especificado.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_cliente'], $_POST['nom_client'], $_POST['cognoms'], $_POST['email'], $_POST['contrasenya'])) {
        $id_cliente = $_POST['id_cliente'];
        $nom_client = $_POST['nom_client'];
        $cognoms = $_POST['cognoms'];
        $email = $_POST['email'];
        $contrasenya = $_POST['contrasenya'];

        $sql = "UPDATE Client SET nom_client = '$nom_client', cognoms = '$cognoms', email = '$email', contrasenya = '$contrasenya' WHERE id_client = '$id_cliente'";
        $result = $conn->query($sql);

        if ($result) {
            header ('Location: panel_admin.php');
        } else {
            echo "Error al actualizar el cliente: " . $conn->error;
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

h2 {
  text-align: center;
  color: #333;
}

label {
  display: block;
  margin-bottom: 10px;
  color: #333;
}

input[type="text"],
input[type="email"],
input[type="password"] {
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
  <title>Editar Cliente</title>
</head>
<body>
  <div class="container">
   
    <form action="editar_cliente.php" method="POST">
    <h2>Editar Cliente</h2>
      <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_client']; ?>">
      <label for="nom_client">Nombre del Cliente:</label>
      <input type="text" name="nom_client" value="<?php echo $cliente['nom_client']; ?>" required><br><br>
      <label for="cognoms">Apellidos:</label>
      <input type="text" name="cognoms" value="<?php echo $cliente['cognoms']; ?>" required><br><br>
      <label for="email">Email:</label>
      <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required><br><br>
      <label for="contrasenya">Contraseña:</label>
      <input type="password" name="contrasenya" value="<?php echo $cliente['contrasenya']; ?>" required><br><br>
      <input type="submit" value="Guardar Cambios">
    </form>
  </div>
</body>
</html>



