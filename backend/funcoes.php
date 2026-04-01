<?php

class Funcoes {

private $conn;

public function __construct() {
    $database = new Database();
    $this->conn = $database->getConnection();
}

public function inserir(){


}

}


?>