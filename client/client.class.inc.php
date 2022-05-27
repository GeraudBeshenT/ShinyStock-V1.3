<?php
	class Client
	{
        Private $idclient;
        Private $nomclient;
        Private $adresseclient;
        Private $telephoneclient;
        Private $emailclient;
        Private $idcommune;
        Private $libcommune;
        Private $prefixeclient;
        Private $indicprospect;
        Private $iban;
        Private $bic;
        Private $codebanque;
        Private $codeguichet;
        Private $ncompte;
        Private $clerib;
        Private $domiciliation;
        Private $tel2;
        Private $idpaiement;
        Private $libpaiement;

		Public function __construct( string $idclient = '', string $nomclient = '', string $adresseclient = '', string $telephoneclient = '', string $emailclient = '', string $idcommune = '', string $prefixeclient = '', string $indicprospect = '', string $iban = '', string $bic = '', string $codebanque = '', string $codeguichet = '', string $ncompte = '', string $clerib = '', string $domiciliation = '', string $tel2 = '', string $idpaiement = '')
		{
            $this->idclient = $idclient;
            $this->nomclient = $nomclient;
            $this->adresseclient = $adresseclient;
            $this->telephoneclient = $telephoneclient;
            $this->emailclient = $emailclient;
            $this->idcommune = $idcommune;
            $this->prefixeclient = $prefixeclient;
            $this->indicprospect = $indicprospect;
            $this->iban = $iban;
            $this->bic = $bic;
            $this->codebanque = $codebanque;
            $this->codeguichet = $codeguichet;
            $this->ncompte = $ncompte;
            $this->clerib = $clerib;
            $this->domiciliation = $domiciliation;
            $this->tel2 = $tel2;
            $this->idpaiement = $idpaiement;
		}

		Public function Getidclient(){return $this->idclient;}
		Public function Getnomclient(){return $this->nomclient;}
		Public function Getadresseclient(){return $this->adresseclient;}
		Public function Gettelephoneclient(){return $this->telephoneclient;}
		Public function Getemailclient(){return $this->emailclient;}
		Public function Getidcommune(){return $this->idcommune;}
        Public function Getlibcommune(){return $this->libcommune;}
		Public function Getcpcommune(){return $this->cpcommune;}
		Public function Getprefixeclient(){return $this->prefixeclient;}
		Public function Getindicprospect(){return $this->indicprospect;}
		Public function Getiban(){return $this->iban;}
		Public function Getbic(){return $this->bic;}
		Public function Getcodebanque(){return $this->codebanque;}
		Public function Getcodeguichet(){return $this->codeguichet;}
		Public function Getncompte(){return $this->ncompte;}
		Public function Getclerib(){return $this->clerib;}
		Public function Getdomiciliation(){return $this->domiciliation;}
		Public function Gettel2(){return $this->tel2;}
		Public function Getidpaiement(){return $this->idpaiement;}
		Public function Getlibpaiement(){return $this->libpaiement;}

		Public function Setidclient(int $e){$this->idclient = $e;}
		Public function Setnomclient(string $e){$this->nomclient;}
		Public function Setadresseclient(string $e){$this->adresseclient;}
		Public function Settelephoneclient(string $e){$this->telephoneclient;}
		Public function Setemailclient(string $e){$this->emailclient;}
		Public function Setidcommune(int $e){$this->idcommune;}
		Public function Setprefixeclient(int $e){$this->prefixeclient;}
		Public function Setindicprospect(string $e){$this->indicprospect;}
		Public function Setiban(string $e){$this->iban;}
		Public function Setbic(string $e){$this->bic;}
		Public function Setcodebanque(string $e){$this->codebanque;}
		Public function Setcodeguichet(string $e){$this->codeguichet;}
		Public function Setncompte(string $e){$this->ncompte;}
		Public function Setclerib(string $e){$this->clerib;}
		Public function Setdomiciliation(string $e){$this->domiciliation;}
		Public function Settel2(string $e){$this->tel2;}
		Public function Setidpaiement(int $e){$this->idpaiement;}


		Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT *
                FROM client
                INNER JOIN commune ON client.idcommune=commune.idcommune
                INNER JOIN paiement ON client.idpaiement=paiement.idpaiement
                WHERE supclient = 0 AND idclient = :idclient;');
            $stmt->bindValue(':idclient',$this->idclient, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                $this->idclient = $row['idclient'];
                $this->nomclient = $row['nomclient'];
                $this->adresseclient = $row['adresseclient'];
                $this->telephoneclient = $row['telephoneclient'];
                $this->emailclient = $row['emailclient'];
                $this->libcommune = $row['libcommune'];
                $this->cpcommune = $row['cpcommune'];
                $this->prefixeclient = $row['prefixeclient'];
                $this->indicprospect = $row['indicprospect'];
                $this->iban = $row['iban'];
                $this->bic = $row['bic'];
                $this->codebanque = $row['codebanque'];
                $this->codeguichet = $row['codeguichet'];
                $this->ncompte = $row['ncompte'];
                $this->clerib = $row['clerib'];
                $this->domiciliation = $row['domiciliation'];
                $this->tel2 = $row['tel2'];
                $this->libpaiement = $row['libpaiement'];
            }
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE client SET supclient = 1 WHERE idclient = :idclient');
            $stmt->bindValue(':idclient',$this->idclient, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE client SET nomclient = :nomclient, adresseclient = :adresseclient, telephoneclient = :telephoneclient, emailclient = :emailclient, idcommune = :idcommune, prefixeclient= :prefixeclient, indicprospect = :indicprospect, iban = :iban, bic = :bic, codebanque = :codebanque, codeguichet = :codeguichet, ncompte = :ncompte, clerib = :clerib, domiciliation = :domiciliation, tel2 = :tel2 WHERE idclient = :idclient');
            $stmt->bindValue(':idclient',$this->idclient, PDO::PARAM_STR);
            $stmt->bindValue(':nomclient',$this->nomclient, PDO::PARAM_STR);
            $stmt->bindValue(':adresseclient',$this->adresseclient, PDO::PARAM_STR);
            $stmt->bindValue(':telephoneclient',$this->telephoneclient, PDO::PARAM_STR);
            $stmt->bindValue(':emailclient',$this->emailclient, PDO::PARAM_STR);
            $stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_INT);
            $stmt->bindValue(':prefixeclient',$this->prefixeclient, PDO::PARAM_STR);
            $stmt->bindValue(':indicprospect',$this->indicprospect, PDO::PARAM_INT);
            $stmt->bindValue(':iban',$this->iban, PDO::PARAM_INT);
            $stmt->bindValue(':bic',$this->bic, PDO::PARAM_STR);
            $stmt->bindValue(':codebanque',$this->codebanque, PDO::PARAM_STR);
            $stmt->bindValue(':codeguichet',$this->codeguichet, PDO::PARAM_STR);
            $stmt->bindValue(':ncompte',$this->ncompte, PDO::PARAM_STR);
            $stmt->bindValue(':clerib',$this->clerib, PDO::PARAM_STR);
            $stmt->bindValue(':domiciliation',$this->domiciliation, PDO::PARAM_STR);
            $stmt->bindValue(':tel2',$this->tel2, PDO::PARAM_STR);
            $stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_INT);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO client (idclient, nomclient, adresseclient, telephoneclient, emailclient, idcommune, prefixeclient, indicprospect, iban, bic, codebanque, codeguichet, ncompte, clerib, domiciliation, tel2, idpaiement, supclient) VALUES (NULL, :nomclient, :adresseclient, :telephoneclient, :emailclient, :idcommune, :prefixeclient, :indicprospect, :iban, :bic, :codebanque, :codeguichet, :ncompte, :clerib, :domiciliation, :tel2, :idpaiement, 0);");
            //  var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':nomclient',$this->nomclient, PDO::PARAM_STR);
            $stmt->bindValue(':adresseclient',$this->adresseclient, PDO::PARAM_STR);
            $stmt->bindValue(':telephoneclient',$this->telephoneclient, PDO::PARAM_STR);
            $stmt->bindValue(':emailclient',$this->emailclient, PDO::PARAM_STR);
            $stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_INT);
            $stmt->bindValue(':prefixeclient',$this->prefixeclient, PDO::PARAM_STR);
            $stmt->bindValue(':indicprospect',$this->indicprospect, PDO::PARAM_INT);
            $stmt->bindValue(':iban',$this->iban, PDO::PARAM_INT);
            $stmt->bindValue(':bic',$this->bic, PDO::PARAM_STR);
            $stmt->bindValue(':codebanque',$this->codebanque, PDO::PARAM_STR);
            $stmt->bindValue(':codeguichet',$this->codeguichet, PDO::PARAM_STR);
            $stmt->bindValue(':ncompte',$this->ncompte, PDO::PARAM_STR);
            $stmt->bindValue(':clerib',$this->clerib, PDO::PARAM_STR);
            $stmt->bindValue(':domiciliation',$this->domiciliation, PDO::PARAM_STR);
            $stmt->bindValue(':tel2',$this->tel2, PDO::PARAM_STR);
            $stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
            var_dump($stmt);
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM client WHERE supclient = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM client WHERE supclient = 0" . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>