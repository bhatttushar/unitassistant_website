<?php 
  $url = $this->uri->segment(1); 
  $aUserDetails = $this->session->userdata();  
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/monthpicker.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables/datatables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables/responsive.dataTables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-confirm.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-confirm.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/datatables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/dataTables.responsive.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/monthpicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
  </head>
  <body>
    <nav class="navbar">
      <div class="container-fluid top-menu">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/images/logo.png'); ?>"></a>
        </div>
        <ul class="nav navbar-nav">
          <li class="nav-item dddown">
              <a class="btn btn-secondary dropdown-toggle <?php echo ($url == 'directors' || $url == 'unsubscribed-directors' || $url == 'future-directors' || $url == 'add-director' || $url =='edit-director') ? 'active' : '' ?>" href="#">Director Management</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo ($url =='edit-director') ? '#' : base_url('directors'); ?>">Directors</a>
                <a class="dropdown-item" href="<?php echo ($url =='edit-director') ? '#' : base_url('unsubscribed-directors');?>">Unsubscribed Directors</a>
                <a class="dropdown-item" href="<?php echo ($url =='edit-director') ? '#' : base_url('future-directors'); ?>">Future Dated</a>
              </div>
          </li>
          <li class="nav-item dddown">
              <a class="btn btn-secondary dropdown-toggle <?php echo ($url == 'customer-communication' || $url == 'unsubscribed-uacc' || $url == 'add-uacc' || $url =='edit-uacc') ? 'active' : '' ?>" href="#">UACC Management</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo ($url =='edit-uacc') ? '#' : base_url('customer-communication');?>">Customer Communication</a>
                <a class="dropdown-item" href="<?php echo ($url =='edit-uacc') ? '#' : base_url('unsubscribed-uacc'); ?>">Unsubscribed Customer Communication</a>
              </div>
          </li>
          <li><a class="btn btn-secondary dropdown-toggle <?php echo ($url == 'bellafizz') ? 'active' : '' ?>" href="<?php echo base_url('bellafizz'); ?>">Bella Fizz</a></li>

          <li><a class="btn btn-secondary dropdown-toggle <?php echo ($url == 'prospects') ? 'active' : '' ?>" href="<?php echo base_url('prospects'); ?>">Prospects</a></li>

          <li><a class="btn btn-secondary dropdown-toggle <?php echo ($url == 'notes') ? 'active' : '' ?>" href="<?php echo base_url('notes'); ?>">Notes</a></li>

          <li><a class="btn btn-secondary dropdown-toggle <?php echo ($url == 'emails') ? 'active' : '' ?>" href="<?php echo base_url('emails'); ?>">Emails</a></li>
          
        </ul>
        <ul class="nav navbar-nav navbar-right">

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo empty($aUserDetails['profile_pic']) ? '' : base_url('assets/images/user_profile/'.$aUserDetails['profile_pic']);?>" class="user-imageIcon">
                <strong><?php echo $aUserDetails['username'];?></strong>&nbsp;&nbsp;
                <strong><i class="fa fa-angle-down" aria-hidden="true"></i></strong>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <div class="navbar-login">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?php echo empty($aUserDetails['profile_pic']) ? '' :  base_url('assets/images/user_profile/'.$aUserDetails['profile_pic']);?>" class="user-image">
                            </div>
                            <div class="col-lg-8">
                                <p class="text-left"><strong><?php echo $aUserDetails['name'];?></strong></p>
                                <p class="text-left small"><?php echo $aUserDetails['email'];?></p>
                                <p class="text-left">
                                    <a href="<?php echo base_url('user-account'); ?>" class="btn btn-primary btn-block btn-sm" style="color: #fff !important;">My profile</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="divider"></li>
                <li>
                    <div class="navbar-login navbar-login-session">
                          <div class="col-lg-12">
                              <p>
                                <a href="<?php echo base_url('user-logout'); ?>" class="btn btn-danger btn-block" style="color: #fff !important;">Log out</a>
                              </p>
                          </div>
                    </div>
                </li>
            </ul>
        </li>
        </ul>
      </div>
    </nav>