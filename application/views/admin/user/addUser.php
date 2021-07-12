<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Add User </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div>
                    <form id="addUser" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>" required>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>" required>
                                    </div>

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name">User Name</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                                    </div>
                                </div>

                               

                            </div>
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="gender">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">-- Select Gender --</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Save" id="submit" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <?php
if ($this->session->flashdata('error')) {?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php }?>
            </div>

        </div>
    </section>
</div>