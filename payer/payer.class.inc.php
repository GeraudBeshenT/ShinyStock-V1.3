<?php
	class Payer
	{
		Private $id_tarif;
		Private $id_article;
		Private $montant;

		Public function __construct(int $id_tarif = 0, int $id_article = 0, string $montant='')
		{
			$this->id_tarif = $id_tarif;
			$this->id_article = $id_article;
			$this->montant = $montant;
		}
		
		Public function Getidtarif(){return $this->id_tarif;}
		Public function Getidarticle(){return $this->id_article;}
		Public function Getmontant(){return $this->montant;}
		
		Public function Setidtarif($e){$this->id_tarif=$e;}
		Public function Setidarticle($e){$this->id_article=$e;}
		Public function Setmontant($e){$this->montant=$e;}
		
		Public function GetPayerByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM payer WHERE id_tarif = :id_tarif ORDER BY id_tarif');
			$stmt->bindValue(':id_tarif',$this->id_tarif, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->id_tarif = $row['id_tarif'];
			$this->id_article = $row['id_article'];
			$this->montant = $row['montant'];
		}

		Public function DelPayerBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE payer SET b_suppayer = 1 WHERE id_tarif = :id_tarif');
			$stmt->bindValue(':id_tarif',$this->id_tarif, PDO::PARAM_INT);
			$stmt->execute();
		}

		Public function SavePayerBDD($pdo)
		{
			$stmt = $pdo->prepare("UPDATE payer SET id_article=:id_article, montant=:montant WHERE id_tarif = :id_tarif");
			$stmt->bindValue(':id_tarif',$this->id_tarif, PDO::PARAM_INT);
			$stmt->bindValue(':id_article',$this->id_article, PDO::PARAM_INT);
			$stmt->bindValue(':montant',$this->montant, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function AddPayerBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO payer VALUES (:id_tarif,:id_article,:montant,0);");
			$stmt->bindValue(':id_tarif',$this->id_tarif, PDO::PARAM_INT);
			$stmt->bindValue(':id_article',$this->id_article, PDO::PARAM_INT);
			$stmt->bindValue(':montant',$this->montant, PDO::PARAM_STR);
			$stmt->execute();
		}
		
		Public function CountPayerBDD($pdo)
		{
			$stmt = $pdo->prepare('SELECT COUNT(*) AS allcount FROM payer WHERE b_suppayer = 0');
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamPayerBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare('SELECT COUNT(*) AS allcount FROM payer WHERE b_suppayer = 0 ' . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>