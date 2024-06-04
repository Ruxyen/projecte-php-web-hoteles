<?php
session_start();

require_once 'conectar_bd.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'conectar_bd.php';

if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];

    $sql = "DELETE FROM Client WHERE dni = '$dni'";
    $result = $conn->query($sql);

    if ($result) {
        header('Location: panel_admin.php');
    } else {
        echo "Error al eliminar la fila: " . $conn->error;
    }
}

if (isset($_GET['id_client'])) {
    $id_client = $_GET['id_client'];

    $sql = "DELETE FROM Client WHERE id_client = '$id_client'";
    $result = $conn->query($sql);

    if ($result) {
        header('Location: panel_admin.php');
    } else {
        echo "Error al eliminar la fila: " . $conn->error;
    }
}

if (isset($_GET['id_reserva'])) {
    $id_reserva = $_GET['id_reserva'];

    $sql = "DELETE FROM Reserva WHERE id_reserva = '$id_reserva'";
    $result = $conn->query($sql);

    if ($result) {
        header('Location: panel_admin.php');
    } else {
        echo "Error al eliminar la fila: " . $conn->error;
    }
}

if (isset($_GET['id_habitacio'])) {
    $id_habitacio = $_GET['id_habitacio'];

    $sql = "DELETE FROM Habitacio WHERE id_habitacio = '$id_habitacio'";
    $result = $conn->query($sql);

    if ($result) {
        header('Location: panel_admin.php');
    } else {
        echo "Error al eliminar la fila: " . $conn->error;
    }
}

$conn->close();
?>
