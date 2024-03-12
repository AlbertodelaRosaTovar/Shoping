<?php
class Usuario
{
    public static function login($usuario, $password)
{
    $conexionDB = DB::crearInstancia();
    $sql = $conexionDB->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
    $sql->execute([$usuario, $password]);
    $usuario = $sql->fetchAll();

    return $usuario;
}

}
