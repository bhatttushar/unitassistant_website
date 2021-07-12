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
				<div class="title-header"><h1>Unsubscribed Directors</h1></div>
				<table id="unsub_director_table" class="display" style="width:98%">
			        <thead>
                           <tr>
                            <th>#</th>
                            <th>User name</th>
                            <th>Update By</th>
                            <th>Update Date</th>
                            <th>Unsubscribe Date</th>
                            <th>Name</th>
                            <th>Director Title</th>
                            <th>English Bitly Url</th>
                            <th>Spansih Bitly Url</th>
                            <th>French Bitly Url</th>
                            <th>Phone</th>
                            <th>Consultant Id</th>
                            <th>Password</th>
                            <th>Director Has Spanish Consultants</th>
                            <th>Unit Number</th>
                            <th>Actual Unit Size</th>
                            <th>Package Value</th>
                            <th>Package For Billing</th>
                            <th>Total Package Charge</th>
                            <th>Total Texting</th>
                            <th>Point Value</th>
                            <th>Approval Status</th>
                            <th>Action</th>
                        </tr>   
                        </thead>
                        <tbody>
                           <?php
                                $count = 1;
                                foreach ($data['details'] as $value) {

                                    if($value['updated_at'] != '') {
                                        $date = date_create($value['updated_at']);
                                            $update_date = date_format($date,"m-d-Y");       
                                    }else {
                                        $update_date = $value['updated_at'];    
                                    }

                                    $sPackagePricing = $value['package_pricing'];
                                    $hidden_newsletter = '';
                                    if($value['hidden_newsletter'] == 'SB' || $value['hidden_newsletter'] == 'AB') {
                                        $hidden_newsletter = $sPackageVal = "$".($sPackagePricing + 25); 
                                    }
                                    if($value['hidden_newsletter'] == 'SE' || $value['hidden_newsletter'] == 'AE'|| $value['hidden_newsletter'] == 'SS' || $value['hidden_newsletter'] == 'AS' || $value['hidden_newsletter'] == 'no' || $value['hidden_newsletter'] == '') {
                                        $hidden_newsletter = "$".( $sPackagePricing + 0); 
                                    }
                                   
                                   
                                    $notes = '<a href="'.base_url('unsub-director-note/'.$value['id_newsletter']).'" class="btn btn-sm btn-primary">Add Note</a>';
                                    $this->load->helper('directors/director_helper');
                                    ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $value['user_name']; ?></td>
                                    <td><?php echo $value['first_name']; ?></td>
                                    <td><?php echo $update_date; ?></td>
                                    <td><?php echo $value['contract_update_date']; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['director_title']; ?></td>
                                    <td><?php echo $value['beatly_url']; ?></td>
                                    <td><?php echo $value['beatly_url_one']; ?></td>
                                    <td><?php echo $value['beatly_url_two']; ?></td>
                                    <td><?php echo $value['cell_number']; ?></td>
                                    <td><?php echo $value['consultant_number']; ?></td>
                                    <td><?php echo $value['intouch_password']; ?></td>
                                    <td><?php echo empty($value['spanish_consultant']) ? '' : 'X'; ?></td>
                                    <td><?php echo empty($value['unit_number']) ? '' : 'X'; ?></td>
                                    <td><?php echo $value['unit_size']; ?></td>
                                    <td><?php echo GetPackageValue($value['package'],$value['unit_size']); ?></td>
                                    <td><?php echo empty($value['package'] ) ? 'N/A'  : $value['package']; ?></td>
                                    <td><?php echo $hidden_newsletter; ?></td>
                                    <td><?php echo $value['nsd_client']; ?></td>
                                    <td><?php echo $value['point_value']; ?></td>
                                    <td><?php echo Get_design_approve_status($value['design_one'], $value['design_approve_status']); ?></td>
                                    <td><?php echo $notes; ?></td>
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

<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#unsub_director_table').DataTable({
        //     "iDisplayLength": 10,
        //     'processing': true,
        //     'serverSide': true,
        //     'serverMethod': 'post',
        //     'ajax': {
        //         'url':baseURL+'unsub-director-listing',
        //         "data": function ( d ) {
        //             d.Records = "unsub_director_listing"
        //       }
        // },
        // 'columns': [
        //     { data: 'number' },
        //     { data: 'user_name' },
        //     { data: 'first_name' },
        //     { data: 'updated_at' },
        //     { data: 'contract_update_date' },
        //     { data: 'name' },
        //     { data: 'director_title' },
        //     { data: 'beatly_url' },
        //     { data: 'beatly_url_one' },
        //     { data: 'beatly_url_two' },
        //     { data: 'cell_number' },
        //     { data: 'consultant_number' },
        //     { data: 'intouch_password' },
        //     { data: 'spanish_consultant' },
        //     { data: 'unit_number' },
        //     { data: 'unit_size' },
        //     { data: 'package_pricing' },
        //     { data: 'package' },
        //     { data: 'hidden_newsletter' },
        //     { data: 'nsd_client' },
        //     { data: 'point_value' },
        //     { data: 'design_approve_status' },
        //     { data: 'notes' },
        // ],
        // "iDisplayLength": 10,
        // 'aoColumnDefs': [{
        //     'bSortable': false,
        //     'aTargets': ['nosort']
        // }],
        // "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
      });
    });
</script>