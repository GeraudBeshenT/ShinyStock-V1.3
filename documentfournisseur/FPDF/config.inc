<?php
	
	$dns = 'mysql:dbname=uvlight;host=127.0.0.1';
    $user = 'root';
    $password = '';
	try {
		$sql = new PDO($dns, $user, $password);
	} 
    catch (PDOException $e) 
    {
        echo 'Échec de la connexion : ' . $e->getMessage();
    }

?>