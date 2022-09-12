<?php
     require_once 'config.php';
     class Auth extends Database{
        

        //Admin Login
        public function admin_login($loginAdmin, $password){
            $sql="SELECT login,password FROM service_national WHERE login=:loginAdmin AND password=:password";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginAdmin'=>$loginAdmin, 'password'=>$password]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'administrateur connecté
        public function currentAdmin($loginAdmin){
            $sql="SELECT id,nom,postnom,prenom,lieu,service,login,password FROM service_national WHERE login=:loginAdmin";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginAdmin'=>$loginAdmin]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Nombre des visites 
        public function site_hits(){
            $sql="SELECT hits FROM visitors";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->fetch(PDO::FETCH_ASSOC);
            return $count;
        }

         //Enregistrer une nouvelle inspection
         public function add_Inspection($codeMat,$nomInsp,$loginInsp,$password,$id_province){
            $sql="INSERT INTO inspection (codeMat,nomInsp,loginInsp,password,id_province) VALUES (:codeMat,:nomInsp,:loginInsp,:password,:id_province)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['codeMat'=>$codeMat,'nomInsp'=>$nomInsp,'loginInsp'=>$loginInsp,'password'=>$password,'id_province'=>$id_province]);
            return true;
        }

        //Vérifier si l'inspection existe déjà dans la base de données
        public function inspection_existe($nomInsp){
            $sql="SELECT nomInsp FROM inspection WHERE nomInsp=:nomInsp";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nomInsp'=>$nomInsp]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Afficher  inspection pour la république
        public function fetchAllInspections(){
            $sql="SELECT inspection.id,codeMat,nomInsp,loginInsp,password,date_creation,id_province,province.provinces FROM inspection INNER JOIN province ON province.id=inspection.id_province";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Affichage avant l'édition d'Inspection existante dans la base de données
        public function editerInspection($id){
            $sql="SELECT * FROM inspection WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Delete Inspection by Admin
        public function deleteInspection($id){
            $sql="DELETE FROM inspection WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Edition proprement dite de l'inspection
        public function update_inspection($id,$nomInsp,$loginInsp,$password,$id_province){
            $sql="UPDATE inspection SET nomInsp=:nomInsp,loginInsp=:loginInsp,password=:password,id_province=:id_province WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nomInsp'=>$nomInsp,'loginInsp'=>$loginInsp,'password'=>$password,'id_province'=>$id_province,'id'=>$id]);
            return true;
        }

        //Compteur de nombres des lignes dans chaque tables
        public function totalCount($tablename){
            $sql="SELECT * FROM $tablename";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre d'agences en activités
         public function totalCountsAg(){
            $sql="SELECT id,codeAg,nomAg,adresseAg,telephoneAg FROM agence WHERE etat !=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre d'agences non en activités
         public function totalCountsAgs(){
            $sql="SELECT id,codeAg,nomAg,adresseAg,telephoneAg FROM agence WHERE etat=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }


        //Compteur de nombre des Masculins des nouveau-nés pour les inspections provinciales de santé de la RDC
        public function totalCountsMMNouveaune(){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,nouveau_ne.id,nouveau_ne.nom,nouveau_ne.sexe FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN nouveau_ne ON hopital.id=nouveau_ne.id_hopital WHERE sexe='Masculin'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre des féminins des nouveau-nés pour les inspections provinciales de santé pour la RDC
         public function totalCountsFFNouveaune(){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,nouveau_ne.id,nouveau_ne.nom,nouveau_ne.sexe FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN nouveau_ne ON hopital.id=nouveau_ne.id_hopital WHERE sexe='Feminin'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Vivants des nouveau-nés pour les inspections provinciales de santé pour la RDC
        public function totalCountsVivantNouveaune(){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,fiche.code,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE etat='Vivant'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Morts des nouveau-nés pour les inspections provinciales de santé pour la RDC
        public function totalCountsMortNouveaune(){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,fiche.code,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE etat='Mort'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

         //Afficher  inspection pour la république
         public function fetchAllRapports(){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,COUNT(nouveau_ne.id) as qte,nouveau_ne.nom,nouveau_ne.sexe FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN nouveau_ne ON hopital.id=nouveau_ne.id_hopital GROUP BY (inspection.id)";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>