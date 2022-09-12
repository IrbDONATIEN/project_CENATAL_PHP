<?php
     require_once 'config.php';
     class Zone extends Database{
        
        //Login Zone de santé
        public function loginZone($loginZone,$password){
            $sql="SELECT loginZone,password FROM zone_sante WHERE loginZone=:loginZone AND password=:password";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginZone'=>$loginZone,'password'=>$password]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de la zone de santé  connecté
        public function currentZone($loginZone){
            $sql="SELECT zone_sante.id,codeZone,nomZone,loginZone,zone_sante.password,id_inspection,inspection.codeMat,inspection.nomInsp FROM zone_sante INNER JOIN inspection ON inspection.id=zone_sante.id_inspection WHERE loginZone=:loginZone";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginZone'=>$loginZone]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

         //Enregistrer un nouvel hôpital pour la zone de santé
         public function add_hopital($codeHopital,$nomHopital,$loginHopital,$password,$cid){
            $sql="INSERT INTO hopital(codeHopital,nomHopital,loginHopital,password,id_zone) VALUES (:codeHopital,:nomHopital,:loginHopital,:password,:cid)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['codeHopital'=>$codeHopital,'nomHopital'=>$nomHopital,'loginHopital'=>$loginHopital,'password'=>$password,'cid'=>$cid]);
            return true;
        }

        //Vérifier si l'hôpital existe déjà dans la base de données
        public function hopital_exist($nomHopital,$loginHopital){
            $sql="SELECT nomHopital,loginHopital FROM hopital WHERE nomHopital=:nomHopital AND loginHopital=:loginHopital";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nomHopital'=>$nomHopital,'loginHopital'=>$loginHopital]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Afficher hôpitaux par zone de santé
        public function fetchAllHopitaux($cid){
            $sql="SELECT id,codeHopital,nomHopital,loginHopital,password,id_zone FROM hopital WHERE id_zone=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Affichage avant l'édition de l'hôpital existant dans la base de données
        public function editerHopital($id){
            $sql="SELECT * FROM hopital WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Delete Hôpital by Admin
        public function deleteHopital($id){
            $sql="DELETE FROM hopital WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Edition proprement dite d'hôpital
        public function update_hopital($id,$nomHopital,$loginHopital,$password){
            $sql="UPDATE hopital SET nomHopital=:nomHopital,loginHopital=:loginHopital,password=:password WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nomHopital'=>$nomHopital,'loginHopital'=>$loginHopital,'password'=>$password,'id'=>$id]);
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

         //Compteur de nombre d'hôpitaux de santé pour une zone de santé
         public function totalCountsHopitaux($cid){
            $sql="SELECT id,codeHopital,nomHopital,loginHopital,password,id_zone FROM hopital WHERE id_zone=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Masculins des nouveau-nés pour l'hôpital de santé
        public function totalCountsMMNouveaune($cid){
            $sql="SELECT hopital.id,codeHopital,nomHopital,id_zone,zone_sante.nomZone,nouveau_ne.id,nouveau_ne.nom,nouveau_ne.sexe FROM hopital INNER JOIN zone_sante ON zone_sante.id=hopital.id_zone LEFT JOIN nouveau_ne ON nouveau_ne.id_hopital=hopital.id WHERE sexe='Masculin' AND id_zone=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre des féminins des nouveau-nés pour l'hôpital de santé
         public function totalCountsFFNouveaune($cid){
            $sql="SELECT hopital.id,codeHopital,nomHopital,id_zone,zone_sante.nomZone,nouveau_ne.id,nouveau_ne.nom,nouveau_ne.sexe FROM hopital INNER JOIN zone_sante ON zone_sante.id=hopital.id_zone LEFT JOIN nouveau_ne ON nouveau_ne.id_hopital=hopital.id WHERE sexe='Feminin' AND id_zone=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Vivants des nouveau-nés pour l'hôpital de santé
        public function totalCountsVivantNouveaune($cid){
            $sql="SELECT hopital.id,codeHopital,nomHopital,id_zone,zone_sante.nomZone,fiche.code,fiche.etat FROM hopital INNER JOIN zone_sante ON zone_sante.id=hopital.id_zone LEFT JOIN fiche ON fiche.id_hopital=hopital.id WHERE etat='Vivant' AND id_zone=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Morts des nouveau-nés pour l'hôpital de santé
        public function totalCountsMortNouveaune($cid){
            $sql="SELECT hopital.id,codeHopital,nomHopital,id_zone,zone_sante.nomZone,fiche.code,fiche.etat FROM hopital INNER JOIN zone_sante ON zone_sante.id=hopital.id_zone LEFT JOIN fiche ON fiche.id_hopital=hopital.id WHERE etat='Mort' AND id_zone=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

         //Afficher  rapport zone de santé
         public function fetchAllRapports($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,COUNT(fiche.code) as qte,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE zone_sante.id=:cid GROUP BY (hopital.id)";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

    }
?>