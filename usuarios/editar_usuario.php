
<?php session_start(); ?>

<?php

require_once '../backend/verifica_login.php';
require_once '../backend/conexao.php';



$conn = new PDO("mysql:host=localhost;dbname=portal_noticias", "root", "");


$id = $_GET['id'];
$autor_id = $_SESSION['usuario_id'];


$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':id' => $id
]);

$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    echo "Usuário não encontrado.";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $sql = "UPDATE usuarios 
            SET nome = :nome, email = :email, senha = :senha 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ':id' => $id
    ]);

    echo "Usuário atualizado com sucesso! 🎉";
}
?>


<h1>Editar Usuário</h1>

<form method="POST">
    <h3>Nome: </h3>
    <input type="text" name="nome" value="<?= htmlspecialchars($noticia['nome']) ?>" required>
    <h3>Email: </h3>
    <input type="email" name="email" value="<?= htmlspecialchars($noticia['email']) ?>" required>
    <h3>Senha: </h3>
    <input type="password" name="senha" required>
    <br><br>
    <input type="submit" value="Atualizar">,
</form>
