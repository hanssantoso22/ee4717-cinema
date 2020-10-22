<?php
    session_start();
    $delete = $_GET['delete'];
    unset($_SESSION['cart'][$delete]);
    header('Location: ' . $_SESSION['history'] . '');
    exit();
?>