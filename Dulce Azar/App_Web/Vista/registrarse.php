<!DOCTYPE html>
<html>

<head>
    <title>Registrarse</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesR.css">
    <link rel="stylesheet" href="stylesR.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
</head>

<body>
    <main>
    <a href="../index.php">
        <img src="https://i.ibb.co/Ny9Nb46/k4u-UAAAAASUVORK5-CYII.png" alt="k4u-UAAAAASUVORK5-CYII" border="0">  
        </a>
        <form method="post" action="../Controlador/registrar.php">
            <div >
                <h1>Registrarse</h1>
                <input type="text" name="username" placeholder="Nombre completo">
                <br>
                <br>
                <input type="password" name="password" placeholder="Contraseña">
                <br>
                <br>
                <input type="email" name="email" placeholder="Correo electronico">
                <br>
                <br>
                <button type=submit name=registrarse>Registrarse</button>
        </form>
        </div>
        <?php
        if (isset($mensaje)) {
            echo "<p>$mensaje</p>";
        }
        // if (isset($registrado) && $registrado) {
        //   echo '<br><a href="Logout.php">Cerrar Sesión</a>';
        // }
        ?>
    </main>
</body>

</html>