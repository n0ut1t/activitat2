<?php
    
    require_once __DIR__.'/../config.php';
    class Db {
        private $host;
        private $dbname;
        private $username;
        private $password;
        private $connection;

        public function __construct(){
            mysqli_report(MYSQLI_REPORT_OFF);

            $this->host = DB_HOST;
            $this->dbname = DB_NAME;
            $this->username = DB_USER;
            $this->password = DB_PASS;

            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            if ($this->connection->connect_errno){
                die('Error de conexion: ' . $this->connection->connect_errno);
            }
        }

        public function getConnection(){
            return $this->connection;
        }

        public function query($sql)  {
            $result = $this->connection->query($sql);

            if ($result === false){
                die ('Error SQL; ' . $this->connection->error);
            }

            return $result;
        }

        public function close(){
            if ($this->connection){
                $this->connection->close();
                $this->connection = null;
            }
        }

        public function __destruct(){
            $this->close();
        }
    }
?>