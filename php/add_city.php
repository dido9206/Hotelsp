<?php  
 $pcode = $_POST['pcode'];
 $name = $_POST['name'];
 $country = $_POST['country'];
 $save = $_POST['save'];
 if($save==1&&(!$pcode||!$name||!$country)) die('<span style="color:red;font-size:14px">Моля въведете задължителните полета</span>');
 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="SELECT * FROM City WHERE pcode =".$pcode;
		  
	$result = mysqli_query($con,$sql);
	$num_rows=0;
	while($row = mysqli_fetch_array($result))
  	{ 		
	   $num_rows++; 
  	}
	if(!$num_rows){  
		if($save==1) 
		{
			$sql="INSERT INTO City (pcode,name,country) VALUES ($pcode,'$name','$country')";
			$result = mysqli_query($con,$sql);
			if (!$result)
  			{
  				die('Неуспешно въвеждане ' . mysqli_error($con));
  			}
			echo "<span style='color:green;font-size:14px'>Успешно добавихте град:".$pcode.",".$name.",".$country."</span>";
		}
		
		//we send 0 to the ajax request
		echo" ";
	}
	else{  
    //else if it's not bigger then 0, then it's available '  
    //and we send 1 to the ajax request  
    	echo "1";
	}
	mysqli_close($con);
?>