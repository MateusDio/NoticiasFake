<?php 

require_once '../backend/conexao.php';

$conexao = new Database();

$conn = $conexao->getConnection();

if($conn){
    echo 'Tudo certo patrão! Conexão foi um sucesso!';
}





?>