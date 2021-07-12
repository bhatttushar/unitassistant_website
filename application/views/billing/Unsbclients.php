<style type="text/css">
	
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users" aria-hidden="true"></i> Unsubscribed Client
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
        		<div class="box">
        			<div class="box-body">
			        	<div class="table-inner table-responsive">
			        		<table id="unsub_table_id" class="table table-hover">
			        			<thead>
			        				<tr>
			        					<th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Consultant Number</th>
                                        <th>Due Amount</th>
                                        <th class="nosort action">Action</th>
			        				</tr>
			        			</thead>
			        			<tbody>
			        				<?php 
                                            $nCount=1 ; 
                                            foreach ($clients as $aUserFormDetail)  {  ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $nCount++;?></td>
                                                    <td><?php echo $aUserFormDetail['name'];?></td>
                                                    <td><?php echo $aUserFormDetail['email'];?></td>
                                                    <td><?php echo $aUserFormDetail['consultant_number'];?></td>
                                                    <td><?php echo $aUserFormDetail['total'] - $aUserFormDetail['total_paid'];  ?></td>
                                                    <td>
                                                        <a class="btn btn-success" href="<?php echo  base_url('billing/invoices-list/'.$aUserFormDetail['id_newsletter'])?>" title="View Invoices">View Invoices</a>&nbsp;
                                                        <a class="btn btn-success" href="<?php echo base_url('billing/invoice-year-report/'.$aUserFormDetail['id_newsletter']);?>" title="Year Report">Year Report</a>&nbsp;
                                                    </td>
                                                </tr>
                                        <?php 
                                            } 
                                        ?> 
			        			</tbody>
			        		</table>
			        	</div>
			        </div>
		        </div>
	        </div>
        </div>
    </section>
</div>