<?php
    require_once 'assets/php/headerindex.php';
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
                <h3 class="m-0 text-white"><i class="fas fa-user"></i>&nbsp;CENATAL|Zone</h3>
              </div>
              <form class="pt-3" action="#" id="login-form" method="post">
                <div id="LoginAlert"></div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="loginZone" name="loginZone" placeholder="Votre login">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Votre mot de passe">
                </div>
                <div class="form-group">
                    <input type="submit" name="valider" class="btn btn-secondary btn-block btn-lg" value="Se connecter" id="LoginBtn" required>
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
        $("#LoginBtn").click(function(e){
          if($("#login-form")[0].checkValidity()){
              e.preventDefault();
              
              $(this).val('Veuillez patientier...');
              $.ajax({
                  url : 'assets/php/action.php',
                  method : 'post',
                  data : $("#login-form").serialize()+'&action=login_zone',
                  success:function(response){
                      if(response ==='login_zone'){
                          window.location = 'zoneSante/zone_sante.php';
                      }
                      else{
                          $("#LoginAlert").html(response);
                      }
                      window.location = 'zoneSante/zone_sante.php';
                      $("#LoginBtn").val('Se connecter');
                  }
              });
          }  
        });
     });
 </script>
</body>
</html>