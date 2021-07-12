<div class="content-wrapper">
    <section class="content-header">
        <h1> <i class="fa fa-envelope"></i> Email Message Management</h1>
        <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a> </li>
            <li class="active">Email Messages</li>
        </ol>
    </section>

    <section class="content">
        <form method="post" action="">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThreetwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThreetwo" aria-expanded="false" aria-controls="collapseThreetwo">Welcome Messages    
                        </a>
                    </h4>
                </div>
                <div id="collapseThreetwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreetwo" style="display:block;height:100%;">
                    <div class="panel-body">
                        <div class="form-group">
                            <h3>Welcome English</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="welcome_english"><?php echo !empty($aMessage['welcome_english']) ? $aMessage['welcome_english'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <h3>Welcome Canada English</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="welcome_canada_english"><?php echo !empty($aMessage['welcome_canada_english']) ? $aMessage['welcome_canada_english'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <h3>Welcome Both English</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="welcome_both_english"><?php echo !empty($aMessage['welcome_both_english']) ? $aMessage['welcome_both_english'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <h3>Welcome Spanish</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="welcome_spanish"><?php echo !empty($aMessage['welcome_spanish']) ? $aMessage['welcome_spanish'] : '';?></textarea> 
                        </div> 
                        <div class="form-group">
                            <h3>Welcome French</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="welcome_french"><?php echo !empty($aMessage['welcome_french']) ? $aMessage['welcome_french'] : '';?></textarea> 
                        </div>
                        <div class="form-group">
                            <h3>Welcome Both French</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="welcome_both_french"><?php echo !empty($aMessage['welcome_both_french']) ? $aMessage['welcome_both_french'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <h3>Current English</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="current_english"><?php echo !empty($aMessage['current_english']) ? $aMessage['current_english'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <h3>Current Canada English</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="current_canada_english"><?php echo !empty($aMessage['current_canada_english']) ? $aMessage['current_canada_english'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <h3>Current Spanish</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="current_spanish"><?php echo !empty($aMessage['current_spanish']) ? $aMessage['current_spanish'] : '';?></textarea>
                        </div>   

                        <div class="form-group">
                            <h3>Current French</h3>
                            <textarea class="ckeditor" rows="5" cols="40" name="current_french"><?php echo !empty($aMessage['current_french']) ? $aMessage['current_french'] : '';?></textarea>
                        </div>   

                        <div class="form-group">
                            <input type="submit" name="save" value="Save" class="btn btn-md btn-success pull-right">      
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>