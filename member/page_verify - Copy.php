<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
//include "content/nav.php";
//include "content/minimum.php";

$sql23="SELECT * from userpro WHERE id='$username'";
$data23 = mysqli_query($conn,$sql23) or die(mysqli_error($conn));
$info23 = mysqli_fetch_array( $data23 );
$fullname = $info23['fname'];
 


include "../alert/alert2.php";

?>
<div id="myPage" class="bg-homerun text-center" style="height: 100vh;">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">PLEASE VERIFY YOUR ID CARD</h3>
	</div>
	<div class="box-welcome2">

<form action="page_verify2.php" method="POST" enctype="multipart/form-data" name="myForm" onsubmit="return validateForm()">
  <img id="blah" src="#" width="200px" onerror="this.src='images/logo_kad.png';"/>
    <div class="form-group">
      <label for="userkp">UPLOAD YOUR ID / PASSPORT / DRIVING LICENSE:</label>
	  <label class="custom-file-upload">
	  <input type="file" name="userkp" id="userkp"><span class="glyphicon glyphicon-upload"></span> Upload
	  <!--<input type="file" name="userkp" id="userkp" required><img src="images/logo_user.png" width="18px" height="18px" border="0" alt=""> Upload-->
	  </label>
	  <h5 class="glow4">*Your Account will be verified by our Authorities within 24 Hours.</h5>
    </div>
    <div class="form-group">
      <label for="fname">FULLNAME:</label>
      <input type="text" name="fname" class="form-control" id="fname" placeholder="Your full name as your ID" value="<?=$fullname?>" required autocomplete="off">
	  <input type="hidden" name="id" class="form-control" id="id" value="<?=$username?>">
	  <h5 class="glow4">*Your Full Name must be same as your ID card/Passport or your account will be bannified.</h5>
    </div>
   
    <button type="submit" class="btn btn-default">Submit</button>
  </form>


	</div>

  </div>
  </div>
  </div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#userkp").change(function(){
        readURL(this);
    });
</script>
<script>$('#overlay').fadeIn('fast').delay(4000).fadeOut('fast');</script>