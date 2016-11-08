

<?php
class Car {
	
	private $connection;
	public $name;
	
	function __construct($mysqli){
		
		//This viitab klassile (THIS ==USER)
		$this->connection = $mysqli;
		
	}
	function saveCar ($plate, $color) {
		
	

		$stmt = $this->connection->prepare("INSERT INTO cars_and_colors (plate, color) VALUES (?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("ss", $plate, $color);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		
		
	}
	
	
	function getAllCars($q, $sort, $direction) {
		//mis sort ja järjekord
		$allowedSortOptions = ["id", "plate", "color"];
		//kas sort on lubatud valikute sees
		if(!in_array($sort,$allowedSortOptions)){
			$sort = "id";
		} 
		echo "Sorteerin ...";
	//TURVALISELT LUBAN 2 VALIKUT
		$orderBy = "ASC"; //vaikimisi
		if($direction == "descending"){
			$orderBy="DESC";
		}
		
		if($q == ""){
			echo"ei otsi";
			$stmt = $this->connection->prepare("
			SELECT id, plate, color
			FROM cars_and_colors
			WHERE deleted IS NULL
			ORDER BY $sort $orderBy
		");
		
		} else {
		echo "Otsib ...".$q;
			//Teen otsisõna
			//Lisan mõelmale poole %
			$searchWord = "%".$q."%";
			$stmt = $this->connection->prepare("
			SELECT id, plate, color
			FROM cars_and_colors
			WHERE deleted IS NULL AND (plate LIKE ? OR color LIKE ?)ORDER BY $sort $orderBy
		");
			$stmt->bind_param("ss", $searchWord,$searchWord );
		}
		
		
		echo $this->connection->error;
		
		$stmt->bind_result($id, $plate, $color);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$car = new StdClass();
			
			$car->id = $id;
			$car->plate = $plate;
			$car->carColor = $color;
			
			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr märgi
			array_push($result, $car);
		}
	
		return $result;
	}
	
	function getSingleCarData($edit_id){
    
		
		$stmt = $this->connection->prepare("SELECT plate, color FROM cars_and_colors WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($plate, $color);
		$stmt->execute();
		
		//tekitan objekti
		$car = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$car->plate = $plate;
			$car->color = $color;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		
		return $car;
		
	}
	function deleteCar($id){
		

		
		$stmt = $this->connection->prepare("UPDATE cars_and_colors SET deleted=NOW() WHERE id=? AND DELETED IS NULL");
		$stmt->bind_param("s",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "kustutamine õnnestus!";
		}
		
	
		
		
	}


	function updateCar($id, $plate, $color){

		
		$stmt = $this->connection->prepare("UPDATE cars_and_colors SET plate=?, color=? WHERE id=?");
		$stmt->bind_param("ssi",$plate, $color, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
	
		
	}
}
	
	/*TEISED FUNKTSIOONID*/

?>