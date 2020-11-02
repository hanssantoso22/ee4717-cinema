<?php
    session_start();
    if (count($_GET['genre'])>0) {
        $genres_str = implode(',',$_GET['genre']);
        header('Location: ' . $_SESSION['history'] . '?genres='.$genres_str.'');
    }
    else {
        header('Location: ' . $_SESSION['history'] .'');
    }
?>