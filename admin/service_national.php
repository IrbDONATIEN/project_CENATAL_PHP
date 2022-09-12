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
    <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;&nbsp;Total Inspection</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('inspection');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Total Zone de Santé</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('zone_sante');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;&nbsp;Total Hôpital</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?= $count->totalCount('hopital');?>
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
<div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-dark">
                <div class="card-header"><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Nouveau-Né</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('nouveau_ne');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-success">
                <div class="card-header"><i class="fa fa-baby"></i><i class="fa fa-baby"></i>&nbsp;&nbsp;Total Fiche</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?= $count->totalCount('fiche');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-danger">
                <div class="card-header"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Total Visite</div>
                    <div class="card-body">
                        <h1 class="display-4">
                           <?php  $data=$count->site_hits(); echo $data['hits'];?>
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