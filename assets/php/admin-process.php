<?php

    require_once 'sessionAdmin.php';

    //Gérer la requête d'ajout inspection avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='add_inspection'){
        $codeMat=$cadmin->test_input($_POST['codeMat']);
        $nomInsp=$cadmin->test_input($_POST['nomInsp']);
        $loginInsp=$cadmin->test_input($_POST['loginInsp']);
        $password=$cadmin->test_input($_POST['password']);
        $id_province=$cadmin->test_input($_POST['id_province']);

        //Vérifier si l'inspection saisie existe déjà dans la base de données
        if($cadmin->inspection_existe($nomInsp)){
            echo $cadmin->showMessage('warning', 'Cette Inspection est déjà enregistrée!');
        }else{
            if($cadmin->add_Inspection($codeMat,$nomInsp,$loginInsp,$password,$id_province)){
            }else{
                echo $cadmin->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

    //Gérer la requête Fetch All Provinces Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllInspections'){
        $output='';
        $inspection=$cadmin->fetchAllInspections();

        if($inspection){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inspection</th>
                            <th>Province</th>
                            <th>Login</th>
                            <th>Mot de passe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($inspection as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['nomInsp'].'</td>
                                        <td>'.$row['provinces'].'</td>
                                        <td>'.$row['loginInsp'].'</td>
                                        <td>'.$row['password'].'</td>
                                        <td>
                                            
                                            <a href="#" id="'.$row['id'].'" title="Voir détail Inspection" class="text-success infoInspectionBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;</a>

                                            <a href="#" id="'.$row['id'].'" title="Editer Inspection" class="text-primary editerInspectionIcon" data-toggle="modal" data-target="#editInspectionModal" ><i class="fas fa-edit fa-lg"></i></a>&nbsp;

                                            <a href="#" id="'.$row['id'].'" title="Supprimer Inspection" class="text-danger deleteInspectionIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore d\'inspection créée !</h3>';
        }
    }

    //Gérer la requête Fetch All Rapports par province Ajax
    if(isset($_POST['action']) && $_POST['action']=='fetchAllRapports'){
        $output='';
        $rapports=$cadmin->fetchAllRapports();

        if($rapports){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Inspection</th>
                            <th>Inspection</th>
                            <th>Province</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($rapports as $row){
                        $output .='<tr>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['codeMat'].'</td>
                                        <td>'.$row['nomInsp'].'</td>
                                        <td>'.$row['provinces'].'</td>
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

    //Gérer la suppression d'une inspection en  Ajax Request
    if(isset($_POST['del_inspection_id'])){
        $id=$_POST['del_inspection_id'];
        $cadmin->deleteInspection($id);
    }
    

?>