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
                    <div class="col-md-6"> <h1 class="m0">Bella Fizz</h1> </div>

                    <div class="col-md-6 text-right">
                        <a class="btn btn-primary" href="<?php echo base_url('add-bellafizz'); ?>">Add New</a>  
                    </div>
                </div>
				
				<table id="bellafizz_table" class="display" style="width:98%">
			        <thead>
                       	<tr>
                            <th>#</th>
                            <th class="nosort">Action</th>
                            <th>Updated at</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Rep ID</th>
                            <th>Phone Number</th>
                            <th>Company / City</th>
                            <th>Billing Month</th>
                    	</tr>   
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            foreach ($data['details'] as $value) {
                                $action = '<a href="'.base_url('edit-bellafizz/'.$value['id_bellafizz']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                    
                                    <a href="'.base_url('delete-bellafizz/'.$value['id_bellafizz']).'" title="Delete record" 
                                    onclick="return confirm('."'Are you sure want to delete this record ?'".')" ><i class="fa fa-remove"></i></a>';
                         
                                $date = date_create($value['updated_at']);
                                $updated_at = date_format($date,"m-d-Y");
                        ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $action; ?></td>
                                    <td><?php echo $updated_at; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['rep_id']; ?></td>
                                    <td><?php echo $value['phone']; ?></td>
                                    <td><?php echo $value['c_city']; ?></td>
                                    <td><?php echo $value['month_billing']; ?></td>
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
        var table = $('#bellafizz_table').DataTable({
            // "iDisplayLength": 10,
            // 'processing': true,
            // 'serverSide': true,
            // 'serverMethod': 'post',
            // 'ajax': {
            //       'url':baseURL+'bellafizz-listing',
            //       "data": function ( d ) {
            //           d.Records = "bellafizz_listing"
            //       }
            // },
            // 'columns': [
            //    { data: 'number' },
            //    { data: 'action' },
            //    { data: 'updated_at' },
            //    { data: 'name' },
            //    { data: 'email' },
            //    { data: 'rep_id' },
            //    { data: 'phone' },
            //    { data: 'c_city' },
            //    { data: 'month_billing' }
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