<?php


class Gestor
{


    public static function delete($id)
    {
        $conexionDB = DB::crearInstancia();
        $sql = $conexionDB->prepare("DELETE FROM productos WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    }

    public static function create($nombre, $categoria, $precio, $stock, $talla)
    {
        $conexionDB = DB::crearInstancia();
        $sql = "INSERT INTO productos (categoria, nombre, precio, stock, talla) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexionDB->prepare($sql);

        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $categoria, PDO::PARAM_STR);
        $stmt->bindParam(3, $precio, PDO::PARAM_STR);
        $stmt->bindParam(4, $stock, PDO::PARAM_STR);
        $stmt->bindParam(5, $talla, PDO::PARAM_STR);



        $stmt->execute();
    }

    public static function update($id, $nombre, $categoria, $precio, $stock, $talla)
    {
        $conexionDB = DB::crearInstancia();
        $sql = "UPDATE productos SET nombre = ?, categoria = ?, precio = ?, stock = ?, talla = ? WHERE id = ?";
        $stmt = $conexionDB->prepare($sql);
    
        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $categoria, PDO::PARAM_STR);
        $stmt->bindParam(3, $precio, PDO::PARAM_STR);
        $stmt->bindParam(4, $stock, PDO::PARAM_STR);
        $stmt->bindParam(5, $talla, PDO::PARAM_STR);
        $stmt->bindParam(6, $id, PDO::PARAM_INT); 
    
        $stmt->execute();
    }
    

    public static function consultarProducto($id)
    {
        $conexionDB = DB::crearInstancia();
        $sql = $conexionDB->prepare("SELECT * FROM productos WHERE id = $id");
        $sql->execute();
        $usuario = $sql->fetchAll();

        return $usuario;
    }

  
    public static function search($nombre, $categoria, $precio, $stock, $talla)
    {
        $conexionDB = DB::crearInstancia();
        $whereConditions = array();
        $params = array();
    
        if ($nombre != null) {
            $whereConditions[] = "nombre = ?";
            $params[] = $nombre;
        }
        if ($categoria != null) {
            $whereConditions[] = "categoria = ?";
            $params[] = $categoria;
        }
        if ($precio != null) {
            $whereConditions[] = "precio = ?";
            $params[] = $precio;
        }
        if ($stock != null) {
            $whereConditions[] = "stock = ?";
            $params[] = $stock;
        }
        if ($talla != null) {
            $whereConditions[] = "talla = ?";
            $params[] = $talla;
        }
    
        $sql = "SELECT * FROM productos";
    
        if (!empty($whereConditions)) {
            $sql .= " WHERE " . implode(" AND ", $whereConditions);
        }
        
        $stmt = $conexionDB->prepare($sql);
    
        foreach ($params as $key => $value) {
            $stmt->bindValue($key + 1, $value, PDO::PARAM_STR);
        }
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

}
