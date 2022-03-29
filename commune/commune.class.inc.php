<?php
	class Commune
	{
		Private $idcommune;
		Private $libcommune;
		Private $cpcommune;

		Public function __construct(string $idcommune='', string $libcommune='', string $cpcommune='')
		{
			$this->idcommune = $idcommune;
			$this->libcommune = $libcommune;
			$this->cpcommune = $cpcommune;
		}

		Public function Getidcommune(){return $this->idcommune;}
		Public function Getlibcommune(){return $this->libcommune;}
		Public function Getcpcommune(){return $this->cpcommune;}

		Public function Setidcommune($e){$this->idcommune=$e;}
		Public function Setlibcommune($e){$this->libcommune=$e;}
		Public function Setcpcommune($e){$this->cpcommune=$e;}

		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM commune WHERE idcommune = :idcommune');
			$stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->idcommune = $row['idcommune'];
			$this->libcommune = $row['libcommune'];
			$this->cpcommune = $row['cpcommune'];
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE commune SET supcommune = 1 WHERE idcommune = :idcommune');
			$stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE commune SET libcommune= :libcommune, cpcommune= :cpcommune WHERE idcommune = :idcommune');
			$stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
			$stmt->bindValue(':libcommune',$this->libcommune, PDO::PARAM_STR);
			$stmt->bindValue(':cpcommune',$this->cpcommune, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO commune (idcommune, libcommune, supcommune, cpcommune) VALUES (NULL, :libcommune, 0,:cpcommune);");
			$stmt->bindValue(':libcommune',$this->libcommune, PDO::PARAM_STR);
			$stmt->bindValue(':cpcommune',$this->cpcommune, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM commune WHERE supcommune = 0");
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM commune WHERE supcommune = 0 " . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>