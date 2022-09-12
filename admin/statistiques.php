<?php
    require_once '../assets/php/headerAdmin.php';
    require_once '../assets/php/auth.php';

    $count=new Auth();
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) au <?=$cservice;?></strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Voir les statistiques d'enregistrements des nouveau-nés RDC!</h4>
    <hr>
    <div class="card border-warning mt-2">
            <h5 class="card-header bg-warning d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fas fa-chart-pie"></i>&nbsp;Toutes les statistiques des données de natalité</span>
            </h5>
        <div class="card-body">
        <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-warning">
                <div class="card-header"><i class="fa fa-male"></i>&nbsp;&nbsp;Total Masculin Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?=$count->totalCountsMMNouveaune();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-female"></i>&nbsp;&nbsp;Total Féminin Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$count->totalCountsFFNouveaune();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 1-->
<div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Vivant Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?=$count->totalCountsVivantNouveaune();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Mort Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$count->totalCountsMortNouveaune();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 1-->
    </div>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>