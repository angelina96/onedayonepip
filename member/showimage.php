<?php
include("../serverdb/server.php");
//mysql_connect("localhost","root","");
//mysql_select_db("onepip");

if(isset($_GET['id']))
{
	//$id = mysqli_real_escape_string($_GET['id']);
	$id = $_GET['id'];
	$sql38="SELECT * FROM userpro WHERE id='$id'";
	$query = mysqli_query($conn,$sql38);
	while($row = mysqli_fetch_assoc($query))
	{
		$imageData = $row["image"];
	}
	header("content-type: image/jpeg");
	echo $imageData;
}
else
{
	echo "Error!";
}

?>