<?php  
session_start();
 //getting data from the $_POST array
 $name = $_POST['name'];
 $city = $_POST['city'];
 $address = $_POST['address'];
 $stars = $_POST['stars'];
 $roomsInfo = $_POST['roomsInfo'];
 $email = $_POST['email'];
 $fieldId = $_POST['fieldId'];
 $save = $_POST['save'];
 $signature = $_SESSION['user_hash'];
 //connecting to the database
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
 if (mysqli_connect_errno($con))
 {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 
 //first checking if we want to save da entry
 if($save=="yes"){
 	$sql="INSERT INTO Hotel(name,city,address,stars,rooms_info,email,user_signature) VALUES ('$name','$city','$address',$stars,'$roomsInfo','$email','$signature');";
	$result = mysqli_query($con,$sql);
	if (!$result)
  	{
  		die('Неуспешно въвеждане ' . mysqli_error($con));
  	}
	$sql="SELECT MAX(id) FROM Hotel";
	$result = mysqli_fetch_array(mysqli_query($con,$sql));
	$sql = "ALTER TABLE room ADD PARTITION (PARTITION h".$result[0]." VALUES IN(".$result[0]."));";
	mysqli_query($con,$sql);
	echo "0";
 
 }
 
 //Checking if we want to update a entry
elseif($save=="update"){
	
	$sql="UPDATE Hotel PARTITION ($signature) SET name='$name', city='$city', address='$address', stars=$stars, rooms_info='$roomsInfo', email='$email' WHERE id=$fieldId";
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
    case "hname":
         if (strlen($name)>50 || strlen($name)<1){echo "Въведете име до 50 символа";}
		 else{echo "0";}
         break;
	case "city":
         if ($city=="none"){echo "Въведете град от списъка";}
		 else{echo "0";}
         break;
	case "address":
         if (strlen($address)>50 || strlen($address)<1){echo "Въведете адрес до 50 символа";}
		 else{echo "0";}
         break;
	case "roomsInfo":
         if (strlen($roomsInfo)>700){echo "Въведете описание до 700 символа";}
		 else{echo "0";}
         break;
	case "stars":
		 if(intval($stars)<1 || intval($stars)>5){echo "Въведете звезди (1-5)";}
		 else {echo "0";}
		 break;
	case "email":
		 if(filter_var($email, FILTER_VALIDATE_EMAIL)){echo "0";}
		 else {echo "Въведете валидна ел.поща";}
		 break;
	
     
    default:
         echo "0";
         break;
 }
 }
	mysqli_close($con);
?>