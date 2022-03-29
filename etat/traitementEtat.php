<?php
    include '../bdd.class.inc.php';
    include '../all.class.inc.php';

    if (!(isset($_POST['action'])))
    {
        header("Location: etat.vue.php");
    }

    switch ($_POST['action']) 
    {
        case 'ajouter':
            $ob = new Etat($_POST['idetat'],$_POST['libetat']);
            $ob->AddBDD($conn);
            header("Location: etat.vue.php");
            break;

        case 'supprimer':
            $ob = new Etat($_POST['idetat']);
            $ob->DelBDD($conn);
            header("Location: etat.vue.php");
            break;

        case 'modifier':
            $ob = new Etat($_POST['idetat'],$_POST['libetat']);
            $ob->SaveBDD($conn);
            header("Location: etat.vue.php");
            break;

        default:
            header("Location: etat.vue.php");
            break;
    }
?>