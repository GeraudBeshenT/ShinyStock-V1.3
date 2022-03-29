<?php

include '../bdd.class.inc.php';
include '../all.class.inc.php';

$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = $_POST['search']['value'];

$searchArray = array();

$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " AND (num_documents LIKE :num_documents "
            . "OR date_document LIKE :date_document "
            . "OR commentaire LIKE :commentaire "
            . "OR statut LIKE :statut "
            . "OR id_etat LIKE :id_etat "
            . "OR id_tiers LIKE :id_tiers)";
    $searchValue = str_replace(" ","%%",$searchValue);
    $searchArray = array(
        'num_documents' => "%$searchValue%",
        'date_document' => "%$searchValue%",
        'commentaire' => "%$searchValue%",
        'statut' => "%$searchValue%",
        'id_etat' => "%$searchValue%",
        'id_tiers' => "%$searchValue%"
    );
}

//$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM casiers WHERE b_supcasiers = 0");
//$stmt->execute();
//$records = $stmt->fetch();
//$totalRecords = $records['allcount'];
//
//$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM casiers WHERE b_supcasiers = 0 " . $searchQuery);
//$stmt->execute($searchArray);
//$records = $stmt->fetch();
//$totalRecordwithFilter = $records['allcount'];

$ob = new Document();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

// $stmt = $conn->prepare("SELECT * FROM document INNER JOIN tarif ON document.id_tarif = tarif.id_tarif WHERE (b_supdocument = 0 AND type_document  = 0) AND (num_documents LIKE '%1%')  OR (Nom LIKE '%1%') OR (email LIKE '%1%') OR (téléphone LIKE '%1%') OR (lib_tarif LIKE '%1%');");

$stmt = $conn->prepare("SELECT * FROM document INNER JOIN tiers ON document.id_tiers = tiers.id_tiers INNER JOIN communes ON document.id_etat = etat.id_etat WHERE b_supdocument = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

foreach ($searchArray as $key => $search) 
{
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
    if ($row['b_supdocument'] == 0) {
        $ob = new Document($row['num_documents']);
        $ob->GetByID($conn);
        $data[] = array(
            "num_documents" => $row['num_documents'],
            "date_document" => $row['date_document'],
            "commentaire" => $row['commentaire'],
            "statut" => $row['statut'],
            "id_etat" => $row['id_etat'],
            "id_tiers" => $row['id_tiers'],
            "actions" => "<div class='btn-group'>"
            // ."<form method='POST' action='../modif/modifDocument.php'>"
                // . "<button type='submit' class='btn btn-success'>Modifier</button>"
                // . "<input name='id' type='hidden' value='" . $row['num_documents'] . "'/>"
                // . "<input name='type' type='hidden' value='Document'/>"
                // . "<input name='action' type='hidden' value='modifier'/>"
            // . "</form> &nbsp"

    // Formulaire en modale du datatable article
            // Liaison page traitement
            . "<form method='POST' action='traitementDocument.php'>"
            // Boutton suppression de la ligne en fonction de l'num_documents
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='id' type='hidden' value='" . $row['num_documents'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form> &nbsp"
            // Boutton modifier l'Document en fonction de l'num_documents
            . " <button type='button' class='btn btn-primary rounded-pill' data-toggle='modal' data-target='#A". $row['num_documents'] ."'><i class='fa fa-edit'></i></button> &nbsp"
            
            . "<form method='POST' action='traitementDocument.php'>"
            // Boutton suppression de la ligne en fonction de l'num_documents
                . "<button type='submit' class='btn btn-info rounded-pill'><i class='fa fa-eye white'></i></button>"
                . "<input name='id' type='hidden' value='" . $row['num_documents'] . "'/>"
                . "<input name='tarif' type='hidden' value='" . $row['id_tarif'] . "'/>"
                . "<input name='Domiciliation' type='hidden' value='" . $row['domiciliation'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='voir'/>"
            . "</form></div>"
// . "<a class='btn btn-info rounded-pill' value='voir' href='../vues/Document.php?num_documents=".$row['num_documents']."'><i class='fa fa-eye white'></i></a>"
            
            
            . "<div class='modal fade' id='A".  $row['num_documents'] ."' tabindex='-1' role='dialog' aria-labelledby='purchaseLabel' aria-hidden='true'>"
            . "    <div class='modal-dialog modal-lg'>"
            . "        <div class='modal-content'>"
            . "            <div class='modal-header'>"
            // Récupération du Nom pour le mettre en titre dnas le modale
            . "                <h4 class='modal-title' id='purchaseLabel'>". $row['date_documents'] ."</h4>"
            . "            </div>"
            // Liaison à la page de traitement
            . "            <form method='POST' action='traitementDocument.php'>"
            . "                 <div class='modal-body'>"
            . "                     <div class='row'>"
            // Récupération de l'id (cacher) avec la fonction Get de la Document.class.inc.php
            . "                         <input name='id' type='hidden' value='".$ob->GetID()."'/>"
            . "                         <div class='col-4'>Nom: "
            // Récupération du nom avec la fonction Get de la Document.class.inc.php
            . "                             <input name='Nom' type='text' value='".$ob->GetNom()."' required/><br>"
            . "                         </div>"
            . "                         <div class='col-4'>Ville: "
            // Récupération de la ville avec la fonction Get de la Document.class.inc.php
            . "                             <input name='Ville' type='text' value='".$ob->GetVille()->GetID()."' required/><br>"
            . "                         </div>"
            . "                         <div class='col-4'>Email:"
            // Récupération de l'email avec la fonction Get de la Document.class.inc.php
            . "                             <input name='email' type='text' value='".$ob->GetEmail()."'/><br>"
            . "                         </div>"
            . "                         <div class='col-4'>Paiement:"
            // Récupération de l'id du type de paiement avec la fonction Get de la Document.class.inc.php
            . "                             <input name='Paiement' type='text' value='".$ob->GetPaiement()->GetID()."' required/><br>"
            . "                         </div>"
            . "                         <div class='col-4'>Indic Prospect:"
            // Récupération de l'id de l'indicPro avec la fonction Get de la Document.class.inc.php
            . "                             <input name='IndicProspect' type='text' value='".$ob->GetIndicProspect()."'/><br>"
            . "                         </div>"
            . "                         <div class='col-4'>Iban:"
            // Récupération de l'iban avec la fonction Get de la Document.class.inc.php
            . "                             <input name='Iban' type='text' value='".$ob->GetIban()."'/><br>"
            . "                         </div>"
            . "                         <div class='col-4'>Tarif:"
            // Récupération de l'id du tarif avec la fonction Get de la Document.class.inc.php
            . "                             <input name='tarif' type='text' value='".$ob->GetTarif()->GetID()."' required/><br>"
            . "                         </div>"
            // Boutton d'action récupérée ensuite dans le traitement venant update la table Document
            . "                         <input name='action' type='hidden' value='modifier'/>"
            . "                     </div>"
            . "            </div>"
            // Bouttons supprimer et annuler.
            . "            <div class='modal-footer'>"
            . "                <button type='submit' class='button bg_green-radius_5 rounded-pill'>Sauvegarder</button>"
            . "                <button type='button' class='btn btn-danger rounded-pill' data-dismiss='modal'>fermer</button>"
            . "            </div>"
            . "            </form>"
            . "        </div>"
            . "    </div>"
            . "</div>",
        );
    }
}

$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
?>