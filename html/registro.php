<?php
    if(!empty($_POST)){
        $nom = $_POST['nom'];
        $cognoms = $_POST['cognoms'];
        $username = $_POST['username_reg'];
        $psw = $_POST['password_reg'];
        
        require __DIR__.'/../classes/Usuari.php';

        $usuari = new Usuari();

        if (!$usuari->signup($username, $psw, $nom, $cognoms)){
            $error = "S'ha produit un error al inserir les dades";
        } else{
            header("Location: login.html");
        }
    } 
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="/static/style.css">
</head>

<body>
    <header>
        <h1>Registro de usuario</h1>
        <nav>
            <a href="index.html">Inicio</a>
            <a href="login.html">Login</a>
        </nav>
    </header>


    <main>
        <form id="form-registro" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validarRegistro();">
            <label for="nom">Nombre</label>
            <input id="nom" name="nom" type="text" required>


            <label for="cognoms">Apellidos</label>
            <input id="cognoms" name="cognoms" type="text" required>


            <label for="username_reg">Usuario</label>
            <input id="username_reg" name="username_reg" type="text" required>


            <label for="password_reg">Contraseña</label>
            <input id="password_reg" name="password_reg" type="password" required>


            <button type="submit">Registrarse</button>
            <?php

					if (isset($error)) {
						
						echo "<div class=\"col-4 offset-4\">$error</div>";

					}

			?>
        </form>
    </main>


    <footer>
        <p>&copy; Galería</p>
    </footer>


    <script src="scripts.js"></script>
</body>

</html>