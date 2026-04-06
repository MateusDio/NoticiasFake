<?php 
session_start();

require_once 'verifica_login.php';

$conn = new PDO('mysql:host=localhost;dbname=portal_noticias', 'root', '');


if (!isset($_GET['id'])) {
    echo "ID da notícia não informado.";
    exit();
}

$id = $_GET['id'];
$autor_id = $_SESSION['usuario_id'];


$sql = "SELECT * FROM noticias WHERE id = :id AND autor_id = :autor_id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':id' => $id,
    ':autor_id' => $autor_id
]);

$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    echo "Notícia não encontrada ou não pertence a você.";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM noticias WHERE id = :id AND autor_id = :autor_id";
    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':id' => $id,
        ':autor_id' => $autor_id
    ]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Excluir Notícia</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <h2>Excluir Notícia</h2>

    <p>Tem certeza que deseja excluir:</p>
    <strong><?= htmlspecialchars($noticia['titulo']) ?></strong>

    <form method="POST" style="margin-top:20px;">
        <button type="submit">Sim, excluir</button>
    </form>

    <a href="dashboard.php" style="display:block; margin-top:15px; text-align:center;">
        Cancelar
    </a>
</div>

</body>
</html>