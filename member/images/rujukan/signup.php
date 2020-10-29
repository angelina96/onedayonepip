<?php include "content/header.php"; ?>
<?php //include "content/nav.php"; ?>

<div id="myPage" class="bg-register">
<h2 class="glow3">REGISTER</h2>
 <div class="row">
  <div class="col-sm-4 col-xs-12"></div>
  <div class="col-sm-4 col-xs-12">
  
  
  <form action="signup2.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="userkp">UPLOAD ID/PASSPORT:</label>
	  <input type="file" name="userkp" id="userkp" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Create Username" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Enter password" required>
    </div>
    <div class="form-group">
      <label for="repwd">Confirm Password:</label>
      <input type="password" name="repwd" class="form-control" id="repwd" placeholder="Enter password" required>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  
  
  
  
 </div>
  <div class="col-sm-4 col-xs-12"></div>
 </div>
</div>





<!-- Container (Contact Section) -->
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
</div>

<?php //include "content/footer.php"; ?>