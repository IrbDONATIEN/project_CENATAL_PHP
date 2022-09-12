<?php
     require_once 'config.php';
     class Insp extends Database{
        
        //Login Inspection de santé
        public function loginInsp($loginInsp,$password){
            $sql="SELECT loginInsp,password FROM inspection WHERE loginInsp=:loginInsp AND password=:password";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginInsp'=>$loginInsp,'password'=>$password]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'inspection  connecté
        public function currentInsp($loginInsp){
            $sql="SELECT inspection.id,codeMat,nomInsp,loginInsp,password,date_creation,id_province,province.provinces FROM inspection INNER JOIN province ON province.id=inspection.id_province WHERE loginInsp=:loginInsp";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginInsp'=>$loginInsp]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

         //Enregistrer une nouvelle zone de santé
         public function add_zone_sante($codeZone,$nomZone,$loginZone,$password,$cid){
            $sql="INSERT INTO zone_sante (codeZone,nomZone,loginZone,password,id_inspection) VALUES (:codeZone,:nomZone,:loginZone,:password,:cid)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['codeZone'=>$codeZone,'nomZone'=>$nomZone,'loginZone'=>$loginZone,'password'=>$password,'cid'=>$cid]);
            return true;
        }

        //Vérifier si la zone de santé existe déjà dans la base de données
        public function zone_sante_existe($nomZone,$loginZone){
            $sql="SELECT nomZone,loginZone FROM zone_sante WHERE nomZone=:nomZone AND loginZone=:loginZone";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nomZone'=>$nomZone,'loginZone'=>$loginZone]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Afficher zone de santé par province inspection de santé
        public function fetchAllZonesSante($id_inspection){
            $sql="SELECT zone_sante.id,codeZone,nomZone,loginZone,zone_sante.password,id_inspection,inspection.nomInsp, inspection.codeMat,date_create FROM zone_sante INNER JOIN inspection ON inspection.id=zone_sante.id_inspection WHERE id_inspection=:id_inspection";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id_inspection'=>$id_inspection]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Affichage avant l'édition de la zone de santé existante dans la base de données
        public function editerZoneSante($id){
            $sql="SELECT * FROM zone_sante WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Delete Zone de santé by Admin
        public function deleteZoneSante($id){
            $sql="DELETE FROM zone_sante WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Edition proprement dite de la zone de santé
        public function update_zone_sante($id,$nomZone,$loginZone,$password){
            $sql="UPDATE zone_sante SET nomZone=:nomZone,loginZone=:loginZone,password=:password WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nomZone'=>$nomZone,'loginZone'=>$loginZone,'password'=>$password,'id'=>$id]);
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

         //Compteur de nombre des zones de santé
         public function totalCountsZones($id_inspection){
            $sql="SELECT id,codeZone,nomZone,loginZone,password,id_inspection,date_create FROM zone_sante WHERE id_inspection=:id_inspection";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id_inspection'=>$id_inspection]);
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre des zones de santé
         public function totalCountsHopis($id_inspection){
            $sql="SELECT zone_sante.id, zone_sante.codeZone, zone_sante.nomZone,id_inspection,inspection.codeMat,inspection.nomInsp, hopital.id, hopital.codeHopital,hopital.nomHopital FROM zone_sante INNER JOIN inspection ON zone_sante.id_inspection=inspection.id INNER JOIN hopital ON zone_sante.id=hopital.id_zone WHERE id_inspection=:id_inspection";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id_inspection'=>$id_inspection]);
            $count=$stmt->rowCount();
            return $count;
        }


        //Compteur de nombre des Masculins des nouveau-nés pour l'hôpital de santé
        public function totalCountsMMNouveaune($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,nouveau_ne.id,nouveau_ne.nom,nouveau_ne.sexe FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN nouveau_ne ON hopital.id=nouveau_ne.id_hopital WHERE sexe='Masculin' AND inspection.id=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre des féminins des nouveau-nés pour l'hôpital de santé
         public function totalCountsFFNouveaune($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,nouveau_ne.id,nouveau_ne.nom,nouveau_ne.sexe FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN nouveau_ne ON hopital.id=nouveau_ne.id_hopital WHERE sexe='Feminin' AND inspection.id=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Vivants des nouveau-nés pour l'hôpital de santé
        public function totalCountsVivantNouveaune($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,fiche.code,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE etat='Vivant' AND inspection.id=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Morts des nouveau-nés pour l'hôpital de santé
        public function totalCountsMortNouveaune($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,fiche.code,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE etat='Mort' AND inspection.id=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }


         //Afficher  rapport inspection provinciale de la santé
         public function fetchAllRapports($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,COUNT(fiche.code) as qte,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE inspection.id=:cid GROUP BY (zone_sante.id)";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


    }
?>