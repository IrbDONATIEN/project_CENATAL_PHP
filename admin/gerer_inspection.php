<?php
    require_once '../assets/php/headerAdmin.php';
    require_once '../assets/php/connexion.php';
    
    //Création code inspection de santé
    $mois = (int)(date("m"));
    $sec1 = date("s");
    $sec2 = (int)(date("s"));
    $code1 = +$sec2 +$mois+ $sec1;
    $code2 = $code1 + $sec2 + $mois;  
    $codeMat= $code1.'-'.$code2 ;
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) au <?=$cservice;?></strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Créer  vos inspections de santé pour les superviser !</h4>
    <hr>
    <div class="card border-info mt-2">
            <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Toutes les Inspections de Santé</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addInspectionModal"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Ajouter Inspection Santé</a>
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherInspections">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>


<!--Début d'Ajout Inspection -->
<div class="modal fade" id="addInspectionModal">
    <div class="modal-dialog modal-dialog-justify">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fas fa-university"></i>&nbsp;Ajouter Inspection Santé</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-inspection-form" class="px-3">
                <div id="adminLoginAlert"></div>
            <div class="form-group">
                <input type="hidden" name="codeMat" id="codeMat" value="<?php echo $codeMat;?>">
                <input type="text" name="nomInsp" id="nomInsp" class="form-control form-control-lg" placeholder="Entrer nom inspection" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="loginInsp" id="loginInsp" class="form-control form-control-lg" placeholder="Entrer login Inspection" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Entrer mot de passe Inspection" required>
            </div>
            <div class="form-group">
                <label for="id_province">Sélectionner Province :</label>
                <select name="id_province" id="id_province" class="form-control form-control-lg" required>
                    <?php $req=$db->query("SELECT * FROM province");
                        while ($tab=$req->fetch()){?>
                             <option value="<?php echo $tab['id'];?>"><?php echo $tab['provinces'];?></option>
                        <?php
                           }
                        ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="addInspections" class="btn btn-secondary btn-block btn-lg" id="addInspectionBtn" value="Ajouter Inspection" >
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout Inspection-->

<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
       
        //Ajouter Inspection Ajax Request
        $("#addInspectionBtn").click(function(e){
            if($("#add-inspection-form")[0].checkValidity()){
                e.preventDefault();
                $("#addInspectionBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/admin-process.php',
                    method:'post',
                    data:$("#add-inspection-form").serialize()+'&action=add_inspection',
                    success:function(response){
                      if(response==='add_inspections'){
                            $("#add-inspection-form")[0].reset();
                            $("#addInspectionModal").modal('hide');
                            Swal.fire({
                                title:'Inspection ajoutée avec succès !',
                                type:'success'
                            });
                      }
                      else{
                          $("#adminLoginAlert").html(response);
                      }
                            $("#add-inspection-form")[0].reset();
                            $("#addInspectionModal").modal('hide');
                            Swal.fire({
                                title:'Inspection ajoutée avec succès !',
                                type:'success'
                            });
                            $("#addInspectionBtn").val('Ajouter Inspection');
                            fetchAllInspections();
                    }
                });
            }
        });

        //Delete Inspection de santé
        $("body").on("click", ".deleteInspectionIcon", function(e){
            e.preventDefault();

            del_inspection_id=$(this).attr('id');

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
                            url:'../assets/php/admin-process.php',
                            method:'post',
                            data:{del_inspection_id:del_inspection_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Inspection de santé !',
                                    'Inspection supprimée avec succès.',
                                    'success'
                                )
                                fetchAllInspections();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All Inspections Ajax Request
        fetchAllInspections();

        function fetchAllInspections(){
            $.ajax({
                url:'../assets/php/admin-process.php',
                method: 'post',
                data:{action: 'fetchAllInspections'},
                success:function(response){
                    $("#afficherInspections").html(response);
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