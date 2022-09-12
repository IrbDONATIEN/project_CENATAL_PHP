<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/connexion.php';
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
            <span class="text-light lead align-self-center"><i class="fa fa-baby"></i><i class="fa fa-baby"></i>&nbsp;Toutes les Fiches Nouveau-nés</span>
              <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addFicheModal"><i class="fa fa-baby"></i><i class="fa fa-baby"></i>&nbsp;Ajouter Fiche Nouveau-né</a>    
            </h5>
        <div class="card-body">
        <div class="table-responsive" id="afficherFiches">
            <p class="text-center lead mt-5">Veuillez patienter...</p>
        </div>
    </div>
</div>
<!--Début d'Ajout fiche nouveau-né -->
<div class="modal fade" id="addFicheModal">
    <div class="modal-dialog modal-dialog-justify">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title text-light"><i class="fa fa-baby"></i><i class="fa fa-baby"></i>&nbsp;Ajouter Fiche Nouveau-né</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-fiche-form" class="px-3">
            <div class="form-group">
                <label for="poids">Entrer poids nouveau-né:</label>
                <input type="decimal" name="poids" id="poids" class="form-control form-control-lg" required autofocus>
            </div>
            <div class="form-group">
                <label for="etat">Séléctionner état nouveau-né:</label>
                <select name="etat" id="etat" class="form-control form-control-lg">
                    <option value="" disabled>Séléctionner état nouveau-né</option>
                    <option value="Vivant" required>Vivant</option>
                    <option value="Mort" required>Mort</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="lieuNais" id="lieuNais" class="form-control form-control-lg" placeholder="Entrer lieu naissance nouveau-né" required>
            </div>
            <div class="form-group">
                <label for="dateNais">Séléctionner Date naissance Nouveau-né:</label>
                <input type="date" name="dateNais" id="dateNais" class="form-control form-control-lg" required>
            </div>
            <div class="form-group">
                <label for="heureNais">Séléctionner Heure naissance Nouveau-né:</label>
                <input type="time" name="heureNais" id="heureNais" class="form-control form-control-lg" placeholder="Entrer lieu naissance nouveau-né" required>
            </div>
            <div class="form-group">
                <label for="etatYeux">Séléctionner état yeux nouveau-né:</label>
                <select name="etatYeux" id="etatYeux" class="form-control form-control-lg">
                    <option value="" disabled>Séléctionner état Yeux nouveau-né</option>
                    <option value="Normal" required>Normal</option>
                    <option value="Pas Normal" required>Pas Normal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="omblic">Séléctionner Ombilic nouveau-né:</label>
                <select name="omblic" id="omblic" class="form-control form-control-lg">
                    <option value="" disabled>Séléctionner état Yeux nouveau-né</option>
                    <option value="Oui" required>Oui</option>
                    <option value="Non" required>Non</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="observation" id="observation" placeholder="Votre observation ici...." cols="4" rows="4" class="form-control form-control-lg" required></textarea>
            </div>
            <div class="form-group">
                <label for="id_nouveaune">Séléctionner Nom Nouveau-né:</label>
                <select name="id_nouveaune" id="id_nouveaune" class="form-control form-control-lg" required>
                    <?php $req=$db->query("SELECT * FROM nouveau_ne WHERE active=0 AND id_hopital='".$cid."'");
                        while ($tab=$req->fetch()){?>
                            <option value="<?php echo $tab['id'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="addFiche" class="btn btn-secondary btn-block btn-lg" id="addFicheBtn" value="Ajouter Fiche Nouveau-né" >
            </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout fiche nouveau-né-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
       
        //Ajouter Fiche Nouveau-né Ajax Request
        $("#addFicheBtn").click(function(e){
            if($("#add-fiche-form")[0].checkValidity()){
                e.preventDefault();
                $("#addFicheBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/hopi-process.php',
                    method:'post',
                    data:$("#add-fiche-form").serialize()+'&action=add_fiche',
                    success:function(response){
                        $("#addFicheBtn").val('Ajouter Fiche Nouveau-né');
                        $("#add-fiche-form")[0].reset();
                        $("#addFicheModal").modal('hide');
                        Swal.fire({
                                title:'Fiche Nouveau-né ajoutée avec succès !',
                                type:'success'
                        });
                        fetchAllFicheNouveaunes();
                    }
                });
            }
        });

        //Delete Nouveau-né 
        $("body").on("click", ".deleteFicheIcon", function(e){
            e.preventDefault();

            del_fiche_id=$(this).attr('id');

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
                            url:'../assets/php/hopi-process.php',
                            method:'post',
                            data:{del_fiche_id:del_fiche_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Fiche Nouveau-né !',
                                    'Fiche Nouveau-né supprimée avec succès.',
                                    'success'
                                )
                                fetchAllFicheNouveaunes();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All Fiches Nouveau-nés  Ajax Request
        fetchAllFicheNouveaunes();

        function fetchAllFicheNouveaunes(){
            $.ajax({
                url:'../assets/php/hopi-process.php',
                method: 'post',
                data:{action: 'fetchAllFicheNouveaunes'},
                success:function(response){
                    $("#afficherFiches").html(response);
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