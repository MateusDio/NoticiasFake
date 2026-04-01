<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method='POST'>

        <input type="email" name="email" placeholder="Email">
        <input type="password" name="senha" placeholder="Senha">
        <button type="submit">Entrar</button>

    </form>


    <?php
    session_start();
    $conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");

    function verificar($conn, $email, $senha)
    {
        $email = trim($email);
        $senha = trim($senha);

        $sql = 'SELECT * FROM usuarios WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header("Location: ../public/index.php");
            exit();

        } else {
            echo "Email ou senha incorretos.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        verificar($conn, $_POST["email"], $_POST["senha"]);
    }

    ?>
</body>

</html>a