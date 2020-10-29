<?php include "content/header.php"; ?>
<?php //include "content/nav.php"; ?>
<?php $upline = $_GET['upline']; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div id="myPage" class="bg-register">
<a class="text-right" href="../index.php">Back</a>
<h2 class="glow3">REGISTER</h2>
 <div class="row">
  <div class="col-sm-4 col-xs-12"></div>
  <div class="col-sm-4 col-xs-12">

  <form action="page_register2.php" method="POST" enctype="multipart/form-data">
  <img id="blah" src="#" width="200px" onerror="this.src='images/logo_kad.png';"/>
  
	  <h5 class="glow4"></h5>
    <div class="form-group">
      <label for="userkp">PLEASE UPLOAD YOUR ID OR PASSPORT OR DRIVING LICENSE WHILE HOLDING YOUR DOCUMENT:</label>
	  <label class="custom-file-upload">
	  <input type="file" name="userkp" id="userkp" required><span class="glyphicon glyphicon-upload glow"></span> Upload
	  <!--<input type="file" name="userkp" id="userkp" required><img src="images/logo_user.png" width="18px" height="18px" border="0" alt=""> Upload-->
	  </label>
	  <h5 class="glow4">*Your Account will be verified by our Authorities within 24 Hours.</h5>
    </div>
    <div class="form-group">
      <label for="fname">FULLNAME:</label>
      <input type="text" name="fname" class="form-control" id="fname" placeholder="Your full name as your ID" required autocomplete="off">
	  <h5 class="glow4">*Your Full Name must be same as your ID card/Passport or your account will be bannified.</h5>
    </div>
    <div class="form-group">
      <label for="email">EMAIL:</label>
      <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" required autocomplete="off">
    </div>
    <div class="form-group">
      <label for="username">CREATE USERNAME:</label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Create Username" required autocomplete="off" onkeyup="nospaces(this)">
    </div>
    <div class="form-group">
      <label for="pwd">PASSWORD:</label>
      <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Enter password" required autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly>
    </div>
    <div class="form-group">
      <label for="repwd">CONFIRM PASSWORD:</label>
      <input type="password" name="repwd" class="form-control" id="repwd" placeholder="Enter password" required autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly>
    </div>
	<input type="hidden" name="upline" value="<?=$upline?>">
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  
 </div>
  <div class="col-sm-4 col-xs-12"></div>
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
<script>
function nospaces(t){
if(t.value.match(/\s/g)){
alert('Spaces and Symbol is not allowed for username');
t.value=t.value.replace(/\s/g,'');
}
}
</script>


<!-- Container (Contact Section)
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p>
      <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
      <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div> -->

<?php //include "content/footer.php"; ?>