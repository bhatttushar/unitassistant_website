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
                    <div class="col-md-6"> <h1 class="m0">Customer Communication</h1> </div>

                    <div class="col-md-6 text-right">
                        <a class="btn btn-primary" href="<?php echo base_url('add-uacc'); ?>">Add New</a>  
                    </div>
                </div>
				
				<table id="uacc_table" class="display" style="width:98%">
			        <thead>
                       	<tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Unsub Date</th>
                            <th>Setup Done</th>
                            <th>Consultant Id</th>
                            <th>Password</th>
                            <th>Area</th>
                            <th>Seminar</th>
                            <th>Month bill date</th>
                            <th>Is UA</th>
                            <th>Create Date</th>
                            <th>Referred</th>
                    	</tr>   
                        </tr>   
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            foreach ($data['details'] as $value) {

                                $IsUA = is_ua($value['consultant_number']);
                                $IsUA = empty($IsUA) ? '' : 'X';

                                $action = '<a href="'.base_url('edit-uacc/'.$value['id_cc_newsletter']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                    
                                    <a href="'.base_url('uacc-client-emails/'.$value['id_cc_newsletter']).'" title="View Email History"><i class="fa fa-list"></i></a>&nbsp;&nbsp;&nbsp;';
                                    ?>
                                
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $action; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['cell_number']; ?></td>
                                        <td><?php echo $value['contract_update_date']; ?></td>
                                        <td><?php echo ($value['status_done'] == '1' ? "X" : ''); ?></td>
                                        <td><?php echo $value['consultant_number']; ?></td>
                                        <td><?php echo $value['intouch_password']; ?></td>
                                        <td><?php echo $value['national_area']; ?></td>
                                        <td><?php echo $value['seminar_affiliation']; ?></td>
                                        <td><?php echo $value['m_bill_date']; ?></td>
                                        <td><?php echo $IsUA; ?></td>
                                        <td><?php echo $value['created_at']; ?></td>
                                        <td><?php echo $value['reffered_by']; ?></td>
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
        eraseUACCCookie('uacc-flag');
        // Customer Communication
        var table = $('#uacc_table').DataTable({
        // "iDisplayLength": 10,
        // 'processing': true,
        // 'serverSide': true,
        // 'serverMethod': 'post',
        // 'ajax': {
        //       'url':baseURL+'uacc-listing',
        //       "data": function ( d ) {
        //           d.Records = "uacc_listing"
        //       }
        // },
        // 'columns': [
        //    { data: 'number' },
        //    { data: 'action' },
        //    { data: 'name' },
        //    { data: 'email' },
        //    { data: 'cell_number' },
        //    { data: 'contract_update_date' },
        //    { data: 'status_done' },
        //    { data: 'consultant_number' },
        //    { data: 'intouch_password' },
        //    { data: 'national_area' },
        //    { data: 'seminar_affiliation' },
        //    { data: 'm_bill_date' },
        //    { data: 'isUa' },
        //    { data: 'created_at' },
        //    { data: 'reffered_by' }
          
        // ],
        // "iDisplayLength": 10,
        // 'aoColumnDefs': [{
        //      'bSortable': false,
        //      'aTargets': ['nosort']
        // }],
        // "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
      });
    });

</script>