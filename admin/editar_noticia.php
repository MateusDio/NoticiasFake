
<?php session_start(); ?>

<?php

require_once '../backend/verifica_login.php';



$conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");


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

    $titulo = trim($_POST['titulo']);
    $resumo = trim($_POST['resumo']);
    $conteudo = trim($_POST['conteudo']);

    $sql = "UPDATE noticias 
            SET titulo = :titulo, resumo = :resumo, conteudo = :conteudo 
            WHERE id = :id AND autor_id = :autor_id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':titulo' => $titulo,
        ':resumo' => $resumo,
        ':conteudo' => $conteudo,
        ':id' => $id,
        ':autor_id' => $autor_id
    ]);

    echo "Notícia atualizada com sucesso! 🎉";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Notícia</title>
</head>
<body>

<h2>Editar Notícia</h2>

<form method="POST">
    <input type="text" name="titulo" value="<?= $noticia['titulo'] ?>" placeholder="Título">

    <textarea name="resumo" placeholder="Resumo"><?= $noticia['resumo'] ?></textarea>

    <textarea name="conteudo" placeholder="Conteúdo"><?= $noticia['conteudo'] ?></textarea>

    <button type="submit">Salvar Alterações</button>
</form>

</body>
</html>