<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/datatables/datatables.min.css')?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/billing.css'); ?>">

    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
  </head>

  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="<?php echo base_url(); ?>" class="logo">
          <span class="logo-mini"><b>UA</b></span>
          <span class="logo-lg"><img src="<?php echo base_url('assets/images/admin/logo1.png'); ?>" height="45"></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-history"></i>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?=empty($last_login) ? "First Time Login" : $last_login;?></li>
                </ul>
              </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('assets/dist/img/avatar.png'); ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="<?php echo base_url('assets/dist/img/avatar.png');?>" class="img-circle" alt="User Image" />
                    <p> <?php echo $this->session->userdata('name'); ?> <small><?php echo 'Admin'; ?></small> </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?php echo base_url('admin/logout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url('uacc-billing/dashboard'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url('uacc-billing/clients'); ?>" >
                <i class="fa fa-users"></i>
                <span> Manage Clients</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url('uacc-billing/billing-history'); ?>" >
                <i class="fa fa-history" aria-hidden="true"></i> <span>Billing History</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url('uacc-billing/credit-payment'); ?>" >
                <i class="fa fa-credit-card"></i>
                <span>Credit Payment</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('uacc-billing/reports'); ?>" >
                <i class="fa fa-file"></i>
                <span>Reports</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/dashboard'); ?>" >
                <i class="fa fa-user"></i>
                <span>Back to admin</span>
              </a>
            </li>


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>