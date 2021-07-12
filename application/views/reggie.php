<?php 
    $lg=( (isset($_GET['language']) && $_GET['language']==1) || !isset($_GET['language']) ) ? 'E' : 'S'; 
    $topImg = (isset($_GET['language']) && $_GET['language']==2) ? 'UA-FLYER-USSPANISHVF.jpg' : 'UA-FLYER-USVF.jpg';
    $english = isset($_GET['language']) && ($_GET['language']==1) ? 'selected' : '';
    $spanish = isset($_GET['language']) && ($_GET['language']==2) ? 'selected' : '';
    $french = isset($_GET['language']) && ($_GET['language']==3) ? 'selected' : '';
?>
<div class="container" id="reggie">
    <div class="row main">
        <div class="col-sm-12 prospects">
            <img src="<?php echo base_url('assets/images/'.$topImg); ?>">
        </div>

        <div class="col-sm-6 chooseLanguage">
            <div class="form-group">
                <h3><?php echo lang_label('choose_language', $lg); ?></h3>
              <select class="form-control" id="language" name="language">
                <option value="1" <?php echo $english; ?> ><?php echo lang_label('english', $lg); ?></option>
                <option value="2" <?php echo $spanish; ?> ><?php echo lang_label('spanish', $lg); ?></option>
              </select>
            </div>
        </div>

        <div class="col-sm-12 prospects">
            <h1><?php echo lang_label('get_started', $lg); ?></h1>
            <h3><?php echo lang_label('fill_out', $lg); ?></h3>
            <h4  style="color: #ff0000; font-weight: 700;"><?php echo lang_label('all_field_required', $lg); ?></h4>
        </div>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="main-login main-center col-sm-6">
                <div class="row mb15">
                    <div class="col-sm-4">    
                        <label><?php echo lang_label('directory_title', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <select name="director_title" class="form-control" required>
                            <option value=""><?php echo lang_label('select_directory_title', $lg); ?></option>
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
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('name', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-4 pl0">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo lang_label('first_name', $lg); ?>" required>
                    </div>
                    <div class="col-sm-4 pl0">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="<?php echo lang_label('last_name', $lg); ?>" required>
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('unit_number', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="text" class="form-control" name="unit_number" id="unit_number" required/>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('consultant_id', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="consultant_number" id="consultant_number" onblur="reggieUniqueId(this.value, '1', '');" required />
                        <div id="resultImageProfile"></div>
                        <span class="error" id="error-consul"></span>
                        <span id="note-consul"></span>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('mk_director', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="mk_director" id="mk_director" required/>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('in_touch_password', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="password" class="form-control" name="intouch_password" id="password" required/>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('email', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="email" id="email" placeholder="<?php echo lang_label('your_email', $lg); ?>" onblur="reggieUniqueEmail(this.value, '1', '');" required>
                        <div id="resultImageProfile1"></div>
                        <span class="error" id="error-email"></span>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('birthday', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="dob" id="birthday" placeholder="<?php echo lang_label('birthday_formate', $lg); ?>" autocomplete="off" required>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('phone', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="cell_number" id="cell_number" placeholder="<?php echo lang_label('phone_number', $lg); ?>" required>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('closing_emails', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input class="form-control"  type="text" name="closing_ecards" required> 
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('unit_name', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="text" class="form-control" name="unit_name" id="unit_name" placeholder="<?php echo lang_label('sally_star', $lg); ?>" required/>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('unit_goals', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="text" class="form-control" name="unit_goal" id="unit_goal" placeholder="<?php echo lang_label('pink_cadillac', $lg); ?>" required/>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('unit_colors_theme', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input class="form-control"  type="text" name="unit_color">
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('name_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_name">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('address_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <textarea class="form-control" name="p_address"></textarea>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('phone_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="alt_phone" id="alt_phone" placeholder="<?php echo lang_label('alt_phone', $lg); ?>">
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('city_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_city">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('state_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_state">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('zip_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_zip">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('phone_number_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_phone">
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('email_label', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_email">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('website_shopping_site', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" class="form-control" name="p_web">
                    </div>
                </div>

                <?php 
                    if (isset($_GET['language'])) { 
                        if ($_GET['language'] != '3') { ?>
                            <div class="row mb15">
                                <div class="col-sm-4">
                                    <label><?php echo lang_label('seminar_affiliation', $lg); ?> *</label>
                                </div>
                                <div class="col-sm-8 pl0">
                                   <input type="text" class="form-control" name="seminar_affiliation" id="seminar_affiliation" required>
                                </div>
                            </div>  
                <?php   }
                    }else{ ?>
                        <div class="row mb15">
                            <div class="col-sm-4">
                                <label><?php echo lang_label('seminar_affiliation', $lg); ?> *</label>
                            </div>
                            <div class="col-sm-8 pl0">
                               <input type="text" class="form-control" name="seminar_affiliation" id="seminar_affiliation" required>
                            </div>
                        </div>  
                <?php } ?>
                    
            </div>
            <div class="main-login main-center col-sm-6">
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('national_area', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="text" class="form-control" name="national_area" id="national_area" required>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('nsd_name', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input class="form-control"  type="text" name="nsd_name">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('nsd_address', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <textarea class="form-control" name="nsd_address"></textarea>
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('nsd_city', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input class="form-control"  type="text" name="nsd_city">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('nsd_state', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input class="form-control"  type="text" name="nsd_state">
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('nsd_zip', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input class="form-control"  type="text" name="nsd_zip">
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('reffered_by', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="text" class="form-control" name="reffered_by" id="reffered_by" required>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('unit_size', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-8 pl0">
                       <input type="text" class="form-control" name="unit_size" id="unit_size" required />
                    </div>
                </div>

                <div class="row mb15">
                    <label class="col-sm-4"><?php echo lang_label('billing', $lg); ?> *</label>
                    <div class="col-sm-8">
                        <div class="row mb15">
                            <div class="col-sm-6 pl0">
                                <input type="text" name="cu_routing" class="form-control" placeholder="<?php echo lang_label('cu_routing', $lg); ?>" required >
                            </div>

                            <div class="col-sm-6 pl0">
                                <input type="text" name="cv_account" class="form-control" placeholder="<?php echo lang_label('cv_account', $lg);?>" required>    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('upload_photo', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="file" class="form-control" name="image" id="photo">
                    </div>
                </div>
                
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('unit_web_site', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 pl0">
                        <input type="text" name="unit_web_site" class="form-control" >
                    </div>
                </div>
                <div class="row mb15">
                    <div class="col-sm-4">
                        <label><?php echo lang_label('primary_personality_style', $lg); ?></label>
                    </div>
                    <div class="col-sm-8 p10">
                        <label class="radio-inline">
                            <input type="radio" name="primary_personality" value="D">D
                        </label>
                        <label class="radio-inline">
                            <input name="primary_personality" value="I" type="radio">I
                        </label>
                        <label class="radio-inline">
                            <input name="primary_personality" value="S" type="radio">S
                        </label>
                         <label class="radio-inline">
                            <input name="primary_personality" value="C" type="radio">C
                        </label>
                    </div>
                </div>
            </div>
            <div class="main-login main-center col-sm-12">
                <div class="row mb15">
                    <div class="col-sm-2">
                        <label><?php echo lang_label('authorization', $lg); ?> *</label>
                    </div>
                    <div class="col-sm-10 pl0">
                        <input type="checkbox" name="authorization" value="1" required>
                        <?php echo lang_label('authorization_txt', $lg); ?>
                    </div>
                </div>
                
                <div class="row mb15">
                    <div class="col-sm-12 text-center">
                        <input type="hidden" name="newsletters_design" id="newsletters_design" value="<?php echo $lg; ?>">
                        <button type="submit" name="save_record" class="btn btn-primary" id="submit"><?php echo lang_label('submit', $lg); ?></button>    
                    </div>
                </div>

                <div class="row mb15">
                    <div class="col-sm-2">
                        <label></label>
                    </div>
                    <div class="col-sm-10 pl0">
                        <?php echo lang_label('process_text', $lg); ?>
                    </div><br/><br/>
                </div>
            </div>
        </form>

    </div>
</div>

<div id="ThankYouModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="font-size: 18px;">
        <p><?php echo lang_label('part2', $lg); ?></p>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        function thankYou() {
            $('#ThankYouModal').modal('show');
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

    });
</script>