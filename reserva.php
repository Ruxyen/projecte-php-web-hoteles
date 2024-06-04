<?php
session_start(); // Inicia la sesión para acceder a las variables de sesión.
?>


<!DOCTYPE html>
<html>

<head>
	<title>Reservar</title>
	<link rel="icon" type="image/png" href="img/desk-bell.png" />
	<style>
		body {
			background-image: url('img/reserva_fondo.jpg');
			height: 100vh;
			margin: 0;
			display: flex;
			justify-content: center;
			align-items: center;

		}

		form {
			width: 500px;
			background-color: #296e83;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			padding: 30px;
			margin: 50px;
			border-radius: 5px;
			font-size: 20px;
			justify-content: center;
			text-align: center;
			box-shadow: 5px 5px 5px #5799aa;
			border-radius: 5px;
			opacity: 100%;

		}

		h1 {
			margin: 0 0 20px;
			font-weight: normal;
			text-align: center;
			border-radius: 5px;
			padding: 5px;
			border: 3px solid white;
			color: white;
		}

		label {
			display: block;
			font-size: 17px;
			color: #333;
			margin-bottom: 5px;
			font-weight: bold;
			color: white;
		}

		select {
			margin-bottom: 20px;
			padding: 10px;
			font-size: 15px;
		}

		input {
			width: 100%;
			padding: 8px;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 3px;
			margin-bottom: 20px;
		}

		#btn-reservar:hover {
			background-color: red;
			padding: 18px;
		}


		input[type="submit"] {
			background-color: black;
			color: #fff;
			cursor: pointer;
			transition: background-color 0.3s;
			padding: 15px;
			width: 50%;
			margin: 0;
			font-weight: bold;
			font-size: 17px;
		}

		input[type="submit"]:hover {
			background-color: blue;
			padding: 18px;
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
			color: black;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
</head>

<body>



	<form method="post" action="guardar_reserva.php">
		<h1>Formulario de Reserva</h1>


		<input type="hidden" name="dni" value="<?php echo $_SESSION['dni']; ?>" readonly>
		<label for="data_entrada">Fecha de entrada:</label>
		<input type="date" name="data_entrada" id="data_entrada" required>
		<br>
		<label for="data_sortida">Fecha de salida:</label>
		<input type="date" name="data_sortida" id="data_sortida" required>
		<br>
		<label for="habitacio">Tipus habitació:</label>
		<select name="select_habitacio">
			<?php
			require_once 'conectar_bd.php';

			$sql_habitaciones = "SELECT tipus_habitacio FROM Habitacio";
			$result_habitaciones = $conn->query($sql_habitaciones);

			if ($result_habitaciones->num_rows > 0) {
				while ($row_habitacion = $result_habitaciones->fetch_assoc()) {
					$tipus_habitacio = $row_habitacion['tipus_habitacio'];
					echo "<option value='$tipus_habitacio'>$tipus_habitacio</option>";
				}
			}
			?>
		</select>

		<label for="num_persones">Persones (máxim 2):</label>
		<input type="number" name="num_persones" min="1" max="2" value="1">
		<br>
		<input id="btn-reservar" type="submit" value="Reservar">
	</form>

	<div class="nav-option logout">
		<a id="logout" href="logout.php"><img src="img/icons/logout-icon.png" class="nav-img" alt="logout" width="80"
				height="80"></a>
		<span>Regresar</span>
	</div>

	<form method="post" action="cliente_reservas.php">
		<h1>Mis Reservas</h1>

		<input type="hidden" name="dni" value="<?php echo $_SESSION['dni']; ?>" readonly>
		<input type="submit" value="Mostrar reservas">
	</form>



	<script>
		const dataEntrada = document.getElementById('data_entrada');
		const dataSortida = document.getElementById('data_sortida');

		dataEntrada.addEventListener('change', () => {
			if (dataEntrada.value > dataSortida.value) {
				dataSortida.value = dataEntrada.value;
			}
		});
	</script>



</body>

</html>