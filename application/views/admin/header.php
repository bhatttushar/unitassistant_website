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

    <style>
    	.error{
        color:red;
        font-weight: normal;
      }

      .content-wrapper{
        min-height: 1000px !important;
      }

      .main-header .logo{
        height: 53px;
        line-height: 53px;
      }

      .main-sidebar, .left-side{
        padding-top: 53px;
      }

      .main-header>.navbar{
        min-height: 53px;
      }

      .nav>li>a{
        overflow: auto;
      }

      .treeview ul {
        background: #ecf0f5;
        list-style-type: none;
        border-right: 1px solid #333;
        padding-left: 0px;
      }

      .treeview ul a{
        color: #333 !important;
      }

      .treeview ul a:hover, .treeview ul a:focus{
        background-color: #e1e3e9;
        color: #333 !important;
      }

      .treeview ul a {
        padding: 7px 0px 7px 20px !important;
        display: block !important;
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
                    <img src="<?php echo base_url('assets/dist/img/avatar.png');?>" class="img-circle" alt="User Image"/>
                    <p> <?php echo $this->session->userdata('name'); ?> <small><?php echo 'Admin'; ?></small> </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                    </div>
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
              <a href="<?php echo base_url('admin/dashboard'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url('admin/user-list'); ?>" >
                <i class="fa fa-users"></i>
                <span>Manage Users</span>
              </a>
            </li>

            <li class="treeview">
              <a href="javascript:;" data-toggle="collapse" data-target="#manageClient">
                <i class="fa fa-users"></i>
                <span>Manage Clients</span>
                <span class="caret"></span>
              </a>
              <ul class="collapse" id="manageClient">
                <li><a href="<?php echo base_url('admin/directors'); ?>"><i class="fa fa-users"></i> Directors</a></li>
                <li><a href="<?php echo base_url('admin/uacc'); ?>"><i class="fa fa-users"></i> UACC Clients</a></li>
                <li><a href="<?php echo base_url('admin/bellafizz'); ?>"><i class="fa fa-users"></i> BellaFizz Clients</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/future-update-list'); ?>" >
                <i class="fa fa-history"></i>
                <span>Future Update List</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/texting-reports'); ?>" >
                <i class="fa fa-file"></i>
                <span>Texting Reports</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/newsletter-reports'); ?>" >
                <i class="fa fa-file"></i>
                <span>Newsletter Reports</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/newsletter-design-status'); ?>" >
                <i class="fa fa-check-circle"></i>
                <span>Newsletter Design Status</span>
              </a>
            </li>
            
            <li class="treeview">
              <a href="<?php echo base_url('admin/requested-changes'); ?>" >
                <i class="fa fa-pencil-square-o"></i>
                <span>Requested Changes</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/email-setting'); ?>" >
                <i class="fa fa-cog"></i>
                <span>Setting</span>
              </a>
            </li>

            <li class="treeview">
              <a href="javascript:;" data-toggle="collapse" data-target="#archieved">
                <i class="fa fa-archive"></i>
                <span> Archieved </span>
                <span class="caret"></span>
              </a>
              <ul class="collapse" id="archieved">
                <li><a href="<?php echo base_url('admin/archieved-clients');?>"><i class="fa fa-archive"></i> UA Archieved </a></li>
                <li><a href="<?php echo base_url('admin/archieved-UACC-clients');?>"><i class="fa fa-archive"></i> UACC Archieved </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/unsuscribed-clients'); ?>" >
                <i class="fa fa-trash"></i>
                <span>Unsubscribed UA Clients</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/unsuscribed-UACC-clients'); ?>" >
                <i class="fa fa-trash"></i>
                <span>Unsubscribed UACC Clients</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/newsletter-messages'); ?>" >
                <i class="fa fa-file"></i>
                <span>Newsletter Message</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/app-version');?>">
                <i class="fa fa-archive"></i>
                <span> App Version </span>
              </a>
            </li>

            <li class="treeview">
              <a href="javascript:;" data-toggle="collapse" data-target="#ua_user_emails">
                <i class="fa fa-envelope"></i>
                <span>UA User Emails</span>
                <span class="caret"></span>
              </a>
              <ul class="collapse" id="ua_user_emails">
                <li><a href="<?php echo base_url('admin/ua-admin-emails');?>"><i class="fa fa-paper-plane"></i> Sent By Admin </a></li>
                <li><a href="<?php echo base_url('admin/ua-user-emails');?>"><i class="fa fa-paper-plane"></i> Sent By Users </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="javascript:;" data-toggle="collapse" data-target="#tbc_user_emails">
                <i class="fa fa-envelope"></i>
                <span>UACC User Emails</span>
                <span class="caret"></span>
              </a>
              <ul class="collapse" id="tbc_user_emails">
                <li><a href="<?php echo base_url('admin/uacc-admin-emails');?>"> <i class="fa fa-paper-plane"></i> Sent By Admin </a></li>
                <li><a href="<?php echo base_url('admin/uacc-user-emails');?>"> <i class="fa fa-paper-plane"></i> Sent By Users </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/email-contents'); ?>" >
                <i class="fa fa-list"></i>
                <span>Client email Messages</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/uacc-email-contents'); ?>" >
                <i class="fa fa-list"></i>
                <span>UACC Client email Messages</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/push-notifications'); ?>" >
                <i class="fa fa-bell"></i>
                <span>UA Push Notifications</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/uacc-push-notifications'); ?>" >
                <i class="fa fa-bell"></i>
                <span>UACC Push Notifications</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('admin/approve-log'); ?>" >
                <i class="fa fa-list"></i>
                <span>Newsletters Approve Log</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('billing/dashboard'); ?>" >
                <i class="fa fa-money"></i>
                <span>UA Billing</span>
              </a>
            </li>


            <li class="treeview">
              <a href="<?php echo base_url('uacc-billing/dashboard'); ?>" >
                <i class="fa fa-money"></i>
                <span>UACC Billing</span>
              </a>
            </li>
          </ul>
        </section>
      </aside>