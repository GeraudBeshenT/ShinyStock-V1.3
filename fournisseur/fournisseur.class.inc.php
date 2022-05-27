<?php
	class Fournisseur
	{
		Private $idfournisseur;
		Private $nomfournisseur;
		Private $adressefournisseur;
		Private $telephonefournisseur;
		Private $emailfournisseur;
		Private $idcommune;
		Private $libcommune;
		Private $prefixefournisseur;
		Private $idsociete;
		Private $libsociete;
		Private $idpaiement;
		Private $libpaiement;
		Private $codefournisseur;

		Public function __construct(string $idfournisseur='', string $nomfournisseur='', string $adressefournisseur='', string $telephonefournisseur='', string $emailfournisseur='', string $idcommune='', string $prefixefournisseur='', string $idsociete='', string $idpaiement='', string $codefournisseur='')
		{
			$this->idfournisseur = $idfournisseur;
			$this->nomfournisseur = $nomfournisseur;
			$this->adressefournisseur = $adressefournisseur;
			$this->telephonefournisseur = $telephonefournisseur;
			$this->emailfournisseur = $emailfournisseur;
			$this->idcommune = $idcommune;
			$this->prefixefournisseur = $prefixefournisseur;
			$this->idsociete = $idsociete;
			$this->idpaiement = $idpaiement;
			$this->codefournisseur = $codefournisseur;
		}

		Public function Getidfournisseur(){return $this->idfournisseur;}
		Public function Getnomfournisseur(){return $this->nomfournisseur;}
		Public function Getadressefournisseur(){return $this->adressefournisseur;}
		Public function Gettelephonefournisseur(){return $this->telephonefournisseur;}
		Public function Getemailfournisseur(){return $this->emailfournisseur;}
		Public function Getidcommune(){return $this->idcommune;}
		Public function Getlibcommune(){return $this->libcommune;}
		Public function Getprefixefournisseur(){return $this->prefixefournisseur;}
		Public function Getidsociete(){return $this->idsociete;}
		Public function Getlibsociete(){return $this->libsociete;}
		Public function Getidpaiement(){return $this->idpaiement;}
		Public function Getlibpaiement(){return $this->libpaiement;}
		Public function Getcodefournisseur(){return $this->codefournisseur;}

		Public function Setidfournisseur($e){$this->idfournisseur=$e;}
		Public function Setnomfournisseur($e){$this->nomfournisseur=$e;}
		Public function Setadressefournisseur($e){$this->adressefournisseur=$e;}
		Public function Settelephonefournisseur($e){$this->telephonefournisseur=$e;}
		Public function Setemailfournisseur($e){$this->emailfournisseur=$e;}
		Public function Setidcommune($e){$this->idcommune=$e;}
		Public function Setprefixefournisseur($e){$this->prefixefournisseur=$e;}
		Public function Setidsociete($e){$this->idsociete=$e;}
		Public function Setidpaiement($e){$this->idpaiement=$e;}
		Public function Setcodefournisseur($e){$this->codefournisseur=$e;}

		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM fournisseur INNER JOIN commune ON commune.idcommune = fournisseur.idcommune INNER JOIN societe ON societe.idsociete = fournisseur.idsociete INNER JOIN paiement ON paiement.idpaiement = fournisseur.idpaiement WHERE supfournisseur = 0 AND idfournisseur = :idfournisseur');
			$stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->idfournisseur = $row['idfournisseur'];
			$this->nomfournisseur = $row['nomfournisseur'];
			$this->adressefournisseur = $row['adressefournisseur'];
			$this->telephonefournisseur = $row['telephonefournisseur'];
			$this->emailfournisseur = $row['emailfournisseur'];
			$this->libcommune = $row['libcommune'];
			$this->prefixefournisseur = $row['prefixefournisseur'];
			$this->libsociete = $row['libsociete'];
			$this->libpaiement = $row['libpaiement'];
			$this->codefournisseur = $row['codefournisseur'];
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE fournisseur SET supfournisseur = 1 WHERE idfournisseur = :idfournisseur');
			$stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE fournisseur SET nomfournisseur = :nomfournisseur, adressefournisseur = :adressefournisseur, telephonefournisseur = :telephonefournisseur, emailfournisseur = :emailfournisseur, idcommune = :idcommune, prefixefournisseur = :prefixefournisseur, idsociete = :idsociete, idpaiement = :idpaiement, codefournisseur = :codefournisseur WHERE idfournisseur = :idfournisseur');
			// var_dump($stmt);
   //          var_dump($this);
   //          die();
			$stmt->bindValue(':idfournisseur',$this->idfournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':nomfournisseur',$this->nomfournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':adressefournisseur',$this->adressefournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':telephonefournisseur',$this->telephonefournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':emailfournisseur',$this->emailfournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
			$stmt->bindValue(':prefixefournisseur',$this->prefixefournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
			$stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
			$stmt->bindValue(':codefournisseur',$this->codefournisseur, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO fournisseur (idfournisseur, nomfournisseur, adressefournisseur, telephonefournisseur, emailfournisseur, idcommune, prefixefournisseur, idsociete, idpaiement, codefournisseur, supfournisseur) VALUES (NULL, :nomfournisseur, :adressefournisseur, :telephonefournisseur, :emailfournisseur, :idcommune, :prefixefournisseur, :idsociete, :idpaiement, :codefournisseur, 0);");
			// var_dump($stmt);
   //          var_dump($this);
   //          die(); 
			$stmt->bindValue(':nomfournisseur',$this->nomfournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':adressefournisseur',$this->adressefournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':telephonefournisseur',$this->telephonefournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':emailfournisseur',$this->emailfournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
			$stmt->bindValue(':prefixefournisseur',$this->prefixefournisseur, PDO::PARAM_STR);
			$stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
			$stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
			$stmt->bindValue(':codefournisseur',$this->codefournisseur, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM fournisseur WHERE supfournisseur = 0");
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM fournisseur WHERE supfournisseur = 0 " . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>