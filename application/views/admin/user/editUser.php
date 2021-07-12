<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Edit User </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div>
                    <form id="editUser" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $userInfo['first_name']; ?>" required>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $userInfo['last_name']; ?>" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_name">User Name</label>
                                        <input type="text" class="form-control required" id="user_name" name="user_name" value="<?php echo $userInfo['user_name']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email" name="email" value="<?php echo $userInfo['email']; ?>" disabled >
                                    </div>
                                </div>
                            </div>
                           

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">-- Select Gender --</option>
                                            <?php
                                                $male = ($userInfo['gender']=='M') ? 'selected' : '';
                                                $female = ($userInfo['gender']=='F') ? 'selected' : '';
                                            ?>
                                            
                                            <option value="M" <?php echo $male ?> >Male</option>
                                            <option value="F" <?php echo $female ?> >Female</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="id_user" id="id_user" value="<?php echo $userInfo['id_user']; ?>" />
                            <input type="submit" class="btn btn-primary" value="Update" id="submit" />
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
