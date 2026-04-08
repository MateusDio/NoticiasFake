
<?php session_start(); ?>


<?php
require_once '../backend/verifica_login.php';
require_once '../backend/conexao.php';
$conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");

// Ativar erros
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Verifica ID
if (!isset($_GET['id'])) {
    echo "ID não informado.";
    exit();
}

$id = $_GET['id'];

// Buscar usuário
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}

// Se confirmou exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Excluir Usuário</title>
</head>
<body>

    <h2>Excluir Usuário</h2>

    <p>
        Tem certeza que deseja excluir o usuário 
        <strong><?= htmlspecialchars($usuario['nome']) ?></strong>?
    </p>

    <form method="POST">
        <button type="submit" href="usuarios.php">Sim, excluir</button>
    </form>

    <br>
    <a href="usuarios.php">Cancelar</a>

</body>
</html>