<?php 
    $lg=( (isset($_GET['language']) && $_GET['language']==1) || !isset($_GET['language']) ) ? 'E' : 'S';
    $topImg = ($lg == 'E') ? 'reggie_uacc_banner.jpg' : 'reggie_uacc_banner_sp.jpg';
    $english = isset($_GET['language']) && ($_GET['language']==1) ? 'selected' : '';
    $spanish = isset($_GET['language']) && ($_GET['language']==2) ? 'selected' : '';
?>
<div class="container" id="reggie-uacc">
    <div class="row main">
        <div class="col-sm-12 prospects">
            <img src="<?php echo base_url('assets/images/'.$topImg); ?>">
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <h3><?php echo lang_label('choose_language', $lg); ?></h3>
                <select class="form-control" id="language" name="language">
                    <option value="1" <?php echo $english; ?> ><?php echo lang_label('english', $lg); ?></option>
                    <option value="2" <?php echo $spanish; ?> ><?php echo lang_label('spanish', $lg); ?></option>
                </select>
            </div>
        </div>
        <br>
        <div class="panel-heading">
            <div class="panel-title text-center">
                <!-- <h1 class="title">Customer Care Package Payment $29.99 per month</h1> -->
                <h3 class="title">
                    <string><?php echo lang_label('Automated_communication', $lg); ?></string>
                </h3>
                <p><?php echo lang_label('Newsletter_to_customers', $lg); ?><br>
                    <?php echo lang_label('Birthday_Text', $lg); ?><br>
                    <?php echo lang_label('Mid_Month_production', $lg); ?><br>
                    <?php echo lang_label('MK_Anniversary_Text', $lg); ?>
                </p>
                <hr >
            </div>
        </div>
      
        <div class="clearfix"></div>
        <form method="post" action="" enctype="multipart/form-data">
            <br><br>
             <div class="col-sm-12 text-center">
                <span class="fill_out_form"><?php echo lang_label('new_clients_fill_out_form', $lg); ?></span>
            </div>
            <br><br><br>
            <div class="col-sm-6">
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('name', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('email', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" id="email" onblur="reggieUniqueEmail(this.value, '', '1');" required>
                        <div id="resultImageProfile1"></div>
                        <span class="error" id="error-email"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Cell_Number', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cell_number" id="cell_number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('consultant_id', $lg);?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="consultant_number" id="consultant_number" onblur="reggieUniqueId(this.value, '', '1');" required>
                        <div id="resultImageProfile"></div>
                        <span class="error" id="error-consul"></span>
                        <span id="note-consul"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Mary_Kay_intouch_Password', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="intouch_password" id="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('national_area', $lg); ?></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="national_area" id="national_area" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Seminar', $lg); ?></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="seminar_affiliation" id="seminar_affiliation">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Address', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input name="address" class="form-control" required>
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('City', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="city" id="city" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('State', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="state" id="state" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Zip', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="zip" id="zip" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('hear_about_us', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <select class="form-control profile-form" name="hear_us" id="hear_us" required>
                            <option value=""><?php echo lang_label('Select_One', $lg); ?></option>
                            <option value="Facebook" ><?php echo lang_label('Facebook', $lg); ?></option>
                            <option value="Friend"><?php echo lang_label('Friend', $lg); ?></option>
                            <option value="My Director"><?php echo lang_label('My_Director', $lg); ?></option>
                            <option value="My National"><?php echo lang_label('My_National', $lg); ?></option>
                            <option value="Other"><?php echo lang_label('Other', $lg); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('payment_type', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <select name="pmt_type" class="form-control profile-form" id="pmt_type" required>
                            <option value="ACH"><?php echo lang_label('ACH', $lg); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('cu_routing', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cu_routing" id="cu_routing" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Checking_Account_Number', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cv_account" id="cv_account" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Mary_Kay_Website', $lg); ?></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control profile-form" name="mary_kay_website">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Facebook_Link', $lg); ?></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control profile-form" name="fb_link" id="fb_link" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Other', $lg); ?></label>
                    <div class="col-sm-8">
                        <select class="form-control profile-form" name="cc_director_title" id="cc_director_title">
                            <option value=""><?php echo lang_label('select_directory_title', $lg); ?></option>
                            <option value="Mary Kay Independent Beauty Consultant"><?php echo lang_label('mary_kay_independent_beauty_consultant', $lg); ?></option>
                            <option value="Independent Sales Director"><?php echo lang_label('independent_sales_director', $lg); ?></option>
                            <option value="Independent Senior Sales Director"><?php echo lang_label('independent_senior_sales_director', $lg); ?></option>
                            <option value="Future Executive Senior Sales Director"><?php echo lang_label('future_executive_senior_sales_director', $lg); ?></option>
                            <option value="Executive Senior Sales Director"><?php echo lang_label('executive_senior_sales_director', $lg); ?></option>
                            <option value="Elite Executive Senior Sales Director"><?php echo lang_label('elite_executive_senior_sales_director', $lg); ?></option>
                            <option value="Independent National Sales Director"><?php echo lang_label('independent_national_sales_director', $lg); ?></option>
                            <option value="Independent Senior National Sales Director"><?php echo lang_label('independent_senior_national_sales_director', $lg); ?></option>
                            <option value="Independent Executive National Sales Director"><?php echo lang_label('independent_executive_national_sales_director', $lg); ?></option>
                            <option value="Independent Elite Executive National Sales Director"><?php echo lang_label('independent_elite_executive_national_sales_director', $lg); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Who_referred_you', $lg); ?></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="reffered_by" id="reffered_by">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('birthday', $lg); ?></label>
                    <div class="col-sm-8">
                        <input name="birthday" class="form-control" id="birthday" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('Discount_Code', $lg); ?></label>
                    <div class="col-sm-8">
                        <input name="discount_code" class="form-control" id="Discount" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4"><?php echo lang_label('upload_photo', $lg); ?></label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="photo" id="photo" >
                    </div>
                </div>
                
                <input type="hidden" name="hidden_newsletter" id="hidden">
             </div>
             <div class="col-sm-12 main-center">
                <div class="form-group">
                    <input type="checkbox" name="cv_prospect" value="1" required>
                    <?php echo lang_label('Recurring_Charge', $lg); ?>
                </div>

                <div class="form-group">
                    <span class="red_text"><b><?php echo lang_label('NOTE', $lg); ?></b></span>    
                </div>
                <div class="form-group">
                    <input type="checkbox" name="digital_biz_card" value="1">
                    <input type="hidden" name="digital_biz_link" id="buzz_link">
                    <img src="../assets/images/biz_card.jpg" class="biz_card" onclick="increaseBizImageSize()">
                    <?php echo lang_label('like_to_add_digital_bizz_card', $lg); ?> 
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4"> <?php echo lang_label('type_name_to_confirm', $lg); ?> </label>
                        <div class="col-sm-8"> 
                            <input type="text" name="recurring_sign" class="recurring_sign form-control">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4"> <?php echo lang_label('today_date', $lg); ?> </label>
                        <div class="col-sm-8"> 
                            <input type="text" name="recurring_today_date" value="<?php echo date('Y-m-d') ?>" readonly class="recurring_today_date">
                        </div>
                    </div>
                </div>
             </div>
             <div class="col-sm-12 text-center">
                <input type="hidden" name="language" value="<?php echo $lg; ?>">
                <button type="submit" name="saveRecord" class="btn btn-primary" id="submit"><?php echo lang_label('submit', $lg); ?></button>
            </div>
        </form>
    </div>
</div>

<!-- Start of WebFreeCounter Code -->
<a href="https://www.webfreecounter.com/" target="_blank"><img src="https://www.webfreecounter.com/hit.php?id=gemekcakn&nd=6&style=1" border="0" alt="free counter"></a>


<div id="UACCThankYouModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="font-size: 18px;">
        <p><?php echo lang_label('thank_you_uacc', $lg); ?></p>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

    function increaseBizImageSize(){
        $(".biz_card").css("width","150px");
    }

    $(document).ready(function(){

        function thankYou() {
            $('#UACCThankYouModal').modal('show');
        }

        var success = $(location).attr("href").split('?').pop();
        console.log(success);

        if (success === 'success') {
            thankYou();
        }

        $('#language').on('change', function() {
          var language = this.value;
          location.replace("?language="+language);
        });

        $('input#name').change(function(event) {
            var BIX = $(this).val().replace(/\s/g, '')
            $('#buzz_link').val('https://www.unitassist.com/tbc/'+BIX);
        });
    });
</script>