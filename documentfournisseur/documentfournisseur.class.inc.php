<?php
    class Documentfournisseur
    {
        Private $iddocumentfournisseur;
        Private $datedocfournisseur;
        Private $commentairefournisseur;
        Private $statutfournisseur;
        Private $idetat;
        Private $libetat;
        Private $idfournisseur;
        Private $nomfournisseur;

        Public function __construct(string $iddocumentfournisseur='', string $datedocfournisseur='', string $commentairefournisseur='', string $statutfournisseur='', string $idetat='', string $idfournisseur='')
        {
            $this->iddocumentfournisseur = $iddocumentfournisseur;
            $this->datedocfournisseur = $datedocfournisseur;
            $this->commentairefournisseur = $commentairefournisseur;
            $this->statutfournisseur = $statutfournisseur;
            $this->idetat = $idetat;
            $this->idfournisseur = $idfournisseur;
        }

        Public function Getiddocumentfournisseur(){return $this->iddocumentfournisseur;}
        Public function Getdatedocfournisseur(){return $this->datedocfournisseur;}
        Public function Getcommentairefournisseur(){return $this->commentairefournisseur;}
        Public function Getstatutfournisseur(){return $this->statutfournisseur;}
        Public function Getidetat(){return $this->idetat;}
        Public function Getlibetat(){return $this->libetat;}
        Public function Getidfournisseur(){return $this->idfournisseur;}
        Public function Getnomfournisseur(){return $this->nomfournisseur;}

        Public function Setiddocumentfournisseur($e){$this->iddocumentfournisseur=$e;}
        Public function Setdatedocfournisseur($e){$this->datedocfournisseur=$e;}
        Public function Setcommentairefournisseur($e){$this->commentairefournisseur=$e;}
        Public function Setstatutfournisseur($e){$this->statutfournisseur=$e;}
        Public function Setidetat($e){$this->idetat=$e;}
        Public function Setidfournisseur($e){$this->idfournisseur=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM documentfournisseur
                INNER JOIN etat ON etat.idetat = documentfournisseur.idetat INNER JOIN fournisseur ON fournisseur.idfournisseur = documentfournisseur.idfournisseur
                WHERE supdocumentfournisseur = 0 AND iddocumentfournisseur = :iddocumentfournisseur');
            $stmt->bindValue(':iddocumentfournisseur',$this->iddocumentfournisseur, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->iddocumentfournisseur = $row['iddocumentfournisseur'];
            $this->datedocfournisseur = $row['datedocfournisseur'];
            $this->statutfournisseur = $row['statutfournisseur'];
            $this->commentairefournisseur = $row['commentairefournisseur'];
            $this->libetat = $row['libetat'];
            $this->nomfournisseur = $row['nomfournisseur'];
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
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO documentfournisseur (iddocumentfournisseur, datedocfournisseur, commentairefournisseur, statutfournisseur, idetat, idfournisseur, supdocumentfournisseur) VALUES (NULL, :datedocfournisseur, :commentairefournisseur, :statutfournisseur, :idetat, :idfournisseur, 0);");
            // var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':datedocfournisseur',$this->datedocfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':commentairefournisseur',$this->commentairefournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':statutfournisseur',$this->statutfournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM documentfournisseur WHERE supdocumentfournisseur = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM documentfournisseur WHERE supdocumentfournisseur = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>