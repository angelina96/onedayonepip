

<style>
  .fixed2 {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 100px;
  height: 100px;
  border: 0px solid #73AD21;
  }
</style>

<?php if(isset($_GET['contract'])) {
if($_GET['contract']=="approve") {
?>
<br><Br>
<div class="alert alert-success alert-dismissible" id="overlay" style="font-family:Arial, Helvetica, sans-serif; position: fixed; top: 40vh; width: 90%; left: 5%; z-index: 8;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Index Trade Activated!</strong><br>Your transaction saved.
</div>

<?php }
else { ?>
<br><Br>
<div class="alert alert-danger alert-dismissible" id="overlay" style="font-family:Arial, Helvetica, sans-serif; position: fixed; top: 40vh; width: 90%; left: 5%;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Index Trade Declined!</strong><br>Please Contact Your Upline.
</div>
<?php
} } ?>



<?php if(isset($_GET['status'])) {
if($_GET['status']=="inprocess") {
?>
<br><Br>
<div class="alert alert-success alert-dismissible" id="overlay" style="font-family:Arial, Helvetica, sans-serif; position: fixed; top: 40vh; width: 90%; left: 5%; z-index: 8;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>  Withdrawal Issued!</strong><br>Your transaction saved.
</div>

<?php }
else { ?>
<br><Br>
<div class="alert alert-danger alert-dismissible" id="overlay" style="font-family:Arial, Helvetica, sans-serif; position: fixed; top: 40vh; width: 90%; left: 5%; z-index: 8;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong> Withdrawal Declined!</strong><br>Please Contact Your Upline.
</div>
<?php
} } ?>

<?php
if(isset($_GET['fault'])) { ?>
<div class="alert alert-danger alert-dismissible" id="overlay" style="font-family:Arial, Helvetica, sans-serif; position: fixed; top: 40vh; width: 90%; left: 5%; z-index: 8;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Attention!</strong><br>Please Upload Your ID CARD Photo
</div>
<?php
}  ?>

<?php
if(isset($_GET['verifi'])) { ?>
<div class="alert alert-success alert-dismissible" id="overlay" style="font-family:Arial, Helvetica, sans-serif; position: fixed; top: 40vh; width: 90%; left: 5%; z-index: 8;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Your ID Uploaded!</strong><br>Please wait until our Authorities verified your ID to unlock RANK and Bonus <img src="images/good.gif" height="30px">
</div>
<?php
}  ?>

