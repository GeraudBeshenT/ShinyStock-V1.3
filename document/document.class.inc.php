<?php
include '../bdd.class.inc.php';

    class Document
    {
        Public function __construct(string $num_documents='',string $date_documents='', string $commentaire='', string $statut='', string $Etat='', string $Tiers='')
        {
            global $conn;
            $this->ID = $num_documents;
            $this->date_documents = $date_documents;
            $this->commentaire = $commentaire;
            $this->statut = $statut;
            $this->Etat = new Etat ($Etat);$this->Etat->GetByID($conn);
            $this->Tiers = new Clients ($Tiers);$this->Tiers->GetByID($conn);;
        }

        Public function SetID($e){$this->num_documents=$e;}
        Public function SetDate_Documents($e){$this->date_documents=$e;}
        Public function SetStatut($e){$this->statut=$e;}
        Public function SetCommentaire($e){$this->commentaire=$e;}
        Public function SetEtat($e){$this->Etat = new Etat ($e);$this->Etat->GetByID($conn);}
        Public function SetTiers($e){$this->Tiers = new Tiers ($e);$this->Tiers->GetByID($conn);}

        Public function GetID(){return $this->num_documents;}
        Public function GetDate_Documents(){return $this->date_documents;}
        Public function GetStatut(){return $this->statut;}
        Public function GetCommentaire(){return $this->commentaire;}
        Public function GetEtat(){return $this->id_Etat;}
        Public function GetTiers(){return $this->id_Tiers;}

        Public function GetByNum_Documents($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM document WHERE num_documents = :num_documents');
            $stmt->bindValue(':num_documents',$this->num_documents, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->ID = $row['num_documents'];
            $this->date_documents = $row['date_documents'];
            $this->commentaire = $row['commentaire'];
            $this->statut = $row['statut'];
            $this->Etat =  new Etat ($row['id_etat']);
            $this->Tiers =  new Tiers($row['id_tiers']);
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE document SET b_supdocument = 1 WHERE num_documents = :num_documents');
            $stmt->bindValue(':num_documents',$this->num_documents, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE document SET date_documents= :date_documents,
                commentaire= :commentaire,
                statut= :statut,
                id_etat= :id_etat,
                id_tiers= :id_tiers WHERE num_documents = :num_documents');
            $stmt->bindValue(':date_documents',$this->date_documents, PDO::PARAM_STR);
            $stmt->bindValue(':commentaire',$this->commentaire, PDO::PARAM_STR);
            $stmt->bindValue(':statut',$this->statut, PDO::PARAM_STR);
            $stmt->bindValue(':id_Etat',$this->Etat->GetID(), PDO::PARAM_STR);
            $stmt->bindValue(':id_Tiers',$this->Tiers->GetID(), PDO::PARAM_STR);
            $stmt->bindValue(':num_documents',$this->ID, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO document (date_documents, commentaire, statut, id_etat, id_tarif, b_supdocument) VALUES (:date_documents, :commentaire, :statut, :id_etat, :id_tiers, 0);");
            $stmt->bindValue(':date_documents',$this->date_documents, PDO::PARAM_STR);
            $stmt->bindValue(':commentaire',$this->commentaire, PDO::PARAM_STR);
            $stmt->bindValue(':statut',$this->statut, PDO::PARAM_STR);
            $stmt->bindValue(':id_etat',$this->etat, PDO::PARAM_STR);
            $stmt->bindValue(':id_tiers',$this->tiers, PDO::PARAM_STR);
            $stmt->execute();
            var_dump($stmt);
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM document WHERE b_supdocument = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM document WHERE b_supdocument = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>