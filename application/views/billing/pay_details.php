<style type="text/css">
    th.nosort.sorting_disabled {
        cursor: pointer;
    }
    .proccessing p {
        top: 1% !important;
        position: relative;
        font-size: 32px;
    }
    ul.pagination {
        float: right;
        margin-top: 0;
        margin-bottom: 10px;
    }
    .table-responsive {
        position: relative;
    }
    .proccessing {
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        background-color: #00000066;
        text-align: center;
        font-size: 22px;
        color: red;
        font-weight: bold;
        z-index: 9999999;
    }
    .pagination>li>span {
        padding: 0;
    }
    input#page_num {
        height: 32px;
        text-align: center;
        font-size: 18px;
        width: 50px;
        border: none;
    }
    span.edit_span {
        display: block;
        color: green;
        cursor: pointer;
    }
</style>
<div class="content-wrapper">
  <section class="content-header"> <h1> <i class="fa fa-users"></i> Payment Details </h1></section>
  <section class="content">
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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"> 
            <div class="row">
              <div class="col-sm-12">
                  <!-- <h3 class="box-title">Payment Details</h3> -->
                  <p><b>Search By:</b></p>
              </div>

              <div class="col-sm-12">
                <form method="post" id="filter_form" action="<?php echo base_url('billing/pay_details'); ?>">


                  
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" name="from_date" class="form-control datepicker" placeholder="From Date" value="<?php echo set_value('from_date'); ?>"/>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="to_date" placeholder="To Date" value="<?php echo set_value('to_date'); ?>"/>    
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="invoice_date" placeholder="Invoice Date" value="<?php echo set_value('invoice_date'); ?>"/>    
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="due_date" placeholder="Due Date" value="<?php echo set_value('due_date'); ?>"/> 
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="c_name" placeholder="Name" />    
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <select name="payment_status" class="form-control">

                                <option value="0">Payment Status</option>

                                <?php
                                    $completed = ($this->input->post('payment_status') == 'S') ? 'selected' : '';
                                    $pending = ($this->input->post('payment_status') == 'P') ? 'selected' : '';
                                    $remaining = ($this->input->post('payment_status') == 'R') ? 'selected' : '';
                                    $canceled = ($this->input->post('payment_status') == 'C') ? 'selected' : '';
                                    $failed = ($this->input->post('payment_status') == 'F') ? 'selected' : '';
                                ?>

                                <option value="S" <?php echo $completed;?> >Completed</option>
                                <option value="P" <?php echo $pending;?> >Pending</option>
                                <option value="R" <?php echo $remaining;?> >Remaining</option>
                                <option value="C" <?php echo $canceled;?> >Canceled</option>
                                <option value="F" <?php echo $failed;?> >Failed</option>
                            </select>    
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- <input type="hidden" name="filter_submit"> -->
                    <div class="col-sm-12">
                        <input type="hidden" name="page" id="Cpage" value="<?php echo (!empty($page) ? $page : 1); ?>">
                        
                        <input type="hidden" name="sort_column" id="Scolumn" value="<?php echo (!empty($sort_column) ? $sort_column : 'invoice_date'); ?>">
                        <input type="hidden" name="sort_order" id="Sorder" value="<?php echo (!empty($sort_order) ? $sort_order : 'DESC'); ?>">

                        <input type="hidden" name="search" id="Ssearch" value="<?php echo (!empty($search) ? $search : ''); ?>">
                        <input type="submit" name="submit_form_btn" class="btn btn-info" id="submit_form_btn" value="Search">
                    </div>
                </form>
              </div>

            </div>
           
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="col-sm-12 text-right" style=" z-index: 22;">
                <ul class="pagination">
                    <li class="">
                        <a href="javascript:void(0)" data-page="prev">← Previous</a>
                    </li>
                    <li class=""><span>
                        <input type="number" id="page_num" name="pageC" min="1" value="<?php echo (!empty($page) ? $page : 1); ?>"> </span></li>
                    <li class="">
                        <a href="javascript:void(0)" data-page="next">Next → </a>
                    </li>
                </ul>
                <div class="search_all col-sm-3 pull-right">
                    <input type="text"  id="search_all" value="<?php echo (!empty($search) ? $search : ''); ?>" placeholder="Search" class="form-control ">
                </div>
                
            </div>
            <table class="table table-hover" id="table_idUA">
                <thead>
                    <tr>
                        <th>#</th>
                        <th >Name</th>
                        <th >Email</th>
                        <th >Invoice Date</th>
                        <th >Amount Due</th>
                        <th >Price</th>
                        <th >Invoice Status</th>
                        <th >Payment Status</th>
                        <th class="nosort action">Action</th>
                    </tr>
                </thead>

                <tbody id="tblUsers" >

                    <?php
                        $nCount = 1;

                    foreach ($aClientsDetails as $aClientsDetail) {?>
                        <tr class="odd gradeX">
                            <td><?php echo $nCount++;?></td>
                            <td><?php echo $aClientsDetail['name'];?></td>
                            <td><?php echo $aClientsDetail['email'];?></td>
                            <td><?php echo $aClientsDetail['invoice_date'];?></td>
                            <td><?php echo number_format($aClientsDetail['Tdue']);?></td>
                            <td><?php echo $aClientsDetail['total'];?></td>
                            <td>
                                <?php
                                    if ($aClientsDetail['invoice_status'] == "Send invoice") {
                                        echo '<span class="label label-success">Send invoice</span>';
                                    } else {
                                        /*echo '<a href="draftUpdate.php?id_invoice=' . $aClientsDetail['id_invoice'] . '"><span class="label label-danger">Save as draft</span></a>';*/
                                        echo '<a href="#"><span class="label label-danger">Save as draft</span></a>';
                                    }
                                ?>

                            </td>

                            <td> <?php echo payment_status($aClientsDetail['payment_status']); ?> </td>

                            <td><a class="btn btn-info" href="<?php echo base_url('assets/billing/tbc/uploads/'.$aClientsDetail['invoice_name']); ?>" title="Download As PDF" download>Generate PDF</a>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
        </div>
    </section>
</div>
<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    jQuery(document).ready(function($) {
        $('body').on('change','#page_num',function(event) {
        $Cnext = parseInt($(this).val());
        if ($Cnext != 0) {
            $('#Cpage').val($Cnext);
            $('#submit_form_btn').trigger('click');

        }
     });

    $('body').on('click','.pagination li a',function(event) {
        $page = $(this).attr('data-page');
        if ($page == 'next') {
            if ($('#Cpage').val() == '') {
                $Cnext = 2; 
            }else {
                $Cnext  = parseInt($('#Cpage').val()) + 1;
            }

            $('#page_num').val($Cnext);     
            $('#Cpage').val($Cnext);        
        }else if($page == 'prev') {
            if (parseInt($('#Cpage').val()) == 1 || $('#Cpage').val() == '') {
                return false;
            }else {

                $Cnext  = parseInt($('#Cpage').val()) - 1;  
                $('#Cpage').val($Cnext);
                $('#page_num').val($Cnext);
            }
            
                    
        }else {
            $('#Cpage').val($page);
            $('#page_num').val($page);
        }

        $('#submit_form_btn').trigger('click');
    });

     $('body').on('change','#filter_form input, #filter_form select',function(event) {
        $('#Cpage').val(1);
     });
     var wto = 1000;
    $('body').on('keyup','#search_all',function(event) {
        clearTimeout(wto);
        wto = setTimeout(function() {
            $('#Ssearch').val($('#search_all').val());
            $('#submit_form_btn').trigger('click');
        }, 1000);
    });

     $('#table_idUA th').click(function(event) {

        $order = $(this).attr('aria-sort');
        $name = $(this).text();
        if ($name == 'Action') {
            return false;
        }

        var Ccolumn = $('#Scolumn').val();
        var Corder = $('#Sorder').val();

        if ($name == Ccolumn) {
            console.log('same column');
            console.log('Corder ='+Corder);
            console.log('order ='+ $order);
            $order = (Corder == 'ASC' ? 'DESC' : 'ASC' );
            /*if (Corder == 'ASC' &&  ($order == 'ascending' || $order == 'ASC' || $order == '')) {
                $order = 'DESC';
            }else if (Corder == 'DESC' &&  ($order == 'DESC' || $order == 'descending')) {
                $order = 'ASC';
            }else if (Corder == 'ASC' &&  ($order == 'ASC' || $order == 'ascending')) {
                $order = 'DESC';
            }else {
                $order = 'ASC';
            }*/

            console.log('laste Order=>'+$order);
        }else {
            $order = ($order == 'ascending' ? 'ASC' : $order); 
            $order = ($order == 'descending' ? 'DESC' : $order); 

        }


        $('#Scolumn').val($name);
        $('#Sorder').val($order);
        $('#submit_form_btn').trigger('click');

     });    
    });

</script>