<?php
include_once("conexion.php");
class Productos
{
    public static function catalogoLista()
    {
        $conexionDB = DB::crearInstancia();
        $sql = $conexionDB->prepare("SELECT * FROM productos");
        $sql->execute();
        $resultado = $sql->fetchAll();

        return $resultado;
    }

    public static function cotizacionLista()
    {
        $conexionDB = DB::crearInstancia();
        $sql = $conexionDB->prepare("SELECT * FROM cotizaciones");
        $sql->execute();
        $resultado = $sql->fetchAll();

        return $resultado;
    }

    public static function registrarProductos($folio, $id_producto, $nombre, $categoria, $precio, $unidades, $talla, $total)
    {
        $conexionDB = DB::crearInstancia();
        $sql = "INSERT INTO cotizaciones (folio, id_producto, nombre, categoria, precio, unidades, talla, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexionDB->prepare($sql);

        $stmt->bindParam(1, $folio, PDO::PARAM_STR);
        $stmt->bindParam(2, $id_producto, PDO::PARAM_STR);
        $stmt->bindParam(3, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(4, $categoria, PDO::PARAM_STR);
        $stmt->bindParam(5, $precio, PDO::PARAM_STR);
        $stmt->bindParam(6, $unidades, PDO::PARAM_STR);
        $stmt->bindParam(7, $talla, PDO::PARAM_STR);
        $stmt->bindParam(8, $total, PDO::PARAM_STR);

        $stmt->execute();

        $id_insertado = $conexionDB->lastInsertId();

        return $id_insertado;
    }

    public static function generarFolio($id)
    {
        $fechaGenerada = date('Y-m-d H:i:s');
        $numeroFolioAleatorio = rand(1, 10000);
        $Prefolio = $fechaGenerada . $id . $numeroFolioAleatorio;
        $folio = preg_replace("/[^0-9]/", "", $Prefolio);

        return $folio;
    }

    public static function consultarCotizacion($id)
    {
        $conexionDB = DB::crearInstancia();
        $sql = $conexionDB->prepare("SELECT folio FROM cotizaciones WHERE id = $id");
        $sql->execute();
        $folio = $sql->fetchAll();

        return $folio;
    }
}
