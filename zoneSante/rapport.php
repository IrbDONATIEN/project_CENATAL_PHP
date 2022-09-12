<?php
    require_once '../assets/php/headerZone.php';
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans la <?=$cnomZone;?>&nbsp;Et de l'<?=$cnomInsp;?> </strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Voir les rapports d'enregistrements des nouveau-nés!</h4>
    <hr>
    <div class="card border-primary mt-2">
            <h5 class="card-header bg-primary d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Tous les rapports des données de natalité</span>
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherRapports">
        <p class="text-center lead mt-5">Veuillez patienter...</p>
    </div>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Fetch All Rapports Ajax Request
        fetchAllRapports();

        function fetchAllRapports(){
            $.ajax({
                url:'../assets/php/zone-process.php',
                method: 'post',
                data:{action: 'fetchAllRapports'},
                success:function(response){
                    $("#afficherRapports").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }
    });
</script>
</body>
</html>