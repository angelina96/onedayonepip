
<br>
<br>
<hr>
<br>
<br>
<CENTER class="glow3"><i class="glyphicon glyphicon-alert glow"></i> Fill in the form below only after you have paid the USDT transaction</CENTER>
<BR>
<!-- Form Validation Form -->
                <form id="form-validation" action="page_deposit3.php" method="post" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">USD Thether Deposit <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" step="0.01" name="amountx" class="form-control floatNumberField" placeholder="USD Thether Amount" min="0"  autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group form-actions">
					<div class="col-xs-12 text-center">
                    
                            <input type="hidden" name="id" value="<?=$_SESSION['USERPRO']?>">
                            <input type="hidden" name="cointype" value="<?=$w?>">
							<?php include "tnc.php"; ?>
                            <input type="submit" class="btn btn-effect-ripple btn-success" value="I have Paid via Crypto">
						</div>
                  </div>
		</form>
<!-- END Form Validation Form -->

<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>