<?php

require_once __DIR__ . '/Db.php';

class Foto
{

    private $db;

    private $id_foto;
    private $id_usuari;
    private $titol;
    private $descripcio;
    private $nom_fixer;
    private $ruta_foto;
    private $data_pujda;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getAllFotos()
    {
        $sql = "SELECT ruta_foto FROM fotos";

        $result = $this->db->query($sql);

        return $result;
    }

    public function getFotoPerld($id_foto)
    {
        $sql = "SELECT ruta_foto FROM fotos WHERE id='$id_foto'";

        $result = $this->db->query($sql);

        return $result;
    }

    public function pujarFoto($fitxer)//pujarfoto($fitxer)
    {
        // Compruebo que venga el fitxer
        if (!isset($fitxer)) {
            return ['ok' => false, 'msg' => 'No se ha enviado ningún fitxer.'];
        }

        // Comprobar errores de upload PHP
        if (!isset($fitxer['error']) || $fitxer['error'] !== UPLOAD_ERR_OK) {
            $code = isset($fitxer['error']) ? $fitxer['error'] : null;
            $msg = $this->codigoErrorUpload($code);
            return ['ok' => false, 'msg' => "Error en la subida: $msg"];
        }

        // Validar tamaño (ejemplo: 5MB máximo)
        $maxBytes = 5 * 1024 * 1024;
        if ($fitxer['size'] > $maxBytes) {
            return ['ok' => false, 'msg' => 'El fitxer supera el tamaño máximo permitido (5MB).'];
        }

        // Validar extensión
        $extensionesPermitidas = ['jpg', 'png', 'gif'];
        $extension = strtolower(pathinfo($fitxer['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $extensionesPermitidas)) {
            return ['ok' => false, 'msg' => 'Extensión no permitida.'];
        }

        // Ruta absoluta o relativa donde quieres guardar.
        // Recomiendo usar una ruta relativa fuera de la carpeta del proyecto si hace falta,
        // pero para ejemplo usaré 'uploads/' en el directorio público.
        $directorioDestino = __DIR__ . '/../static/img/'; // ajusta según estructura
        if (!is_dir($directorioDestino)) {
            if (!mkdir($directorioDestino, 0777, true)) {
                return ['ok' => false, 'msg' => 'No se pudo crear la carpeta de destino. Comprueba permisos.'];
            }
        }

        // Crear nombre único y seguro
        $nombreUnico = uniqid('foto_', true) . '.' . $extension;
        $rutaCompleta = $directorioDestino . $nombreUnico;

        // Mover fitxer desde tmp a destino
        if (!move_uploaded_file($fitxer['tmp_name'], $rutaCompleta)) {
            return ['ok' => false, 'msg' => 'move_uploaded_file falló. Comprueba permisos y ruta.'];
        }

        // Devolver la ruta accesible desde el navegador (relativa a la raíz pública)
        // Si uploads está en el mismo nivel que public/index.php, ajusta accordingly.
        // En este ejemplo devolvemos la ruta relativa 'uploads/nombre.ext'
        $rutaPublica = '/../static/img/' . $nombreUnico;

        return ['ok' => true, 'ruta' => $rutaPublica, 'nombre' => $nombreUnico];
    }

    private function codigoErrorUpload($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                return 'El fitxer excede upload_max_filesize.';
            case UPLOAD_ERR_FORM_SIZE:
                return 'El fitxer excede MAX_FILE_SIZE del formulario.';
            case UPLOAD_ERR_PARTIAL:
                return 'El fitxer fue subido parcialmente.';
            case UPLOAD_ERR_NO_FILE:
                return 'No se subió ningún fitxer.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Falta la carpeta temporal.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Fallo al escribir el fitxer en disco.';
            case UPLOAD_ERR_EXTENSION:
                return 'Subida detenida por extensión.';
            default:
                return 'Error desconocido.';
        }
    }


    public function guardarFoto($id_usuari, $titol, $descripcio, $nom_fixer, $ruta_foto, $data_pujada)
    {

        $sql = "INSERT INTO fotos (id_usuari, titol, descripcio, nom_fixer, ruta_foto, data_pujada)
                    VALUES ('$id_usuari', '$titol', '$descripcio','$nom_fixer', '$ruta_foto', '$data_pujada')";

        $result = $this->db->query($sql);

        return $result;
    }

    public function mostrarMiniaturas()
    {
        // $sql = "SELECT id, ruta_foto FROM fotos";
        // $result = $this->db->query($sql);

        // if ($result && $result->num_rows > 0) {
        //     echo '<div class="galeria">';
        //     while ($row = $result->fetch_assoc()) {
        //         echo '<div class="miniatura">';
        //         echo '<img src="' . htmlspecialchars($row['ruta_foto']) . '" alt="Foto ' . $row['id'] . '">';
        //         echo '</div>';
        //     }
        //     echo '</div>';
        // } else {
        //     echo '<p>No hay fotos disponibles.</p>';
        // }
    }

    public function mostrarDetall()
    {
        $sql = "SELECT titol, descripcio, data_pujada FROM fotos";

        $result = $this->db->query($sql);

        return $result;
    }

    public function __destruct()
    {
        $this->db->close();
    }
}


?>