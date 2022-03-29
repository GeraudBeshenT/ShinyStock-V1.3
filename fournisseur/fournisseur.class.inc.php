<?php
    class Fournisseur
    {
        Private $idtiers;
        Private $typetiers;
        Private $nom;
        Private $adresse;
        Private $telephone;
        Private $email;
        Private $idcommune;
        Private $libcommune;
        Private $cpcommune;
        Private $prefixe;
        Private $indicprospect;
        Private $iban;
        Private $bic;
        Private $codebanque;
        Private $codeguichet;
        Private $ncompte;
        Private $clerib;
        Private $domiciliation;
        Private $tel2;
        Private $idtarif;
        Private $libtarif;
        Private $idsociete;
        Private $libsociete;
        Private $idpaiement;
        Private $libpaiement;
        Private $codefournisseur;
        Private $libfournisseur;

        Public function __construct(string $idtiers='', string $typetiers='', string $nom='', string $adresse='', string $telephone='', string $email='', string $idcommune='', string $prefixe='', string $indicprospect='', string $iban='', string $bic='', string $codebanque='', string $codeguichet='', string $ncompte='', string $clerib='', string $domiciliation='', string $tel2='', string $idtarif='', string $idsociete='', string $idpaiement='', string $codefournisseur='', string $libfournisseur='')
        {
            $this->idtiers = $idtiers;
            $this->typetiers = $typetiers;
            $this->nom = $nom;
            $this->adresse = $adresse;
            $this->telephone = $telephone;
            $this->email = $email;
            $this->idcommune = $idcommune;
            $this->prefixe = $prefixe;
            $this->indicprospect = $indicprospect;
            $this->iban = $iban;
            $this->bic = $bic;
            $this->codebanque = $codebanque;
            $this->codeguichet = $codeguichet;
            $this->ncompte = $ncompte;
            $this->clerib = $clerib;
            $this->domiciliation = $domiciliation;
            $this->tel2 = $tel2;
            $this->idtarif = $idtarif;
            $this->idsociete = $idsociete;
            $this->idpaiement = $idpaiement;
            $this->codefournisseur = $codefournisseur;
            $this->libfournisseur = $libfournisseur;
        }

        Public function Getidtiers(){return $this->idtiers;}
        Public function Gettypetiers(){return $this->typetiers;}
        Public function Getnom(){return $this->nom;}
        Public function Getadresse(){return $this->adresse;}
        Public function Gettelephone(){return $this->telephone;}
        Public function Getemail(){return $this->email;}
        Public function Getidcommune(){return $this->idcommune;}
        Public function Getlibcommune(){return $this->libcommune;}
        Public function Getcpcommune(){return $this->cpcommune;}
        Public function Getprefixe(){return $this->prefixe;}
        Public function Getindicprospect(){return $this->indicprospect;}
        Public function Getiban(){return $this->iban;}
        Public function Getbic(){return $this->bic;}
        Public function Getcodebanque(){return $this->codebanque;}
        Public function Getguichet(){return $this->codeguichet;}
        Public function Getncompte(){return $this->ncompte;}
        Public function Getclerib(){return $this->clerib;}
        Public function Getdomiciliation(){return $this->domiciliation;}
        Public function Gettel2(){return $this->tel2;}
        Public function Getidtarif(){return $this->idtarif;}
        Public function Getlibtarif(){return $this->libtarif;}
        Public function Getidsociete(){return $this->idsociete;}
        Public function Getlibsociete(){return $this->libsociete;}
        Public function Getidpaiement(){return $this->idpaiement;}
        Public function Getlibpaiement(){return $this->libpaiement;}
        Public function Getcodefournisseur(){return $this->codefournisseur;}
        Public function Getlibfournisseur(){return $this->libfournisseur;}

        Public function Setidtiers($e){$this->idtiers=$e;}
        Public function Settypetiers($e){$this->typetiers=$e;}
        Public function Setnom($e){$this->nom;}
        Public function Setadresse($e){$this->adresse;}
        Public function Settelephone($e){$this->telephone;}
        Public function Setemail($e){$this->email;}
        Public function Setidcommune($e){$this->idcommune;}
        Public function Setlibcommune($e){$this->libcommune;}
        Public function Setcpcommune($e){$this->cpcommune;}
        Public function Setprefixe($e){$this->prefixe;}
        Public function Setindicprospect($e){$this->indicprospect;}
        Public function Setiban($e){$this->iban;}
        Public function Setbic($e){$this->bic;}
        Public function Setcodebanque($e){$this->codebanque;}
        Public function Setguichet($e){$this->codeguichet;}
        Public function Setncompte($e){$this->ncompte;}
        Public function Setclerib($e){$this->clerib;}
        Public function Setdomiciliation($e){$this->domiciliation;}
        Public function Settel2($e){$this->tel2;}
        Public function Setidtarif($e){$this->idtarif;}
        Public function Setlibtarif($e){$this->libtarif;}
        Public function Setidsociete($e){$this->idsociete;}
        Public function Setlibsociete($e){$this->libsociete;}
        Public function Setidpaiement($e){$this->idpaiement;}
        Public function Setlibpaiement($e){$this->libpaiement;}
        Public function Setcodefournisseur($e){$this->codefournisseur;}
        Public function Setlibfournisseur($e){$this->libfournisseur;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM tiers WHERE idtiers = :idtiers');
            $stmt->bindValue(':idtiers',$this->idtiers, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->idtiers = $row['idtiers'];
            $this->typetiers = $row['typetiers'];
            $this->nom = $row['nom'];
            $this->adresse = $row['adresse'];
            $this->telephone = $row['telephone'];
            $this->email = $row['email'];
            $this->idcommune = $row['idcommune'];
            $this->prefixe = $row['prefixe'];
            $this->indicprospect = $row['indicprospect'];
            $this->iban = $row['iban'];
            $this->bic = $row['bic'];
            $this->codebanque = $row['codebanque'];
            $this->codeguichet = $row['codeguichet'];
            $this->ncompte = $row['ncompte'];
            $this->clerib = $row['clerib'];
            $this->domiciliation = $row['domiciliation'];
            $this->tel2 = $row['tel2'];
            $this->idcommune = $row['idcommune'];
            $this->idtarif = $row['idtarif'];
            $this->idsociete = $row['idsociete'];
            $this->idpaiement = $row['idpaiement'];
            $this->codefournisseur = $row['codefournisseur'];
            $this->libfournisseur = $row['libfournisseur'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE tiers SET suptiers = 1 WHERE idtiers = :idtiers');
            $stmt->bindValue(':idtiers',$this->idtiers, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE tiers SET typetiers = :typetiers, nom =:nom, adresse = :adresse, telephone = :telephone, email = :email, idcommune = :idcommune, prefixe = :prefixe, indicprospect = :indicprospect, iban = :iban, bic = :bic, codebanque = :codebanque, codeguichet = :codeguichet, ncompte = :ncompte, clerib = :clerib, domiciliation = :domiciliation, tel2 = :tel2, idtafit = :idtarif, idsociete = :idsociete, idpaiement = :idpaiement, codefournisseur = :codefournisseur, libfournisseur = :libfournisseur, 0 WHERE idtiers = :idtiers');
            $stmt->bindValue(':idtiers',$this->idtiers, PDO::PARAM_STR);
            $stmt->bindValue(':typetiers',$this->typetiers, PDO::PARAM_STR);
            $stmt->bindValue(':nom',$this->nom, PDO::PARAM_STR);
            $stmt->bindValue(':adresse',$this->adresse, PDO::PARAM_STR);
            $stmt->bindValue(':telephone',$this->telephone, PDO::PARAM_STR);
            $stmt->bindValue(':email',$this->email, PDO::PARAM_STR);
            $stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
            $stmt->bindValue(':prefixe',$this->prefixe, PDO::PARAM_STR);
            $stmt->bindValue(':indicprospect',$this->indicprospect, PDO::PARAM_STR);
            $stmt->bindValue(':iban',$this->iban, PDO::PARAM_STR);
            $stmt->bindValue(':bic',$this->bic, PDO::PARAM_STR);
            $stmt->bindValue(':codebanque',$this->codebanque, PDO::PARAM_STR);
            $stmt->bindValue(':codeguichet',$this->codeguichet, PDO::PARAM_STR);
            $stmt->bindValue(':ncompte',$this->ncompte, PDO::PARAM_STR);
            $stmt->bindValue(':clerib',$this->clerib, PDO::PARAM_STR);
            $stmt->bindValue(':domiciliation',$this->domiciliation, PDO::PARAM_STR);
            $stmt->bindValue(':tel2',$this->tel2, PDO::PARAM_STR);
            $stmt->bindValue(':idtarif',$this->idtarif, PDO::PARAM_STR);
            $stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
            $stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
            $stmt->bindValue(':codefournisseur',$this->codefournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':libfournisseur',$this->libfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO tiers (idtiers, typetiers, nom, adresse, telephone, email, idcommune, prefixe, indicprospect, iban, bic, codebanque, codeguichet, ncompte, clerib, domiciliation, tel2, idtarif, idsociete, idpaiement, codefournisseur, libfournisseur, suptiers) VALUES (NULL, :typetiers, :nom, :adresse, :telephone, :email, :idcommune, :prefixe, :indicprospect, :iban, :bic, :codebanque, :codeguichet, :ncompte, :clerib, :domiciliation, :tel2, :idtarif, :idsociete, :idpaiement, :codefournisseur, :libfournisseur, 0);");
            //  var_dump($stmt);
            // var_dump($this);
            // die(); 
            $stmt->bindValue(':typetiers',$this->typetiers, PDO::PARAM_STR);
            $stmt->bindValue(':nom',$this->nom, PDO::PARAM_STR);
            $stmt->bindValue(':adresse',$this->adresse, PDO::PARAM_STR);
            $stmt->bindValue(':telephone',$this->telephone, PDO::PARAM_STR);
            $stmt->bindValue(':email',$this->email, PDO::PARAM_STR);
            $stmt->bindValue(':idcommune',$this->idcommune, PDO::PARAM_STR);
            $stmt->bindValue(':prefixe',$this->prefixe, PDO::PARAM_STR);
            $stmt->bindValue(':indicprospect',$this->indicprospect, PDO::PARAM_STR);
            $stmt->bindValue(':iban',$this->iban, PDO::PARAM_STR);
            $stmt->bindValue(':bic',$this->bic, PDO::PARAM_STR);
            $stmt->bindValue(':codebanque',$this->codebanque, PDO::PARAM_STR);
            $stmt->bindValue(':codeguichet',$this->codeguichet, PDO::PARAM_STR);
            $stmt->bindValue(':ncompte',$this->ncompte, PDO::PARAM_STR);
            $stmt->bindValue(':clerib',$this->clerib, PDO::PARAM_STR);
            $stmt->bindValue(':domiciliation',$this->domiciliation, PDO::PARAM_STR);
            $stmt->bindValue(':tel2',$this->tel2, PDO::PARAM_STR);
            $stmt->bindValue(':idtarif',$this->idtarif, PDO::PARAM_STR);
            $stmt->bindValue(':idsociete',$this->idsociete, PDO::PARAM_STR);
            $stmt->bindValue(':idpaiement',$this->idpaiement, PDO::PARAM_STR);
            $stmt->bindValue(':codefournisseur',$this->codefournisseur, PDO::PARAM_STR);
            $stmt->bindValue(':libfournisseur',$this->libfournisseur, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM tiers WHERE suptiers = 0 AND typetiers = 1");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM tiers WHERE suptiers = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>