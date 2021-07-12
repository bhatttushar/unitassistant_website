<div class="box-body table-responsive">
    <table class="table table-hover" id="table_id">
        <thead>
           <tr>
                <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:300px;">
                    <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                </th>
                <th>#</th>
                <th>User name</th>
                <th>Update By</th>
                <th>Name</th>
                <th>Consultant Number</th>
                <th>Unit Size</th>
                <th>Package Price</th>
                <th>Point Value</th>
                <!-- <th>CV Account</th> -->
                <th>Approval Status</th>
                <th>Updated Date</th>
                <th>Approved Date</th>
                <th class="nosort action">Action</th>
            </tr>   
        </thead>
        <tbody id="tblUsers" >
            <?php 
                $nCount=1 ; 
                foreach ($aUserFormDetails as $aUserFormDetail){?>
                    <tr class="odd gradeX">
                        <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" onClick="unckeckMaster()" value="<?php echo $aUserFormDetail['id_newsletter']; ?>"  /></td>
                       
                        <td><?=$nCount++;?></td>
                   
                        <td><?=$aUserFormDetail['user_name'];?></td>

                        <td><?=$aUserFormDetail['updated_by'];?></td>
                    
                        <td><?=$aUserFormDetail['name'];?></td>
                   
                        <td><?=$aUserFormDetail['consultant_number'];?></td>

                        <td class="editable"><span class="underline"><?=$aUserFormDetail['unit_size'];?></span>
                            <input type="hidden" value="<?php echo $aUserFormDetail['id_newsletter'];?>" name="hidden_id" id="hidden_id">
                            <img src="<?php echo base_url('assets/images/load.gif'); ?>" class="img-responsive img-load">
                        </td>
                        <td>
                        <?php
                            $sPackagePricing = $aUserFormDetail['package_pricing'];
                            if($aUserFormDetail['hidden_newsletter'] == 'SB' || $aUserFormDetail['hidden_newsletter'] == 'AB'){
                                $nHiddenNewsLetter = 25;
                            }

                            if($aUserFormDetail['hidden_newsletter'] == 'SE' || $aUserFormDetail['hidden_newsletter'] == 'AE'|| $aUserFormDetail['hidden_newsletter'] == 'SS' || $aUserFormDetail['hidden_newsletter'] == 'AS' || $aUserFormDetail['hidden_newsletter'] == 'no' || $aUserFormDetail['hidden_newsletter'] == ''){
                                $nHiddenNewsLetter = 0; 
                            }

                            echo  $sPackagePricing + $nHiddenNewsLetter;
                        ?>      
                        </td>
                        <td><?=$aUserFormDetail['point_value'];?></td>
                        <!-- <td> -->
                            <!--?php
                            if(!empty($aUserFormDetail['cv_account'])){
                                echo decryptIt($aUserFormDetail['cv_account']);
                            }
                            ?-->
                        <!-- </td> -->
                        <td>
                            <strong>
                            <?php
                                echo Get_design_approve_status($aUserFormDetail['design_one'], $aUserFormDetail['design_approve_status']);
                           ?>
                            </strong>
                        </td>
                        <td><?=$aUserFormDetail['updated_at'];?></td>
                        <td><?=$aUserFormDetail['approved_date'];?></td>
                        <td>
                            <a href=" <?php echo base_url('admin/userHistory/'.$aUserFormDetail['id_newsletter'].''); ?>" title="Click to see history"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;

                            <a href="<?php echo base_url('excel_export/downloadExcel/id_newsletter/'.$aUserFormDetail['id_newsletter'].''); ?>" title="Click to Download excel file"><i class="fa fa-download"></i></a>&nbsp;&nbsp;&nbsp;

                            <a href="<?php echo base_url('admin/deleteClient/'.$aUserFormDetail['id_newsletter'].'/UA');?>" title="Delete client" ><i class="fa fa-times" onclick="return confirm('Are you sure to delete this record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
                            
                            <?php
                            if($aUserFormDetail['design_approve_status'] == 1){ ?>
                                <a href="<?php echo base_url('admin/UAClientDisApprove/'.$aUserFormDetail['id_newsletter']); ?>" title="Disapprove client" ><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
                            <?php }elseif($aUserFormDetail['design_approve_status'] == 2 || $aUserFormDetail['design_approve_status'] == 3){ ?>
                                <a href="<?php echo base_url('admin/UAClientApprove/'.$aUserFormDetail['id_newsletter']) ?>" title="Approve client" ><i class="fa fa-thumbs-up" aria-hidden="true" onclick="return confirm('Are you sure to aprrove record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
                            <?php } ?>
                                <a href="newsletterMessage.php?id_newsletter=<?=$aUserFormDetail['id_newsletter'];?>" title="Send Mail" ><i class="fa fa-envelope" onclick="return confirm('Are you sure to send mail to this record ?');" ></i></a>&nbsp;&nbsp;&nbsp;

                                <a href="<?php echo base_url('admin/clientEmails/'.$aUserFormDetail['id_newsletter'].''); ?>" title="View client emails"><i class="fa fa-list"></i></a>
                        </td>
                    </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>