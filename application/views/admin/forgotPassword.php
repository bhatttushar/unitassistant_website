
        <p class="login-box-msg">Forgot Password</p>
        <?php $this->load->helper('form');?>
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

if ($this->session->flashdata('send')) {?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('send'); ?>
            </div>
        <?php }

if ($this->session->flashdata('notsend')) {?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('notsend'); ?>
            </div>
        <?php }

if ($this->session->flashdata('unable')) {?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('unable'); ?>
            </div>
        <?php }

if ($this->session->flashdata('invalid')) {?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('invalid'); ?>
            </div>
        <?php }?>

        <form action="<?php echo base_url(); ?>resetPasswordUser" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="login_email" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Submit" />
            </div><!-- /.col -->
          </div>
        </form>
        <a href="<?php echo base_url() ?>">Login</a><br>