<?php
    if (!empty($_POST)){

        require __DIR__.'/../classes/Usuari.php';

        $usuari = new Usuari();

        $username = $_POST["username"];
        $pssw = $_POST["password"];

        if($usuari->login($username, $pssw)){
            session_start();
            $_SESSION["id"] = $usuari->getId();
            $_SESSION["nom_usuari"] = $usuari->getNomComplert();

            header("Location: /../index.html");
        } else {
            header('Location: /../html/registro.php');
        }
    } else {
        header('Location: /../html/registro.php');
    }
?>