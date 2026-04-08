
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include('../backend/verifica_login.php');
    include('../backend/conexao.php');
    $conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");


    $sql = "SELECT * FROM usuarios";
    $res = $conn->query($sql);

    ?>


    <h1>Usuários</h1>

    <?php while ($u = $res->fetch(PDO::FETCH_ASSOC)): ?>

        <div class="card">
            <p><strong>Nome: </strong><?php echo $u['nome']; ?></p>
            <p><strong>Email: </strong><?php echo $u['email']; ?></p>

            <a href="editar_usuario.php?id=<?= $u['id'] ?>">Editar</a>
            <a href="excluir_usuario.php?id=<?= $u['id'] ?>">Excluir</a>


        </div>
    <?php endwhile; ?>
</body>

</html>