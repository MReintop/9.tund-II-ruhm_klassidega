<?php

	require("../../config.php");
	require("Interest.class.php");
	require("Car.class.php");
	require("User.class.php");
	require("Helper.class.php");
	
	
	//ÜHENDUS
	
	$database = "if16_mreintop";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	
	$User = new User($mysqli);
	$Interest = new Interest($mysqli);
	$Car = new Car($mysqli);
	$Helper = new Helper($mysqli);
	
	
	
	
	// see fail, peab olema kõigil lehtedel kus 
	// tahan kasutada SESSION muutujat
	session_start();
	
	//***************
	//**** SIGNUP ***
	//***************
	
	
	
	
	

	
	
	
	
	
	
	/*function sum($x, $y) {
		
		return $x + $y;
		
	}
	
	
	function hello($firsname, $lastname) {
		
		return "Tere tulemast ".$firsname." ".$lastname."!";
		
	}
	
	echo sum(5123123,123123123);
	echo "<br>";
	echo hello("Romil", "Robtsenkov");
	echo "<br>";
	echo hello("Juku", "Juurikas");
	*/

?>