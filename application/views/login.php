<section class="clearfix loginSection">
	<div class="container">
		<div class="row">
			<div class="center-block col-md-4 col-sm-6 col-xs-12">
		        <div class="row">
		        	<h2 class="text-center">Unit Assistant Service</h2>

		            <div class="col-md-12">
		                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
		            </div>
		        </div>
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
				<div class="panel panel-default loginPanel">
					<div class="panel-heading text-center">User Sign In</div>
					<div class="panel-body">
						<form class="loginForm" action="<?php echo base_url('user-login'); ?>" method="post">
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
							<div class="form-group mt30">
								
								<a href="<?php echo base_url('admin'); ?>" class="link btn btn-primary">Go to Admin</a>

								<button type="submit" class="btn btn-primary pull-right">Sign In</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>