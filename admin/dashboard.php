<!DOCTYPE html>
<?php
require_once '../backend/verifica_login.php'; ?>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>
    <main>
        <?php

        require_once '../backend/conexao.php';
        require_once '../includes/header.php';
        require_once '../includes/navbar.php';

        echo '<h1>Bem-vindo ao seu Perfil, ' . $_SESSION['usuario_nome'] . '!</h1>';

        ?>


        <?php

        $conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");


        $sql = "SELECT * FROM noticias WHERE autor_id = :autor_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':autor_id' => $_SESSION['usuario_id']
        ]);
        $res = $stmt;
        ?>

        <a href="../admin/nova_noticia.php">Nova noticia</a>
        <h1>Suas noticias:</h1>

        <?php while ($u = $res->fetch(PDO::FETCH_ASSOC)): ?>

            <div class="card">
                <p><strong>Titulo: </strong><?php echo $u['titulo']; ?></p>
                <p><strong>Data: </strong><?php echo $u['data_publicacao']; ?></p>
                <p><strong>Resumo: </strong><?php echo $u['resumo']; ?></p>


                <a href="../admin/editar_noticia.php?id=<?= $u['id'] ?>"> ✏️ Editar</a>
                <a href="../admin/excluir_noticia.php?id=<?= $u['id'] ?>"> ❌ Excluir</a>


            </div>
        <?php endwhile; ?>




    </main>

    <?php require_once '../includes/footer.php'; ?>



</body>

</html>