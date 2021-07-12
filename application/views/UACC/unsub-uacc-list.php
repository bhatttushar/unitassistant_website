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
				<div class="title-header"><h1>Unsubscribed Customer Communication</h1></div>
				<table id="unsub_uacc_table" class="display" style="width:98%">
			        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Unsubscribe Date</th>
                            <th>Phone Number</th>
                            <th>Consultant Id</th>
                            <th>Password</th>
                            <th>Area</th>
                            <th>Seminar</th>
                            <th>Action</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $return = array();
                            foreach ($data['details'] as $value) {
                               
                                $action = '<a href="'.base_url('unsub-uacc-note/'.$value['id_cc_newsletter']).'" class="btn btn-sm btn-primary">Add Note</a>';
                        ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['contract_update_date']; ?></td>
                                    <td><?php echo $value['cell_number']; ?></td>
                                    <td><?php echo $value['consultant_number']; ?></td>
                                    <td><?php echo $value['intouch_password']; ?></td>
                                    <td><?php echo $value['national_area']; ?></td>
                                    <td><?php echo $value['seminar_affiliation']; ?></td>
                                    <td><?php echo $action; ?></td>
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
        var table = $('#unsub_uacc_table').DataTable({
            // "iDisplayLength": 10,
            // 'processing': true,
            // 'serverSide': true,
            // 'serverMethod': 'post',
            // 'ajax': {
            //       'url':baseURL+'unsub-uacc-listing',
            //       "data": function ( d ) {
            //           d.Records = "unsub_uacc_listing"
            //       }
            // },
            // 'columns': [
            //    { data: 'number' },
            //    { data: 'name' },
            //    { data: 'email' },
            //    { data: 'contract_update_date' },
            //    { data: 'cell_number' },
            //    { data: 'consultant_number' },
            //    { data: 'intouch_password' },
            //    { data: 'national_area' },
            //    { data: 'seminar_affiliation' },
            //    { data: 'action' },
              
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