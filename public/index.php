<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


        require_once '../includes/footer.php';


        ?>


    </main>
    <?php require_once '../includes/footer.php'; ?>
</body>

</html>