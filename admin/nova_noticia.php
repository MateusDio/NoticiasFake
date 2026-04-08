
<?php session_start(); ?>


<?php


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");

function inserir($conn, $titulo, $resumo, $conteudo, $autor_id)
{
    $titulo = trim($titulo);
    $resumo = trim($resumo);
    $conteudo = trim($conteudo);

    $sql = 'INSERT INTO noticias (titulo, resumo, conteudo, autor_id) 
            VALUES (:titulo, :resumo, :conteudo, :autor_id)';

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':titulo' => $titulo,
        ':resumo' => $resumo,
        ':conteudo' => $conteudo,
        ':autor_id' => $autor_id
    ]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    inserir(
        $conn,
        $_POST["titulo"],
        $_POST["resumo"],
        $_POST["conteudo"],
        $_SESSION['usuario_id']
    );

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nova Notícia</title>
<link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body>

<div class="container">
    <h2>Nova Notícia</h2>

    <form method="POST">
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="resumo" placeholder="Resumo" required></textarea>
        <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
        <button type="submit">Publicar</button>
    </form>
</div>

<a href="dashboard.php">Voltar</a>

</body>
</html>