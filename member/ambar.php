<?php

include "../serverdb/server.php";

define('DIRECTORY', 'Photo');

/*$link=mysql_connect("localhost","root","");
if(!$link)
{
	die("could not connect:".mysql_error());
} 
mysql_select_db("media",$link);
*/

$sql38="select id,image from userpro where image!='' and id='oyo'";
$query=mysqli_query($conn,$sql38)or die("Invalid query: " . mysqli_error($conn));

//$returned=mysql_result($query,0,0);
while($row = mysqli_fetch_assoc($query))
	{
$returned = $row["image"];
$id = $row["id"];
//$file=fopen("Photo/".$id.".jpeg","w");
//fwrite($file,$returned);
echo "done for ".$id."<br>";

//header("content-type: image/jpeg");
//echo $returned;

file_put_contents(DIRECTORY . '/'.$id.'.jpg', $returned);

	}
?>