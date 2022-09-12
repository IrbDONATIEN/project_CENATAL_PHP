<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['loginZone']);
    unset($_SESSION['loginAdmin']);
    unset($_SESSION['loginInsp']);
    header('location:../../index.php');
?>