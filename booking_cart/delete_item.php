<?php
    session_start();
    $delete = $_GET['delete'];
    $subtotal = $_GET['subtotal'];
    $_SESSION['total'] = $_SESSION['total'] - $subtotal;
    unset($_SESSION['cart'][$delete]);
    header('Location: ' . $_SESSION['history'] . '');
    exit();
?>