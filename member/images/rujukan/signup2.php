<?php
include "../serverdb/server.php";


$email = $_POST['username'];
$email = $_POST['email'];
$username= $_POST['username'];
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];

$upload_image=$_FILES["userkp"]["name"];  //image name
$folder="Photo/";  // folder name where image will be store
move_uploaded_file($_FILES["userkp"]["tmp_name"], "$folder".$_FILES["userkp"]["name"]);

//$sql="UPDATE officer SET image_name='$upload_image',image_path='$folder' WHERE officerId='$officerId'";
$sql="INSERT INTO userpro (id,email,username,pwd,image_name,image_path) values('$username','$email','$username','$pwd','$upload_image','$folder')";

$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

if($result){
echo "<script>alert('Success!');document.location.href='signup.php';</script>";
}
else 
{
echo "your picture is not uploaded ";
}


					
//mysql_close($con);

?>