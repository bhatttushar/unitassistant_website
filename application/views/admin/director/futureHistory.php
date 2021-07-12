<style type="text/css">
  .form-group{
    overflow: auto;
  }  

  #back{
    margin-top: 15px;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1> <i class="fa fa-history"></i> Client History </h1>
  </section>

  <section class="content">
    <div class="col-md-08">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">History Details</h3>
        </div>

        <div class="box-body">
            <div class="col-md-12 accord-2" id="accord-2">
                <div class="form-group">
                    <label class="col-lg-3">Name:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['name'] ? $data['name'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="primary">
                <div class="form-group">
                    <label class="col-lg-3 b-date">Do Not Contact Consultants:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['contact'] ? $data['contact'] :'' ?>" type="text" name="contact" >
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 b-date">Client Notes:</label>
                    <div class="col-lg-9">
                        <textarea class="form-control" name="client_note" ><?php echo $data['client_note'] ? $data['client_note'] :'' ?></textarea> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Unit Number:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['unit_number'] ? $data['unit_number'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Consultant Number:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['consultant_number'] ? $data['consultant_number'] : '';?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Intouch Password:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['intouch_password'] ? $data['intouch_password'] : '';?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Cell Phone Number:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['cell_number'] ? $data['cell_number'] : '' ?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Director Title:</label>
                    <div class="col-lg-9">
                        <select name="director_title" class="form-control" >
                            <option value="">---Select Director Title--</option>
                            <option value="Independent Sales Director"<?php echo $data['director_title']=='Independent Sales Director' ? 'selected="selected"' : '';?>>Independent Sales Director</option>
                            <option value="Independent Senior Sales Director" <?php echo $data['director_title']=='Independent Senior Sales Director' ? 'selected="selected"' : ''; ?>>Independent Senior Sales Director</option>
                            <option value="Future Executive Senior Sales Director" <?php echo $data['director_title']=='Future Executive Senior Sales Director' ? 'selected="selected"' : ''; ?>>Future Executive Senior Sales Director</option>
                            <option value="Executive Senior Sales Director" <?php echo $data['director_title']=='Executive Senior Sales Director' ? 'selected="selected"' : ''; ?>>Executive Senior Sales Director</option>
                            <option value="Elite Executive Senior Sales Director" <?php echo $data['director_title']=='Elite Executive Senior Sales Director' ? 'selected="selected"' : ''; ?>>Elite Executive Senior Sales Director</option>
                            <option value="Independent National Sales Director" <?php echo $data['director_title']=='Independent National Sales Director' ? 'selected="selected"' : ''; ?>>Independent National Sales Director</option>
                            <option value="Independent Senior National Sales Director" <?php echo $data['director_title']=='Independent Senior National Sales Director' ? 'selected="selected"' : ''; ?>>Independent Senior National Sales Director</option>
                            <option value="Independent Executive National Sales Director" <?php echo $data['director_title']=='Independent Executive National Sales Director' ? 'selected="selected"' : ''; ?>>Independent Executive National Sales Director</option>
                            <option value="Independent Elite Executive National Sales Director" <?php echo $data['director_title']=='Independent Elite Executive National Sales Director' ? 'selected="selected"' : ''; ?>>Independent Elite Executive National Sales Director</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Closing for E cards</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['closing_ecards'] ? $data['closing_ecards'] : '' ?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">MK email address:</label>
                    <div class="col-lg-9">
                        <input  name="email" class="form-control" value="<?php echo $data['email'] ? $data['email'] : ''?>" type="email" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Your Birthday:</label>
                    <div class="col-lg-9 b-date">
                        <input type="text" name="dob" placeholder="click to show datepicker"  value="<?php echo $data['dob'] ? $data['dob'] : ''?>" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Unit Web Site:</label>
                    <div class="col-lg-9">
                        <input type="text" name="unit_web_site" class="form-control" value="<?php echo $data['unit_web_site'] ? $data['unit_web_site'] : ''?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Unit Name:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['unit_name'] ? $data['unit_name'] : '';?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Unit Colors/Favorite:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['unit_color'] ? $data['unit_color'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Unit Goal:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['unit_goal'] ? $data['unit_goal'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">National Area/Go give:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['national_area'] ? $data['national_area'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Seminar Affiliation:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['seminar_affiliation'] ? $data['seminar_affiliation'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="primary">
                    <div class="form-group">
                        <label class="col-sm-3">Primary Personality Style:</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name="primary_personality" value="D" <?php echo ($data['primary_personality']=='D') ? 'checked' : ''?> > D
                            </label>
                            <label class="radio-inline">
                                <input name="primary_personality" value="I" type="radio"<?php echo ($data['primary_personality']=='I') ? 'checked' : ''?> > I
                            </label>
                            <label class="radio-inline">
                                <input name="primary_personality" value="S"  type="radio" <?php echo ($data['primary_personality']=='S') ? 'checked' : ''?> > S
                            </label>
                             <label class="radio-inline">
                                <input name="primary_personality" value="C" type="radio" <?php echo ($data['primary_personality']=='C') ? 'checked' : ''?> > C
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Referred by:</label>
                    <div class="col-lg-9">
                        <input class="form-control" value="<?php echo $data['reffered_by'] ? $data['reffered_by'] : ''?>" type="text" >
                    </div>
                </div>
                <div class="last-field">
                    <div class="form-group">
                        <label class="col-lg-3">First time bill date:</label>
                        <div class="col-lg-9">
                            <input class="form-control" value="<?php echo $data['first_bill_date'] ? $data['first_bill_date'] : ''?>" type="text" name="first_bill_date" placeholder="click to show datepicker" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <label>Language :</label>
                    </div>  
                    <div class="col-md-3">
                        <input type="radio" name="newsletters_design" value="E" <?php echo (($data['newsletters_design']=='E') || ($data['newsletters_design']=='')) ? 'checked' : ''?> > English
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="newsletters_design" value="S" <?php echo ($data['newsletters_design']=='S') ? 'checked' : ''?> >Spanish
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <label>Select Email :</label>
                    </div>  
                    <div class="col-md-3">
                        <input type="radio" name="select_email" value="W" <?php echo (($data['select_email']=='W') || ($data['select_email']=='')) ? 'checked' : ''?> > Welcome
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="select_email" value="C" <?php echo ($data['select_email']=='C') ? 'checked' : ''?> >Current
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3">Contract Update Date:</label>
                    <div class="col-lg-9">
                        <input class="form-control" id="example4" value="<?php echo $data['contract_update_date'] ? $data['contract_update_date'] :'';?>" type="text" name="contract_update_date" >
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" id="next" class="btn btn-success btn-md button">Next</button>
                </div> 
            </div>
            <div class="panel-group main-accord" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="accordion">Newsletter Designs</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label> Newsletter Designs: </label>
                                </div>
                                <div class="col-md-12"> 
                                    <div class="col-md-6">
                                        <input type="radio" name="design_one" class="radio-inline" <?php echo ($data['hidden_newsletter']=='SE') ? 'checked' : ''?> > Simple Newsletter English
                                    </div>  
                                    <div class="col-md-6">      
                                        <input type="radio" name="design_one" class="radio-inline" <?php echo ($data['hidden_newsletter']=='SS') ? 'checked' : ''?> > Simple Newsletter Spanish
                                    </div>
                                </div>    
                                <div class="col-md-12"> 
                                    <div class="col-md-6">        
                                        <input type="radio" name="design_one"  class="radio-inline" <?php echo ($data['hidden_newsletter']=='SB') ? 'checked' : ''?> > Simple Newsletter Both
                                    </div>
                                    <div class="col-md-6">        
                                        <input type="radio" name="design_one" class="radio-inline" <?php echo ($data['hidden_newsletter']=='AE') ? 'checked' : ''?> > Advanced Newsletter English 
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <div class="col-md-6">                
                                        <input type="radio" name="design_one" class="radio-inline" <?php echo ($data['hidden_newsletter']=='AS') ? 'checked' : ''?> > Advanced Newsletter Spanish
                                    </div>
                                    <div class="col-md-6">        
                                        <input type="radio" name="design_one" class="radio-inline" <?php echo ($data['hidden_newsletter']=='AB') ? 'checked' : ''?> > Advanced Newsletter Both
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <div class="col-md-6">    
                                        <input type="radio" name="design_one" class="radio-inline" <?php echo ($data['hidden_newsletter']=='') ? 'checked' : ''?> >No Subscription 
                                    </div>
                                </div>       
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>Director Name in Stars:</label>
                                    <input type="radio" name="design_two" class="radio-inline" <?php echo ($data['design_two']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="design_two" class="radio-inline" <?php echo ($data['design_two']=='N') || ($data['design_two']=='') ? 'checked' : ''?> > No
                                    <input type="radio" name="design_two" class="radio-inline" <?php echo ($data['design_two']=='X') ? 'checked' : ''?> > No Subscription     
                                </div>
                                <div class="col-md-12">
                                    <label>Wholesale Section -Show wholesale amounts  :</label>  
                                    <input type="radio" name="wholesale_amount" class="radio-inline" <?php echo ($data['wholesale_amount']=='Y') || ($data['wholesale_amount']=='') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="wholesale_amount"  class="radio-inline" <?php echo ($data['wholesale_amount']=='N') ? 'checked' : ''?> > No
                                    <input type="radio" name="wholesale_amount"  class="radio-inline" <?php echo ($data['wholesale_amount']=='X') ? 'checked' : ''?> > No Subscription     
                                </div>
                                <div class="col-md-12">
                                    <label>Wholesale Section - Show Director name in Stats:</label>  
                                    <input type="radio" name="wholesale_section" class="radio-inline" <?php echo ($data['wholesale_section']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="wholesale_section"  class="radio-inline" <?php echo ($data['wholesale_section']=='N') || ($data['wholesale_section']=='') ? 'checked' : ''?> > No
                                    <input type="radio" name="wholesale_section"  class="radio-inline" <?php echo ($data['wholesale_section']=='X') ? 'checked' : ''?> > No Subscription 
                                </div>
                                <div class="col-md-12">
                                    <label>Court of Sales~Show Consultant Amounts:</label>  
                                    <input type="radio" name="court_sale" class="radio-inline" <?php echo ($data['court_sale']=='Y') || ($data['court_sale']=='') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="court_sale"  class="radio-inline" <?php echo ($data['court_sale']=='N') ? 'checked' : ''?> > No  
                                    <input type="radio" name="court_sale"  class="radio-inline" <?php echo ($data['court_sale']=='X') ? 'checked' : ''?> > No Subscription     
                                </div>
                                <div class="col-md-12">
                                    <label>Court of Sales~Show Director name in Stats:</label>  
                                    <input type="radio" name="court_sale_director" class="radio-inline" <?php echo ($data['court_sale_director']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="court_sale_director"  class="radio-inline" <?php echo ($data['court_sale_director']=='N') || ($data['court_sale_director']=='') ? 'checked' : ''?> > No
                                    <input type="radio" name="court_sale_director"  class="radio-inline" <?php echo ($data['court_sale_director']=='X') ? 'checked' : ''?> > No Subscription 
                                </div>
                                <div class="col-md-12">
                                    <label>Court of Sharing~Show commission Amounts:</label>  
                                    <input type="radio" name="court_sharing" class="radio-inline" <?php echo ($data['court_sharing']=='Y') || ($data['court_sharing']=='') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="court_sharing"  class="radio-inline" <?php echo ($data['court_sharing']=='N') ? 'checked' : ''?> > No
                                    <input type="radio" name="court_sharing"  class="radio-inline" <?php echo ($data['court_sharing']=='X') ? 'checked' : ''?> > No Subscription     
                                </div>
                                <div class="col-md-12">
                                    <label>Court of Sharing - Show Director Name Stats:</label>  
                                    <input type="radio" name="court_sharing_director" class="radio-inline" <?php echo ($data['court_sharing_director']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="court_sharing_director"  class="radio-inline" <?php echo ($data['court_sharing_director']=='N')||($data['court_sharing_director']=='') ? 'checked' : ''?> > No
                                    <input type="radio" name="court_sharing_director"  class="radio-inline" <?php echo ($data['court_sharing_director']=='X') ? 'checked' : ''?> > No Subscription 
                                </div>
                                <div class="col-md-12">
                                    <label>Do you Celebrate Birthdays:</label>  
                                    <input type="radio" name="birthday_rec" class="radio-inline" <?php echo ($data['birthday_rec']=='Y') || ($data['birthday_rec']=='') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="birthday_rec"  class="radio-inline" <?php echo ($data['birthday_rec']=='N') ? 'checked' : ''?> > No
                                    <input type="radio" name="birthday_rec"  class="radio-inline" <?php echo ($data['birthday_rec']=='X') ? 'checked' : ''?> > No Subscription     
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Wholesale - Remove any names under : </label>
                                    </div>
                                    <div class="col-md-6">    
                                        <input type="text" name="wholesale_remove_name" value="<?php echo $data['wholesale_remove_name'] ? $data['wholesale_remove_name'] : 0 ?>" >
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Wholesale - Remove any amounts under this amount but leave names Amount here:</label>
                                    </div>   
                                
                                    <div class="col-md-6">  
                                        <input type="text" name="wholesale_remove" value="<?php echo $data['wholesale_remove'] ? $data['wholesale_remove'] :0 ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Special Newsletter Requests    </label> 
                                    </div>   
                                
                                    <div class="col-md-6">  
                                        <input type="text" name="special_news_request" value="<?php echo $data['special_news_request'] ? $data['special_news_request'] : '' ?>" >
                                    </div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>English Bitly Url:</label> 
                                    </div>
                                    <div class="col-md-6">  
                                        <input type="text" name="beatly_url" value="<?php echo $data['beatly_url'] ? $data['beatly_url'] : '' ?>" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Spanish Bitly Url:</label> 
                                    </div>
                                    <div class="col-md-6">  
                                        <input type="text" name="beatly_url_one" value="<?php echo $data['beatly_url_one'] ? $data['beatly_url_one'] : '' ?>">
                                    </div>
                                </div>  
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="accordion">Newsletters Distribution
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>Unit Newsletter Emailed to Unit</label>  
                                    <input type="checkbox" name="distribution_one" value="2"<?php echo ($data['distribution_one'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Facebook Posting Unit Newsletter</label>    
                                    <input type="checkbox" name="distribution_two" value="2" <?php echo ($data['distribution_two'] != 0) ? 'checked' : ''?> >
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="accordion">Birthdays
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                   <div class="col-md-3">
                                        <label>Birthday :</label> 
                                    </div>
                                    <div class="col-md-3">
                                        <input type="radio" name="birthday_one" value="2" <?php echo ($data['birthday_one'] == 2) ? 'checked' : ''?> > Hand Signed - Gift Included - Magnet 
                                    </div>
                                    <div class="col-md-3">    
                                        <input type="radio" name="birthday_one" value="1" <?php echo ($data['birthday_one']=='1') ? 'checked' : ''?> > Birthday Post Card
                                    </div>
                                    <div class="col-md-3">    
                                        <input type="radio" name="birthday_one"  class="radio-inline" <?php echo ($data['birthday_one'] == 0) ? 'checked' : ''?> > No Subcription   
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="accordion">Anniversary
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label>Annivesary : </label>
                                    </div>
                                    <div class="col-md-3">    
                                        <input type="radio" name="anniversary_one" class="radio-inline" <?php echo ($data['anniversary_one'] == 2) ? 'checked' : ''?> > Hand Signed - Gift Included - Magnet 
                                    </div> 
                                    <div class="col-md-3">   
                                        <input type="radio" name="anniversary_one" class="radio-inline" <?php echo ($data['anniversary_one']=='1') ? 'checked' : ''?> > Anniversary Post Card 
                                    </div>
                                    <div class="col-md-3">        
                                        <input type="radio" name="anniversary_one"  class="radio-inline" <?php echo ($data['anniversary_one'] == 0) ? 'checked' : ''?> > No Subcription 
                                    </div>
                                </div>            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" class="accordion">Status Post Cards
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>A3 ~ Earned discount reminder Post Card </label>  
                                    <input type="checkbox" name="status_one" value="1" <?php echo ($data['status_one'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Inactive 1st Month Post Card </label>    
                                    <input type="checkbox" name="status_two" value="1" <?php echo ($data['status_two'] != 0) ? 'checked' : ''?> >
                                </div>
                                 <div class="col-md-12">
                                    <label>Inactive 2nd Month Post Card </label>  
                                    <input type="checkbox" name="status_three" value="1" <?php echo ($data['status_three'] != 0 ) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Inactive 3rd Month Post Card </label>    
                                    <input type="checkbox" name="status_four" value="1" <?php echo ($data['status_four'] != 0) ? 'checked' : ''?> >
                                </div>
                                 <div class="col-md-12">
                                    <label>Terminated (TI) Post Card </label>  
                                    <input type="checkbox" name="status_five" value="1" <?php echo ($data['status_five'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Thank For Ordering Post Card  </label>    
                                    <input type="checkbox" name="status_six" value="1" <?php echo ($data['status_six'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label> Consistency Club $750 or $250 </label>
                                    <input type="checkbox" name="status_seven" value="2" <?php echo ($data['status_seven'] != 0) ? 'checked' : ''?> >
                                    <?php if(empty($data['status_seven0'])) { ?>    
                                           <input type="button" value="$750" id="but" class="btn btn-danger btn-md">
                                    <?php } else { ?>    
                                           <input type="button" value="$750" id="but" class="btn btn-success btn-md">
                                    <?php } ?>
                                
                                </div>
                                <div class="col-md-12">
                                    <label> Send to Director </label>
                                    <input type="checkbox" name="status_seven1" value="2" <?php echo ($data['status_seven1'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label> Star on Target-Include Your name on card Y or N </label>    
                                    <input type="checkbox" name="status_eight" value="1" <?php echo ($data['status_eight'] != 0) ? 'checked' : ''?> >
                                     <input type="radio" name="status_eight1" class="radio-inline" <?php echo ($data['status_eight1']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="status_eight1"  class="radio-inline" <?php echo ($data['status_eight1']=='N') ? 'checked' : ''?> > No
                                </div>
                                <div class="col-md-12">
                                    <label> Star Congratulations Gifts </label>    
                                    <input type="checkbox" name="status_nine" value="1" <?php echo ($data['status_nine'] != 0) ? 'checked' : ''?> >
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix" class="accordion">Last Month Correspondence
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label> Last Month Correspondence :  </label>
                                </div>
                                <div class="col-md-12">
                                    <input type="radio" name="last_one" class="radio-inline" <?php echo ($data['last_one'] == 2) ? 'checked="checked"' : ''?> > Look Book, Sample & Letter from you 
                                    <input type="radio" name="last_one"  class="radio-inline" <?php echo ($data['last_one']=='1') ? 'checked' : ''?> > Last Month Post Card
                                    <input type="radio" name="last_one"  class="radio-inline" <?php echo ($data['last_one'] == 0) ? 'checked' : ''?> > No Subcription   
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" class="accordion">Gift Services
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>Monthly wholesale Post Cards & Gift Service </label>  
                                    <input type="checkbox" name="gift_one" <?php echo ($data['gift_one'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>YTD Sales Post Card & Gift Service</label>    
                                    <input type="checkbox" name="gift_two" <?php echo ($data['gift_two'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Recruiting Post Card & Gift Service</label>    
                                    <input type="checkbox" name="gift_three" <?php echo ($data['gift_three'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Send Gift To Director</label>    
                                    <input type="checkbox" name="gift_four" <?php echo ($data['gift_four'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>New Reds Program With Gift</label>    
                                    <input type="checkbox" name="gift_five" <?php echo ($data['gift_five'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Star Program- Lori Hogg brush gift</label>    
                                    <input type="checkbox" <?php echo ($data['star_program'] != 0) ? 'checked' : ''?> >
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight" class="accordion">New Consultant Options
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="lebal-seven">New Consultant Husband Post Card </label>  
                                    <input type="checkbox" name="consultant_one" value="1" <?php echo ($data['consultant_one'] != 0) ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label class="lebal-seven"> New Consultant Post Card(6 weeks) <br>
                                      <small>please send  the 7 Day wonder challange card Yes or No</small> 
                                    </label>    
                                    <input type="checkbox" name="consultant_two" value="1" <?php echo ($data['consultant_two'] != 0) ? 'checked' : ''?> >
                                    <input type="radio" name="consultant_two1" class="radio-inline" <?php echo ($data['consultant_two1']=='Y') ? 'checked' : ''?> >Yes 
                                    <input type="radio" name="consultant_two1" class="radio-inline" <?php echo ($data['consultant_two1']=='N') ? 'checked' : ''?> > No
                                    <input type="radio" name="consultant_two1" class="radio-inline" <?php echo ($data['consultant_two1']=='X') ? 'checked' : ''?> > No Subscription
                                </div>
                                <div class="col-md-12">
                                    <label class="lebal-seven">New Consultant Welcome Packet</label>    
                                    <input type="checkbox" name="consultant_three" value="1" <?php echo ($data['consultant_three'] != 0) ? 'checked' : ''?> >
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="lebal-seven">Only Mail Bundles to me I will hand out </label>
                                    <input type="radio" name="consultant_five" value="Y" <?php echo ($data['consultant_five']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="consultant_five" value="N" <?php echo ($data['consultant_five']=='N') ? 'checked' : ''?> > No
                                    <input type="radio" name="consultant_five" value="X" <?php echo ($data['consultant_five']=='X') ? 'checked' : ''?> > No Subscription 
                                </div>
                                 <div class="col-md-12">
                                    <label class="lebal-seven">Recruiter Checklist </label>    
                                    <input type="checkbox" name="consultant_six" value="1" <?php echo ($data['consultant_six'] != 0) ? 'checked' : ''?> >
                                </div>
                                 <div class="col-md-12">
                                    <label class="lebal-seven">New Consultant Notes:</label>
                                    <textarea  name="consultant_seven" readonly="" ><?php echo empty($data['consultant_seven']) ? '' : $data['consultant_seven']?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <input type="radio" name="consultant_four" value="U" <?php echo ($data['consultant_four']=='U') ? 'checked' : ''?> > Use UA Packet only  
                                    <input type="radio" name="consultant_four" value="A" <?php echo ($data['consultant_four'] =='A') ? 'checked' : ''?> > Adding pages into UA Packet 
                                    <input type="radio" name="consultant_four" value="P" <?php echo ($data['consultant_four']=='P') ? 'checked' : ''?> > Packet Translated To Spanish 
                                    <input type="radio" name="consultant_four" value="S" <?php echo ($data['consultant_four']=='S') ? 'checked' : ''?> > Use UA Spanish Packet
                                    <input type="radio" name="consultant_four" value="N" <?php echo ($data['consultant_four']=='N') || ($data['consultant_four']=='') ? 'checked' : ''?> >No Subscription
                                </div>     
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingNine">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">Newsletter Printing options
                            </a>
                        </h4>
                    </div>
                    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>No Email Option</label>  
                                    <input type="checkbox" name="no_email_option" value="0" <?php echo ($data['no_email_option']=='1') ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Override Color</label>    
                                    <input type="checkbox" name="override_color" value="0" <?php echo ($data['override_color']=='1') ? 'checked' : ''?> >
                                </div> 
                                <div class="col-md-12">
                                    <label>Auto Send:</label>    
                                    <input type="text" name="auto_send" value="<?php echo ($data['auto_send'] != '') ? $data['auto_send'] : ''?>" id="auto_send"   >
                                </div> 
                                <div class="col-md-12">
                                    <label>Override Black /white</label>
                                    <input type="checkbox" name="override_black_white" value="0" <?php echo ($data['override_black_white']=='1') ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>English Only Newsletter</label>
                                     <input type="checkbox" name="english_only" value="0" <?php echo ($data['english_only']=='1') ? 'checked' : ''?> >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 ">
                                    <label>Newsletter Notes:</label> 
                                    <textarea name="newsletter_send_notes"><?php echo ($data['newsletter_send_notes'] != '') ? $data['newsletter_send_notes'] : ''?></textarea>
                                </div>   
                            </div>  
                            <div class="col-md-12">    
                                <div class="col-md-12">
                                    <label>N0</label>
                                    <input type="radio" name="n_zero" class="radio-inlinC" <?php echo ($data['n_zero']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="n_zero" class="radio-inline" <?php echo ($data['n_zero']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="n_zero" class="radio-inline" <?php echo ($data['n_zero']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="n_zero" class="radio-inline" <?php echo ($data['n_zero']=='N') ? 'checked' : ''?> >No Subscription             
                                </div>
                                <div class="col-md-12">
                                    <label>N1</label>
                                    <input type="radio" name="n_one" class="radio-inline" <?php echo ($data['n_one']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="n_one" class="radio-inline" <?php echo ($data['n_one']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="n_one" class="radio-inline" <?php echo ($data['n_one']=='F') ? 'checked' : ''?> >Front Page Color 
                                    <input type="radio" name="n_one" class="radio-inline" <?php echo ($data ['n_one']=='N') ? 'checked' : ''?> >No Subscription              
                                </div>
                                <div class="col-md-12">
                                    <label>N2</label>
                                    <input type="radio" name="n_two" class="radio-inline" <?php echo ($data['n_two']=='C') ? 'checked' : ''?>  >Full Color
                                    <input type="radio" name="n_two" class="radio-inline" <?php echo ($data['n_two']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="n_two" class="radio-inline" <?php echo ($data['n_two']=='F') ? 'checked' : ''?> >Front Page Color 
                                    <input type="radio" name="n_two" class="radio-inline" <?php echo ($data['n_two']=='N') ? 'checked' : ''?> >No Subscription              
                                </div>
                                <div class="col-md-12">
                                    <label>N3</label>
                                    <input type="radio" name="n_three" class="radio-inline" <?php echo ($data['n_three']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="n_three" class="radio-inline" <?php echo ($data['n_three']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="n_three" class="radio-inline" <?php echo ($data['n_three']=='F') ? 'checked' : ''?> > Front Page Color
                                    <input type="radio" name="n_three" class="radio-inline" <?php echo ($data['n_three']=='N') ? 'checked' : ''?> >No Subscription         
                                </div>
                                <div class="col-md-12">
                                    <label>A1</label>
                                    <input type="radio" name="a_one" class="radio-inline" <?php echo ($data['a_one']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="a_one" class="radio-inline" <?php echo ($data['a_one']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="a_one" class="radio-inline" <?php echo ($data['a_one']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="a_one" class="radio-inline" <?php echo ($data['a_one']=='N') ? 'checked' : ''?> >No Subscription             
                                </div>
                                <div class="col-md-12">
                                    <label>A2</label>
                                    <input type="radio" name="a_two" class="radio-inline" <?php echo ($data['a_two']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="a_two" class="radio-inline" <?php echo ($data['a_two']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="a_two" class="radio-inline" <?php echo ($data['a_two']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="a_two" class="radio-inline" <?php echo ($data['a_two']=='N') ? 'checked' : ''?> >No Subscription             
                                </div>
                                <div class="col-md-12">
                                    <label>A3</label>
                                    <input type="radio" name="a_three" class="radio-inline" <?php echo ($data['a_three']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="a_three" class="radio-inline" <?php echo ($data['a_three']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="a_three" class="radio-inline" <?php echo ($data['a_three']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="a_three" class="radio-inline" <?php echo ($data['a_three']=='N') ? 'checked' : ''?> >No Subscription         
                                </div>
                                <div class="col-md-12">
                                    <label>I1</label>
                                    <input type="radio" name="i_one" class="radio-inline" <?php echo ($data['i_one']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="i_one" class="radio-inline" <?php echo ($data['i_one']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="i_one" class="radio-inline" <?php echo ($data['i_one']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="i_one" class="radio-inline" <?php echo ($data['i_one']=='N') ? 'checked' : ''?> >No Subscription             
                                </div>
                                <div class="col-md-12">
                                    <label>I2</label>
                                    <input type="radio" name="i_two" class="radio-inline" <?php echo ($data['i_two']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="i_two" class="radio-inline" <?php echo ($data['i_two']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="i_two" class="radio-inline" <?php echo ($data['i_two']=='F') ? 'checked' : ''?> >Front Page Color 
                                    <input type="radio" name="i_two" class="radio-inline" <?php echo ($data['i_two']=='N') ? 'checked' : ''?> >No Subscription          
                                </div>
                                <div class="col-md-12">
                                    <label>I3</label>
                                    <input type="radio" name="i_three" class="radio-inline" <?php echo ($data['i_three']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="i_three" class="radio-inline" <?php echo ($data['i_three']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="i_three" class="radio-inline" <?php echo ($data['i_three']=='F') ? 'checked' : ''?> >Front Page Color
                                    <input type="radio" name="i_three" class="radio-inline" <?php echo ($data['i_three']=='N') ? 'checked' : ''?> >No Subscription               
                                </div>
                                <div class="col-md-12">
                                    <label>T1</label>
                                    <input type="radio" name="t_one" class="radio-inline" <?php echo ($data['t_one']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="t_one" class="radio-inline" <?php echo ($data['t_one']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="t_one" class="radio-inline" <?php echo ($data['t_one']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="t_one" class="radio-inline" <?php echo ($data['t_one']=='N') ? 'checked' : ''?> >No Subscription             
                                </div>
                                <div class="col-md-12">
                                    <label>T2</label>
                                    <input type="radio" name="t_two" class="radio-inline" <?php echo ($data['t_two']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="t_two" class="radio-inline" <?php echo ($data['t_two']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="t_two" class="radio-inline" <?php echo ($data['t_two']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="t_two" class="radio-inline" <?php echo ($data['t_two']=='N') ? 'checked' : ''?> >No Subscription         
                                </div>
                                <div class="col-md-12">
                                    <label>TP</label>
                                    <input type="radio" name="t_three" class="radio-inline" <?php echo ($data['t_three']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="t_three" class="radio-inline" <?php echo ($data['t_three']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="t_three" class="radio-inline" <?php echo ($data['t_three']=='F') ? 'checked' : ''?> >Front Page Color  
                                    <input type="radio" name="t_three" class="radio-inline" <?php echo ($data['t_three']=='N') ? 'checked' : ''?> >No Subscription             
                                </div>
                                <div class="col-md-12">
                                    <label>TS</label>
                                    <input type="radio" name="t_four" class="radio-inline" <?php echo ($data['t_four']=='C') ? 'checked' : ''?> >Full Color
                                    <input type="radio" name="t_four" class="radio-inline" <?php echo ($data['t_four']=='B') ? 'checked' : ''?> >B/W 
                                    <input type="radio" name="t_four" class="radio-inline" <?php echo ($data['t_four']=='F') ? 'checked' : ''?> > 
                                                Front Page Color  
                                    <input type="radio" name="t_four" class="radio-inline" <?php echo ($data['t_four']=='N') ? 'checked' : ''?> >No Subscription                 
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title total accordion" > POINT TOTAL
                          <span style="float: right;" id="output"><?php echo $data['point_value'];?></span>
                          <input type="hidden" name="point" id="point" value="">
                        </h4>
                    </div>
                    <div  class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour"></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">Packaging</a>
                        </h4>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label>Actual Unit Size : </label>
                                    <input type="text" name="unit_size" value="<?php echo ($data['unit_size']) ? $data['unit_size'] : '';?>" id="unit_size" >
                                    <span id="error" style="color: rgb(196, 30, 30);"></span>
                                </div>
                                <div class="col-md-12">
                                    <label>Package : </label>
                                    <input type="radio" name="package" class="radio-inline"  value="S" <?php echo ($data['package']=='S') ? 'checked' : ''?> > Sapphire  
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='R') ? 'checked' : ''?> > Ruby
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='D') ? 'checked' : ''?> > Diamond
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='E') ? 'checked' : ''?> > Emerald
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='P') ? 'checked' : ''?> > Pearl
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='E1') ? 'checked' : ''?> > Economy
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='S1') ? 'checked' : ''?> > Special
                                    <input type="radio" name="package"  class="radio-inline" <?php echo ($data['package']=='N') ? 'checked' : ''?> > No Subscription
                                </div>
                                <div class="col-md-12">
                                    <label>Facebooking Newsletter </label>
                                    <input type="checkbox" name="facebook" class="radio-inline"  value="0" <?php echo ($data['facebook']=='1') ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Newsletter</label>
                                    <input type="radio" name="emailing" class="radio-inline"  value="1" <?php echo ($data['emailing']=='1') ? 'checked' : ''?> > $38
                                    <input type="radio" name="emailing"  class="radio-inline" <?php echo ($data['emailing']=='2') ? 'checked' : ''?> > $55
                                    <input type="radio" name="emailing"  class="radio-inline" <?php echo ($data['emailing']=='0') ? 'checked' : ''?> >
                                    <?php 
                                    $hidden_radio=(($data['emailing']=='1') ? 38 : (($data['emailing']==2) ? 55 : 0)); ?>
                                    <input type="hidden" name="hidden_radio" id="hidden_radio" value="<?php echo $hidden_radio ?>">No Subscription
                                </div>
                                <div class="col-md-12">
                                    <label>Emailing of newsletter</label>
                                    <input type="checkbox" name="email_newsletter" class="radio-inline"  value="0" <?php echo ($data['email_newsletter']=='1') ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>NSD text and email</label>
                                    <input type="checkbox" name="email_newsletter" class="radio-inline"  value="0" <?php echo ($data['nsd_client']=='1') ? 'checked' : ''?> >
                                </div> 
                                 <div class="col-md-12">
                                    <label>Total Text Program : </label>
                                    <input type="checkbox" name="total_text_program" class="radio-inline"  value="0" <?php echo ($data['total_text_program']=='1') ? 'checked' : ''?> >
                                </div>
                                
                                <div class="col-md-12">
                                    <label>Other language newsletter</label>
                                    <input type="checkbox" name="other_language_newsletter" class="radio-inline"  value="0" <?php echo ($data['other_language_newsletter']=='1') ? 'checked' : ''?> >
                                </div>
                                <div class="col-md-12">
                                    <label>Newsletter-Color</label>
                                    <input type="number" name="newsletter_color" value="<?php echo ($data['newsletter_color']) ? $data['newsletter_color'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Newsletter-Black White</label> 
                                    <input type="number" name="newsletter_black_white" value="<?php echo ($data['newsletter_black_white']) ? $data['newsletter_black_white'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>13th Month Packet Postage</label>
                                    <input type="number" name="month_packet_postage" value="<?php echo ($data['month_packet_postage']) ? $data['month_packet_postage'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>New Consultant Packet Postage</label>
                                    <input type="number" name="consultant_packet_postage" value="<?php echo ($data['consultant_packet_postage']) ? $data['consultant_packet_postage'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>New Consultant Bundles</label>
                                    <input type="number" name="consultant_bundles" value="<?php echo ($data['consultant_bundles']) ? $data['consultant_bundles'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Consistency Gift</label>
                                    <input type="number" name="consistency_gift" value="<?php echo ($data['consistency_gift']) ? $data['consistency_gift'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Reds Program Gift</label>
                                    <input type="number" name="reds_program_gift" value="<?php echo ($data['reds_program_gift']) ? $data['reds_program_gift'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Stars Program Gift</label>
                                    <input type="number" name="stars_program_gift" value="<?php echo ($data['stars_program_gift']) ? $data['stars_program_gift'] :0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Gift Wrap and Postage</label>
                                    <input type="number" name="gift_wrap_postpage" value="<?php echo ($data['gift_wrap_postpage']) ? $data['gift_wrap_postpage'] :0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>One Rate Postage</label>
                                    <input type="number" name="one_rate_postpage" value="<?php echo ($data['one_rate_postpage']) ? $data['one_rate_postpage'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Month End Blast Flyer</label>
                                    <input type="number" name="month_blast_flyer" value="<?php echo ($data['month_blast_flyer']) ? $data['month_blast_flyer'] : 0;?>" >
                                <div class="col-md-12">
                                    <label>Flyer Ecard to Unit</label>
                                    <input type="number" name="flyer_ecard_unit" value="<?php echo ($data['flyer_ecard_unit']) ? $data['flyer_ecard_unit'] :0;?>">
                                </div>
                                <div class="col-md-12">
                                    <label>Unit Challenge Flyer</label>
                                    <input type="number" name="unit_challenge_flyer" value="<?php echo ($data['unit_challenge_flyer']) ? $data['unit_challenge_flyer'] :0;?>">
                                </div>
                                <div class="col-md-12">
                                    <label>Team Building Flyer</label>
                                    <input type="number" name="team_building_flyer" value="<?php echo ($data['team_building_flyer']) ? $data['team_building_flyer'] : 0;?>">
                                <div class="col-md-12">
                                    <label>Wholesale Promo Flyer</label>
                                    <input type="number" name="wholesale_promo_flyer" value="<?php echo ($data['wholesale_promo_flyer']) ? $data['wholesale_promo_flyer'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Flyer/Page/ Postcard Design</label>
                                    <input type="number" name="postcard_design" value="<?php echo ($data['postcard_design']) ? $data['postcard_design'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Flyer/Page/ Postcard Edits</label>
                                    <input type="number" name="postcard_edit" value="<?php echo ($data['postcard_edit']) ? $data['postcard_edit'] :0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Flyer Design/Ecard to unit</label>
                                    <input type="number" name="ecard_unit" value="<?php echo ($data['ecard_unit']) ? $data['ecard_unit'] :0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Specialty Postcard </label>
                                    <input type="number" name="speciality_postcard" value="<?php echo ($data['speciality_postcard']) ? $data['speciality_postcard'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Card with gift</label>
                                    <input type="number" name="card_with_gift" value="<?php echo ($data['card_with_gift']) ? $data['card_with_gift'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Birthday Card and Brownie</label>
                                    <input type="number" name="birthday_brownie" value="<?php echo ($data['birthday_brownie']) ? $data['birthday_brownie'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Birthday Cards and Starbucks</label>
                                    <input type="number" name="birthday_starbucks" value="<?php echo ($data['birthday_starbucks']) ? $data['birthday_starbucks'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Anniversary Card and Starbucks</label>
                                    <input type="number" name="anniversary_starbucks" value="<?php echo ($data['anniversary_starbucks']) ? $data['anniversary_starbucks'] : 0;?>" > 
                                </div>
                                <div class="col-md-12">
                                    <label>Referral Credit</label>
                                    <input type="number" name="referral_credit" value="<?php echo ($data['referral_credit']) ? $data['referral_credit'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label>Special Credit</label>
                                    <input type="number" name="special_credit" value="<?php echo ($data['special_credit']) ? $data['special_credit'] : 0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label> Consultant Communication- billing </label>
                                    <input type="number" name="cc_billing" value="<?php echo ($data['cc_billing']) ? $data['cc_billing'] :0;?>" >
                                </div>
                                <div class="col-md-12">
                                    <label> Customer Newsletter </label>
                                    <input type="number" name="customer_newsletter" value="<?php echo ($data['customer_newsletter']) ? $data['customer_newsletter'] : 0;?>" >
                                </div>
                                
                                <div class="col-md-12">
                                    <label> NL Flyer Design </label>
                                    <input type="number" name="nl_flyer" value="<?php echo $data['nl_flyer'];?>" >
                                </div>
                                <?php 
                                if($data['nsd_client']=='1') { ?>
                                <div class="col-md-12">
                                    <label> Texting: </label>
                                    <input type="radio" name="texting" class="radio-inline"> Yes 
                                    <input type="radio" name="texting" class="radio-inline" > No
                                    <input type="radio" name="texting" class="radio-inline" > No Subscription  
                                   <input type="hidden" name="hidden_texting"  id="hidden_texting" class="radio-inline" value="<?php echo isset($data['hidden_texting']) ? $data['hidden_texting'] : 0 ;?>" >
                                    <?php 
                                        if(($data['package']=='E1') && ($data['texting']=='Y')) { ?>        
                                        <div class="col-md-12" id="economy_div">
                                            <label> Please choose price: </label>
                                            <input type="radio" name="economy" class="radio-inline"> 19.99
                                            <input type="radio" name="economy"  class="radio-inline"> 49.99
                                        </div> 
                                    <?php } ?>       
                                </div>
                                <?php } ?>
                                <div class="col-md-12">
                                    <label> Text System:Free With Diamond Plus PKG Includes all @ signs for test and all othe Email services with @ sign. : 
                                      <?php 
                                          $sHiddenNewsletterPrice = Get_hidden_newsletter($data['hidden_newsletter']);
                                          $sPackagePricing = $data['package_pricing'] + $sHiddenNewsletterPrice;   
                                      ?>
                                      <input type="text"  id="package_value" value="<?php echo empty($sPackagePricing) ? 0 : $sPackagePricing;?>" >
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <label> Consultant Communication </label>
                                    <input type="radio" name="consultant_communication" class="radio-inline"  value="Y" <?php echo ($data['consultant_communication']=='Y') ? 'checked' : ''?> > Yes
                                    <input type="radio" name="consultant_communication"  class="radio-inline" <?php echo ($data['consultant_communication']=='N') ? 'checked' : ''?> > No
                                </div>
                                <div class="col-md-12">
                                    <label> Director has Spanish consultants: </label>
                                    <input type="checkbox" name="spanish_consultant" value="0" <?php echo ($data['spanish_consultant']=='1') ? 'checked' : ''?> >
                                </div>
                                
                                <div class="col-md-12">
                                    <label> Routing: </label>
                                    <input type="text" name="cu_routing" value="<?php echo $data['cu_routing'];?>" >
                                </div>
                                <div class="col-md-12">
                                    <label> Account: </label>
                                    <input type="text"  name="cv_account" value="<?php echo empty($data['cv_account']) ? '' : decryptIt($data['cv_account']);?>" >
                                </div>
                                <div class="col-md-12">
                                    <label> Package Notes: </label> 
                                    <textarea name="package_note"><?php echo $data['package_note'] ?></textarea>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingLast">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseLast" aria-expanded="false" aria-controls="collapseLast">Texting System
                            </a>
                        </h4>
                    </div>
                    <div id="collapseLast" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingLast">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-12 signature-date">
                                    <label> Text Note: </label>
                                    <textarea name="note"><?php echo $data['note']; ?></textarea>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <button type="button" id="back" class="btn btn-success btn-md button">Back</button>
            </div>
        </div><!-- /.box-body -->
    </div>
    </div>

  </section>

</div>

<script type="text/javascript">
    $(document).ready(function(){

    $("#accordion").hide();
    $("#accord-2").show();
    $("#next").click(function(){
        $("#accordion").show();
        $("#accord-2").hide();

    });
    $("#back").click(function(){
        $("#accordion").hide();
        $("#accord-2").show();
    });

    $('input').prop('disabled', true);
    $('select').prop('disabled', true);
    $('textarea').prop('disabled', true);
});
</script>