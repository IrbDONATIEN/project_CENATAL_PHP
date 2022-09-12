<?php
session_start();
require_once 'hopi.php';
$cuser=new Hopi();

//Session Hôpital
if(!isset($_SESSION['user'])){
    header('location:../index.php');
    die;
}
    $clogin=$_SESSION['user'];
    
    $data=$cuser->currentHopi($clogin);
    
    $cid=$data['id'];
    $ccodeHopital=$data['codeHopital'];
    $cnomHopital=$data['nomHopital'];
    $cnomZone=$data['nomZone'];
    
?>