<?php
     require_once 'config.php';
     class Hopi extends Database{
        
        //Login Hôpital de santé
        public function loginHopi($loginHopital,$password){
            $sql="SELECT loginHopital,password FROM hopital WHERE loginHopital=:loginHopital AND password=:password";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginHopital'=>$loginHopital,'password'=>$password]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'hôpital  connecté
        public function currentHopi($loginHopital){
            $sql="SELECT hopital.id,codeHopital,nomHopital,loginHopital,hopital.password,id_zone,zone_sante.codeZone,zone_sante.nomZone FROM hopital INNER JOIN zone_sante ON zone_sante.id=hopital.id_zone WHERE loginHopital=:loginHopital";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['loginHopital'=>$loginHopital]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

         //Enregistrer un nouveau-né dans un hôpital de santé
         public function add_nouveaune($nom,$prenom,$sexe,$service,$id_hopital){
            $sql="INSERT INTO nouveau_ne(nom,prenom,sexe,service,id_hopital) VALUES (:nom,:prenom,:sexe,:service,:id_hopital)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom'=>$nom,'prenom'=>$prenom,'sexe'=>$sexe,'service'=>$service,'id_hopital'=>$id_hopital]);
            return true;
        }

        //Afficher Nouveau-né par hôpital 
        public function fetchAllNouveaunes($cid){
            $sql="SELECT nouveau_ne.id,nom,prenom,sexe,service,nouveau_ne.date_creation,id_hopital,hopital.codeHopital,hopital.nomHopital FROM nouveau_ne INNER JOIN hopital ON hopital.id=nouveau_ne.id_hopital WHERE id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Affichage avant l'édition du nouveau-né existant dans la base de données
        public function editerNouveaune($id){
            $sql="SELECT * FROM nouveau_ne WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Delete Nouveau-né par hôpital by Admin
        public function deleteNouveaune($id){
            $sql="DELETE FROM nouveau_ne WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Edition proprement dite du nouveau-né
        public function update_nouveaune($id,$nom,$prenom,$sexe){
            $sql="UPDATE nouveau_ne SET nom=:nom,prenom=:prenom,sexe=:sexe WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom'=>$nom,'prenom'=>$prenom,'sexe'=>$sexe,'id'=>$id]);
            return true;
        }

        //Mise à jour de données de nouveau-né 
        public function update_NN($id_nouveaune){
            $sql="UPDATE nouveau_ne SET active=1 WHERE id=:id_nouveaune";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id_nouveaune'=>$id_nouveaune]);
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


        //Enregistrer une fiche dans un hôpital de santé
        public function add_fiche($poids,$etat,$lieuNais,$dateNais,$heureNais,$etatYeux,$omblic,$observation,$id_nouveaune,$cid){
            $sql="INSERT INTO fiche(poids,etat,lieuNais,dateNais,heureNais,etatYeux,omblic,observation,id_nouveaune,id_hopital) VALUES (:poids,:etat,:lieuNais,:dateNais,:heureNais,:etatYeux,:omblic,:observation,:id_nouveaune,:cid)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['poids'=>$poids,'etat'=>$etat,'lieuNais'=>$lieuNais,'dateNais'=>$dateNais,'heureNais'=>$heureNais,'etatYeux'=>$etatYeux,'omblic'=>$omblic,'observation'=>$observation,'id_nouveaune'=>$id_nouveaune,'cid'=>$cid]);
            return true;
        }

        //Enregistrer un rapport dans un hôpital de santé
        public function add_rapport($id_nouveaune,$cid){
            $sql="INSERT INTO rapports (id_nouveau_ne,id_hopital_id) VALUES (:id_nouveaune,:cid)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id_nouveaune'=>$id_nouveaune,'cid'=>$cid]);
            return true;
        }

        //Afficher rapports Nouveau-né par hôpital 
        public function fetchAllRapports($cid){
            $sql="SELECT inspection.id,inspection.codeMat,inspection.nomInsp,id_province,province.provinces,zone_sante.id,zone_sante.codeZone,zone_sante.nomZone, hopital.id,hopital.codeHopital, hopital.nomHopital,COUNT(fiche.code) as qte,fiche.code,fiche.etat FROM inspection INNER JOIN province ON province.id=inspection.id_province INNER JOIN zone_sante ON inspection.id=zone_sante.id_inspection INNER JOIN hopital ON zone_sante.id=hopital.id_zone INNER JOIN fiche ON hopital.id=fiche.id_hopital WHERE hopital.id=:cid GROUP BY (hopital.id)";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Afficher Fiche Nouveau-né par hôpital 
        public function fetchAllFiches($cid){
            $sql="SELECT code,poids,etat,lieuNais,dateNais,heureNais,etatYeux,omblic,observation,fiche.date_creation,id_nouveaune,nouveau_ne.nom,nouveau_ne.prenom,nouveau_ne.sexe,fiche.id_hopital,hopital.codeHopital,hopital.nomHopital FROM fiche INNER JOIN nouveau_ne ON nouveau_ne.id=fiche.id_nouveaune INNER JOIN hopital ON hopital.id=fiche.id_hopital WHERE fiche.id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Affichage avant l'édition de la fiche existante dans la base de données
        public function editerFiche($id){
            $sql="SELECT * FROM fiche WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Delete fiche par hôpital by Admin
        public function deleteFiche($id){
            $sql="DELETE FROM fiche WHERE code=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Edition proprement dite de la fiche
        public function update_fiche($id,$poids,$etat,$lieuNais,$dateNais,$heureNais,$etatYeux,$omblic,$observation,$id_nouveaune,$id_hopital){
            $sql=" WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['poids'=>$poids,'etat'=>$etat,'lieuNais'=>$lieuNais,'dateNais'=>$dateNais,'heureNais'=>$heureNais,'etatYeux'=>$etatYeux,'omblic'=>$omblic,'observation'=>$observation,'id_nouveaune'=>$id_nouveaune,'id_hopital'=>$id_hopital,'id'=>$id]);
            return true;
        }

         //Compteur de nombre des nouveau-né pour l'hôpital de santé
         public function totalCountsNouveaune($cid){
            $sql="SELECT id, nom, prenom, sexe, service, date_creation, id_hopital, active FROM nouveau_ne WHERE id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre des fiches des nouveau-nés pour l'hôpital de santé
         public function totalCountsFNouveaune($cid){
            $sql="SELECT code,poids,etat,lieuNais,dateNais, heureNais, etatYeux, omblic, observation,date_creation,id_nouveaune, id_hopital FROM fiche WHERE id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des féminins des nouveau-nés pour l'hôpital de santé
        public function totalCountsMMNouveaune($cid){
            $sql="SELECT id,nom,prenom,sexe,service,date_creation,id_hopital,active FROM nouveau_ne WHERE sexe='Masculin' AND id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des Masculins des nouveau-nés pour l'hôpital de santé
        public function totalCountsFFNouveaune($cid){
            $sql="SELECT id,nom,prenom,sexe,service,date_creation,id_hopital,active FROM nouveau_ne WHERE sexe='Feminin' AND id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

         //Compteur de nombre des vivants des nouveau-nés pour l'hôpital de santé
         public function totalCountsVivantNouveaune($cid){
            $sql="SELECT code,poids,etat,lieuNais,dateNais,heureNais,etatYeux,omblic,observation,date_creation,id_nouveaune,id_hopital FROM fiche WHERE etat='Vivant' AND id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre des morts des nouveau-nés pour l'hôpital de santé
        public function totalCountsMortNouveaune($cid){
            $sql="SELECT code,poids,etat,lieuNais,dateNais,heureNais,etatYeux,omblic,observation,date_creation,id_nouveaune,id_hopital FROM fiche WHERE etat='Mort' AND id_hopital=:cid";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['cid'=>$cid]);
            $count=$stmt->rowCount();
            return $count;
        }

    }
?>