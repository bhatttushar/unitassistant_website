<?php  $id_newsletter = $this->uri->segment(3); ?>
<style type="text/css">
    input[type="submit"]{
        margin-top: 20px !important;
    } 
</style>

<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-envelope"></i> Newsletter Message Management </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header"> <h3 class="box-title">Newsletter Message</h3> </div>

                    <!-- <form method="post" action="<?php echo base_url('admin/save-newsletter-messages'); ?>"> -->
                    <form method="post" action="" id="msg_form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>English</h3>
                                    <?php $sContent = english_content(); ?>
                                    <textarea class="ckeditor" rows="5" cols="40" name="english"><?php echo isset($aMsg[0]['english']) ? $aMsg[0]['english'] : $sContent;?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <h3>Spanish</h3>
                                    <?php $sContent = spanish_content(); ?>
                                    <textarea class="ckeditor" rows="5" cols="40" name="spanish"><?php echo isset($aMsg[0]['spanish']) ? $aMsg[0]['spanish'] : $sContent;?></textarea> 
                                </div> 
                                <div class="col-md-12">
                                    <h3>French</h3>
                                    <?php $sContent = french_content(); ?>
                                    <textarea class="ckeditor" rows="5" cols="40" name="french"><?php echo isset($aMsg[0]['french']) ? $aMsg[0]['french'] : $sContent;?></textarea> 
                                </div> 
                                
                            </div>
                        </div>

                         <?php
                        if(isset($id_newsletter)){?>
                            <input type="hidden" name="id_newsletter" id="hidden_id" value="<?php echo isset($id_newsletter) ? $id_newsletter :'' ;?>">
                        <?php }else{ ?>
                            <input type="submit" name="save_newsletter_messages" value="Save" class="btn btn-md btn-success pull-right">
                        <?php } ?>

                    </form>      

                </div>
            </div>

        

        </div>
    </section>

</div>
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var nId = $("#hidden_id").val();
        if(nId != ''){
            $("#msg_form").submit();
        }
    });
</script>     