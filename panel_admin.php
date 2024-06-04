<?php

session_start(); // Inicia una nueva sesión o reanuda una existente

if (!isset($_SESSION['username'])) { // Verifica si la variable de sesión 'username' no está establecida.

    header('Location: login.php'); // Si 'username' no está establecido, redirige al usuario a la página de inicio de sesión.

    exit; // Termina el script.
}

require_once 'conectar_bd.php'; // Incluye y ejecuta el archivo 'conectar_bd.php' para establecer la conexión con la base de datos.

$sql_reserva = "SELECT * FROM Reserva"; // Consulta SQL para seleccionar todos los registros de la tabla 'Reserva'.

$result_reserva = $conn->query($sql_reserva); // Ejecuta la consulta SQL y guarda el resultado en la variable `$result_reserva`.

$sql_client = "SELECT * FROM Client"; // Consulta SQL para seleccionar todos los registros de la tabla 'Client'.

$result_client = $conn->query($sql_client); // Ejecuta la consulta SQL y guarda el resultado en la variable `$result_client`.

$sql_habitacio = "SELECT * FROM Habitacio"; // Consulta SQL para seleccionar todos los registros de la tabla 'Habitacio'.

$result_habitacio = $conn->query($sql_habitacio); // Ejecuta la consulta SQL y guarda el resultado en la variable `$result_habitacio`.


// Consulta SQL para seleccionar información específica de las tablas 'Client', 'Reserva' y 'Habitacio' utilizando JOINs.

$sql_general = "SELECT c.dni, c.nom_client, c.email, h.id_habitacio, h.tipus_habitacio, h.preu_nit, h.descripció
FROM Client c
JOIN Reserva r ON c.id_client = r.id_client
JOIN Habitacio h ON r.id_habitacio = h.id_habitacio"; // 

$result_general = $conn->query($sql_general); // Ejecuta la consulta SQL y guarda el resultado en la variable `$result_general`.



?>




<!DOCTYPE html>
<html>

<head>
    <title>Panel Admin</title>
    <link rel="stylesheet" type="text/css" href="css/panel_admin.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_panel.css">
    <link rel="icon" type="image/png" href="img/admin.png" />
    <style>
        body {
            margin-bottom: 50px;
        }
        #btn {
            text-decoration: none;
            font-size: 18px;
            color: rgb(black);
            font-weight: bold;
            background-color: #f5f5f5;
            padding: 5px;
            margin: 5px

        }
        a{
            text-decoration: none;
            font-size: 18px;
            color: white;
            font-weight: bold;
            padding: 5px;
            margin: 5px;
        }

        #titulo_admin {
            left: 50px;
            position: relative;
        }

        hr {
            margin-top: 20px;
            border-width: 0px;



        }

        h2 {
            padding: 5px;
            border: 3px solid black;
            border-radius: 5px;
            background-color: rgb(54, 243, 227);
            margin-top: 30px;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            border-radius: 30px;
            margin-top: 10px;
            margin-bottom: 10px;

        }


        th,
        td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: darkcyan;
            font-weight: bold;
            color: white;
        }

        td {
            border-right: 1px solid #ddd;
            border-left: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }


        hr {
            margin-bottom: 30px;
        }


        #logout:hover {
            background-color: red;
            padding: 5px;
            transition: background-position .5s, background-size 0s;
            color: black;
            border-radius: 10px;
        }

        .btn {
            color: red;
        }
        .btn_editar{
            color:blue;
        }
    </style>
</head>

<body id="principal">

    <header>

        <div class="logosec">
            <div class="logo">BLUESEA - HOTEL</div>
            <img src="img/icons/menu-icon.png" class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn">
                <img src="img/icons/search-icon.png" class="icn srchicn" alt="search-icon">
            </div>
        </div>

        <div class="message">
            <div class="circle"></div>
            <img src="img/icons/notificacion-icon.png" class="icn" alt="">
            <div class="dp">
                <img src="img/icons/admin-icon.png" class="dpicn" alt="dp">
            </div>
        </div>

    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <img src="img/icons/dashboard-icon.png" class="nav-img" alt="dashboard">
                        <a href="#general">Dashboard</a>
                    </div>

                    <div class="option2 nav-option">
                        <img src="img/icons/reserva-icon.png" class="nav-img" alt="articles">
                        <a href="#reservas">Reservas</a>
                    </div>

                    <div class="nav-option option3">
                        <img src="img/icons/cliente-icon.png" class="nav-img" alt="report">
                        <a href="#clientes">Clientes</a>
                    </div>

                    <div class="nav-option option4">
                        <img src="img/icons/habitacion-icon.png" class="nav-img" alt="institution">
                        <a href="#habitaciones">Habitaciones</a>
                    </div>

                    <div class="nav-option logout">
                        <img src="img/icons/logout-icon.png" class="nav-img" alt="logout">
                        <a id="logout" href="logout.php">Cerrar sesión</a>
                    </div>

                </div>
            </nav>
        </div>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <h1 id="titulo_admin">Bienvenido,
                <?php echo $_SESSION['username']; ?>!
            </h1>
    
        

            <hr id="reservas">

            <div class="report-container">

                <div class="report-header">
                    <h1 class="recent-Articles">Reservas</h1>
                    <button class="view">Ver todo</button>
                </div>

                <table>
                    <tr>
                        <th>Id_Reserva</th>
                        <th>Data Entrada</th>
                        <th>Data Sortida</th>
                        <th>Núm.Persones</th>
                        <th>Id_Habitació</th>
                        <th>Id_Client</th>

                    </tr>
                    <?php while ($valor_reserva = $result_reserva->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php echo $valor_reserva['id_reserva']; ?>
                            </td>
                            <td>
                                <?php echo $valor_reserva['data_entrada']; ?>
                            </td>
                            <td>
                                <?php echo $valor_reserva['data_sortida']; ?>
                            </td>
                            <td>
                                <?php echo $valor_reserva['num_persones']; ?>
                            </td>
                            <td>
                                <?php echo $valor_reserva['id_habitacio']; ?>
                            </td>
                            <td>
                                <?php echo $valor_reserva['id_Client']; ?>
                            </td>
                            <td><a class="btn"
                                    href="eliminar_fila.php?id_reserva=<?php echo $valor_reserva['id_reserva']; ?>">Eliminar</a>
                            </td>
                            <td><a class="btn_editar" href="editar_reserva.php?id_reserva=<?php echo $valor_reserva['id_reserva']; ?>">Editar</a></td>



                        </tr>
                    <?php endwhile; ?>
                </table>

            </div>

            <hr id="clientes">

            <div class="report-container">

                <div class="report-header">
                    <h1 class="recent-Articles">Clientes</h1>
                    <button class="view">Ver todo</button>
                </div>

                <table>
                    <tr>
                        <th>Id_Client</th>
                        <th>Nom_Client</th>
                        <th>Cognoms</th>
                        <th>Email</th>
                        <th>Contrasenya</th>

                    </tr>
                    <?php while ($valor_client = $result_client->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php echo $valor_client['id_client']; ?>
                            </td>
                            <td>
                                <?php echo $valor_client['nom_client']; ?>
                            </td>
                            <td>
                                <?php echo $valor_client['cognoms']; ?>
                            </td>
                            <td>
                                <?php echo $valor_client['email']; ?>
                            </td>
                            <td>
                                <?php echo $valor_client['contrasenya']; ?>
                            </td>
                            <td><a class="btn"
                                    href="eliminar_fila.php?id_client=<?php echo $valor_client['id_client']; ?>">Eliminar</a>
                            </td>
                            <td><a class="btn_editar" href="editar_cliente.php?id_cliente=<?php echo $valor_client['id_client']; ?>">Editar</a></td>



                        </tr>
                    <?php endwhile; ?>
                </table>

            </div>

            <hr id="habitaciones">

            <div class="report-container">

                <div class="report-header">
                    <h1 class="recent-Articles">Habitaciones</h1>
                    <button class="view">Ver todo</button>
                </div>

                <table>
                    <tr>
                        <th>Id_Habitació</th>
                        <th>Tipus_habitació</th>
                        <th>Preu_Nit</th>
                        <th>Capacitat</th>
                        <th>Descripció</th>

                    </tr>
                    <?php while ($valor_habitacio = $result_habitacio->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php echo $valor_habitacio['id_habitacio']; ?>
                            </td>
                            <td>
                                <?php echo $valor_habitacio['tipus_habitacio']; ?>
                            </td>
                            <td>
                                <?php echo $valor_habitacio['preu_nit']; ?>
                            </td>
                            <td>
                                <?php echo $valor_habitacio['capacitat']; ?>
                            </td>
                            <td>
                                <?php echo $valor_habitacio['descripció']; ?>
                            </td>
                            <td><a class="btn"
                                    href="eliminar_fila.php?id_habitacio=<?php echo $valor_habitacio['id_habitacio']; ?>">Eliminar</a>
                                    <td><a class="btn_editar" href="editar_habitacion.php?id_habitacio=<?php echo $valor_habitacio['id_habitacio']; ?>">Editar</a></td>

                            </td>


                        </tr>
                    <?php endwhile; ?>
                </table>
                <h2>Añadir Habitación Nueva</h2>
                <form action="agregar_habitacion.php" method="POST">
                    <br>
                    <label for="tipus_habitacio">Tipo de Habitación:</label>
                    <input type="text" name="tipus_habitacio" required><br><br>
                    <label for="preu_nit">Precio por Noche:</label>
                    <input type="number" name="preu_nit" required><br><br>
                    <label for="capacitat">Capacidad:</label>
                    <input type="number" name="capacitat" required><br><br>
                    <label for="descripció ">Descripción:</label>
                    <textarea name="descripció" required></textarea><br><br>
                    <input id=btn type="submit" value="Agregar Habitación">
                </form>

            </div>


        </div>
    </div>


    <script src="js/panel_admin.js"></script>

</body>

</html>

<!--Cerrar la conexión a la base de datos-->

<?php $conn->close(); ?>