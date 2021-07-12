<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-bell"></i> Send Notifications </h1>
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
                <?php }?>
              <?php
                if ($this->session->flashdata('success')) {?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php }?>
          </div>
        </div>
        <div class="row">
		    <div class="col-md-12">
		    	<form name="send_noti" class="send_noti" method="post" action="">
           			<div class="form-group col-md-6">	
						<label>Notification Title</label>
						<input type="text" name="title" class="form-control" value="<?php echo $data['title']; ?>" required >
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-6">
						<label>Notification Message</label>
						<textarea class="form-control" rows="10" name="message" required><?php echo $data['message']; ?></textarea>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-12 text-left">
            <button type="submit" class="btn btn-info ">Send</button>
					</div>
					<div class="clearfix"></div>
				</form>
		    </div>
		</div>
	</section>
</div>