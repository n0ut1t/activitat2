<?php

    require_once __DIR__ . '/Db.php';

    class Comentari {
        private $db;

        private $id;
        private $id_foto;
        private $id_usuari;
        private $comentari;
        private $data_comentari;

        public function __construct(){
            $this->db = new Db();
        }

        public function guardarComentari($id, $id_foto, $id_usuari, $comentari, $data_comentari){
            $sql = "INSERT INTO comentaris (id, id_foto, id_usuari, comentari, data_comentari)
                    VALUES ('$id', '$id_foto', '$id_usuari', '$comentari', '$data_comentari')";

            $result = $this->db->query($sql);

            return $result;
        }

        public function getComentariPerFoto($id_foto){
            $sql = "SELECT * FROM comentaris WHERE id_foto='$id_foto'";

            $result = $this->db->query($sql);

            return $result;
        }

        public function __destruct(){
            $this->db->close();
        }
    }

?>