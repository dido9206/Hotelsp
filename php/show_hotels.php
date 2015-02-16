<?php  
session_start();
 $searchHotel = $_POST['searchHotel'];
 $sort = $_POST['sort'];
 $signature = $_SESSION['user_hash'];
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM Hotel PARTITION (".$signature.") WHERE name LIKE('%".$searchHotel."%') ORDER BY ".$sort." DESC";
		  
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result))
  	{
  		echo "<li>
				<div class='pic'>
					<p><a class='single_image' href='uploads/".$row['picture']."'><img src='uploads/".$row['picture']."'  width='100%' height='100%'/></a></p>
				</div>
				<h2>".$row['name']."<span>***</span></h2>
				<p>".$row['rooms_info']."<span><a  class='more' onclick='showHotel(".$row['id'].")'>Повече</a></span></p>
			  </li>";
  	}

	mysqli_close($con);

  
?> 