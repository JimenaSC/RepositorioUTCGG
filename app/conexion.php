<?php
	$usuario = "root";
	$pass = "";
	$host = "localhost";
	$dbname = "repositorio";
	try {
		$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $usuario, $pass);

		
	} catch (PDOException $e) {
	    print "¡Error!: " . $e->getMessage() . "<br/>";
	    die();
	}


?>