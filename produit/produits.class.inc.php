<?php
    class Produit
    {
        Private $idproduit;
        Private $idarticleInitial;
        Private $idarticleCompose;
        Private $libarticleCompose;
        Private $qteachat;

        Public function __construct(string $idproduit='', string $idarticleInitial='', string $idarticleCompose='', string $libarticleCompose='', string $qteachat='')
        {
            $this->idproduit = $idproduit;
            $this->idarticleInitial = $idarticleInitial;
            $this->idarticleCompose = $idarticleCompose;
            $this->libarticleCompose = $libarticleCompose;
            $this->qteachat = $qteachat;
        }

        Public function Getidproduit(){return $this->idproduit;}
        Public function GetidarticleInitial(){return $this->idarticleInitial;}
        Public function GetidarticleCompose(){return $this->idarticleCompose;}
        Public function GetlibarticleCompose(){return $this->libarticleCompose;}
        Public function Getqteachat(){return $this->qteachat;}

        Public function Setidproduit($e){$this->idproduit=$e;}
        Public function SetidarticleInitial($e){$this->idarticleInitial=$e;}
        Public function SetidarticleCompose($e){$this->idarticleCompose=$e;}
        Public function Setqteachat($e){$this->qteachat=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM compose INNER JOIN article ON article.idarticle = compose.idarticleInitial WHERE supcompose = 0 AND idproduit = :idproduit');
            $stmt->bindValue(':idproduit',$this->idproduit, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->idproduit = $row['idproduit'];
            $this->idarticleInitial = $row['idarticleInitial'];
            $this->idarticleCompose = $row['idarticleCompose'];
            $this->libarticleCompose = $row['libarticleCompose'];
            $this->qteachat = $row['qteachat'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE compose SET supcompose = 1 WHERE idproduit = :idproduit');
            $stmt->bindValue(':idproduit',$this->idproduit, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE compose SET idarticleInitial = :idarticleInitial, idarticleCompose = :idarticleCompose, libarticleCompose = :libarticleCompose, qteachat = :qteachat WHERE idproduit = :idproduit');
            // var_dump($stmt);
   //          var_dump($this);
   //          die();
            $stmt->bindValue(':idproduit',$this->idproduit, PDO::PARAM_STR);
            $stmt->bindValue(':idarticleInitial',$this->idarticleInitial, PDO::PARAM_STR);
            $stmt->bindValue(':idarticleCompose',$this->idarticleCompose, PDO::PARAM_STR);
            $stmt->bindValue(':libarticleCompose',$this->libarticleCompose, PDO::PARAM_STR);
            $stmt->bindValue(':qteachat',$this->qteachat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO compose (idproduit, idarticleInitial, idarticleCompose, libarticleCompose, qteachat, supcompose) VALUES (NULL, :idarticleInitial, :idarticleCompose, :libarticleCompose, :qteachat, 0);");
            // var_dump($stmt);
   //          var_dump($this);
   //          die(); 
            $stmt->bindValue(':idarticleInitial',$this->idarticleInitial, PDO::PARAM_STR);
            $stmt->bindValue(':idarticleCompose',$this->idarticleCompose, PDO::PARAM_STR);
            $stmt->bindValue(':libarticleCompose',$this->libarticleCompose, PDO::PARAM_STR);
            $stmt->bindValue(':qteachat',$this->qteachat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM compose WHERE supcompose = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM compose WHERE supcompose = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>