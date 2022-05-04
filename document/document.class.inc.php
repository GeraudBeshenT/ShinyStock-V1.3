<?php
    class Document
    {
        Private $iddocument;
        Private $datedoc;
        Private $commentaire;
        Private $statut;
        Private $idetat;
        Private $libetat;
        Private $idfournisseur;
        Private $nomfournisseur;

        Public function __construct(string $iddocument='', string $datedoc='', string $commentaire='', string $statut='', string $idetat='', string $idfournisseur='')
        {
            $this->iddocument = $iddocument;
            $this->datedoc = $datedoc;
            $this->commentaire = $commentaire;
            $this->statut = $statut;
            $this->idetat = $idetat;
            $this->idfournisseur = $idfournisseur;
        }

        Public function Getiddocument(){return $this->iddocument;}
        Public function Getdatedoc(){return $this->datedoc;}
        Public function Getcommentaire(){return $this->commentaire;}
        Public function Getstatut(){return $this->statut;}
        Public function Getidetat(){return $this->idetat;}
        Public function Getlibetat(){return $this->libetat;}
        Public function Getidfournisseur(){return $this->idfournisseur;}
        Public function Getnomfournisseur(){return $this->nomfournisseur;}

        Public function Setiddocument($e){$this->iddocument=$e;}
        Public function Setdatedoc($e){$this->datedoc=$e;}
        Public function Setcommentaire($e){$this->commentaire=$e;}
        Public function Setstatut($e){$this->statut=$e;}
        Public function Setidetat($e){$this->idetat=$e;}
        Public function Setidfournisseur($e){$this->idfournisseur=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM document
                INNER JOIN etat ON etat.idetat = document.idetat INNER JOIN fournisseur ON fournisseur.idfournisseur = document.idfournisseur
                WHERE supdocument = 0 AND iddocument = :iddocument');
            $stmt->bindValue(':iddocument',$this->iddocument, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->iddocument = $row['iddocument'];
            $this->datedoc = $row['datedoc'];
            $this->statut = $row['statut'];
            $this->commentaire = $row['commentaire'];
            $this->libetat = $row['libetat'];
            $this->nomfournisseur = $row['nomfournisseur'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE document SET supdocument = 1 WHERE iddocument = :iddocument');
            $stmt->bindValue(':iddocument',$this->iddocument, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE document SET datedoc = :datedoc, commentaire = :commentaire, statut = :statut, idetat = :idetat, idfournisseur = :idfournisseur WHERE iddocument = :iddocument');
            
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':iddocument',$this->iddocument, PDO::PARAM_STR);
            $stmt->bindValue(':datedoc',$this->datedoc, PDO::PARAM_STR);
            $stmt->bindValue(':commentaire',$this->commentaire, PDO::PARAM_STR);
            $stmt->bindValue(':statut',$this->statut, PDO::PARAM_STR);
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO document (iddocument, datedoc, commentaire, statut, idetat, idfournisseur, supdocument) VALUES (NULL, :datedoc, :commentaire, :statut, :idetat, :idfournisseur, 0);");
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':datedoc',$this->datedoc, PDO::PARAM_STR);
            $stmt->bindValue(':commentaire',$this->commentaire, PDO::PARAM_STR);
            $stmt->bindValue(':statut',$this->statut, PDO::PARAM_STR);
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM document WHERE supdocument = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM document WHERE supdocument = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>