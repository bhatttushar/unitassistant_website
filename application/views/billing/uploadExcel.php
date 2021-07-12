<style type="text/css">
	.btn-bs-file input[type="file"] {
	    position: absolute;
	    top: -9999999;
	    filter: alpha(opacity=0);
	    opacity: 0;
	    width: 0;
	    height: 0;
	    outline: none;
	    cursor: inherit;
	}
	.btn-group.list-btn {
	    width: 100%;
	    margin: 5px;
	}
	label.btn-bs-file.btn.btn-md.btn-info {
	    display: block;
	    width: 100%;
	}
	.col-sm-3 {
	    padding-left: 0;
	    padding-right: 0;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-upload"></i> Upload Excels </h1>
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
        	<div class="col-sm-12">

				<form action="" method="post" id="upform" name="upexel" enctype="multipart/form-data">

					<div class="col-sm-3">
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                <label class="btn-bs-file btn btn-md btn-info">
                                    Newsletter-B/W Color
                                    <input type="file" id="file" name="newsletter_color"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                   13th Month Packet Postage
                                    <input type="file" id="file2" name="month_packet_postage"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    New Consultant Packet Postage
                                    <input type="file" id="file3" name="consultant_packet_postage"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    New Consultant Bundles
                                    <input type="file" id="file4" name="consultant_bundles"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    Consistency Gift
                                    <input type="file" id="file5" name="consistency_gift"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    Reds Program Gift
                                    <input type="file" id="file6" name="reds_program_gift"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                   Stars Program Gift
                                    <input type="file" id="file7" name="stars_program_gift"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                   Gift Wrap and Postage
                                    <input type="file" id="file8" name="gift_wrap_postpage"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    One Rate Postage
                                    <input type="file" id="file9" name="one_rate_postpage"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                   Month End Blast Flyer
                                    <input type="file" id="file10" name="month_blast_flyer"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                   All Flyers
                                    <input type="file" id="file11" name="flyer_ecard_unit"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  Speciality Postcard 
                                    <input type="file" id="file18" name="speciality_postcard"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  Greeting Card
                                    <input type="file" id="file33" name="greeting_card"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  Card with gift
                                    <input type="file" id="file19" name="card_with_gift"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                 Greeting Post Card
                                    <input type="file" id="file20" name="birthday_brownie"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  Birthday Cards and Starbucks
                                    <input type="file" id="file21" name="birthday_starbucks"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  Anniversary Card and Starbucks
                                    <input type="file" id="file22" name="anniversary_starbucks"/>
                                </label>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                   Referral Credit
                                    <input type="file" id="file23" name="referral_credit"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    Special Credit
                                    <input type="file" id="file24" name="special_credit"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    Special Credit Notes
                                    <input type="file" id="file24" name="special_cr_note"/>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        
                        
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    Picture Texting
                                    <input type="file" id="file30" name="picture_texting"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    Invoice Note
                                    <input type="file" id="file31" name="invoice_note"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                    New Client Set up Fee
                                    <input type="file" id="file32" name="client_setup"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  English Bitley URL
                                    <input type="file" id="file34" name="beatly_url"/>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  Spanish Bitley URL
                                    <input type="file" id="file35" name="beatly_url_one"/>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="btn-group list-btn">
                                 <label class="btn-bs-file btn btn-md btn-info">
                                  French Bitley
                                    <input type="file" id="file36" name="beatly_url_two"/>
                                </label>
                            </div>
                        </div>
                     </div>


				</form>        		
        	</div>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-bs-file input[type="file"]').change(function(event) {
		  $('#upform').submit();		
		});
	});
	
	
</script>