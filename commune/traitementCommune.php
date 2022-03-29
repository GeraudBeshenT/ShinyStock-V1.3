<?php

    include '../bdd.class.inc.php';
    include '../all.class.inc.php';

    if (!(isset($_POST['action'])))
    {
        header("Location: commune.vue.php");
    }

    switch ($_POST['action']) 
    {
        case 'ajouter':
            $ob = new Commune($_POST['idcommune'],$_POST['libcommune'],$_POST['cpcommune']);
            $ob->AddBDD($conn);
            header("Location: commune.vue.php");
            break;

        case 'supprimer':
            $ob = new Commune($_POST['idcommune']);
            $ob->DelBDD($conn);
            header("Location: commune.vue.php");
            break;

        case 'modifier':
            $ob = new Commune($_POST['idcommune'],$_POST['libcommune'],$_POST['cpcommune']);
            $ob->SaveBDD($conn);
            header("Location: commune.vue.php");
            break;

        default:
            header("Location: commune.vue.php");
            break;
    }
?>