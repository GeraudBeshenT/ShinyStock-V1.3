<?php
    class Document
    {
        Private $iddocumentclient;
        Private $datedocclient;
        Private $commentaireclient;
        Private $statutclient;
        Private $idetat;
        Private $libetat;
        Private $idclient;
        Private $nomclient;

        Public function __construct(string $iddocumentclient='', string $datedocclient='', string $commentaireclient='', string $statutclient='', string $idetat='', string $idclient='')
        {
            $this->iddocumentclient = $iddocumentclient;
            $this->datedocclient = $datedocclient;
            $this->commentaireclient = $commentaireclient;
            $this->statutclient = $statutclient;
            $this->idetat = $idetat;
            $this->idclient = $idclient;
        }

        Public function Getiddocumentclient(){return $this->iddocumentclient;}
        Public function Getdatedocclient(){return $this->datedocclient;}
        Public function Getcommentaireclient(){return $this->commentaireclient;}
        Public function Getstatutclient(){return $this->statutclient;}
        Public function Getidetat(){return $this->idetat;}
        Public function Getlibetat(){return $this->libetat;}
        Public function Getidclient(){return $this->idclient;}
        Public function Getnomclient(){return $this->nomclient;}

        Public function Setiddocumentclient($e){$this->iddocumentclient=$e;}
        Public function Setdatedocclient($e){$this->datedocclient=$e;}
        Public function Setcommentaireclient($e){$this->commentaireclient=$e;}
        Public function Setstatutclient($e){$this->statutclient=$e;}
        Public function Setidetat($e){$this->idetat=$e;}
        Public function Setidclient($e){$this->idclient=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM documentclient
                INNER JOIN etat ON etat.idetat = documentclient.idetat INNER JOIN client ON client.idclient = documentclient.idclient
                WHERE supdocumentclient = 0 AND iddocumentclient = :iddocumentclient');
            $stmt->bindValue(':iddocumentclient',$this->iddocumentclient, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->iddocumentclient = $row['iddocumentclient'];
            $this->datedocclient = $row['datedocclient'];
            $this->statutclient = $row['statutclient'];
            $this->commentaireclient = $row['commentaireclient'];
            $this->libetat = $row['libetat'];
            $this->nomclient = $row['nomclient'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE documentclient SET supdocumentclient = 1 WHERE iddocumentclient = :iddocumentclient');
            $stmt->bindValue(':iddocumentclient',$this->iddocumentclient, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE documentclient SET datedocclient = :datedocclient, commentaireclient = :commentaireclient, statutclient = :statutclient, idetat = :idetat, idclient = :idclient WHERE iddocumentclient = :iddocumentclient');
            
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddocumentclient',$this->iddocumentclient, PDO::PARAM_STR);
            $stmt->bindValue(':datedocclient',$this->datedocclient, PDO::PARAM_STR);
            $stmt->bindValue(':commentaireclient',$this->commentaireclient, PDO::PARAM_STR);
            $stmt->bindValue(':statutclient',$this->statutclient, PDO::PARAM_STR);
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':idclient',$this->idclient, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO documentclient (iddocumentclient, datedocclient, commentaireclient, statutclient, idetat, idclient, supdocumentclient) VALUES (NULL, :datedocclient, :commentaireclient, :statutclient, :idetat, :idclient, 0);");
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':datedocclient',$this->datedocclient, PDO::PARAM_STR);
            $stmt->bindValue(':commentaireclient',$this->commentaireclient, PDO::PARAM_STR);
            $stmt->bindValue(':statutclient',$this->statutclient, PDO::PARAM_STR);
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':idclient',$this->idclient, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM documentclient WHERE supdocumentclient = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM documentclient WHERE supdocumentclient = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>