<?php
   require_once '../assets/php/headerInsp.php';

    //Création code zone de santé
    $mois = (int)(date("m"));
    $sec1 = date("s");
    $sec2 = (int)(date("s"));
    $code1 = +$sec2 +$mois+ $sec1;
    $code2 = $code1 + $sec2 + $mois;  
    $zoness="Z";
    $codeZone=$code1.$zoness.$code2 ;
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) à l'<?=$cnomInsp;?></strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Créer vos zones de santé pour les voir prochainnement !</h4>
    <hr>
    <div class="card border-secondary mt-2">
            <h5 class="card-header bg-secondary d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-plus-square"></i>&nbsp;Toutes les zones de santé</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addZoneSanteModal"><i class="fa fa-plus-square"></i>&nbsp;Ajouter Zone de Santé</a>    
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherZones">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>

<!--Début d'Ajout Zone de santé -->
<div class="modal fade" id="addZoneSanteModal">
    <div class="modal-dialog modal-dialog-justify">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-plus-square"></i>&nbsp;Ajouter Zone Santé</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-zonesante-form" class="px-3">
                <div id="inspLoginAlert"></div>
            <div class="form-group">
                <input type="hidden" name="codeZone" id="codeZone" value="<?php echo $codeZone;?>">
                <input type="text" name="nomZone" id="nomZone" class="form-control form-control-lg" placeholder="Entrer nom Zone de santé" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="loginZone" id="loginZone" class="form-control form-control-lg" placeholder="Entrer login Zone de Santé" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Entrer mot de passe Zone de Santé" required>
            </div>
            <div class="form-group">
                <input type="submit" name="addZoneSante" class="btn btn-secondary btn-block btn-lg" id="addZoneSanteBtn" value="Ajouter Zone Santé" >
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout zone de santé-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
       
        //Ajouter Zone de Santé Ajax Request
        $("#addZoneSanteBtn").click(function(e){
            if($("#add-zonesante-form")[0].checkValidity()){
                e.preventDefault();
                $("#addZoneSanteBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/insp-process.php',
                    method:'post',
                    data:$("#add-zonesante-form").serialize()+'&action=add_zone',
                    success:function(response){
                      if(response==='add_inspections'){
                            $("#addZoneSanteBtn").val('Ajouter Zone Santé');
                            $("#add-zonesante-form")[0].reset();
                            $("#addZoneSanteModal").modal('hide');
                            Swal.fire({
                                title:'Zone de Santé ajoutée avec succès !',
                                type:'success'
                            });
                      }
                      else{
                          $("#inspLoginAlert").html(response);
                      }
                            $("#addZoneSanteBtn").val('Ajouter Zone Santé');
                            $("#add-zonesante-form")[0].reset();
                            $("#addZoneSanteModal").modal('hide');
                            Swal.fire({
                                title:'Zone de Santé ajoutée avec succès !',
                                type:'success'
                            });
                            fetchAllZoneSante();
                    }
                });
            }
        });

        //Delete Zone de santé
        $("body").on("click", ".deleteZoneIcon", function(e){
            e.preventDefault();

            del_zone_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-la!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/insp-process.php',
                            method:'post',
                            data:{del_zone_id:del_zone_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Zone de santé !',
                                    'Zone de Santé supprimée avec succès.',
                                    'success'
                                )
                                fetchAllZoneSante();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All Zones de santé Ajax Request
        fetchAllZoneSante();

        function fetchAllZoneSante(){
            $.ajax({
                url:'../assets/php/insp-process.php',
                method: 'post',
                data:{action: 'fetchAllZoneSante'},
                success:function(response){
                    $("#afficherZones").html(response);
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