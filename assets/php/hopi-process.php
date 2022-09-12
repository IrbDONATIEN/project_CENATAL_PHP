<?php

    require_once 'session.php';

    //Gérer la requête d'ajout nouveau-né avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='add_nouveaune'){
        $nom=$cuser->test_input($_POST['nom']);
        $prenom=$cuser->test_input($_POST['prenom']);
        $sexe=$cuser->test_input($_POST['sexe']);
        $service=$cuser->test_input($_POST['service']);

        $cuser->add_nouveaune($nom,$prenom,$sexe,$service,$cid);
        
    }

    //Gérer la requête Fetch All Nouveau-nés Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='fetchAllNouveaunes'){
        $output='';
        $nouveaune=$cuser->fetchAllNouveaunes($cid);

        if($nouveaune){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom NN</th>
                            <th>Prénom NN</th>
                            <th>Sexe</th>
                            <th>Service</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($nouveaune as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['sexe'].'</td>
                                        <td>'.$row['service'].'</td>
                                        <td>
                                            
                                            <a href="#" id="'.$row['id'].'" title="Voir détail Nouveau-né" class="text-success infoNouveauneBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;</a>

                                            <a href="#" id="'.$row['id'].'" title="Editer Nouveau-né" class="text-primary editerNouveauneIcon" data-toggle="modal" data-target="#editNouveauneModal" ><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['id'].'" title="Supprimer Nouveau-né" class="text-danger deleteNouveauneIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des nouveau-nés crééent pour cet hôpital !</h3>';
        }
    }

    //Gérer la suppression d'un nouveau-né en  Ajax Request
    if(isset($_POST['del_nouveaune_id'])){
        $id=$_POST['del_nouveaune_id'];
        $cuser->deleteNouveaune($id);
    }



    //Gérer la requête d'ajout fiche nouveau-né avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='add_fiche'){
        $poids=$cuser->test_input($_POST['poids']);
        $etat=$cuser->test_input($_POST['etat']);
        $lieuNais=$cuser->test_input($_POST['lieuNais']);
        $dateNais=$cuser->test_input($_POST['dateNais']);
        $heureNais=$cuser->test_input($_POST['heureNais']);
        $etatYeux=$cuser->test_input($_POST['etatYeux']);
        $omblic=$cuser->test_input($_POST['omblic']);
        $observation=$cuser->test_input($_POST['observation']);
        $id_nouveaune=$cuser->test_input($_POST['id_nouveaune']);

        $cuser->add_rapport($id_nouveaune,$cid);
        $cuser->update_NN($id_nouveaune);
        $cuser->add_fiche($poids,$etat,$lieuNais,$dateNais,$heureNais,$etatYeux,$omblic,$observation,$id_nouveaune,$cid);
        
    }

    //Gérer la requête Fetch All Fiches Nouveau-nés Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='fetchAllFicheNouveaunes'){
        $output='';
        $fnouveaune=$cuser->fetchAllFiches($cid);

        if($fnouveaune){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom NN</th>
                            <th>Prenom</th>
                            <th>Sexe</th>
                            <th>Date</th>
                            <th>Poids</th>
                            <th>Etat</th>
                            <th>Observation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($fnouveaune as $row){
                        $output .='<tr>
                                        <td>'.$row['code'].'</td>
                                        <td>'.$row['nom'].'</td>
                                        <td>'.$row['prenom'].'</td>
                                        <td>'.$row['sexe'].'</td>
                                        <td>'.$row['dateNais'].'</td>
                                        <td>'.$row['poids'].'</td>
                                        <td>'.$row['etat'].'</td>
                                        <td>'.$row['observation'].'</td>
                                        <td>
                                            
                                            <a href="#" id="'.$row['code'].'" title="Voir détail Fiche d\'Enregistrement Nouveau-né" class="text-success infoFicheBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;</a>

                                            <a href="#" id="'.$row['code'].'" title="Editer d\'Enregistrement Nouveau-né" class="text-primary editerFicheIcon" data-toggle="modal" data-target="#editFicheModal" ><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['code'].'" title="Supprimer d\'Enregistrement Nouveau-né" class="text-danger deleteFicheIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des fiches d\'enregistrements des nouveau-nés crééent pour cet hôpital !</h3>';
        }
    }

    //Gérer la suppression d'une fiche en  Ajax Request
    if(isset($_POST['del_fiche_id'])){
        $id=$_POST['del_fiche_id'];
        $cuser->deleteFiche($id);
    }
    
    //Gérer la requête Fetch All Rapports par zone de santé Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllRapports'){
        $output='';
        $rapports=$cuser->fetchAllRapports($cid);

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