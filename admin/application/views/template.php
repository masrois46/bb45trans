<?php $config = $this->session->userdata('config'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $this->session->flashdata('title'); ?> - Administrator BB 45Trans</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="/assets/css/font-awesome.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
<link href="/assets/css/pages/dashboard.css" rel="stylesheet">
<link href="/assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body ng-app="bb45trans">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="/">Administrator <?php echo $config['get_title']['value']; ?></a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?=$this->session->userdata('auth_admin')['email'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Profile</a></li>
              <li><a href="/auth/logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav" ng-controller="menuCtrl">
        <li id="menuDashboard"><a href="/"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li id="menuOrder" class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-shopping-cart"></i><span>Invoice</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/data-order">Data Order</a></li>
            <li><a href="/data-order/confirmation-transfer">Data Confirmation Transfer</a></li>
          </ul>
        </li>
        <li id="menuTour"><a href="/tours"><i class="icon-globe"></i><span>Data Tours</span> </a> </li>
        <li id="menuService"><a href="/tours/service"><i class="icon-magic"></i><span>Data Service</span> </a> </li>
        <li id="menuUser"><a href="/users"><i class="icon-user"></i><span>Users</span> </a></li>
        <li id="menuAdmin"><a href="/admin"><i class="icon-user-md"></i><span>Admin</span> </a> </li>
        <li id="menuReport"><a href="/report"><i class="icon-list-alt"></i><span>Report</span> </a> </li>
        <li id="menuSetting"><a href="/setting"><i class="icon icon-cog"></i><span>Setting</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
        <?= $contents; ?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; <?php echo date('Y');?> <a href="https://bb45trans.com" target="_blank">BB 45Trans Tour and Travel Organizer</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="/assets/js/jquery-1.7.2.min.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/dataTables.bootstrap.min.js"></script>
<script src="/assets/js/dataTables.rowReorder.min.js"></script>
<script src="/assets/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/excanvas.min.js"></script>
<script src="/assets/js/chart.min.js" type="text/javascript"></script> 
<script src="/assets/js/bootstrap.js"></script>
<script src="/assets/js/base.js"></script>
<script src="/assets/js/angular.min.js"></script>
<script src="/assets/js/costume/<?php echo $this->session->flashdata('js'); ?>"></script>
</body>
</html>
