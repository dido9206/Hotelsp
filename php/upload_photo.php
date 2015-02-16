<?php

  $fieldId= $_POST['delHotel'];
  $file_id='file';
  $status='';

  $filename=$_FILES[$file_id]['name'];
  $tmpfile=$_FILES[$file_id]['tmp_name'];

  if(!$_FILES[$file_id]['name']) {
    	echo returnStatus("<font color=\'red\'>no file specified</font>");
    	return;
  }
  /*copy file over to tmp directory */
  if(move_uploaded_file($tmpfile, "../uploads/".$filename)){
    $status="<font color=\'green\'>Качено!</font>";
	 $con=mysqli_connect("localhost","root","1qazZAQ!","hotels");
	
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//var_dump($_POST);
	$sql="UPDATE Hotel SET picture='$filename' WHERE id=$fieldId";
	$result = mysqli_query($con,$sql);
	mysqli_close($con);
  }else{
    $status='<font color=\'red\'>Грешка!</font>';
  }
  echo returnStatus($status);

function returnStatus($status){
	return "<html><body><script type='text/javascript'>function init(){if(top.uploadComplete) top.uploadComplete('".$status."');}window.onload=init;
</script></body></html>";

}

?>
