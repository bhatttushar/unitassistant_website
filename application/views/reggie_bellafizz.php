<div class="container">
    <h1 class="text-center">Bella Fizz Client</h1>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
            <?php } ?>
            <div class="form-outer">
                <h4  style="color: #ff0000; font-weight: 700;">All * fields are required.</h4>
                <form action="" method="post" class="blastpro" name="blastpro">
                    <div class="form-group">
                        <label for="name" class="col-lg-3 control-label">Name*:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rep-id" class="col-lg-3 control-label">Rep ID*:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="rep_id" id="rep_id" required onblur="ReggiBellaUniqueRepID(this.value);">
                            <div id="RepLoadImg"></div>
                            <span class="error" id="error-rep"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-3 control-label">Email*:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="email" name="email" id="email" required onblur="ReggiBellaUniqueEmail(this.value);">
                            <div id="LoadImg"></div>
                            <span class="error" id="error-email"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-3 control-label">Bella Password*:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-lg-3 control-label">Address:</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="address" id="address"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-lg-3 control-label">City:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="city" id="city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="state" class="col-lg-3 control-label">State:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="state" id="state">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="col-lg-3 control-label">Zip:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="zip" id="zip">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-lg-3 control-label">Phone Number:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="phone" id="phone">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="payment" class="col-lg-3 control-label">Payment Type:</label>
                        <div class="col-lg-9">
                            <select name="pmt_type" class="form-control">
                                <option selected="selected" value="CC">CC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardnumber" class="col-lg-3 control-label">Card Number*:</label>
                        <div class="col-lg-9">
                            <input type="text" name="cc_number" placeholder="**** **** **** ****" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="securitycode" class="col-lg-3 control-label">Security Code*:</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Security Code" name="cc_code"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expirydate" class="col-lg-3 control-label">Expiration Date*:</label>
                        <div class="col-lg-9">
                            <input type="text" maxlength="5" name="cc_expir_date" placeholder="MM/YY"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postalcode" class="col-lg-3 control-label">Postal Code:</label>
                        <div class="col-lg-9">
                            <input type="text" name="cc_zip" placeholder="1001" class="form-control">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="website" class="col-lg-3 control-label">Website:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="website" id="website" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="col-lg-3 control-label">Facebook Link:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="facebook" id="facebook" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="referred" class="col-lg-3 control-label">Referred by:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="referred" id="referred" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-success submitblast">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>


    <div id="ThankYouBellaModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body" style="font-size: 18px;">
                <p>Thank you for registering-- we will be sending a email soon to welcome you.</p>
              </div>
            </div>
        </div>
    </div>


<script type="text/javascript">

    function ReggiBellaUniqueEmail(email){
      $("#LoadImg").html('<img src="'+baseURL+'assets/images/load1.gif" alt="" />');
      $("#error-email").html("");
      if(email !== ''){
        if (!ValidateEmail(email)) {
                $("#error-email").html("Please Enter valid email address!!");
                $(".submitblast").attr('disabled',true);
                $("#LoadImg").html('');
            }else {
                $.ajax({
                    url: baseURL + 'reggie-bellafizz-unique-email',
                    type: 'POST',
                    data: {email: email},
                    success: function(response){
                      $("#LoadImg").html('');
                      if(response != '0') {
                        $("#error-email").html(response);
                        $(".submitblast").attr('disabled',true);
                      }else {
                        $(".submitblast").attr('disabled',false);
                        $("#error-email").html();
                      }
                    }
                });
            }
        }else {
          $("#error-email").html("Please Enter email address!!");
          $(".submitblast").attr('disabled',true);
          $("#LoadImg").html('');
        }
    }

    function ReggiBellaUniqueRepID(rep_id){
      $("#RepLoadImg").html('<img src="'+baseURL+'assets/images/load1.gif" alt="" />');
      $("#error-rep").html("");
      if(rep_id !== ''){
            $.ajax({
                url: baseURL + 'reggie-bellafizz-unique-rep-id',
                type: 'POST',
                data: {rep_id: rep_id},
                success: function(response){
                  $("#RepLoadImg").html('');
                  if(response != '0') {
                    $("#error-rep").html(response);
                    $(".submitblast").attr('disabled',true);
                  }else {
                    $(".submitblast").attr('disabled',false);
                    $("#error-rep").html();
                  }
                }
            });
        }else {
          $("#error-rep").html("Please Enter rep_id address!!");
          $(".submitblast").attr('disabled',true);
          $("#RepLoadImg").html('');
        }
    }

    $(document).ready(function(){

        function thankYou() {
            $('#ThankYouBellaModal').modal('show');
        }

        var success = $(location).attr("href").split('?').pop();

        if (success === 'success') {
            thankYou();
        }

    });

</script>