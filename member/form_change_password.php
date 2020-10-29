<form id="form-validation" action="form_change_password2.php" method="post" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Current Password <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="Password" name="cpwd" class="form-control" placeholder="Type your old password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="val-password">Password <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="password" id="val-password" name="npwd" class="form-control" placeholder="Type your new password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="password" id="val-confirm-password" name="rpwd" class="form-control" placeholder="Re-type your new password" required>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="hidden" name="id" value="<?=$_SESSION['USERPRO']?>">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">Change Password</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                        </div>
                    </div>
                </form>