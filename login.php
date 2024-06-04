<?php

session_start(); // Inicia una nueva sesión o reanuda una existente.

require_once 'conectar_bd.php'; // Incluye el archivo para conectar a la base de datos.

//include("forms/register.php"); //  Incluye el archivo de registro.



//LOGIN ADMIN

if (isset($_POST['submit'])) { // Verifica si se ha enviado el formulario.

  $admin = $_POST['username']; // Obtiene el nombre de usuario ingresado.

  $passadmin = $_POST['password']; // Obtiene la contraseña ingresada.


  $valid_user = false; // Inicializa una variable para validar el usuario.


  if ($admin == 'admin' && $passadmin == '1234') { // Verifica si el usuario y la contraseña coinciden con los valores predefinidos.

    $valid_user = true; // Establece la variable de validación en verdadero.
  }

  if ($valid_user) { // Si el usuario es válido, inicia sesión y redirige al panel de administración.

    $_SESSION['username'] = $admin; // Almacena el nombre de usuario en la sesión.

    header('Location: panel_admin.php'); // Redirige al panel de administración.

    exit; // Termina la ejecución del script.
  } else {
    echo "<script>alert('Usuario o contraseña incorrectos');</script>";
  }
}



//LOGIN CLIENT

if (isset($_POST['submit'])) { // Verifica si se ha enviado el formulario.

  $username = $_POST['username']; // Obtiene el nombre de usuario ingresado.

  $password = $_POST['password']; // Obtiene la contraseña ingresada.

  $sql = "SELECT * FROM Client WHERE dni='$username' AND contrasenya='$password'"; // Consulta SQL para buscar al cliente en la base de datos.

  $result = $conn->query($sql); // Ejecuta la consulta SQL.

  if ($result->num_rows > 0) { // Si se encuentra al cliente, inicia sesión y redirige a la página de reserva.

// Almacena el nombre de usuario en la sesión.
    $_SESSION['dni'] = $username; // Almacena el DNI en la sesión.

    header('Location: reserva.php'); // Redirige a la página de reserva.

    exit; // Termina la ejecución del script.
  } else {
    echo "<script>alert('Usuario o contraseña incorrectos');</script>";
  }
}


?>



<!DOCTYPE html>
<html>

<head>
  <title>Recepción</title>
  <link rel="icon" type="image/png" href="img/recepción.png"/>

  <style>

    
    body{
      background-image: url("img/recepcion2.jpg");
    }

    h1 {
      margin: 0 0 20px;
      font-weight: bold;
      text-align: center;
      border-radius: 5px;
      padding: 5px;
      border: 1px solid grey;
    }

    /* Estilos del formulario */

    form {
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      width: 400px;
      padding: 20px;
      background-color: white;
      margin-top:15px;
      margin-left:50px;
      background-color:#EBE6E3;
      box-shadow:0px 3px 3px 3px gray;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      margin-bottom: 20px;
      border-bottom: 1px solid rgba(17, 39, 42, 1);
      border-right: none;
      border-top: none;
      border-left: none;
      border-radius: 3px;
      font-size: 14px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
      --c: #2ba9ac;
      border: none;
      border-radius: 5px;

      box-shadow: 0 0 0 .1em inset var(--c);
      --_g: linear-gradient(var(--c) 0 0) no-repeat;
      background:
        var(--_g) calc(var(--_p, 0%) - 100%) 0%,
        var(--_g) calc(200% - var(--_p, 0%)) 0%,
        var(--_g) calc(var(--_p, 0%) - 100%) 100%,
        var(--_g) calc(200% - var(--_p, 0%)) 100%;
      background-size: 50.5% calc(var(--_p, 0%)/2 + .5%);
      outline-offset: .1em;
      transition: background-size .4s, background-position 0s .6s;
    }

    input[type="submit"]:hover {
      --_p: 100%;
      transition: background-position .5s, background-size 0s;
      color: white;
    }


    input[type="submit"]:active {
      box-shadow: 0 0 9e9q inset #0009;
      background-color: var(--c);
      color: #fff;
      font-weight: bold;

    }

    #register {
      width: 100%;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
      --c: #b32020;
      /* the color*/

      box-shadow: 0 0 0 .1em inset var(--c);
      --_g: linear-gradient(var(--c) 0 0) no-repeat;
      background:
        var(--_g) calc(var(--_p, 0%) - 100%) 0%,
        var(--_g) calc(200% - var(--_p, 0%)) 0%,
        var(--_g) calc(var(--_p, 0%) - 100%) 100%,
        var(--_g) calc(200% - var(--_p, 0%)) 100%;
      background-size: 50.5% calc(var(--_p, 0%)/2 + .5%);
      outline-offset: .1em;
      transition: background-size .4s, background-position 0s .6s;
    }

    #register:hover {
      --_p: 100%;
      transition: background-position .5s, background-size 0s;
      color: white;
    }

    #register:active {
      box-shadow: 0 0 9e9q inset #0009;
      background-color: var(--c);
      color: #fff;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <?php if (isset($error)): ?>
    <p style="color: red;">
      <?php echo $error; ?>
    </p>
  <?php endif; ?>

  <div id="contenedor">

    <div id="imagen"></div>

    <div id="formularios">

      <form method="post" action="login.php">
        <h1>Iniciar Sesión</h1>
        <label>DNI:</label>
        <input type="text" name="username" required minlength="5" maxlength="9"  >
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="submit" value="Iniciar Reserva">
      </form>


      <form action="registro_cliente.php" method="POST">
        <h1>Registrarse</h1>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni" required minlength="9" maxlength="9"><br>
        <br>
        <label for="nom_client">Nombre de client:</label>
        <input type="text" name="nom_client" id="nom_client" required><br>

        <label for="cognoms">Apellidos:</label>
        <input type="text" name="cognoms" id="cognoms" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label>Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <input id="register" type="submit" value="Registrarse">
      </form>

    </div>

  </div>



</body>

</html>