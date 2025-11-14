<?php
session_start(); // muy importante si usas $_SESSION

require __DIR__ . '/../classes/foto.php';

$foto = new Foto();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['archivo'])) {
        echo "No se ha enviado el input 'archivo'. Revisa el name del input en el formulario.";
        exit;
    }

    $resultado = $foto->pujarFoto($_FILES['archivo']);

    if (!$resultado['ok']) {
        // Mensaje de error claro
        echo "Error al subir el archivo: " . htmlspecialchars($resultado['msg']);
        exit;
    }

    // Ruta pública que devolverá la función (ej: 'uploads/foto_xxx.jpg')
    $ruta = $resultado['ruta'];
    $nom_fitxer = $resultado['nombre'];

    // Verificar sesión / id usuario
    if (!isset($_SESSION['id'])) {
        echo "No se ha detectado usuario en sesión.";
        exit;
    }

    $id_usuari = $_SESSION['id'];
    $titol = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $data = date("Y-m-d H:i:s");

    $ok = $foto->guardarFoto($id_usuari, $titol, $descripcion, $nom_fitxer, $ruta, $data);

    if ($ok) {
        echo "Foto subida correctamente<br>";
        echo "<img src='" . htmlspecialchars($ruta) . "' width='300'>";
    } else {
        echo "La foto se subió al servidor pero hubo un error al guardar en la base de datos.";
        // aquí podrías borrar el fichero recién subido si quieres mantener integridad
    }
}
?>