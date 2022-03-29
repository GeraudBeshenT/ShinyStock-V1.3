<?php
	class Produit
	{
		Private $ID;
		Private $nom_article;
		Private $qte_article;

		Public function __construct(int $aID = 0, string $anom_article='', string $aqte_article='')
		{
			$this->ID = $aID;
			$this->nom_article = $anom_article;
			$this->qte_article = $aqte_article;
		}

		Public function GetID(){return $this->ID;}
		Public function Getnomarticle(){return $this->nom_article;}
		Public function Getqtearticle(){return $this->qte_article;}

		Public function SetID(int $e){$this->ID = $e;}
		Public function Setnomarticle(string $e){$this->nom_article = $e;}
		Public function Setqtearticle(string $e){$this->qte_article = $e;}

		Public function GetProduitByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM compose');
            $stmt->bindValue(':id',$this->ID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
			$this->ID = $row['id_article_produit'];
        }

        Public function DelProduitBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE compose SET b_supcompose = 1');
            $stmt->bindValue(':id',$this->ID, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveProduitBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE article SET nom_article = :nom, qte_article = :qte WHERE id_article = :id');
            $stmt->bindValue(':id',$this->ID, PDO::PARAM_STR);
            $stmt->bindValue(':nom',$this->nom_article, PDO::PARAM_STR);
            $stmt->bindValue(':qte',$this->qte_article, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddProduitBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO article (id_article, nom_article, sous_fam, ref_four, gencod, frais, qte_cde_fou, qte_stock, cpt_ac, cpt_ve_m, cpt_ve_c, cpt_ve_om, cpt_ve_e, cpt_ve_cee, commentaire, id_categorie, b_suparticle)
            	VALUES (NULL, :nom, :sous_fam, :ref_four, :gencod, :frais, :qte_cde_fou, :qte_stock, :cpt_ac, :cpt_ve_m, :cpt_ve_c, :cpt_ve_om, :cpt_ve_e, :cpt_ve_cee, :commentaire, :id_categorie, 0);");
            $stmt->bindValue(':nom',$this->nom, PDO::PARAM_STR);
            $stmt->bindValue(':sous_fam',$this->sous_fam, PDO::PARAM_STR);
            $stmt->bindValue(':ref_four',$this->four, PDO::PARAM_STR);
            $stmt->bindValue(':gencod',$this->gencod, PDO::PARAM_STR);
            $stmt->bindValue(':frais',$this->frais, PDO::PARAM_STR);
            $stmt->bindValue(':qte_cde_fou',$this->qte_cde_fou, PDO::PARAM_STR);
            $stmt->bindValue(':qte_stock',$this->qte_stock, PDO::PARAM_STR);
            $stmt->bindValue(':cpt_ac',$this->cpt_ac, PDO::PARAM_STR);
            $stmt->bindValue(':cpt_ve_m',$this->cpt_ve_m, PDO::PARAM_STR);
            $stmt->bindValue(':cpt_ve_c',$this->cpt_ve_c, PDO::PARAM_STR);
            $stmt->bindValue(':cpt_ve_om',$this->cpt_ve_om, PDO::PARAM_STR);
            $stmt->bindValue(':cpt_ve_e',$this->cpt_ve_e, PDO::PARAM_STR);
            $stmt->bindValue(':cpt_ve_cee',$this->cpt_ve_cee, PDO::PARAM_STR);
            $stmt->bindValue(':commentaire',$this->comm, PDO::PARAM_STR);
            $stmt->bindValue(':id_categorie',$this->idcat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountProduitBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM compose WHERE b_supcompose = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountProduitParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM compose WHERE b_supcompose = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
		
		Public function AddComposant($pdo,$article,$quantite)
		{
			$stmt = $pdo->prepare("INSERT INTO compose VALUES (:produit,:article,:quantite, 0)");
            $stmt->bindValue(':produit',$this->ID, PDO::PARAM_INT);
            $stmt->bindValue(':article',$article, PDO::PARAM_INT);
            $stmt->bindValue(':quantite',$quantite, PDO::PARAM_INT);
			$stmt->execute();
		}

        public function produire(int $quantite = 0,  $jsonData, $conn)
        {
            $this->updateComposantQuantite($quantite, $jsonData, $conn);
            $this->updateProduitQuantite($quantite, $conn);
        }
    
        public function updateComposantQuantite(int $quantite = 0, $jsonData, $conn)
        {
            foreach ($jsonData as $article) {
                try {
                    $stmt = $conn->prepare('UPDATE article SET Qte_stock = Qte_stock - :qte_p*:quantite WHERE id_article = :id');
                    $stmt->bindValue(':id', $article['id'], PDO::PARAM_INT);
                    $stmt->bindValue(':qte_p', $article['qte_p'], PDO::PARAM_INT);
                    $stmt->bindValue(':quantite', $quantite, PDO::PARAM_INT);
                    $stmt->execute();
                } catch (Exception $ex) {
                    
                }
            }
        }
        public function updateProduitQuantite(int $quantite = 0, $conn)
        {
            try {
                $stmt = $conn->prepare('UPDATE article SET Qte_stock = Qte_stock + :quantite WHERE id_article = :id_article');
                $stmt->bindValue(':id_article', $this->ID, PDO::PARAM_INT);
                $stmt->bindValue(':quantite', $quantite, PDO::PARAM_INT);
                $stmt->execute();
            } catch (Exception $ex) {
                
            }
        }
    }
?>