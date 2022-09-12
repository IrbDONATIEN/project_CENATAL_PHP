<?php
session_start();
require_once 'zone.php';
$cZone=new Zone();

//Session Zone de santé
if(!isset($_SESSION['loginZone'])){
    header('location:../index.php');
    die;
}
    $clogin=$_SESSION['loginZone'];

    $data=$cZone->currentZone($clogin);

    $cid=$data['id'];
    $ccodeZone=$data['codeZone'];
    $cnomZone=$data['nomZone'];
    $cnomInsp=$data['nomInsp'];
?>