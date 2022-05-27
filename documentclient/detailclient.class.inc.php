<?php
    class Detailclient
    {
        Private $iddetailclient;
        Private $iddocumentclient;
        Private $datedocclient;
        Private $idarticle;
        Private $libarticle;
        Private $qteachat;

        Public function __construct(string $iddetailclient='', string $iddocumentclient='', string $idarticle='', string $qteachat='')
        {
            $this->iddetailclient = $iddetailclient;
            $this->iddocumentclient = $iddocumentclient;
            $this->idarticle = $idarticle;
            $this->qteachat = $qteachat;
        }

        Public function Getiddetailclient(){return $this->iddetailclient;}
        Public function Getiddocumentclient(){return $this->iddocumentclient;}
        Public function Getdatedocclient(){return $this->datedocclient;}
        Public function Getidarticle(){return $this->idarticle;}
        Public function Getlibarticle(){return $this->libarticle;}
        Public function Getqteachat(){return $this->qteachat;}

        Public function Setiddetailclient($e){$this->iddetailclient=$e;}
        Public function Setiddocumentclient($e){$this->iddocumentclient=$e;}
        Public function Setidarticle($e){$this->idarticle=$e;}
        Public function Setqteachat($e){$this->qteachat=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM detailclient
                INNER JOIN documentclient ON documentclient.iddocumentclient = detailclient.iddocumentclient
                INNER JOIN article ON article.idarticle = detailclient.idarticle
                WHERE supdetailclient = 0');
            $stmt->bindValue(':iddetailclient',$this->iddetailclient, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->iddetailclient = $row['iddetailclient'];
            $this->iddocumentclient = $row['iddocumentclient'];
            $this->datedocclient = $row['datedocclient'];
            $this->idarticle = $row['idarticle'];
            $this->libarticle = $row['libarticle'];
            $this->qteachat = $row['qteachat'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE detailclient SET supdetailclient = 1 WHERE iddetailclient = :iddetailclient');
            $stmt->bindValue(':iddetailclient',$this->iddetailclient, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE detailclient SET iddocumentclient = :iddocumentclient, idarticle = :idarticle, qteachat = :qteachat WHERE iddetailclient = :iddetailclient');
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddetailclient',$this->iddetailclient, PDO::PARAM_STR);
            $stmt->bindValue(':iddocumentclient',$this->iddocumentclient, PDO::PARAM_STR);
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
            $stmt->bindValue(':qteachat',$this->qteachat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO detailclient (iddetailclient, iddocumentclient, idarticle, qteachat, supdetailclient) VALUES (NULL, :iddocumentclient, :idarticle, :qteachat, 0);");
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddocumentclient',$this->iddocumentclient, PDO::PARAM_STR);
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
            $stmt->bindValue(':qteachat',$this->qteachat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM detailclient WHERE supdetailclient = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM detailclient WHERE supdetailclient = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>