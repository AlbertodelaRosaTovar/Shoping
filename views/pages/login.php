<main>

    <body class="fondoGestor">
        <div class="container mx-auto">
            <div class="col-4">
                <div class="text-center">
                <img src="resources/images/logo.png" class="logo">
                <div class="mt-4" >
                    <form method="POST" action="./?controller=admin&action=login">
                        <label class="text-white">Nombre</label>
                        <input class="form-control input_catalogo" type="text" name="usuario" placeholder="Ingrese su usuario">

                        <label class="text-white">Contraseña</label>
                        <input class="form-control input_catalogo" type="password" name="contrasena" placeholder="Ingrese su contraseña">
                        <input class="mt-3 btn btn-outline-light" type="submit" name="login" value="aceder">
                    </form>
                </div>
            </div>
            </div>
        </div>
    </body>
</main>