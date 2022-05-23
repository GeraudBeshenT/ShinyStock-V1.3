<?php
    class Detailfournisseur
    {
        Private $iddetailfournisseur;
        Private $idarticle;
        Private $libarticle;
        Private $iddocumentfournisseur;
        Private $datedocdocumentfournisseur;
        Private $qtearticle;

        Public function __construct(string $iddetailfournisseur='', string $idarticle='', string $iddocumentfournisseur='', string $qtearticle='')
        {
            $this->iddetailfournisseur = $iddetailfournisseur;
            $this->idarticle = $idarticle;
            $this->iddocumentfournisseur = $iddocumentfournisseur;
            $this->qtearticle = $qtearticle;
        }

        Public function Getiddetailfournisseur(){return $this->iddetailfournisseur;}
        Public function Getidarticle(){return $this->idarticle;}
        Public function Getlibarticle(){return $this->libarticle;}
        Public function Getiddocumentfournisseur(){return $this->iddocumentfournisseur;}
        Public function Getdatedocdocumentfournisseur(){return $this->datedocdocumentfournisseur;}
        Public function Getqtearticle(){return $this->qtearticle;}

        Public function Setiddetailfournisseur($e){$this->iddetailfournisseur=$e;}
        Public function Setidarticle($e){$this->idarticle=$e;}
        Public function Setiddocumentfournisseur($e){$this->iddocumentfournisseur=$e;}
        Public function Setqtearticle($e){$this->qtearticle=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM detailfournisseur
                INNER JOIN article ON article.idarticle = detailfournisseur.idarticle
                INNER JOIN documentfournisseur ON documentfournisseur.iddocumentfournisseur = detailfournisseur.iddocumentfournisseur
                WHERE supdetailfournisseur = 0 AND iddocumentfournisseur = :iddocumentfournisseur');
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->iddetailfournisseur = $row['iddetailfournisseur'];
            $this->idarticle = $row['idarticle'];
            $this->iddocumentfournisseur = $row['iddocumentfournisseur'];
            $this->qtearticle = $row['qtearticle'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE documentfournisseur SET supdocumentfournisseur = 1 WHERE iddocumentfournisseur = :iddocumentfournisseur');
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE documentfournisseur SET datedocfournisseur = :datedocfournisseur, commentairefournisseur = :commentairefournisseur, statutfournisseur = :statutfournisseur, idetat = :idetat, idfournisseur = :idfournisseur WHERE iddocumentfournisseur = :iddocumentfournisseur');
            
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':datedocfournisseur',$this->datedocfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':commentairefournisseur',$this->commentairefournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':statutfournisseur',$this->statutfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO detailfournisseur (iddetailfournisseur, idarticle, iddocumentfournisseur, qtearticle, supdetailfournisseur) VALUES (NULL, :idarticle, :iddocumentfournisseur, :qtearticle, 0);");
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':qtearticle',$this->qtearticle, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM detailfournisseur WHERE supdetailfournisseur = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM detailfournisseur WHERE supdetailfournisseur = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>