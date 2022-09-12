<?php
    require_once '../assets/php/header.php';
?>
<div class="container">
    <div class="alert alert-secondary alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans l'<?=$cnomHopital;?>&nbsp;Et sous la supervision de la <?=$cnomZone;?> </strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-2">Tableau de Bord de l'Hôpital de Santé/Service Accoucheuse !</h4>
    <hr>
    <div class="card border-secondary mt-2">
            <h5 class="card-header bg-secondary d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-baby"></i>&nbsp;Tous les Nouveau-nés</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNouveauneModal"><i class="fa fa-baby"></i>&nbsp;Ajouter Nouveau-né</a>    
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherNouveaunes">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout nouveau-né -->
<div class="modal fade" id="addNouveauneModal">
    <div class="modal-dialog modal-dialog-justify">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-baby"></i>&nbsp;Ajouter Nouveau-né</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-nouveaune-form" class="px-3">
            <div class="form-group">
                <input type="hidden" name="service" id="service" value="Service Accoucheuse">
                <input type="text" name="nom" id="nom" class="form-control form-control-lg" placeholder="Entrer nom nouveau-né" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" name="prenom" id="prenom" class="form-control form-control-lg" placeholder="Entrer prénom nouveau-né" required>
            </div>
            <div class="form-group">
                <label for="sexe">Séléctionner Sexe :</label>
                <select name="sexe" id="sexe" class="form-control form-control-lg">
                    <option value="" disabled>Séléctionner Sexe</option>
                    <option value="Masculin" required>Masculin</option>
                    <option value="Feminin" required>Féminin</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="addNouveaune" class="btn btn-secondary btn-block btn-lg" id="addNouveauneBtn" value="Ajouter Nouveau-né" >
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout nouveau-né-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
       
        //Ajouter Nouveau-né Ajax Request
        $("#addNouveauneBtn").click(function(e){
            if($("#add-nouveaune-form")[0].checkValidity()){
                e.preventDefault();
                $("#addNouveauneBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/hopi-process.php',
                    method:'post',
                    data:$("#add-nouveaune-form").serialize()+'&action=add_nouveaune',
                    success:function(response){
                        $("#addNouveauneBtn").val('Ajouter Nouveau-né');
                        $("#add-nouveaune-form")[0].reset();
                        $("#addNouveauneModal").modal('hide');
                        Swal.fire({
                                title:'Nouveau-né ajouté avec succès !',
                                type:'success'
                        });
                        fetchAllNouveaunes();
                    }
                });
            }
        });

        //Delete Nouveau-né 
        $("body").on("click", ".deleteNouveauneIcon", function(e){
            e.preventDefault();

            del_nouveaune_id=$(this).attr('id');

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
                            url:'../assets/php/hopi-process.php',
                            method:'post',
                            data:{del_nouveaune_id:del_nouveaune_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Nouveau-né !',
                                    'Nouveau-né supprimé avec succès.',
                                    'success'
                                )
                                fetchAllNouveaunes();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All Nouveau-nés  Ajax Request
        fetchAllNouveaunes();

        function fetchAllNouveaunes(){
            $.ajax({
                url:'../assets/php/hopi-process.php',
                method: 'post',
                data:{action: 'fetchAllNouveaunes'},
                success:function(response){
                    $("#afficherNouveaunes").html(response);
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