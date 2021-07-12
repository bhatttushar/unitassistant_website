
        
<p class="login-box-msg">Admin Sign In</p>

        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
if ($this->session->flashdata('error')) {?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php }
if ($this->session->flashdata('success')) {?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php }?>

        <form action="<?php echo base_url('admin'); ?>" method="post">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="User Name" name="user_name" required />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
          </div>
          <div class="row">
            <div class="col-xs-8">
              <a href="<?php echo base_url('user-login'); ?>" class="link btn btn-primary">Go to home</a>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block" value="Sign In" />
              
            </div><!-- /.col -->
          </div>
        </form>

        <!-- <a href="<?php echo base_url() ?>forgotPassword">Forgot Password</a><br> -->