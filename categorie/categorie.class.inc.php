<?php
	class Categorie
	{
		Private $idcategorie;
		Private $reference;
		Private $libcategorie;
		Private $description;
		Private $codedouane;

		Public function __construct(string $idcategorie='', string $reference='', string $libcategorie='', string $description='', string $codedouane='')
		{
			$this->idcategorie = $idcategorie;
			$this->reference = $reference;
			$this->libcategorie = $libcategorie;
			$this->description = $description;
			$this->codedouane = $codedouane;
		}

		Public function Getidcategorie(){return $this->idcategorie;}
		Public function Getreference(){return $this->reference;}
		Public function Getlibcategorie(){return $this->libcategorie;}
		Public function Getdescription(){return $this->description;}
		Public function Getcodedouane(){return $this->codedouane;}

		Public function Setidcategorie($e){$this->idcategorie=$e;}
		Public function Setreference($e){$this->reference=$e;}
		Public function Setlibcategorie($e){$this->libcategorie=$e;}
		Public function Setdescription($e){$this->description=$e;}
		Public function Setcodedouane($e){$this->codedouane=$e;}

		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM categorie WHERE idcategorie = :idcategorie');
			$stmt->bindValue(':idcategorie',$this->idcategorie, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->idcategorie = $row['idcategorie'];
			$this->reference = $row['reference'];
			$this->libcategorie = $row['libcategorie'];
			$this->description = $row['description'];
			$this->codedouane = $row['codedouane'];
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE categorie SET supcategorie = 1 WHERE idcategorie = :idcategorie');
			$stmt->bindValue(':idcategorie',$this->idcategorie, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE categorie SET reference= :reference, libcategorie= :libcategorie, description= :description, codedouane= :codedouane WHERE idcategorie = :idcategorie');
			$stmt->bindValue(':idcategorie',$this->idcategorie, PDO::PARAM_STR);
			$stmt->bindValue(':reference',$this->reference, PDO::PARAM_STR);
			$stmt->bindValue(':libcategorie',$this->libcategorie, PDO::PARAM_STR);
			$stmt->bindValue(':description',$this->description, PDO::PARAM_STR);
			$stmt->bindValue(':codedouane',$this->codedouane, PDO::PARAM_STR);
			
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO categorie (idcategorie, reference, libcategorie, description, codedouane, supcategorie) VALUES (NULL, :reference, :libcategorie, :description, :codedouane, 0);");
			$stmt->bindValue(':idcategorie',$this->idcategorie, PDO::PARAM_STR);
			$stmt->bindValue(':rereferencef',$this->reference, PDO::PARAM_STR);
			$stmt->bindValue(':libcategorie',$this->libcategorie, PDO::PARAM_STR);
			$stmt->bindValue(':description',$this->description, PDO::PARAM_STR);
			$stmt->bindValue(':codedouane',$this->codedouane, PDO::PARAM_STR);
			
			$stmt->execute();
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM categorie WHERE supcategorie = 0");
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM categorie WHERE supcategorie = 0 " . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>