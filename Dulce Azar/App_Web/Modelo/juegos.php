<?php
//Prueba de modelo de juegos
require_once 'conex_bd.php';

class Juegos extends Usuario{

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function SeleccionarJuego (){
        $consulta = "SELECT * FROM manchita";
        return mysqli_query($this->conexion, $consulta);
    }

    public function SeleccionarJuegoPorId ($id){
        $consulta = "SELECT * FROM manchita WHERE id = $id";
        return mysqli_query($this->conexion, $consulta);
    }
}