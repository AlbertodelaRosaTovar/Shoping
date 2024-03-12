<body class="fondoGestor">
    <main class="aling-items-center">
        <div class="container mx-auto fondo-estrellas" style="width:80%;">
            <div class="row justify-content-center align-items-center">
                <div class="card mb-5 fondoNegro text-white">
                    <div style="display: flex; align-items: center;">
                        <img src="resources/images/logo.png" class="logo-catalogo" style="margin-right: 10px;">
                        <div>
                            <h1 style="margin: 0;">TIENDA EL INGE</h1>
                            <h2 style="margin: 0;">Catálogo de productos</h2>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($productos)) {
                    foreach ($productos as $item) {
                ?>
                        <div class="card col-3 me-5 mb-3">
                            <p>
                                Nombre : <?php echo $item['nombre']; ?>
                            </p>
                            <p>
                                Categoria : <?php echo $item['categoria']; ?>
                            </p>
                            <p>
                                Precio : <?php echo number_format($item['precio'], 2); ?>
                            </p>
                            <p>
                                Talla : <?php echo $item['talla']; ?>
                            </p>

                            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target=" <?php echo '#e' . $item['id'] . 'Modal'; ?>">
                                Solicitar
                            </button>
                        </div>

                        <div class="modal fade" id="e<?php echo $item['id'] ?>Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar producto al carrito.</h5>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Cuantas unidades desea solicitar.
                                        <form method="POST" action="./?controller=pages&action=carrito">
                                            <input class="form-control input_catalogo" type="number" name="unidades">
                                            <input hidden name="id" value="<?php echo $item['id']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                                        <button type="submit" value="agregar" class="btn btn-primary">Solicitar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                } elseif (isset($_SESSION['ticket'])) {
                    echo "<div class='card p-3'>
                    <h5>Folio generado.</h5>";
                    foreach ($_SESSION['ticket'] as $ticket) {
                    ?>

                        <p>Ticket : <?php echo $ticket[0]['folio'];  ?></p>





                <?php

                    }
                    echo "
                    <a class='btn btn-primary'  href='./?controller=pages&action=finalizar'>Volver a comprar.</a>
                    <a class='btn btn-primary' href=''>Enviar al correo.</a>
                    </div>";
                }
                ?>
            </div>
        </div>
        <a href="./?controller=admin&action=login" class="btn administrador"><i class="fas fa-user-shield fa-5x"></i></a>

        </head>
        <button type="button" class="btn btn-primary carrito" data-mdb-toggle="modal" data-mdb-target="#carritoModal">
            <i class="fas fa-shopping-cart"></i>
        </button>


        <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-white fondoNegro">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar producto al carrito.</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Cuerpo del modal -->
                    <div class="modal-body fondo-estrellas">
                        Mis productos.
                        <table class="table table-dark table-striped">
                            <tr>
                                <td>Nombre</td>
                                <td>Categoria</td>
                                <td>Precio</td>
                                <td>Unidades</td>
                                <td>Talla</td>
                            </tr>
                            <?php
                            if (isset($_SESSION['productos'])) {
                                foreach ($_SESSION['productos'] as $carrito) {
                            ?>
                                    <tr>
                                        <td><?php echo $carrito[0]['nombre'] ?></td>
                                        <td><?php echo $carrito[0]['categoria'] ?></td>
                                        <td>$<?php echo number_format($carrito[0]['precio'], 2) ?></td>
                                        <td><?php echo $carrito[0]['unidades'] ?></td>
                                        <td><?php echo $carrito[0]['talla'] ?></td>
                                    </tr>
                                <?php
                                }
                            } else { ?>
                                <p>Tu carrito esta vacio</p>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div class="modal-footer text-white fondoNegro">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                        <a href="./?controller=pages&action=registrar">Comprar</a>
                    </div>
                </div>
            </div>
        </div>





    </main>
</body>