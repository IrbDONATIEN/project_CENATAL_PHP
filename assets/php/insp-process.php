<?php

    require_once 'sessionInsp.php';

    //Gérer la requête d'ajout de la zone de santé avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='add_zone'){
        $codeZone=$cInsp->test_input($_POST['codeZone']);
        $nomZone=$cInsp->test_input($_POST['nomZone']);
        $loginZone=$cInsp->test_input($_POST['loginZone']);
        $password=$cInsp->test_input($_POST['password']);
       
        //Vérifier si la zone de santé saisie existe déjà dans la base de données
        if($cInsp->zone_sante_existe($nomZone,$loginZone)){
            echo $cInsp->showMessage('warning', 'Cette zone de santé et le login zone de santé est déjà enregistrée!');
        }else{
            if($cInsp->add_zone_sante($codeZone,$nomZone,$loginZone,$password,$cid)){
            }else{
                echo $cInsp->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

    //Gérer la requête Fetch All Zones de santé Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllZoneSante'){
        $output='';
        $zones=$cInsp->fetchAllZonesSante($cid);

        if($zones){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Zone</th>
                            <th>Zone de Santé</th>
                            <th>Login</th>
                            <th>Mot de passe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($zones as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['codeZone'].'</td>
                                        <td>'.$row['nomZone'].'</td>
                                        <td>'.$row['loginZone'].'</td>
                                        <td>'.$row['password'].'</td>
                                        <td>
                                            
                                            <a href="#" id="'.$row['id'].'" title="Voir détail Zone de Santé" class="text-success infoZoneBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;</a>

                                            <a href="#" id="'.$row['id'].'" title="Editer Zone de Santé " class="text-primary editerZoneIcon" data-toggle="modal" data-target="#editZoneModal" ><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['id'].'" title="Supprimer Zone de Santé" class="text-danger deleteZoneIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:(Pas encore de Zone de Santé créée pour cette inspection !</h3>';
        }
    }

    //Gérer la suppression d'une zone de santé en  Ajax Request
    if(isset($_POST['del_zone_id'])){
        $id=$_POST['del_zone_id'];
        $cInsp->deleteZoneSante($id);
    }
    

    //Gérer la requête Fetch All Rapports par inspection Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllRapports'){
        $output='';
        $rapports=$cInsp->fetchAllRapports($cid);

        if($rapports){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Zone de santé</th>
                            <th>Zone de santé </th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($rapports as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['codeZone'].'</td>
                                        <td>'.$row['nomZone'].'</td>
                                        <td>'.$row['qte'].'</td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des rapports crééent !</h3>';
        }
    }


?>