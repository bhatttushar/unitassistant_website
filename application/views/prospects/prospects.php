<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<form action="" method="post">
	            <div class="form-group">
	                <label class="col-lg-3">Name:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="name" class="form-control" value="<?php echo empty($data['name']) ? '' : $data['name']; ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-lg-3">Phone Number:</label>
	                <div class="col-lg-9">
	                    <input type="text" name="phone" class="form-control" value="<?php echo empty($data['phone']) ? '' : $data['phone']; ?>">
	                </div>
	            </div>

	            <div class="form-group">
	                <div class="col-lg-12 text-right">
	                	<button type="submit" id="prospects_submit" class="btn btn-success">Save</button>
	                </div>
	            </div>
	        </form>		

	        <?php include 'prospects-add-note.php'; ?>
		</div>

		<div class="col-sm-4">
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>

<script type="text/javascript">


	function saveProspectsNote(id_prospect){
	  var note = $("#note").val();
	  var client_name = $("#name_client").val();
	  var users_id = $(".hidden-user").val();
	  if(note == ''){
	    $("#note-error").html('Please add note!!');
	  } else {
	    
	    $("#note-error").html('');
	    $.ajax({
	        url: baseURL+'add-prospects-note',
	        type: 'POST',
	        data: {id_prospect : id_prospect, note: note, users : users_id, client_name : client_name},
	        beforeSend: function(){
	          $(".img-load").show();
	        },
	        success: function(response) {
	            $("#note").val('');
	            if(response != 0) {
	              createCookie("flag", 1, 0);
	              $('#hidden_id_prospect').val(response);
	              $('#is_note').val('1');
	              loadNewProspectsNotes(response);
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

	function loadNewProspectsNotes(id_prospect, all=''){
	  $.ajax({
	      url: baseURL+'prospects-note-list',
	      type: 'POST',
	      data: {id_prospect : id_prospect, all:all},
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