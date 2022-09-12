<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Ir Donatien">
        <meta http-equiv="x-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
        <title>CENATAL|<?=ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <style type="text/css">
            html,body{
                height:100%;
            }
            
            /*FOOTER*/
            .footer{
            background:#303022;
            color:#d3d3d3;
            height: 70px;
            position: relative;
            }

             /* Make the image fully responsive */
            .carousel-inner {
                width: 100%;
                height: 100%;
            }
            .footer .footer-botton{
            background:#343a40;
            color:#686868;
            height: 70px;
            width: 100%;
            border:1px solid red;
            text-align:center;
            position:absolute;
            bottom:0px;
            left: 0px;
            padding-top:20px;
            }
        </style>
        <link rel="shortcut icon" href="assets/images/logo.png" />
    </head>
    <body class="bg-white">

    <nav class="navbar navbar-expand-md bg-secondary navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><img src="assets/images/logo1.png" style="width: 20%;height: 20%;" class="rounded-circle" >&nbsp;<strong>CENATAL</strong></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="index.php")?"active":"";?>" href="index.php"><i class="fa fa-home"></i>&nbsp;Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="apropos.php")?"active":"";?>" href="apropos.php"><i class="fa fa-comment"></i>&nbsp;Apropos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-cog"></i>&nbsp;Administration
                    </a>
                    <div class="dropdown-menu">
                        <a href="utilisateur.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="utilisateur.php")?"active":"";?>"><i class="fas fa-user"></i>&nbsp;Inspection</a>
                        <a href="utilisateur_zone.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="utilisateur_zone.php")?"active":"";?>"><i class="fas fa-user"></i>&nbsp;Zone de Santé</a>
                        <a href="utilisateur_hopital.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="utilisateur_hopital.php")?"active":"";?>"><i class="fas fa-user"></i>&nbsp;Hôpital</a>
                        <a href="administrateur.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="administrateur.php")?"active":"";?>"><i class="fas fa-user-cog"></i>&nbsp;Administrateur</a>
                    </div>
                </li>
                </ul>
            </div> 
        </nav>