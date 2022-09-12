<?php

    require_once 'sessionZone.php';

    //Gérer la requête d'ajout de l'hôpital de santé avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='add_hopital'){
        $codeHopital=$cZone->test_input($_POST['codeHopital']);
        $nomHopital=$cZone->test_input($_POST['nomHopital']);
        $loginHopital=$cZone->test_input($_POST['loginHopital']);
        $password=$cZone->test_input($_POST['password']);

        //Vérifier si l'hôpital de santé saisie existe déjà dans la base de données
        if($cZone->hopital_exist($nomHopital,$loginHopital)){
            echo $cZone->showMessage('warning', 'Cet hôpital de santé et login de l\'hôpital de santé est déjà enregistré!');
        }else{
            if($cZone->add_hopital($codeHopital,$nomHopital,$loginHopital,$password,$cid)){
            }else{
                echo $cZone->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

    //Gérer la requête Fetch All Hôpitaux de santé Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllHopitalSante'){
        $output='';
        $hopitaux=$cZone->fetchAllHopitaux($cid);

        if($hopitaux){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Hôpital</th>
                            <th>Hôpital de Santé</th>
                            <th>Login</th>
                            <th>Mot de passe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($hopitaux as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['codeHopital'].'</td>
                                        <td>'.$row['nomHopital'].'</td>
                                        <td>'.$row['loginHopital'].'</td>
                                        <td>'.$row['password'].'</td>
                                        <td>
                                            
                                            <a href="#" id="'.$row['id'].'" title="Voir détail Hôpital de Santé" class="text-success infoHopitalBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;</a>

                                            <a href="#" id="'.$row['id'].'" title="Editer Hôpital de Santé " class="text-primary editerHopitalIcon" data-toggle="modal" data-target="#editHopitalModal" ><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['id'].'" title="Supprimer Hôpital de Santé" class="text-danger deleteHopitalIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:(Pas encore d\'hôpitaux de Santé crééent pour cette zone de santé!</h3>';
        }
    }

    //Gérer la suppression d'un hôpital de santé en  Ajax Request
    if(isset($_POST['del_hopi_id'])){
        $id=$_POST['del_hopi_id'];
        $cZone->deleteHopital($id);
    }
    
    //Gérer la requête Fetch All Rapports par zone de santé Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllRapports'){
        $output='';
        $rapports=$cZone->fetchAllRapports($cid);

        if($rapports){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Hôpital</th>
                            <th>Hôpital</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($rapports as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['codeHopital'].'</td>
                                        <td>'.$row['nomHopital'].'</td>
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