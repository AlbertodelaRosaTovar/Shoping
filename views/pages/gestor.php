<body class="fondoGestor">
    <main>
        <div class="container mt-3">
            <form method="POST" action="./?controller=admin&action=insert">
                <div class="row justify-content-center">
                    <div class="col-10 ">
                        <div class="row">
                            <div class="col-md-4">
                                <input name="nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="col-md-4 ">
                                <input name="categoria" class="form-control" placeholder="Categoría">
                            </div>
                            <div class="col-md-4 ">
                                <input name="precio" class="form-control" placeholder="Precio">
                            </div>
                            <div class="col-md-6 mx-auto mt-3">
                                <input name="stock" class="form-control" placeholder="Stock">
                            </div>
                            <div class="col-md-6 mt-3 mx-auto">
                                <input name="talla" class="form-control" placeholder="Talla">
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mt-3 ">
                        <input class="btn btn-outline-success" type="submit" name="create" value="Registrar producto">
                        <input class="btn btn-outline-danger" type="submit" name="search" value="Buscar producto">
                        <a class="btn btn-outline-danger carrito" style="font-size:20px; " href="./?controller=pages&action=viewCatalogo">
                            <i class="mt-4 fas fa-door-open"></i>
                            <i class="mt-4 fas fa-arrow-right"></i> </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-6 mt-3">
                <div class="container">
                    <div class="overflow-auto custom-scrollbar" style="max-height: 500px;">
                        <table class="table table-dark table-striped">
                            <tr>
                                <td>#</td>
                                <td>Nombre</td>
                                <td>Categoria</td>
                                <td>Precio</td>
                                <td>Stock</td>
                                <td>Talla</td>
                                <td></td>
                            </tr>
                            <?php foreach ($productos as $item) { ?>
                                <tr>
                                    <td><?php echo $item['nombre'] ?></td>
                                    <td><?php echo $item['categoria'] ?></td>
                                    <td><?php echo number_format($item['precio'], 2) ?></td>
                                    <td><?php echo $item['stock'] ?></td>
                                    <td><?php echo $item['talla'] ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <a class="btn btn-danger me-3" href="./?controller=admin&action=delete&id=<?php echo $item['id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <button type="button" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="<?php echo '#e' . $item['id'] . 'Modal'; ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </div>

                                    </td>
                                </tr>
                                <div class="modal fade" id="e<?php echo $item['id'] ?>Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Cabecera del modal -->
                                            <div class="modal-header text-white fondoNegro">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar producto.</h5>
                                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Cuerpo del modal -->
                                            <div class="modal-body fondoModalGestor text-white">
                                                <form method="POST" action="./?controller=admin&action=update">
                                                    <input hidden name="id" placeholder="nombre" value="<?php echo $item['id']; ?>">
                                                    <label>Nombre :</label>
                                                    <input class="form-control" type="text" name="nombre" placeholder="nombre" value="<?php echo $item['nombre']; ?>">
                                                    <label class="mt-3">Categoria</label>
                                                    <input class="form-control" type="text" name="categoria" placeholder="categoria" value="<?php echo $item['categoria']; ?>">
                                                    <label class="mt-3">Precio</label>
                                                    <input class="form-control " type="number" name="precio" placeholder="precio" value="<?php echo number_format($item['precio'], 2); ?>">
                                                    <label class="mt-3">Stock</label>
                                                    <input class="form-control " type="number" name="stock" placeholder="stock" value="<?php echo $item['stock']; ?>">
                                                    <label class="mt-3">Talla</label>
                                                    <input class="form-control " type="text" name="talla" placeholder="talla" value="<?php echo $item['talla']; ?>">

                                            </div>
                                            <div class="modal-footer text-white fondoNegro">
                                                <button type="button" class="btn btn-outline-danger" data-mdb-dismiss="modal">Cerrar</button>
                                                <input class="custom-btn" type="submit" name="actualizar" value="Registrar producto">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-6 mt-3">
                <div class="container">
                    <div class="overflow-auto custom-scrollbar" style="max-height: 500px;">
                        <table class="table table-dark table-striped">
                            <tr>
                                <td>#</td>
                                <td>Folio</td>
                                <td>Unidades</td>
                                <td>Total</td>
                                <td></td>
                            </tr>
                            <?php foreach ($cotizaciones as $venta) { ?>
                                <tr>
                                    <td><?php echo $venta['id'] ?></td>
                                    <td><?php echo $venta['folio'] ?></td>
                                    <td><?php echo $venta['unidades'] ?></td>
                                    <td><?php echo number_format($venta['total'], 2) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target=" <?php echo '#e' . $venta['folio'] . 'Modal'; ?>">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="e<?php echo $venta['folio'] ?>Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Cabecera del modal -->
                                            <div class="modal-header text-white fondoNegro">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar producto.</h5>
                                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Cuerpo del modal -->
                                            <div class="modal-body fondoModalGestor text-white">
                                                <p>Nombre : <?php echo $venta['nombre'] ?></p>
                                                <p>Categoria :<?php echo $venta['categoria'] ?></p>
                                                <p>Precio por unidad : <?php echo number_format($venta['precio'], 2) ?></p>
                                                <p>Unidades solicitadas : <?php echo $venta['unidades'] ?></p>
                                                <p>Talla : <?php echo $venta['talla'] ?></p>

                                            </div>
                                            <div class="modal-footer text-white fondoNegro">
                                                <button type="button" class="btn btn-outline-danger" data-mdb-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>


        </div>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>