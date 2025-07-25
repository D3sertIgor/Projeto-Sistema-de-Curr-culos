<?php

class ConexaoBD {
    private $serverName = "localhost";
    private $userName = "root";
    private $password = "ds3b24";
    private $dbName = "prj_Completo2024";

    public function conectar() {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        return $conn;
    }
}
?>