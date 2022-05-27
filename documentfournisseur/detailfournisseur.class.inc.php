<?php
    class Detailfournisseur
    {
        Private $iddetailfournisseur;
        Private $iddocumentfournisseur;
        Private $datedocfournisseur;
        Private $idarticle;
        Private $libarticle;
        Private $qteachat;

        Public function __construct(string $iddetailfournisseur='', string $iddocumentfournisseur='', string $idarticle='', string $qteachat='')
        {
            $this->iddetailfournisseur = $iddetailfournisseur;
            $this->iddocumentfournisseur = $iddocumentfournisseur;
            $this->idarticle = $idarticle;
            $this->qteachat = $qteachat;
        }

        Public function Getiddetailfournisseur(){return $this->iddetailfournisseur;}
        Public function Getiddocumentfournisseur(){return $this->iddocumentfournisseur;}
        Public function Getdatedocfournisseur(){return $this->datedocfournisseur;}
        Public function Getidarticle(){return $this->idarticle;}
        Public function Getlibarticle(){return $this->libarticle;}
        Public function Getqteachat(){return $this->qteachat;}

        Public function Setiddetailfournisseur($e){$this->iddetailfournisseur=$e;}
        Public function Setiddocumentfournisseur($e){$this->iddocumentfournisseur=$e;}
        Public function Setidarticle($e){$this->idarticle=$e;}
        Public function Setqteachat($e){$this->qteachat=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM detailfournisseur
                INNER JOIN documentfournisseur ON documentfournisseur.iddocumentfournisseur = detailfournisseur.iddocumentfournisseur
                INNER JOIN article ON article.idarticle = detailfournisseur.idarticle
                WHERE supdetailfournisseur = 0');
            $stmt->bindValue(':iddetailfournisseur',$this->iddetailfournisseur, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->iddetailfournisseur = $row['iddetailfournisseur'];
            $this->iddocumentfournisseur = $row['iddocumentfournisseur'];
            $this->datedocfournisseur = $row['datedocfournisseur'];
            $this->idarticle = $row['idarticle'];
            $this->libarticle = $row['libarticle'];
            $this->qteachat = $row['qteachat'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE detailfournisseur SET supdetailfournisseur = 1 WHERE iddetailfournisseur = :iddetailfournisseur');
            $stmt->bindValue(':iddetailfournisseur',$this->iddetailfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE detailfournisseur SET iddocumentfournisseur = :iddocumentfournisseur, idarticle = :idarticle, qteachat = :qteachat WHERE iddetailfournisseur = :iddetailfournisseur');
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddetailfournisseur',$this->iddetailfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
            $stmt->bindValue(':qteachat',$this->qteachat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO detailfournisseur (iddetailfournisseur, iddocumentfournisseur, idarticle, qteachat, supdetailfournisseur) VALUES (NULL, :iddocumentfournisseur, :idarticle, :qteachat, 0);");
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
            $stmt->bindValue(':qteachat',$this->qteachat, PDO::PARAM_STR);
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