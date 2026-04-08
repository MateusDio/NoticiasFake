

<div class="navbar">

    <a href="index.php">Início</a>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="../public/index.php">Início</a>
        <a href="../admin/dashboard.php">Dashboard</a>
        <a href="../backend/logout.php">Logout</a>

    <?php else: ?>

        <a href="../public/login.php">Login</a>
        <a href="../public/cadastro.php">Cadastro</a>

    <?php endif; ?>

</div>