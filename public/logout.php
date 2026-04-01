<?php
session_start();       // inicia a sessão
session_destroy();     // destrói tudo da sessão

header("Location: login.php"); // redireciona pro login
exit;

?>