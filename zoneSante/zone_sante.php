<?php
    require_once '../assets/php/headerZone.php';
    require_once '../assets/php/zone.php';

    $count=new Zone();
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans la <?=$cnomZone;?>&nbsp;Et de l'<?=$cnomInsp;?> </strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Tableau de Bord de Zone de Santé !</h4>
    <hr>
    <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Code Zone de Santé</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?=$ccodeZone;?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;&nbsp;Total Hôpital</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?= $count->totalCountsHopitaux($cid);?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-warning">
                <div class="card-header"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Total Rapport</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('rapports');?>
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