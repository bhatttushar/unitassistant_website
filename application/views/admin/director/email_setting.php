<div class="content-wrapper">
  <section class="content-header">
    <h1> <i class="fa fa-envelope"></i> Email Settings</h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php
            if ($this->session->flashdata('error')) {?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php } ?>

          <?php
            if ($this->session->flashdata('success')) {?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
            <form method="post">
                <div class="col-md-12">
                    <label> Email Setting </label>
                    <input type="checkbox" name="email_setting" value="1" <?php echo ($email_setting==1) ? "checked='checked'" : '';?> id="setting">
                    <input type="submit" name="submit" value="Save" class="btn btn-success btn-md">
                </div>
            </form>
          </div>
        </div>
    </div>
  </div>
  </section>
</div>       