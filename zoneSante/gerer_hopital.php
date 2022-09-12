<?php
    require_once '../assets/php/headerZone.php';

    //Création code hôpital de santé
    $mois = (int)(date("m"));
    $sec1 = date("s");
    $sec2 = (int)(date("s"));
    $code1 = +$sec2 +$mois+ $sec1;
    $code2 = $code1 + $sec2 + $mois;  
    $hopi="H";
    $codeHopital=$hopi.$code1.$code2 ;
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans la <?=$cnomZone;?>&nbsp;Et de l'<?=$cnomInsp;?> </strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Créer vos hôpitaux de santé pour les voir prochainnement !</h4>
    <hr>
    <div class="card border-secondary mt-2">
            <h5 class="card-header bg-secondary d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;Tous les hôpitaux sous Supervision</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addHopitalModal"><i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;Ajouter Hôpital Santé</a>    
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherHopitaux">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout Hôpital de santé -->
<div class="modal fade" id="addHopitalModal">
    <div class="modal-dialog modal-dialog-justify">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-plus-square"></i>&nbsp;Ajouter Hôpital Santé</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-hopital-form" class="px-3">
                <div id="zoneLoginAlert"></div>
            <div class="form-group">
                <input type="hidden" name="codeHopital" id="codeHopital" value="<?php echo $codeHopital;?>">
                <input type="text" name="nomHopital" id="nomHopital" class="form-control form-control-lg" placeholder="Entrer nom Hôpital de santé" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="loginHopital" id="loginHopital" class="form-control form-control-lg" placeholder="Entrer login Hôpital de Santé" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Entrer mot de passe Hôpital de Santé" required>
            </div>
            <div class="form-group">
                <input type="submit" name="addHopitalSante" class="btn btn-secondary btn-block btn-lg" id="addHopitalBtn" value="Ajouter Hôpital Santé" >
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout hôpital de santé-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
       
        //Ajouter Hôpital de Santé Ajax Request
        $("#addHopitalBtn").click(function(e){
            if($("#add-hopital-form")[0].checkValidity()){
                e.preventDefault();
                $("#addHopitalBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/zone-process.php',
                    method:'post',
                    data:$("#add-hopital-form").serialize()+'&action=add_hopital',
                    success:function(response){
                      if(response==='add_hopital'){
                            $("#addHopitalBtn").val('Ajouter Hôpital Santé');
                            $("#add-hopital-form")[0].reset();
                            $("#addHopitalModal").modal('hide');
                            Swal.fire({
                                title:'Hôpital de Santé ajouté avec succès !',
                                type:'success'
                            });
                      }
                      else{
                          $("#zoneLoginAlert").html(response);
                      }
                            $("#addHopitalBtn").val('Ajouter Hôpital Santé');
                            $("#add-hopital-form")[0].reset();
                            $("#addHopitalModal").modal('hide');
                            Swal.fire({
                                title:'Hôpital de Santé ajouté avec succès !',
                                type:'success'
                            });
                            fetchAllHopitalSante();
                    }
                });
            }
        });

        //Delete Hôpital de santé
        $("body").on("click", ".deleteHopitalIcon", function(e){
            e.preventDefault();

            del_hopi_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/zone-process.php',
                            method:'post',
                            data:{del_hopi_id:del_hopi_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Hôpital de santé !',
                                    'Hôpital de Santé supprimé avec succès.',
                                    'success'
                                )
                                fetchAllHopitalSante();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All Hôpitaux de santé Ajax Request
        fetchAllHopitalSante();

        function fetchAllHopitalSante(){
            $.ajax({
                url:'../assets/php/zone-process.php',
                method: 'post',
                data:{action: 'fetchAllHopitalSante'},
                success:function(response){
                    $("#afficherHopitaux").html(response);
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