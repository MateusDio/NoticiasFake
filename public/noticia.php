<?php
session_start();
require_once '../backend/conexao.php';
require_once '../includes/header.php';
require_once '../includes/navbar.php';
require_once '../backend/verifica_login.php';

$conn = new PDO('mysql:host=localhost;dbname=portal_noticias', 'root', '');

if (!isset($_GET['id'])) {
    echo "ID da notícia não informado.";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT noticias.*, usuarios.nome 
        FROM noticias
        JOIN usuarios ON noticias.autor_id = usuarios.id
        WHERE noticias.id = :id";

$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    echo "Notícia não encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($noticia['titulo']) ?></title>
</head>

<body>

    <main>

        <h1><?= htmlspecialchars($noticia['titulo']) ?></h1>

        <p><strong>Autor:</strong> <?= htmlspecialchars($noticia['nome']) ?></p>
        <p><strong>Data:</strong> <?= $noticia['data_publicacao'] ?></p>

        <p><?= nl2br(htmlspecialchars($noticia['conteudo'])) ?></p>

        <a href="index.php">Voltar</a>

    </main>
    <?php require_once '../includes/footer.php'; ?>
</body>

</html>