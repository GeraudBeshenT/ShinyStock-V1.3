<?php

    include '../bdd.class.inc.php';
    include '../all.class.inc.php';

    if (!(isset($_POST['action'])))
    {
        header("Location: tarif.vue.php");
    }

    switch ($_POST['action']) 
    {
        case 'ajouter':
            $ob = new Tarif($_POST['idtarif'],$_POST['libtarif']);
            $ob->AddBDD($conn);
            header("Location: tarif.vue.php");
            break;

        case 'supprimer':
            $ob = new Tarif($_POST['idtarif']);
            $ob->DelBDD($conn);
            header("Location: tarif.vue.php");
            break;

        case 'modifier':
            $ob = new Tarif($_POST['idtarif'],$_POST['libtarif']);
            $ob->SaveBDD($conn);
            header("Location: tarif.vue.php");
            break;

        default:
            header("Location: tarif.vue.php");
            break;
    }
?>