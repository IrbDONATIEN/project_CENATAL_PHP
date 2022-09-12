<?php
session_start();
require_once 'auth.php';
$cadmin=new Auth();

//Session Admin
if(!isset($_SESSION['loginAdmin'])){
    header('location:../index.php');
    die;
}
    $clogin=$_SESSION['loginAdmin'];

    $data=$cadmin->currentAdmin($clogin);

    $cid=$data['id'];
    $cservice=$data['service'];
?>