<?php
	class Casier
	{
        Private $idcasier;
        Private $libcasier;
        Private $idarticle;
        Private $libarticle;

		Public function __construct(string $idcasier = '', string $libcasier = '', string $idarticle = '', string $libarticle = '')
		{
            $this->idcasier = $idcasier;
            $this->libcasier = $libcasier;
            $this->idarticle = $idarticle;
		}

		Public function Getidcasier(){return $this->idcasier;}
		Public function Getlibcasier(){return $this->libcasier;}
		Public function Getidarticle(){return $this->idarticle;}
		Public function Getlibarticle(){return $this->libarticle;}

		Public function Setidcasier(int $e){$this->idcasier = $e;}
		Public function Setlibcasier(string $e){$this->libcasier;}
		Public function Setidarticle(int $e){$this->idarticle;}

		Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT *
                FROM casier
                INNER JOIN article ON casier.idarticle=article.idarticle
                WHERE idcasier = :idcasier;');
            $stmt->bindValue(':idcasier',$this->idcasier, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                $this->libcasier = $row['libcasier'];
                $this->libarticle = $row['libarticle'];
            }
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE casier SET supcasier = 1 WHERE idcasier = :idcasier');
            $stmt->bindValue(':idcasier',$this->idcasier, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE casier SET libcasier = :libcasier, idarticle = :idarticle WHERE idcasier = :idcasier');
            $stmt->bindValue(':libcasier',$this->libcasier, PDO::PARAM_STR);
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_INT);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO casier (idcasier, libcasier, idarticle, supcasier) VALUES (NULL, :libcasier, :idarticle, 0);");
            //  var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':libcasier',$this->libcasier, PDO::PARAM_STR);
            $stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
            var_dump($stmt);
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM casier WHERE supcasier = 0 ");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM casier WHERE supcasier = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>