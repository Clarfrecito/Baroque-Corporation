<?php
require_once '../Utiles/verificar_sesion.php';
verificar_sesion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesJ.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <title>Manchita</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof resultado !== 'undefined' && typeof ganancia !== 'undefined') {
                alert('La manchita salió en la posición: ' + resultado + '. Ganancia: ' + ganancia + ' caramelos.');
            }
        });
    </script>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="https://i.ibb.co/Ny9Nb46/k4u-UAAAAASUVORK5-CYII.png" alt="Logo" border="0">  
        </a>
    </header>
    <main>
        <h1>Juego de la Manchita</h1>
        <form method="POST" action="../Controlador/juegos.php">
            <fieldset>
                <legend>Selecciona las posiciones en las que crees que saldrá la manchita:</legend>
                <label>
                    <input type="checkbox" name="posiciones[]" value="1-12"> Del 1 al 12
                </label><br>
                <label>
                    <input type="checkbox" name="posiciones[]" value="13-24"> Del 13 al 24
                </label><br>
                <label>
                    <input type="checkbox" name="posiciones[]" value="25-36"> Del 25 al 36
                </label><br>
                <label>
                    <input type="checkbox" name="posiciones[]" value="37-48"> Del 37 al 48
                </label><br>
                <br>
                <label for="posicion_exacta">O ingresa posiciones exactas (separadas por comas, máximo 10):</label><br>
                <input type="text" id="posicion_exacta" name="posicion_exacta"><br><br>
                <button type="submit" name="jugar">Jugar Manchita</button>
            </fieldset>
        </form>
        <br>
        <form method="POST" action="../Controlador/registrar.php">
            <button type="submit" name="logout">Cerrar Sesión</button>
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>
