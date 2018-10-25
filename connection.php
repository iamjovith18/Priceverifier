<?php 
try{
	$conn = new PDO("sqlsrv:Server=172.16.10.76;Database=coh_ho_test2","sa","system32@pos");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	echo "No Connection: " . $e->getMessage();
}

 ?>
 
 