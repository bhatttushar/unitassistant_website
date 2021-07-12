<?php  $id_newsletter = $this->uri->segment(2); 
       $name = getName($id_newsletter);
?>
<section class="clearfix">
	<div class="container-fluid">		
		<div class="row">
			<div class="table_wrepper">
				<div class="title-header">
					<h1 class="text-center"><?php echo $name;?></h1>
				</div>
                <table id="client_email_table" class="table table-striped table-bordered table-hover table-green">
                    <thead>
                       <tr>
                            <th>#</th>
                            <th>Purpose</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php 
                            $nCount=1 ; 
                            foreach ($emails as $val){ ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $nCount++;?></td>
                                    <td><?php echo $val['purpose'];?></td>
                                    <td><?php echo $val['created_at'];?></td>
                                    <td>
                                        <a href="<?php echo base_url('view-client-email/'.$id_newsletter.'/'.$val['purpose']);?>" title="Click to view client's email detail" class="btn btn-sm btn-info">View Detail</a>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                        <?php  }  ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>