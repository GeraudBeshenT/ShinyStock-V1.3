<?php
	class Tarif
	{
		Private $idtarif;
		Private $libtarif;

		Public function __construct(string $cidtarif='', string $clibtarif='')
		{
			$this->idtarif = $cidtarif;
			$this->libtarif = $clibtarif;
		}

		Public function Getidtarif(){return $this->idtarif;}
		Public function Getlibtarif(){return $this->libtarif;}

		Public function Setidtarif($e){$this->idtarif=$e;}
		Public function Setlibtarif($e){$this->libtarif=$e;}

		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT * FROM tarif WHERE idtarif = :idtarif');
			$stmt->bindValue(':idtarif',$this->idtarif, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch();
			$this->idtarif = $row['idtarif'];
			$this->libtarif = $row['libtarif'];
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE tarif SET suptarif = 1 WHERE idtarif = :idtarif');
			$stmt->bindValue(':idtarif',$this->idtarif, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE tarif SET libtarif= :libtarif WHERE idtarif = :idtarif');
			$stmt->bindValue(':idtarif',$this->idtarif, PDO::PARAM_STR);
			$stmt->bindValue(':libtarif',$this->libtarif, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO tarif (idtarif, libtarif, suptarif) VALUES (NULL, :libtarif, 0);");
			$stmt->bindValue(':libtarif',$this->libtarif, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM tarif WHERE suptarif = 0");
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM tarif WHERE suptarif = 0 " . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>