<?php
	$id = $info23['id'];
	$name = $info23['fname'];
	$emel = $info23['email'];
	$address = $info23['address'];
	$phone = $info23['phone'];
	$akaunb = $info23['akaunb'];
	$jenisb = $info23['jenisb'];
	$penama = $info23['penama'];
	$addressbtc = $info23['addressbtc'];
	$trustwallet = $info23['trustwallet'];
?>
                <!-- Form Validation Form -->
                <form id="form-validation" action="form_update_profile2.php" method="post" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <!--<label class="col-md-3 control-label">Username <span class="text-danger">*</span></label>-->
                        <div class="col-md-6">
                            <?=$id?><input type="hidden" name="id" class="form-control" placeholder="Choose a nice username.." value="<?=$id?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label class="col-md-3 control-label">Email <span class="text-danger">*</span></label>-->
                        <div class="col-md-6">
                            <?=$emel?><input type="hidden" name="emel" class="form-control" placeholder="Enter your valid email.." value="<?=$emel?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="fname">Full Name <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter your full name" value="<?=$name?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="address">Address <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address" value="<?=$address?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="phone">Phone Number <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your number" value="<?=$phone?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="akaunb">Bank Account Number <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="akaunb" name="akaunb" class="form-control" placeholder="Enter your account number to receive income" value="<?=$akaunb?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="jenisb">Country Local Bank Name <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="jenisb" name="jenisb" class="form-control" placeholder="Your Country Local Bank" value="<?=$jenisb?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="penama">Bank Account Holder Name <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" id="penama" name="penama" class="form-control" placeholder="Account Holder Name" value="<?=$penama?>" required>
                        </div>
                    </div>
					
                    <!-- <div class="form-group">
                        <label class="col-md-3 control-label" for="btc">Bitcoin Address<br><span class="text-warning">(optional)</span></label>
                        <div class="col-md-6">
                            <input type="text" id="btc" name="btc" class="form-control" placeholder="Bitcoin Wallet Address" value="<?=$addressbtc?>">
                        </div>
                    </div> -->
					
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="submit" class="btn btn-effect-ripple btn-primary" value="UPDATE">
                            <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
							<button  onclick="hidenshow()" type="reset" class="btn btn-effect-ripple btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>