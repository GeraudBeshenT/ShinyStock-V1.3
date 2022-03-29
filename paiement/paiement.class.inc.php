<?php
	class Paiement
	{
		Private $idpaiement;
		Private $libpaiement;

		Public function __construct(string $cidpaiement='', string $clibpaiement='')
		{
			$this->idpaiement = $cidpaiement;
			$this->libpaiement = $clibpaiement;
		}

		Public function Getidpaiement(){return $this->idpaiement;}
		Public function Getlibpaiement(){return $this->libpaiement;}

		Public function Setidpaiement($e){$this->idpaiement=$e;}
		Public function Setlibpaiement($e){$this->libpaiement=$e;}

		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM paiement WHERE idpaiement = :idpaiement');
			$stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->idpaiement = $row['idpaiement'];
			$this->libpaiement = $row['libpaiement'];
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE paiement SET suppaiement = 1 WHERE idpaiement = :idpaiement');
			$stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE paiement SET libpaiement= :libpaiement WHERE idpaiement = :idpaiement');
			$stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
			$stmt->bindValue(':libpaiement',$this->libpaiement, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO paiement (idpaiement, libpaiement, suppaiement) VALUES (NULL, :libpaiement, 0);");
			$stmt->bindValue(':libpaiement',$this->libpaiement, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM paiement WHERE suppaiement = 0");
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM paiement WHERE suppaiement = 0 " . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>