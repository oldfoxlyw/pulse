<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>后台管理 - 信息</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('resources/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('resources/css/font-awesome.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('resources/css/adminia.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('resources/css/adminia-responsive.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('resources/css/pages/login.css'); ?>" rel="stylesheet" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php echo $meta_data; ?>
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 				
			</a>
			<a class="brand" href="<?php echo site_url('index'); ?>">后台管理</a>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">
					</li>
				</ul>
			</div> <!-- /nav-collapse -->
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div> <!-- /navbar -->
<div id="login-container">
	<div id="login-header">
		<h3><?php if($type != MESSAGE_TYPE_SUCCESS): ?>错误<?php endif; ?>信息</h3>
	</div> <!-- /login-header -->
	<div id="login-content" class="clearfix">
        <p><?php echo $return_content; ?></p>
        <h3><?php echo lang($info); ?></h3>
	</div> <!-- /login-content -->
</div> <!-- /login-wrapper -->
<script src="<?php echo base_url('resources/js/jquery-1.7.2.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.js'); ?>"></script>
</body>
</html>
