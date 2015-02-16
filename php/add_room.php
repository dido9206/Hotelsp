<?php  
 //getting data from the $_POST array
 $hotel_id = $_POST['hotel_id'];
 $numbeds = $_POST['numbeds'];
 $view = $_POST['view'];
 $hasbath = $_POST['hasbath'];
 $price = $_POST['price'];
 $fieldId = $_POST['fieldId'];
 $save = $_POST['save'];
 //connecting to the database
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
 if (mysqli_connect_errno($con))
 {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 
 //first checking if we want to save da entry
 if($save=="yes"){
 	$sql="INSERT INTO  `hotels`.`room` (`id` ,`hotel_id` ,`numbeds` ,`view` ,`havebathroom` ,`price` ,`picture`) VALUES (NULL , '$hotel_id' ,  '$numbeds',  '$view',  '$hasbath',  '$price', NULL);";
	$result = mysqli_query($con,$sql);
	if (!$result)
  	{
  		die('Неуспешно въвеждане ' . mysqli_error($con));
  	}
	echo "0";
 
 }
 
 //Checking if we want to update a entry
elseif($save=="update"){
	
	$sql="UPDATE room PARTITION ($hotel_id) SET hotel_id=$hotel_id, numbeds=$numbeds, view='$view', havebathroom='$hasbath', price=$price WHERE id=$fieldId";
	$result = mysqli_query($con,$sql);
	if (!$result)
  	{
  		die('Неуспешно въвеждане ' . mysqli_error($con));
  	}
	echo "0";
}

//Else we start the validation process
 else
 {
 switch ($fieldId) {
    case "hotel_id":
         if (strlen($hotel_id)<1){echo "Изберете хотел";}
		 else{echo "0";}
         break;
	case "numbeds":
         if (intval($numbeds)<1||intval($numbeds)>10){echo "Въведете брой легла (1-10)";}
		 else{echo "0";}
         break;
	case "view":
         if (strlen($view)>20 || strlen($view)<1){echo "Въведете гледка до 20 символа";}
		 else{echo "0";}
         break;
	case "hasbath":
         if ($hasbath=="none"){echo "Въведете баня";}
		 else{echo "0";}
         break;
	case "price":
		 if(!is_numeric($price)){echo "Въведете цена";}
		 else {echo "0";}
		 break;
    default:
         echo "0";
         break;
 }
 }
	mysqli_close($con);
?>