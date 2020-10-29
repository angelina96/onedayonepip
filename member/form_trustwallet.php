<form id="form-validation" action="form_trustwallet2.php" method="post" class="form-horizontal form-bordered">
                    
					
					
					
					<div class="form-group">
                        <label class="col-md-3 control-label">USDT WALLET ADDRESS <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="text" name="addressbtc" class="form-control" placeholder="eg: 34gBbcBwTqVHL7toNrzfppu58CXsYj7VdP" value="<?=$addressbtc?>"  required>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-3 control-label">TRUSTWALLET ID<span style="color:yellow">&nbsp; (optional)</span></label>
                        <div class="col-md-6">
                            <input type="text" name="trustwallet" class="form-control" placeholder="optional" value="<?=$trustwallet?>" >
                        </div>
                    </div>
					
					
					
					
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="hidden" name="id" value="<?=$_SESSION['USERPRO']?>">
                            <button type="submit" class="btn btn-effect-ripple btn-success">UPDATE CRYPTO INFORMATION</button>
                        </div>
                    </div>
                </form>