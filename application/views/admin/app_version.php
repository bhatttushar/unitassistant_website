<div class="content-wrapper">
  <section class="content-header">
    <h1> <i class="fa fa-wpforms"></i>App Versions</h1>
  </section>

  <section class="content">
    <div class="row">
        <form method="post">
            <div class="col-sm-4 br-right">
                <div class="col-sm-12">
                    <h3>UA App Version</h3>
                </div>
                <div class="form-group col-sm-6">
                    <label>Android</label>
                    <input type="text" class="form-control" name="ua_android" value="<?php echo $app_version['ua_android'];?>" required>
                </div>
                <div class="form-group col-sm-6">
                    <label>iPhone</label>
                    <input type="text" name="ua_ios" class="form-control" value="<?php echo $app_version['ua_ios'];?>" required>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-sm-4 br-right">
                <div class="col-sm-12">
                    <h3>UACC App Version</h3>
                </div>
                <div class="form-group col-sm-6">
                    <label>Android</label>
                    <input type="text" class="form-control" name="uacc_android" value="<?php echo $app_version['uacc_android'];?>" required>
                </div>
                <div class="form-group col-sm-6">
                    <label>iPhone</label>
                    <input type="text" name="uacc_ios" class="form-control" value="<?php echo $app_version['uacc_ios'];?>" required>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12">
                    <h3>TBP  App Version</h3>
                </div>
                <div class="form-group col-sm-6">
                    <label>Android</label>
                    <input type="text" class="form-control" name="tbp_android" value="<?php echo $app_version['tbp_android'];?>" required>
                </div>
                <div class="form-group col-sm-6">
                    <label>iPhone</label>
                    <input type="text" name="tbp_ios" class="form-control" value="<?php echo $app_version['tbp_ios'];?>" required>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-sm-12">
                <div class="form-group col-sm-6">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>    
            </div>
            
        </form>
    </div>
  </section>
</div>       