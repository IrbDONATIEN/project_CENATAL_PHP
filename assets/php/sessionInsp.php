<?php
session_start();
require_once 'insp.php';
$cInsp=new Insp();

//Session Admin
if(!isset($_SESSION['loginInsp'])){
    header('location:../index.php');
    die;
}
    $clogin=$_SESSION['loginInsp'];

    $data=$cInsp->currentInsp($clogin);

    $cid=$data['id'];
    $cnomInsp=$data['nomInsp'];
    $ccodeMat=$data['codeMat'];
?>