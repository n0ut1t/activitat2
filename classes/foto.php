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

    public function validarFoto()
    {
        //hay que comprobar que la exstension de la foto sea valida, hacer una vez sepa como cojer los datos
    }

    public function guardarFoto($id_foto, $id_usuari, $titol, $descripcio, $ruta_foto, $data_pujada)
    {

        $sql = "INSERT INTO fotos (id, id_usuari, titol, descripcio, nom_fixer, ruta_foto, data_pujada)
                    VALUES ('$id_foto', '$id_usuari', '$titol', '$descripcio', '$ruta_foto', '$data_pujada')";

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

    public function __destruct(){
        $this->db->close();
    }
}


?>