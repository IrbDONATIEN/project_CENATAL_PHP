<?php
    session_start();
    require_once 'assets/php/headerindex.php';
    if(isset($_SESSION['loginAdmin'])){
        header('location:admin/service_national.php');
    }
    if(isset($_SESSION['loginInsp'])){
        header('location:inspection/inspection.php');
    }
    if(isset($_SESSION['loginZone'])){
        header('location:zoneSante/zone_sante.php');
    }
    if(isset($_SESSION['user'])){
        header('location:hopital/hopital_sante.php');
    }
    
    //Nombre de visiteur
    include_once 'assets/php/config.php';
    $db=new Database();
    $sql="UPDATE visitors SET hits=hits+1 WHERE id=0";
    $stmt=$db->conn->prepare($sql);
    $stmt->execute();
?>

<div class="container mt-3">
    <div class="text-center mt-3 m-0 bg-secondary rounded">
         <hr>
         <h2><strong style="color:white;">Bienvenu(e) dans notre Système de Centralisation nommé CENATAL !</strong></h2>
         <hr>
    </div>
    <div id="myCarousel" class="carousel slide mt-2" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                   <img src="assets/images/logo1.png" alt="Logo 1" width="1100" height="550">
                </div>
                <div class="carousel-item">
                   <img src="assets/images/imag.jpeg" alt="Logo 2" width="1100" height="550">
                </div>
                <div class="carousel-item">
                   <img src="assets/images/images.jpeg" alt="Logo 3" width="1100" height="550">
                </div>
                <div class="carousel-item">
                   <img src="assets/images/07.jpg" alt="Logo 4" width="1100" height="550">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
<div>

<?php
    require_once 'assets/php/footer.php';
?>
</body>
</html>