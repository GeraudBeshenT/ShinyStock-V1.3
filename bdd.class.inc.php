<?php
// connection à la base de donnée shinystock.
try 
{
    $conn = new PDO("mysql:host=127.0.0.1;dbname=dd", "root", "");
    $conn->exec("SET CHARACTER SET utf8");
} 
catch (PDOException $except) 
{
    echo "echec de connexion", $except->getMessage();
}

?>

