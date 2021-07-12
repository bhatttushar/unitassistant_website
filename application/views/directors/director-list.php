<section class="clearfix">
	<div class="container-fluid">
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
			<div class="table_wrepper">

                <div class="row">
                    <div class="col-md-6"> <h1 class="m0">Directors</h1> </div>

                    <div class="col-md-6 text-right">
                        <a class="btn btn-primary" href="<?php echo base_url('add-director'); ?>">Add New</a>  
                    </div>
                </div>
				
				<table id="director_table" class="display" style="width:98%">
			        <thead>
                       <tr>
	                        <th>#</th>
                            <th class="nosort">Action</th>
                            <th>Created Date</th>
                            <th>Update By</th>
                            <th>Update Date</th>
                            <th>Unsubscribe Date</th>
                            <th>Langauge</th>
                            <th>Name</th>
                            <th>Director Title</th>
                            <th>English Bitly Url</th>
                            <th>Spansih Bitly Url</th>
                            <th>French Bitly Url</th>
                            <th>Consultant Id</th>
                            <th>Password</th>
                            <th>Actual Unit Size</th>
                            <th>Package</th>
                            <th>Total Package Charge</th>
                            <th>total text package</th>
                            <th>7/2019 Total Text Package</th>
                            <th>Point Value</th>
                            <th>Approval Status</th>
                            <th>Last Email Date</th>
                            <th>Approval Date</th>
	                    </tr>   
                    </thead>
			        <tbody>
                        <?php
                        $count = 1;
                        foreach ($data['details'] as $value) {
                            $action = '';
                            if($value['design_approve_status'] == 3) { 
                                $action .= '<a href="viewDetail.php?id_client_newsletter='.$value['id_newsletter'].'" title="Click to view clients requested changes"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;';
                            }
                            $action .= '<a href="'.base_url("edit-director/".$value['id_newsletter']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                            <a href="'.base_url("client-emails/".$value['id_newsletter']).'" title="Click to view client emails"><i class="fa fa-list"></i></a>&nbsp;&nbsp;&nbsp;';
                            
                            if (IsInTbc($value['consultant_number']) <= 0) {
                                $action .= '<button type="button" data-id="'.$value['id_newsletter'].'" class="btn btn-sm add-in-uacc btn-warning">Add UACC</button>';
                            }

                            if(!empty((int)$value['updated_at'])) {
                                $date = date_create($value['updated_at']);
                                $update_date = date_format($date,"m-d-Y");       
                            }else {  
                                $update_date = '';
                            }
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $action; ?></td>
                                <td><?php echo (empty($value['created_at']) ? '' : date('m/d/Y', strtotime($value['created_at']))); ?></td>
                                <td><?php echo $value['updated_by']; ?></td>
                                <td><?php echo $update_date; ?></td>
                                <td><?php echo $value['contract_update_date']; ?></td>
                                <td><?php echo get_newsletters_design($value['newsletters_design']); ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['director_title']; ?></td>
                                <td><?php echo $value['beatly_url']; ?></td>
                                <td><?php echo $value['beatly_url_one']; ?></td>
                                <td><?php echo $value['beatly_url_two']; ?></td>
                                <td><?php echo $value['consultant_number']; ?></td>
                                <td><?php echo $value['intouch_password']; ?></td>
                                <td><?php echo $value['unit_size']; ?></td>
                                <td><?php echo GetPackageValue($value['package'],$value['unit_size']); ?></td>
                                <td><?php echo $value['package_pricing']; ?></td>
                                <td><?php echo Get_total_text_program($value['package'], $value['total_text_program']); ?></td>
                                <td><?php echo Get_total_text_program7($value['package'], $value['total_text_program7']); ?></td>
                                <td><?php echo $value['point_value']; ?></td>
                                <td><?php echo Get_design_approve_status($value['design_one'], $value['design_approve_status']); ?></td>
                                <td><?php echo (empty($value['last_email_update_date']) ? '' : $value['last_email_update_date']); ?></td>
                                <td><?php echo (empty($value['approved_date']) ? '' : $value['approved_date']); ?></td>
                            </tr>
                        <?php
                            $count++;    
                        }
                    ?>
                    </tbody>
			        
			    </table>
			</div>
		</div>
	</div>
</section>	

<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function(){
        eraseCookie('flag');

        //directors
        var table = $('#director_table').DataTable({
      //     "iDisplayLength": 10,
      //     'processing': true,
      //     'serverSide': true,
      //     'serverMethod': 'post',
      //     'ajax': {
      //           'url':baseURL+'director-listing',
      //           "data": function ( d ) {
      //               d.Records = "director_listing"
      //           }
      //     },
      //     'columns': [
      //        { data: 'number' },
      //        { data: 'action' },
      //        { data: 'created_at' },
      //        { data: 'updated_by' },
      //        { data: 'updated_at' },
      //        { data: 'contract_update_date' },
      //        { data: 'newsletters_design' },
      //        { data: 'name' },
      //        { data: 'director_title' },
      //        { data: 'beatly_url' },
      //        { data: 'beatly_url_one' },
      //        { data: 'beatly_url_two' },
      //        { data: 'consultant_number' },
      //        { data: 'intouch_password' },
      //        { data: 'unit_size' },
      //        { data: 'package_pricing' },
      //        { data: 't_package' },
      //        { data: 'total_text_program' },
      //        { data: 'total_text_program7' },
      //        { data: 'point_value' },
      //        { data: 'design_one' },
      //        { data: 'last_email_update_date' },
      //        { data: 'approved_date' },
      //     ],
      //     "iDisplayLength": 10,
      //     'aoColumnDefs': [{
      //          'bSortable': false,
      //          'aTargets': ['nosort']
      //     }],
      //     "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
       });
    });

</script>