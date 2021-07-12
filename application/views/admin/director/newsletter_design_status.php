<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Client Newsletter Design Status </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Client Newsletter Design Status Listing</h3>
                    </div>
        
                    <div class="box-body table-responsive">
                        <table class="table table-hover" id="news_design_status_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Client Name</th>
                                    <th>Newsletter Design Status</th>
                                </tr>   
                            </thead>

                            <tbody>
                                <?php 
                                    $nCounter=1 ; 
                                    foreach ($data as $val) {?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $nCounter++;?> </td>
                                            <td><?php echo $val['user_name'];?></td>
                                            <td><?php echo $val['name'];?></td>
                                            <td> 
                                                <strong> 
                                                <?php 
                                                $this->load->helper('directors/director');
                                                echo Get_design_approve_status($val['design_one'], $val['design_approve_status']);?></strong>
                                            </td>
                                        </tr>
                                <?php } ?> 
                            </tbody>       
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>