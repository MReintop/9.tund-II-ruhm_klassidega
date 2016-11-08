cleaninput

<?php
class Helper {
	
	private $connection;
	public $name;
	
	function __construct($mysqli){
		
		//This viitab klassile (THIS ==USER)
		$this->connection = $mysqli;
		
	}
	
		function cleanInput($input){
		
		$input = trim($input);           
		$input = htmlspecialchars($input);
		$input = stripslashes($input);
		
	    return $input;
	}
	
	/*TEISED FUNKTSIOONID*/
}

?>
