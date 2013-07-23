<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $std_header; ?>
</head>
<body>
<?php echo $std_nav; ?>

<div id="content">
	<div class="container">
		<div class="row">
			<div class="span3">
<?php echo $std_sidebar; ?>
            </div>
            
			<div class="span9">
<?php echo $std_content; ?>
			</div> <!-- /span9 -->
		</div> <!-- /row -->
	</div> <!-- /container -->
</div> <!-- /content -->
<?php echo $std_footer; ?>
<!--
<script src="<?php echo base_url('resources/js/excanvas.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.flot.pie.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.flot.orderBars.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.flot.resize.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/charts/bar.js'); ?>"></script>
 Placed at the end of the document so the pages load faster -->
</body>
</html>
