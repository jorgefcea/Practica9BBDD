<?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
        exit;
    }
    header("Location: admin.php");
    exit;
?>