<?php  
session_start();
 $id = $_POST['id'];
  $signature = $_SESSION['user_hash'];
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM Hotel PARTITION (".$signature.") WHERE id= ".$id;
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<li>
  				<a class='more' onclick='hotelList("."\"news\"".");'>Назад</a><br/><hr/>
				<div class='bigpic'>
					<p><a class='single_image' href='uploads/".$row['picture']."'><img src='uploads/".$row['picture']."'  width='100%' height='100%'/></a></p>
				</div>

				<h2>".$row['name']."<span>***</span></h2><br/>
				<span><b>Адрес:</b> </span>".$row['address']."<br/>
				<span><b>Град:</b> </span>".$row['city']."<br/>
				<span><b>Email:</b> </span>".$row['email']."<br/>
				<span><b>Описание:</b> </span>".$row['rooms_info']."<br/><hr/>
				<h3>Стаи:</h3><br/>
			  </li>";
  	}
	
	$sql="SELECT * FROM room PARTITION (h".$id.")";
	$result = mysqli_query($con,$sql);
	if (!$result){
		die ("Няма въведени стаи");
	}
	while($row = mysqli_fetch_array($result))
  	{
  		echo "	<div class='bigpic'>
					<p><a class='single_image' href='uploads/".$row['picture']."'><img src='uploads/".$row['picture']."'  width='100%' height='100%'/></a></p>
				

				".$row['numbeds']." легла, ".$row['view']." гледка, баня: ".$row['havebathroom'].", цена: ".$row['price']." лв./нощувка<br/>
				
				</div>";
  	}

	mysqli_close($con);

  
?> 
