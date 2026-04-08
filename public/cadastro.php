
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method='POST'>

        <input type="text" name="nome" placeholder="Nome">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="senha" placeholder="Senha">
        <button type="submit">Cadastrar</button>

    </form>




    <?php

    $conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");

    function inserir($conn, $nome, $email, $senha)
    {
        $nome = trim($nome);
        $email = trim($email);
        $senha = password_hash(trim($senha), PASSWORD_DEFAULT);

        $sql = 'INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)';
        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha
        ]);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        inserir($conn, $_POST["nome"], $_POST["email"], $_POST["senha"]);
    }

    ?>
</body>