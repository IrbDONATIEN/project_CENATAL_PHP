<?php
    session_start();
    require_once 'auth.php';
    require_once 'insp.php';
    require_once 'hopi.php';
    require_once 'zone.php';
    $admin=new Auth();
    $Insp=new Insp();
    $Zone=new Zone();
    $Hopi=new Hopi();

    //Gérer l'authentification de l'Admin Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='adminLogin'){
        $loginAdmin=$admin->test_input($_POST['loginAdmin']);
        $password=$admin->test_input($_POST['password']);

        $loggedInAdmin=$admin->admin_login($loginAdmin,$password);

        if($loggedInAdmin !=null){
            $_SESSION['loginAdmin']=$loginAdmin;
        }
        else{
            echo $admin->showMessage('danger', 'Login et Mot de passe admin est Incorrect!');
        }
    }


    //Gérer l'authentification de l'Inspection Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='login_Insp'){
        $loginInsp=$Insp->test_input($_POST['loginInsp']);
        $password=$Insp->test_input($_POST['password']);

        $loggedInInsp=$Insp->loginInsp($loginInsp,$password);

        if($loggedInInsp !=null){
            $_SESSION['loginInsp']=$loginInsp;
        }
        else{
            echo $Insp->showMessage('danger', 'Login et Mot de passe Inspection est Incorrect!');
        }
    }

    //Gérer l'authentification de la zone de santé Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='login_zone'){
        $loginZone=$Zone->test_input($_POST['loginZone']);
        $password=$Zone->test_input($_POST['password']);

        $loggedInZone=$Zone->loginZone($loginZone,$password);

        if($loggedInZone !=null){
            $_SESSION['loginZone']=$loginZone;
        }
        else{
            echo $Zone->showMessage('danger', 'Login et Mot de passe Zone de santé est Incorrect!');
        }
    }

    //Gérer l'authentification de l'hôpital de santé Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='login_hopi'){
        $loginHopital=$Hopi->test_input($_POST['loginHopital']);
        $password=$Hopi->test_input($_POST['password']);

        $loggedInHopi=$Hopi->loginHopi($loginHopital,$password);

        if($loggedInHopi !=null){
            $_SESSION['user']=$loginHopital;
        }
        else{
            echo $Hopi->showMessage('danger', 'Login et Mot de passe hôpital de santé est Incorrect!');
        }
    }

?>