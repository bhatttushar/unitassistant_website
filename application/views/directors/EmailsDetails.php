<?php  
    $id_newsletter = $this->uri->segment(2); 
    $name = getName($id_newsletter);
    $purpose = str_replace('%20', ' ', $this->uri->segment(3));
?>

<div class="container">       
    <div class="row">
        <div class="col-sm-6 text-center">
            <h3>Client Name</h3>
            <p><?php echo $name;?></p>
        </div>

        <div class="col-sm-6 text-center">
            <h3>Purpose</h3>
            <p><?php echo $purpose;?></p>
        </div>
    </div>

    <div class="row">
        <div class="chat_area chat-widget">
            <ul class="list-unstyled">
            <?php 

                if (empty($data)) {
                    echo '<h4 class="modal-title text-center" style="color: red;font-weight: bold;">Email not found</h4>';
                }else{
                    if (is_array($data) || is_object($data)) {
                        foreach ($data as $key => $val) {
                            $aUserData = getUserData($val['userby']);
                            $nDate = isset($val['created_at']) ? $val['created_at'] : '';
                            $sCreatedDate = date("M j", strtotime($nDate));
                            $sTime = date('h:i A', strtotime($nDate));
                            $nYear = date('Y', strtotime($nDate));
                            $sCurrentYear = date('Y');
                            if ($nYear < $sCurrentYear) {
                                $sYear = "'" . $nYear;
                            } else {
                                $sYear = '';
                            } ?>
                            <li class="left clearfix">
                                <span class="chat-img1 pull-left">
                                    <?php $sProfile = empty($aUserData['profile_pic']) ? base_url('assets/images/profile_img/female.jpg') : base_url('assets/images/profile_img/'.$aUserData['profile_pic']); ?>
                                    <img src="<?php echo $sProfile; ?>" class="chat-img1">
                                </span>
                                <div class="chat-body1 clearfix">
                                <?php
                                    if ($val['purpose']=='Approval mail') {
                                        $sUsername = 'Admin';
                                    } else {
                                        if (empty($aUserData)) {
                                            $sUsername = '';
                                        }else{
                                            $sUsername = ucfirst($aUserData['first_name']) . "&nbsp;" . ucfirst($aUserData['last_name']);   
                                        }
                                    }
                                ?>
                                <p><span class="user-name"><?php echo $sUsername; ?> - </span></p>
                                <?php echo htmlspecialchars_decode(htmlentities(html_entity_decode($val['detail'])));?></p>
                                <div class="chat_time pull-right"><?php echo $sCreatedDate . $sYear . "&nbsp;at&nbsp;" . $sTime; ?></div>
                                </div>
                            </li>
                        <?php }
                    }
                }
            ?>
            </ul>
        </div><!--chat_area-->
    </div>
</div>