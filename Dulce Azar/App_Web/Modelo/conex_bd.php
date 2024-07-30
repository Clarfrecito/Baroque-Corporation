<?php
class Conexion
{
    private static $conexion = null;

    public static function conectar()
    {
        if (self::$conexion == null) {
            try {
                self::$conexion = new mysqli("localhost", "root", "", "dulce_azar");
                if (self::$conexion->connect_error) {
                    throw new Exception("Error de conexión: " . self::$conexion->connect_error);
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
        return self::$conexion;
    }

    public static function cerrar()
    {
        if (self::$conexion != null) {
            self::$conexion->close();
            self::$conexion = null;
        }
    }
}