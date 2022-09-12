<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/hopi.php';

    $count=new Hopi();
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans l'<?=$cnomHopital;?>&nbsp;Et sous la supervision de la <?=$cnomZone;?> </strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Tableau de Bord de l'Hôpital de Santé/Service Accoucheuse !</h4>
    <hr>
    <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;&nbsp;Code d'Hôpital de Santé</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$ccodeHopital;?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-success">
                <div class="card-header"><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?=$count->totalCountsNouveaune($cid);?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-baby"></i><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Fiche Nouveau-né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$count->totalCountsFNouveaune($cid);?>
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