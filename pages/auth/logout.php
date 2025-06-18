<?php
    session_start();
    session_destroy();
    header('Location: login.php?erro=Digite email e senha!');
    exit;
?>