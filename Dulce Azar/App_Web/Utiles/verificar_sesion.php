<?php
function verificar_sesion() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Verificar si la sesión está activa
    if (!isset($_SESSION['username'])) {
        header("Location: ../Vista/login.php"); // Redirige al login si no hay sesión
        exit();
    }
}
?>