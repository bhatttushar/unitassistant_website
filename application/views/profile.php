<div class="container" style="padding-top: 60px;">
	<h1 class="page-header">Edit Profile</h1>
	<div class="row">
		<!-- left column -->
		<div class="col-md-4 col-sm-6 col-xs-12">
  			<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<div class="text-center">
    			<img src="./assets/images/user_profile/<?php echo $user_data['profile_pic'];?>" class="avatar img-circle img-thumbnail" alt="avatar">
    			<h6>Upload a different photo...</h6>
    			<input type="file" class="text-center center-block well well-sm" name="profile_picture">
    			<input type="hidden" name="alt_image" value="<?php echo $user_data['profile_pic'];?>">
  			</div>
		</div>
		<!-- edit form column -->
		<div class="col-md-8 col-sm-6 col-xs-12 personal-info">
			<?php
				if ($this->session->flashdata('error')) { ?>
		            <div class="alert alert-danger alert-dismissable">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <?php echo $this->session->flashdata('error'); ?>
		            </div>
		        <?php }
				if ($this->session->flashdata('success')) { ?>
		            <div class="alert alert-success alert-dismissable">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <?php echo $this->session->flashdata('success'); ?>
		            </div>
		        <?php } ?>
  			<h3>Personal info</h3>
  				<div class="form-group">
      				<label class="col-lg-3 control-label">User name:</label>
  					<div class="col-lg-8">
        				<input class="form-control profile-form" value ="<?php echo $user_data['user_name'];?>" type="text" disabled="">
      				</div>
      				<span class="help-block"></span>
    			</div>
    			<div class="form-group">
      				<label class="col-lg-3 control-label">First name:</label>
  					<div class="col-lg-8">
        				<input class="form-control profile-form" value="<?php echo $user_data['first_name'] ? $user_data['first_name'] : $_POST['first_name'];?>" type="text" name="first_name">
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-lg-3 control-label">Last name:</label>
      				<div class="col-lg-8">
    					<input class="form-control profile-form" value="<?php echo $user_data['last_name'] ? $user_data['last_name'] : $_POST['last_name'];?>" type="text" name="last_name">
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-lg-3 control-label">Email:</label>
      				<div class="col-lg-8">
        				<input class="form-control profile-form" value="<?php echo $user_data['email'];?>" type="email" disabled="">
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label">Password:</label>
  					<div class="col-md-8">
        				<input class="form-control profile-form" type="password" placeholder="Enter New Password" name="password">
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label">Confirm password:</label>
      				<div class="col-md-8">
        				<input class="form-control profile-form" placeholder ="Re-enter Your Password" name="re_password" type="password">
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label">Gender:</label>
      				<div class="col-md-8">
        				<select class="form-control profile-form" name="gender">
        					<?php 
        						$sSelectedMale = ($user_data['gender'] == 'M') ? 'selected' : '';
        						$sSelectedFemale = ($user_data['gender'] == 'F') ? 'selected' : '';
        					?>
        					<option value="0">Select Your Gender</option>
        					<option value="M" <?php echo $sSelectedMale;?>>Male</option>
        					<option value="F" <?php echo $sSelectedFemale;?>>Female</option>
        				</select>
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label">Address:</label>
      				<div class="col-md-8">
        				<textarea class="form-control profile-form" name="address" placeholder="Add Your Address"><?php echo ($user_data['address']) ? $user_data['address'] : $_POST['address'];?></textarea>
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label">Phone:</label>
      				<div class="col-md-8">
        				<input type="text" name="phone" class="form-control profile-form" placeholder="Enter Your Phone Number" value="<?php echo $user_data['phone'] ? $user_data['phone'] : $_POST['phone'];?>">
      				</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label">DOB:</label>
      				<div class="col-md-8  profile-form">
      					<div class="hero-unit">
                			<input type="text" name="dob" placeholder="click to show datepicker"  id="dob" value="<?php echo $user_data['dob'] ? $user_data['dob'] : $_POST['dob'];?>" class="form-control">
            			</div>
   					</div>
    			</div>
    			<div class="form-group">
      				<label class="col-md-3 control-label"></label>
      				<div class="col-md-8">
      					<input type="hidden" name="hidden_password" value="<?php echo $user_data['password']; ?>">
      					<input type="hidden" name="salt" value="<?php echo $user_data['salt']; ?>">
        				<input class="btn btn-primary" value="Save Changes" type="submit">
        				<span></span>
        				<input class="btn btn-default" value="Cancel" type="reset">
      				</div>
    			</div>
  			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
        $('#dob').datepicker({
            format: "dd/mm/yyyy"
        });  
    });
</script>