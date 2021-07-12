<style type="text/css">
  span.chat-img1.pull-left img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    border: 1px solid;
  }

  .chat_area {
    float: left;
    overflow-x: hidden;
    overflow-y: auto;
    width: 100%;
    margin-top: 20px;
    border: 1px solid;
    padding: 10px;
    height: 800px;
    max-height: 300px;
    border-radius: 12px;
}

  .chat_area .chat-body1 {
    margin-left: 50px;
  }

  .chat-body1 p {
    background: #fbf9fa none repeat scroll 0 0;
    padding: 10px;
  }
</style>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="text-center">Client Name</h3>
        <p class="text-center"><?php echo getName($aViewEmailDetails[0]['id_newsletter_client']);?></p>
      </div>
      <div class="col-sm-6">
        <h3 class="text-center">Purpose</h3>
        <p class="text-center"><?php echo $aViewEmailDetails[0]['purpose'];?></p>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="chat_area chat-widget">
        <ul class="list-unstyled">
          <?php 
            /*$nCount = count($aNotesDatas);*/
            foreach($aViewEmailDetails as $value){
              $aUserData = getUserByName($value['userby']);

              $sCreatedDate = date("M j", strtotime($value['created_at']));
              $sTime = date('h:i A', strtotime($value['created_at']));  
              $nYear = date('Y', strtotime($value['created_at']));
              $sCurrentYear = date('Y');
              $sYear = ($nYear < $sCurrentYear) ? "'".$nYear : '';
          ?>
          <li class="left clearfix">
            <span class="chat-img1 pull-left">
                <?php 
                  $sProfile = empty($aNotesData['profile_pic']) ? base_url('/assets/images/profile_img/female.jpg') : base_url('/assets/images/profile_img/').$aNotesData['profile_pic'] ;
                ?>
              <img src="<?php echo $sProfile;?>" class="chat-img1">
            </span>
            <div class="chat-body1 clearfix">
              <?php 
                if($value['purpose'] == 'Approval mail'){
                  $sUsername = 'Admin';
                }else{
                  $sUsername = empty($aUserData) ? '' : ucfirst($aUserData['first_name'])."&nbsp;".ucfirst($aUserData['last_name']);
                }
              ?>
              <p><span class="user-name"><?php echo $sUsername;?> - </span><?php echo  htmlspecialchars_decode( htmlentities( html_entity_decode( $value['detail'] ) ) );?></p>
              <div class="chat_time pull-right"><?php echo $sCreatedDate.$sYear."&nbsp;at&nbsp;".$sTime; ?></div>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div><!--chat_area-->
    </div>
  </section>
</div>