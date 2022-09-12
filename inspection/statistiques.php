<?php
    require_once '../assets/php/headerInsp.php';
    require_once '../assets/php/insp.php';

    $count=new Insp();
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) à l'<?=$cnomInsp;?></strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Voir les statistiques d'enregistrements des nouveau-nés!</h4>
    <hr>
    <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-warning">
                <div class="card-header"><i class="fa fa-male"></i>&nbsp;&nbsp;Total Masculin Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?=$count->totalCountsMMNouveaune($cid);?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-female"></i>&nbsp;&nbsp;Total Féminin Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$count->totalCountsFFNouveaune($cid);?>
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
                             <?=$count->totalCountsVivantNouveaune($cid);?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Mort Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$count->totalCountsMortNouveaune($cid);?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 1-->
</div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>