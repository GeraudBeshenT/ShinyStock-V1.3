<?php
	class Article
	{
		Private $idarticle;
		Private $libarticle;
		Private $sousfam;
		Private $reffour;
		Private $genrod;
		Private $frais;
		Private $qtecdefou;
		Private $qtestock;
		Private $cptac;
		Private $cptvem;
		Private $cptvec;
		Private $cptveom;
		Private $cptvee;
		Private $cptvecee;
		Private $commentaire;
		Private $idcategorie;
		Private $libcategorie;

		Public function __construct(string $idarticle='', string $libarticle='', string $sousfam='', string $reffour='', string $genrod='', string $frais='', string $qtecdefou='', string $qtestock='', string $cptac='', string $cptvem='', string $cptvec='', string $cptveom='', string $cptvee='', string $cptvecee='', string $commentaire='', string $idcategorie='')
		{
			$this->idarticle = $idarticle;
			$this->libarticle = $libarticle;
			$this->sousfam = $sousfam;
			$this->reffour = $reffour;
			$this->genrod = $genrod;
			$this->frais = $frais;
			$this->qtecdefou = $qtecdefou;
			$this->qtestock = $qtestock;
			$this->cptac = $cptac;
			$this->cptvem = $cptvem;
			$this->cptvec = $cptvec;
			$this->cptveom = $cptveom;
			$this->cptvee = $cptvee;
			$this->cptvecee = $cptvecee;
			$this->commentaire = $commentaire;
			$this->idcategorie = $idcategorie;
		}
		
		
		Public function Getidarticle(){return $this->idarticle;}
		Public function Getlibarticle(){return $this->libarticle;}
		Public function Getsousfam(){return $this->sousfam;}
		Public function Getreffour(){return $this->reffour;}
		Public function Getgenrod(){return $this->genrod;}
		Public function Getfrais(){return $this->frais;}
		Public function Getqtecdefou(){return $this->qtecdefou;}
		Public function Getqtestock(){return $this->qtestock;}
		Public function Getcptac(){return $this->cptac;}
		Public function Getcptvem(){return $this->cptvem;}
		Public function Getcptvec(){return $this->cptvec;}
		Public function Getcptveom(){return $this->cptveom;}
		Public function Getcptvee(){return $this->cptvee;}
		Public function Getcptvecee(){return $this->cptvecee;}
		Public function Getcommentaire(){return $this->commentaire;}
		Public function Getidcategorie(){return $this->idcategorie;}
		Public function Getlibcategorie(){return $this->libcategorie;}
		
		Public function Setidarticle($e){$this->idarticle = $e;}
		Public function Setlibarticle($e){$this->libarticle = $e;}
		Public function Setsousfam($e){$this->sousfam = $e;}
		Public function Setreffour($e){$this->reffour = $e;}
		Public function Setgenrod($e){$this->genrod = $e;}
		Public function Setfrais($e){$this->frais = $e;}
		Public function Setqtecdefou($e){$this->qtecdefou = $e;}
		Public function Setqtestock($e){$this->qtestock = $e;}
		Public function Setcptac($e){$this->cptac = $e;}
		Public function Setcptvem($e){$this->cptvem = $e;}
		Public function Setcptvec($e){$this->cptvec = $e;}
		Public function Setcptveom($e){$this->cptveom = $e;}
		Public function Setcptvee($e){$this->cptvee = $e;}
		Public function Setcptvecee($e){$this->cptvecee = $e;}
		Public function Setcommentaire($e){$this->commentaire = $e;}
		Public function Setidcategorie($e){$this->idcategorie = $e;}
		
		
		Public function GetByID($pdo)
		{
			$stmt = $pdo->prepare('SELECT *
				FROM article
				INNER JOIN categorie ON article.idcategorie=categorie.idcategorie
				WHERE idarticle = :idarticle ORDER BY idarticle');
			$stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
			$stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			$this->libarticle = $row['libarticle'];
			$this->sousfam = $row['sousfam'];
			$this->reffour = $row['reffour'];
			$this->genrod = $row['genrod'];
			$this->frais = $row['frais'];
			$this->qtecdefou = $row['qtecdefou'];
			$this->qtestock = $row['qtestock'];
			$this->cptac = $row['cptac'];
			$this->cptvem = $row['cptvem'];
			$this->cptvec = $row['cptvec'];
			$this->cptveom = $row['cptveom'];
			$this->cptvee = $row['cptvee'];
			$this->cptvecee = $row['cptvecee'];
			$this->commentaire = $row['commentaire'];
			$this->libcategorie = $row['libcategorie'];
		}
		}

		Public function DelBDD($pdo)
		{
			$stmt = $pdo->prepare('UPDATE article SET suparticle = 1 WHERE idarticle = :idarticle');
			$stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
			$stmt->execute();
		}

		Public function SaveBDD($pdo)
		{
			$stmt = $pdo->prepare("UPDATE article SET libarticle=:libarticle, sousfam=:sousfam, reffour=:reffour, genrod=:genrod, frais=:frais, qtecdefou=:qtecdefou, qtestock=:qtestock, cptac=:cptac, cptvem=:cptvem, cptvec=:cptvec, cptveom=:cptveom, cptvee=:cptvee, cptvecee=:cptvecee, commentaire=:commentaire, idcategorie=:idcategorie WHERE idarticle = :idarticle");
			$stmt->bindValue(':idarticle',$this->idarticle, PDO::PARAM_STR);
			$stmt->bindValue(':libarticle',$this->libarticle, PDO::PARAM_STR);
			$stmt->bindValue(':sousfam',$this->sousfam, PDO::PARAM_STR);
			$stmt->bindValue(':reffour',$this->reffour, PDO::PARAM_STR);
			$stmt->bindValue(':genrod',$this->genrod, PDO::PARAM_STR);
			$stmt->bindValue(':frais',$this->frais, PDO::PARAM_STR);
			$stmt->bindValue(':qtecdefou',$this->qtecdefou, PDO::PARAM_STR);
			$stmt->bindValue(':qtestock',$this->qtestock, PDO::PARAM_STR);
			$stmt->bindValue(':cptac',$this->cptac, PDO::PARAM_STR);
			$stmt->bindValue(':cptvem',$this->cptvem, PDO::PARAM_STR);
			$stmt->bindValue(':cptvec',$this->cptvec, PDO::PARAM_STR);
			$stmt->bindValue(':cptveom',$this->cptveom, PDO::PARAM_STR);
			$stmt->bindValue(':cptvee',$this->cptvee, PDO::PARAM_STR);
			$stmt->bindValue(':cptvecee',$this->cptvecee, PDO::PARAM_STR);
			$stmt->bindValue(':commentaire',$this->commentaire, PDO::PARAM_STR);
			$stmt->bindValue(':idcategorie',$this->idcategorie, PDO::PARAM_INT);
			$stmt->execute();
		}

		Public function AddBDD($pdo)
		{
			$stmt = $pdo->prepare("INSERT INTO article (idarticle, libarticle, sousfam, reffour, genrod, frais, qtecdefou, qtestock, cptac, cptvem, cptvec, cptveom, cptvee, cptvecee, commentaire, idcategorie, suparticle) VALUES (NULL, :libarticle, :sousfam, :reffour, :genrod, :frais, :qtecdefou, :qtestock, :cptac, :cptvem, :cptvec, :cptveom, :cptvee, :cptvecee, :commentaire, :idcategorie, 0);");
			/* var_dump($stmt);
            var_dump($this);
            die(); */
			$stmt->bindValue(':libarticle',$this->libarticle, PDO::PARAM_STR);
			$stmt->bindValue(':sousfam',$this->sousfam, PDO::PARAM_STR);
			$stmt->bindValue(':reffour',$this->reffour, PDO::PARAM_STR);
			$stmt->bindValue(':genrod',$this->genrod, PDO::PARAM_STR);
			$stmt->bindValue(':frais',$this->frais, PDO::PARAM_STR);
			$stmt->bindValue(':qtecdefou',$this->qtecdefou, PDO::PARAM_STR);
			$stmt->bindValue(':qtestock',$this->qtestock, PDO::PARAM_STR);
			$stmt->bindValue(':cptac',$this->cptac, PDO::PARAM_STR);
			$stmt->bindValue(':cptvem',$this->cptvem, PDO::PARAM_STR);
			$stmt->bindValue(':cptvec',$this->cptvec, PDO::PARAM_STR);
			$stmt->bindValue(':cptveom',$this->cptveom, PDO::PARAM_STR);
			$stmt->bindValue(':cptvee',$this->cptvee, PDO::PARAM_STR);
			$stmt->bindValue(':cptvecee',$this->cptvecee, PDO::PARAM_STR);
			$stmt->bindValue(':commentaire',$this->commentaire, PDO::PARAM_STR);
			$stmt->bindValue(':idcategorie',$this->idcategorie, PDO::PARAM_INT);
			$stmt->execute();
		}
		
		Public function CreateBDD($pdo)
		{
			$stmt = $pdo->prepare("");
		}

		Public function CountBDD($pdo)
		{
			$stmt = $pdo->prepare('SELECT COUNT(*) AS allcount FROM article WHERE suparticle = 0');
			$stmt->execute();
			$records = $stmt->fetch();
			return $records['allcount'];
		}

		Public function CountParamBDD($pdo,$searchQuery,$searchArray)
		{
			$stmt = $pdo->prepare('SELECT COUNT(*) AS allcount FROM article WHERE suparticle = 0 ' . $searchQuery);
			$stmt->execute($searchArray);
			$records = $stmt->fetch();
			return $records['allcount'];
		}
	}
?>