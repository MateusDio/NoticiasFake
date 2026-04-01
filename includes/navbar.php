<?php session_start(); ?>

<div class="navbar">
<a href="index.php"> Início </a>


   <?php if (isset($_SESSION['usuario_id'])): ?>
    <a href="dashboard.php"> Dashboard </a>
    <a href="logout.php"> Logout </a>
    

<?php else: ?>
    <a href="login.php"> Login </a>
    <a href="cadastro.php"> Cadastro </a>
<?php endif; ?>
    
</div>