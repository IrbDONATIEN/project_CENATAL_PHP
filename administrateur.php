<?php
    require_once 'assets/php/headerindex.php';

    //Nombre de visiteur
    include_once 'assets/php/config.php';
    $db=new Database();
    $sql="UPDATE visitors SET hits=hits+1 WHERE id=0";
    $stmt=$db->conn->prepare($sql);
    $stmt->execute();
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo" style="width: 200px;height: 100px;">
                <img src="assets/images/logo1.png" style="width: 100%;height: 100%;object-fit: scale-down;position: relative;left: 20%;">
              </div>
              <center><h4 style="color: #31A3DD;">Centralisation Données Natalité</h4></center>
              <hr>
              <div class="card-header bg-secondary">
                <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;CENATAL|Admin</h3>
              </div>
              <form class="pt-3" action="#" method="post" id="admin-login-form">
                <div id="adminLoginAlert"></div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="loginAdmin" name="loginAdmin" placeholder="Votre login" autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Votre mot de passe">
                </div>
                <div class="form-group">
                    <input type="submit" name="valider" class="btn btn-secondary btn-block btn-lg" value="Se connecter" id="adminLoginBtn" required>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
    require_once 'assets/php/footer.php';
?>
 <script type="text/javascript">
     $(document).ready(function(){
        $("#adminLoginBtn").click(function(e){
          if($("#admin-login-form")[0].checkValidity()){
              e.preventDefault();
              
              $(this).val('Veuillez patientier...');
              $.ajax({
                  url : 'assets/php/action.php',
                  method : 'post',
                  data : $("#admin-login-form").serialize()+'&action=adminLogin',
                  success:function(response){
                      if(response === 'admin_login'){
                          window.location = 'admin/service_national.php';
                      }
                      else{
                          $("#adminLoginAlert").html(response);
                      }
                      window.location = 'admin/service_national.php';
                      $("#adminLoginBtn").val('Se connecter');
                  }
              });
          }  
        });
     });
 </script>
</body>
</html>