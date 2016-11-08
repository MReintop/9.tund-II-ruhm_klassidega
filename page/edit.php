<?php
	//edit.php
	require("../functions.php");
	
	
	
	if (isset($_GET["delete"])){
		
		$Car->deleteCar($_GET["id"]);
			header("Location: data.php");
			exit();
		
	}
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Car->updateCar($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["plate"]), $Helper->cleanInput($_POST["color"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	
	//Kui pole id-d aadressireal, siis suunan
	if (!isset($_GET["id"])){
		header("Location:data.php");
		exit();
	}
	
	$c = $Car->getSingleCarData($_GET["id"]);
	var_dump($c);
	
	


	
?>
<?php require ("../header.php");?>
<br><br>
<a href="data.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="number_plate" >auto nr</label><br>
	<input id="number_plate" name="plate" type="text" value="<?php echo $c->plate;?>" ><br><br>
  	<label for="color" >värv</label><br>
	<input id="color" name="color" type="color" value="<?=$c->color;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
	<br><br>
	
	
	
  </form>
  <br>
  <br>
  <a href="?id=<?=$_GET["id"];?>&deleted=true">Kustuta</a>
<?php require ("../footer.php");?>