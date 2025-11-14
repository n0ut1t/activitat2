<?php

require_once __DIR__ . '/Db.php';

class Usuari
{
    private $db;

    private $id;
    private $username;
    private $password;
    private $nom;
    private $cognoms;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function signup($username, $password, $nom, $cognoms)
    {
        $sql = "INSERT INTO usuaris (username, password, nom, cognoms)
                    VALUES ('$username','$password','$nom','$cognoms')";

        $result = $this->db->query($sql);

        return $result;
    }

    public function login($username, $password)
    {
        $sql = "SELECT id, nom, cognoms FROM usuaris WHERE username='$username' and password='$password' LIMIT 1";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->id = $row['id'];
            $this->username = $username;
            $this->password = $password;
            $this->nom = $row['nom'];
            $this->cognoms = $row['cognoms'];

            return true;
        } else {
            return false;
        }
    }

    public function getNomComplert()
    {
        return $this->nom . ' ' . $this->cognoms;
    }

    public function getFotos()
    {
        $id_usuari = $this->id;
        $sql = "SELECT ruta_foto FROM fotos where id_usuari='$id_usuari'";

        $result = $this->db->query($sql);

        return $result;
    }

    public function getId()
    {
        return $this->id;
    }
    public function __destruct()
    {
        $this->db->close();
    }
}

?>