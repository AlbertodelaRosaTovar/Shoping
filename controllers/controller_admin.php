<?php
include_once("models/usuario.php");
include_once("models/productos.php");
include_once("models/gestor.php");
include_once("conexion.php");


class ControllerAdmin
{
    function login()
    {
        if(isset($_POST['login'])){   
        $usuario = $_POST['usuario'];
        $password = $_POST['contrasena'];
        $validar = Usuario::login($usuario, $password);
        if($validar[0]['usuario'] != null && $validar[0]['contrasena'] != null){
            header('Location: ./?controller=admin&action=gestorProductos');
        } else {
            header('Location: ./?controller=admin&action=login');
          }
        }
        include_once("views/pages/login.php");
    }
    function gestorProductos()
    {

        $search = $_GET['search'] ?? null;
        $nombre = $_GET['nombre'] ?? null;
        $categoria = $_GET['categoria'] ?? null;
        $precio = $_GET['precio'] ?? null;
        $stock = $_GET['stock'] ?? null;
        $talla = $_GET['talla'] ?? null;


        if (isset($search)) {
            $productos = Gestor::search($nombre, $categoria, $precio, $stock, $talla);            
        } else {
            $productos = productos::catalogoLista();
        }
        $cotizaciones = productos::cotizacionLista();
        include_once("views/pages/gestor.php");
    }

    function insert()
    {
        $create = $_POST['create'] ?? null;
        $search = $_POST['search'] ?? null;
        $nombre = $_POST['nombre'] ?? null;
        $categoria = $_POST['categoria'] ?? null;
        $precio = $_POST['precio'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $talla = $_POST['talla'] ?? null;


        if (isset($create)) {
            $crear = Gestor::create($nombre, $categoria, $precio, $stock, $talla);
            header('Location: ./?controller=admin&action=gestorProductos');
        } else {
            header('Location: ./?controller=admin&action=gestorProductos&search=' . $search . '&nombre='.$nombre.'&categoria='.$categoria.'&precio='.$precio.'&stock='.$stock.'&talla='.$talla.'');
        }
    }

    function delete()
    {
        $id = $_GET['id'];
        $eliminar = Gestor::delete($id);
        header('Location: ./?controller=admin&action=gestorProductos');
    }

    function update()
    {
        $id = $_GET['id'] ?? 0;
        $actualizar = $_POST['actualizar'] ?? null;
        $producto = Gestor::consultarProducto($id);
        include_once("views/pages/actualizar.php");
        if (isset($actualizar)) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $talla = $_POST['talla'];

            $crear = Gestor::update($id, $nombre, $categoria, $precio, $stock, $talla);
            header('Location: ./?controller=admin&action=gestorProductos');
        }
    }
}
