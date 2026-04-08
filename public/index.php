
<?php 

session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <main>
        <?php

        require_once '../backend/conexao.php';
        require_once '../includes/header.php';
        require_once '../includes/navbar.php';
        $conexao = new Database();

        $conn = $conexao->getConnection();

        if ($conn) {
            echo 'Tudo certo patrão! Conexão foi um sucesso!';
        }


        ?>a
        <?php
        include('../backend/verifica_login.php');




        $sql = "SELECT noticias.*, usuarios.nome 
        FROM noticias 
        JOIN usuarios ON noticias.autor_id = usuarios.id 
        ORDER BY data_publicacao DESC";

        $res = $conn->query($sql);

        ?>


        <h1>Fake news:</h1>

        <?php while ($u = $res->fetch(PDO::FETCH_ASSOC)): ?>

            <div class="card">
                <p><strong>Autor: </strong><?= $u['nome'] ?></p>
                <p><strong>Data: </strong><?= $u['data_publicacao'] ?></p>
                <p><strong>Titulo: </strong><?= $u['titulo'] ?></p>
                <p><strong>Resumo: </strong><?= $u['resumo'] ?></p>
                <a href="noticia.php?id=<?= $u['id'] ?>">Ler mais...</a>



            </div>
        <?php endwhile; ?>

      
    </main>
    <?php require_once '../includes/footer.php'; ?>
</body>

</html>