<form method="POST" action="./?controller=admin&action=update">
    <input hidden name="id" placeholder="nombre" value="<?php echo $producto[0]['id']; ?>">
    <input type="text" name="nombre" placeholder="nombre" value="<?php echo $producto[0]['nombre']; ?>">
    <input type="text" name="categoria" placeholder="categoria" value="<?php echo $producto[0]['categoria']; ?>">
    <input type="number" name="precio" placeholder="precio" value="<?php echo $producto[0]['precio']; ?>">
    <input type="number" name="stock" placeholder="stock" value="<?php echo $producto[0]['stock']; ?>">
    <input type="text" name="talla" placeholder="talla" value="<?php echo $producto[0]['talla']; ?>">
    <input type="submit" name="actualizar" value="Registrar producto">
</form>