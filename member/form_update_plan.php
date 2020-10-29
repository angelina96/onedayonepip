				<form id="form-validation" action="form_update_plan2.php" method="post" class="form-horizontal form-bordered">
                    
					
					<div class="form-group">
                        <label class="col-md-3 control-label">Plan Name<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="planname" class="form-control" placeholder="Plan Name" value="<?=$planname?>" required>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="col-md-3 control-label">Plan ROI<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="planroi" class="form-control" placeholder="Plan ROI" value="<?=$planroi?>" required>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="col-md-3 control-label">Plan Day<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="planday" class="form-control" placeholder="Plan Day" value="<?=$planday?>" required>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="col-md-3 control-label">Minimum Invest<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="mininv" class="form-control" placeholder="Minimum Invest" value="<?=$mininv?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Minimum Withdraw<span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="minwd" class="form-control" placeholder="Minimum Invest" value="<?=$minwd?>" required>
                        </div>
                    </div>
					
					
					<input type="hidden" name="plantype" class="form-control" placeholder="Plan Type" value="<?=$plantype?>" required>
					
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="hidden" name="id" value="<?=$_SESSION['USERPRO']?>">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">UPDATE PLAN</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger">RESET</button>
							<button  onclick="hidenshow()" type="reset" class="btn btn-effect-ripple btn-danger">CANCEL</button>
                        </div>
                    </div>
                </form>