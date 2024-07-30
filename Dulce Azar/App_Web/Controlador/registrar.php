<?php
session_start();
require_once '../Modelo/usuario.php';
require_once '../Modelo/conex_bd.php';
require_once '../Utiles/verificar_sesion.php';

class RegistrarControlador
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion::conectar();
    }

    

    public function registrar()
    {
        if (isset($_POST['registrarse'])) {
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
                $filtroUsername = "[A-Za-z0-9_]{5,20}";
                $filtroEmail = "[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}";
                if ($this->verificar_datos($filtroUsername, $_POST['username']) && $this->verificar_datos($filtroEmail, $_POST['email'])) {
                    $username = $this->limpiar_cadena($_POST['username']);
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $email = $this->limpiar_cadena($_POST['email']);

                    $stmt = $this->conexion->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $username, $email, $password);
                    if ($stmt->execute()) {
                        $_SESSION['username'] = $username;
                        header("Location: ../Vista/login.php");
                        exit();
                    } else {
                        echo "Ha ocurrido un error al registrar.";
                    }
                    $stmt->close();
                } else {
                    echo "Los datos ingresados no son válidos.";
                }
            } else {
                echo "Por favor complete todos los datos.";
            }
        } else {
            header("Location: ../Vista/registrarse.php");
            exit();
        }
    }

    public function logout()
    {
        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Location: ../index.php");
            exit();
        }
    }

    public function login() 
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $this->limpiar_cadena($_POST["username"]);
            $password = $_POST["password"];

            $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row["password"])) {
                    $_SESSION['username'] = $username;
                    header("Location: ../Vista/juegos.php");
                    exit();
                } else {
                    header("Location: ../Vista/contraseña_incorrecta.php");
                    exit();
                }
            } else {
                header("Location: ../Vista/contraseña_incorrecta.php");
                exit();
            }
            $stmt->close();
        }
    }

    function verificar_datos($filtro, $cadena) {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return true;
        } else {
            return false;
        }
    }

    function limpiar_cadena($cadena){
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        $cadena=str_ireplace("<script>", "", $cadena);
        $cadena=str_ireplace("</script>", "", $cadena);
        $cadena=str_ireplace("<script src", "", $cadena);
        $cadena=str_ireplace("<script type=", "", $cadena);
        $cadena=str_ireplace("SELECT * FROM", "", $cadena);
        $cadena=str_ireplace("DELETE FROM", "", $cadena);
        $cadena=str_ireplace("INSERT INTO", "", $cadena);
        $cadena=str_ireplace("DROP TABLE", "", $cadena);
        $cadena=str_ireplace("DROP DATABASE", "", $cadena);
        $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
        $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
        $cadena=str_ireplace("<?php", "", $cadena);
        $cadena=str_ireplace("?>", "", $cadena);
        $cadena=str_ireplace("--", "", $cadena);
        $cadena=str_ireplace("^", "", $cadena);
        $cadena=str_ireplace("<", "", $cadena);
        $cadena=str_ireplace("[", "", $cadena);
        $cadena=str_ireplace("]", "", $cadena);
        $cadena=str_ireplace("==", "", $cadena);
        $cadena=str_ireplace(";", "", $cadena);
        $cadena=str_ireplace("::", "", $cadena);
        return $cadena;
    }
}

$conexion = new Conexion();

if (isset($_POST['registrarse'])) {
    $controlador = new RegistrarControlador($conexion);
    $controlador->registrar();
} elseif (isset($_POST['login'])) {
    $controlador = new RegistrarControlador($conexion);
    $controlador->login();
} elseif (isset($_POST['logout'])) {
    $controlador = new RegistrarControlador($conexion);
    $controlador->logout();
}
?>