<?php
include_once("conexion.php");
include_once("models/usuario.php");
include_once("models/productos.php");
include_once("models/gestor.php");

class ControllerPages
{

    function viewCatalogo()
    {
        session_start();

        $productos = productos::catalogoLista();
        include_once("views/pages/catalogo.php");
    }

    function carrito()
    {
        session_start();
        $_SESSION['carrito'] = [];
        $unidades = $_POST['unidades'];
        $id = $_POST['id'];
        $producto = Gestor::consultarProducto($id);

        $registro = ["id" => $id, "nombre" => $producto[0]['nombre'], "categoria" => $producto[0]['categoria'], "precio" => $producto[0]['precio'], "unidades" => $unidades, "talla" => $producto[0]['talla'],];
        array_push($_SESSION['carrito'], $registro);
        $_SESSION['productos'][] = $_SESSION['carrito'];
        header('Location: ./?controller=pages&action=viewCatalogo');
    }

    function registrar()
    {
        session_start();
        $_SESSION['ticket'] = [];
        foreach($_SESSION['productos'] as $producto){
            $folio = Productos::generarFolio($producto[0]['id']);
            $total = $producto[0]['precio'] * $producto[0]['unidades'];
            $cotizar = Productos::registrarProductos($folio,$producto[0]['id'], $producto[0]['nombre'], $producto[0]['categoria'], $producto[0]['precio'], $producto[0]['unidades'], $producto[0]['talla'], $total);
            $cotizacion = Productos::consultarCotizacion($cotizar);
            array_push($_SESSION['ticket'],$cotizacion);
        }
        header('Location: ./?controller=pages&action=ticket');
    }

    function ticket()
    {
        session_start();
        include_once("views/pages/catalogo.php");
    }

    function finalizar() 
    {
        session_start();
        session_destroy();
        header('Location: ./?controller=pages&action=viewCatalogo');
            
    }
}
