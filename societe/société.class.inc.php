<?php
	class Societe
	{
		Private $idsociete;
		Private $libsociete;

		Public function __construct(string $cidsociete='', string $clibsociete='')
		{
			$this->idsociete = $cidsociete;
			$this->libsociete = $clibsociete;
		}

		Public function Getidsociete(){return $this->idsociete;}
		Public function Getlibsociete(){return $this->libsociete;}

		Public function Setidsociete($e){$this->idsociete=$e;}
		Public function Setlibsociete($e){$this->libsociete=$e;}

		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM societe WHERE idsociete = :idsociete');
			$stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->idsociete = $row['idsociete'];
			$this->libsociete = $row['libsociete'];
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE societe SET supsociete = 1 WHERE idsociete = :idsociete');
			$stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE societe SET libsociete= :libsociete WHERE idsociete = :idsociete');
			$stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
			$stmt->bindValue(':libsociete',$this->libsociete, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO societe (idsociete, libsociete, supsociete) VALUES (NULL, :libsociete, 0);");
			$stmt->bindValue(':libsociete',$this->libsociete, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM societe WHERE supsociete = 0");
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM societe WHERE supsociete = 0 " . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>