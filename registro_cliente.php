<?php

require_once 'conectar_bd.php'; // Incluye el archivo 'conectar_bd.php' que contiene las credenciales para conectarse a la base de datos.

$conn = new mysqli($servername, $username, $password, $dbname); // Crea una nueva conexión a la base de datos utilizando las credenciales.

if ($conn->connect_error) { // Verifica si hay un error de conexión.
    die("Error de conexión: " . $conn->connect_error); // Muestra el error y termina el script.
}

$sql = "SELECT MAX(id_client) as ultimo_id FROM Client"; // Consulta SQL para obtener el último valor de 'id_client' en la tabla 'Client'.

$result = $conn->query($sql); // Ejecuta la consulta SQL y guarda el resultado.

if ($result->num_rows > 0) { // Verifica si hay al menos un registro en el resultado.

    $row = $result->fetch_assoc(); // Obtiene el registro como un array asociativo.

    $ultimo_id = $row['ultimo_id']; // Guarda el valor de 'ultimo_id' en la variable $ultimo_id.

    echo "<script>alert('¡Bienvenido!');</script>";


} else { // Si no hay registros en el resultado.

    echo "No se encontraron registros en la tabla Client"; // Muestra un mensaje indicando que no se encontraron registros.
}


$ultimo_id_string = strval($ultimo_id + 1); // Incrementa el valor de $ultimo_id en 1 y lo convierte a string.

// Obtiene los valores del formulario POST y los guarda en variables.

$nom_client = $_POST['nom_client'];
$cognoms = $_POST['cognoms'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$password = $_POST['password'];



    



?>





<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bienvenido/a!</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/welcome-back.png"/>
    <link rel="stylesheet" href="">
</head>

<style>
    body {
        background-color: #296e83;

    }

    h1 {
        margin: 25px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        color:white;
        font-size:40px;
        margin-top:40px;
    }


    /* Estilos del formulario */

    form {
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        width: 400px;
        padding: 20px;
        background-color: black;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="submit"] {
        color: white;
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
        div {
            position:fixed;
            display:block;
            top:40px;
            justify-content:center;
            align-items:center;
            line-height:40px;
            left:25%;
            width:50%;
            font-size:20px;
            border:3px solid white;
            padding:20px;
            margin:0;
            border-radius:15px;
           box-shadow: 5px 5px 5px 5px gray;
           color:white;
            
        }
</style>

<body>
    <div class="nav-option logout">
        <a id="logout" href="logout.php"><img src="img/icons/logout-icon.png" class="nav-img" alt="logout" width="80"
                height="80"></a>
        <span>Regresar</span>
    </div>
    <?php

    // Consulta SQL para insertar un nuevo registro en la tabla 'Client'.
    
    $sql = "INSERT INTO Client (id_client,nom_client, cognoms, email, contrasenya, dni) VALUES ('$ultimo_id_string','$nom_client', '$cognoms', '$email','$password','$dni')";

    if ($conn->query($sql) === TRUE) { // Ejecuta la consulta SQL y verifica si se realizó correctamente.
    

        echo "<div>";
        echo "<h1>Has sido registrado/a exitosamente</h1>"; // Muestra un mensaje indicando que el registro fue exitoso.
        echo "<p>¡Bienvenido/a al Hotel - BLUESEA!<br><br> Nos complace mucho que hayas elegido confiar en nosotros para tu estancia en BLUESEA. <br>Estamos comprometidos en ofrecerte una experiencia inolvidable en cada uno de tus viajes y nos enorgullece ser tu hogar lejos del hogar.

        <br>Desde el momento en que te registras, te ofrecemos un servicio personalizado y de alta calidad que se extiende a cada aspecto de tu estancia. <br>Nuestro equipo está aquí para ayudarte en todo momento, desde recomendaciones de restaurantes locales hasta la planificación de excursiones y tours.
        
        <br>Además, entendemos que la seguridad y la limpieza son fundamentales para tu tranquilidad y bienestar durante tu estancia. <br>Por eso, estamos comprometidos en seguir las pautas y recomendaciones de salud y seguridad para garantizar que todas nuestras instalaciones sean seguras y estén limpias.
        
        <br>Gracias de nuevo por confiar en nosotros para tu próxima estancia en BLUESEA. <br> Esperamos que tengas una estancia maravillosa con nosotros y que disfrutes de todas las comodidades y servicios que ofrecemos. <br>No dudes en contactarnos si necesitas algo durante tu estancia.</p>";

        echo "</div>";

    } else { // Si hubo un error al ejecutar la consulta.
    
        echo "Error: " . $sql . "<br>" . $conn->error; // Muestra el error y la consulta SQL.
    }

    $conn->close(); // Cierra la conexión a la base de datos.
    
    ?>




</body>

</html>