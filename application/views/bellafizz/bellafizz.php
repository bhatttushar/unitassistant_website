<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<form action="" method="post" class="blastpro" name="blastpro">
	            <div class="form-group">
	                <label class="col-lg-3">Name:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="name" class="form-control" value="<?php echo empty($data['name']) ? '' : $data['name']; ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Rep ID:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="rep_id" class="form-control" value="<?php echo empty($data['rep_id']) ? '' : $data['rep_id']; ?>" onblur="bellafizzUniqueId(this.value);" required>
	                    <div id="bellaRepLoadImg"></div>
                        <span class="error" id="bella-error-rep"></span>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Email:</label>
	                <div class="col-lg-9">
	                    <input type="email" name="email" class="form-control" value="<?php echo empty($data['email']) ? '' : $data['email']; ?>" onblur="bellafizzUniqueEmail(this.value);" required>
	                    <div id="bellaLoadImg"></div>
                        <span class="error" id="bella-error-email"></span>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Login ID:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="loginid" class="form-control" value="<?php echo empty($data['loginid']) ? '' : $data['loginid']; ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Password:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="password" class="form-control" value="<?php echo empty($data['password']) ? '' : $data['password']; ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Company / City:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="c_city" class="form-control" value="<?php echo empty($data['c_city']) ? '' : $data['c_city']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Address:</label>
	                <div class="col-lg-9">
	                    <textarea  name="address" class="form-control"><?php echo empty($data['address']) ? '' : $data['address']; ?></textarea>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">City:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="city" class="form-control" value="<?php echo empty($data['city']) ? '' : $data['city']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">State:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="state" class="form-control" value="<?php echo empty($data['state']) ? '' : $data['state']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Zip:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="zip" class="form-control" value="<?php echo empty($data['zip']) ? '' : $data['zip']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Phone Number:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="phone" class="form-control" value="<?php echo empty($data['phone']) ? '' : $data['phone']; ?>">
	                </div>
	            </div>
	            
	            <div class="form-group">
	                <label class="col-lg-3">Payment Type:</label>
	                <div class="col-lg-9">
	                    <select name="pmt_type" class="form-control">
	                        <option value="CC" selected>CC</option>
	                    </select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Card Number:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="cc_number" class="form-control" placeholder="**** **** **** ****" value="<?php echo empty($data['cc_number']) ? '' : $data['cc_number']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Security Code:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="cc_code" class="form-control" placeholder="Security Code" value="<?php echo empty($data['cc_code']) ? '' : $data['cc_code']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Expiration Date</label>
	                <div class="col-lg-9">
	                    <input type="text" name="cc_expir_date" class="form-control" id="cc_expir_date" placeholder="MM/YY" value="<?php echo empty($data['cc_expir_date']) ? '' : $data['cc_expir_date']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Postal Code</label>
	                <div class="col-lg-9">
	                    <input type="text" name="cc_zip" class="form-control" placeholder="1001" value="<?php echo empty($data['cc_zip']) ? '' : $data['cc_zip']; ?>">
	                </div>
	            </div>
	            <div class="form-group ovfi">
	                <label class="col-lg-3">Month to Start Billing:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="month_billing" class="form-control" id="month_billing" placeholder="MM/YYYY" value="<?php echo isset($data['month_billing']) ? $data['month_billing'] : ''; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Website:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="website" class="form-control" value="<?php echo empty($data['website']) ? '' : $data['website']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Facebook Link:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="facebook" class="form-control" value="<?php echo empty($data['facebook']) ? '' : $data['facebook']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Referred by:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="referred" class="form-control" value="<?php echo empty($data['referred']) ? '' : $data['referred']; ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="col-lg-12 text-right">
	                	<button type="submit" id="bellafizz_submit" class="btn btn-success">Save</button>
	                </div>
	            </div>
	        </form>		
		</div>

		<div class="col-sm-4">
			<?php include 'bellafizz-add-note.php'; ?>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>

<script type="text/javascript">

	function bellafizzUniqueId(selectedValue){  
	  var id_bellafizz = $('#hidden_id_bellafizz').val();
	  $("#bellaRepLoadImg").html('<img src="'+baseURL+'/assets/images/load1.gif" alt="" />');
	  $("#bella-error-rep").html("");
	  if(selectedValue == ''){
	    $("#bella-error-rep").html("Rep id is required!!");
	    $("#bellafizz_submit").attr('disabled',true);
	    $("#bellaRepLoadImg").html('');
	  }else{
	    $("#bella-error-rep").html("");
	    $.ajax({
	      url: baseURL + 'bellafizz-unique-rep',
	      type: 'POST',
	      data: {id_bellafizz:id_bellafizz, rep_id : selectedValue},
	      success: function(response) {
	        if(response == "1"){
	          $("#bella-error-rep").html("Rep id must be unique!!");
	          $("#bellafizz_submit").attr('disabled', true);
	          $("#bellaRepLoadImg").html('');
	          $("#note-consul").html('');
	        }else{
	          $("#bella-error-rep").html("");
	          $("#bellafizz_submit").attr('disabled',false);
	          $("#bellaRepLoadImg").html('');
	        }
	      }
	    });
	  }
	}

	function bellafizzUniqueEmail(email){
	  var id_bellafizz = $('#hidden_id_bellafizz').val();
	  $("#bellaLoadImg").html('<img src="'+baseURL+'assets/images/load1.gif" alt="" />');
	  $("#bella-error-email").html("");
	  if(email !== ''){
	    if (!ValidateEmail(email)) {
	            $("#bella-error-email").html("Please Enter valid email address!!");
	            $("#bellafizz_submit").attr('disabled',true);
	            $("#bellaLoadImg").html('');
	        }else {
	          $.ajax({
	            url: baseURL + 'bellafizz-unique-email',
	            type: 'POST',
	            data: {id_bellafizz:id_bellafizz, email: email},
	            success: function(response){
	              $("#bellaLoadImg").html('');
	              if(response != '0') {
	                $("#bella-error-email").html(response);
	                $("#bellafizz_submit").attr('disabled',true);
	              }else {
	                $("#bellafizz_submit").attr('disabled',false);
	                $("#bella-error-email").html();
	              }
	            }
	      });
	        }
	    }else {
	      $("#bella-error-email").html("Please Enter email address!!");
	      $("#bellafizz_submit").attr('disabled',true);
	      $("#bellaLoadImg").html('');
	    }
	}


	function saveBellafizzNote(id_bellafizz){
	  var note = $("#note").val();
	  var client_name = $("#name_client").val();
	  var users_id = $(".hidden-user").val();
	  if(note == ''){
	    $("#note-error").html('Please add note!!');
	  } else {
	    
	    $("#note-error").html('');
	    $.ajax({
	        url: baseURL+'add-bellafizz-note',
	        type: 'POST',
	        data: {id_bellafizz : id_bellafizz, note: note, users : users_id, client_name : client_name},
	        beforeSend: function(){
	          $(".img-load").show();
	        },
	        success: function(response) {
	            $("#note").val('');
	            if(response != 0) {
	              createCookie("flag", 1, 0);
	              $('#hidden_id_bellafizz').val(response);
	              $('#is_note').val('1');
	              loadNewBellafizzNotes(response);
	            }
	        },
	        complete:function(data){
	          $(".img-load").hide();
	        },

	        error: function(jqXHR, textStatus, errorThrown) {
	          console.log(textStatus, errorThrown);
	        }

	    });
	  }
	}

	function loadNewBellafizzNotes(id_bellafizz, all=''){
	  $.ajax({
	      url: baseURL+'bellafizz-note-list',
	      type: 'POST',
	      data: {id_bellafizz : id_bellafizz, all:all},
	      success: function(response) {
	          $("#note").val('');
	          $(".note-loader").hide();
	          if(response) {
	            $('.notes_listing .chat_area').remove();
	            $('.notes_listing').append(response);
	          }
	        }
	  });
	}

	$(document).ready(function(){ 
	  $(".js-example-basic-multiple").select2({
	    placeholder: "Click to select a user"
	  });

	  $(".js-example-basic-multiple").on("select2:select", function (e) { 
	      var select_val = $(e.currentTarget).val();
	      $(".hidden-user").val(select_val);
	  });

	});

</script>