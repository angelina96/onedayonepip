<div class="col-xs-12">
                    <label class="csscheckbox csscheckbox-primary" data-toggle="tooltip" title="Agree to the terms">
                        <input type="checkbox" id="register-terms" name="register-terms" required checked>
                        <span></span>
                    </label>
                    <a href="#modal-terms" data-toggle="modal">I accept the Terms & Agreement</a>
</div>

<div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title text-center"><strong>Terms and Conditions</strong></h3>
                            </div>
                            <div class="modal-body">
                                <?php include "terms.php";?>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="button" class="btn btn-effect-ripple btn-primary" data-dismiss="modal">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>