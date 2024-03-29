<!doctype html>
<html lang="en-us">
<?php /*?><head>
	<meta charset="utf-8">
	
	<title>White Label - a full featured Admin Skin</title>
	
	<meta name="description" content="">
	<meta name="author" content="revaxarts.com">
	
	
	<!-- Google Font and style definitions -->
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">-->
	<link rel="stylesheet" href="<? echo base_url()?>css/style.css">
	
	<!-- include the skins (change to dark if you like) -->
	<link rel="stylesheet" href="<? echo base_url()?>css/light/theme.css" id="themestyle">
	<!-- <link rel="stylesheet" href="css/dark/theme.css" id="themestyle"> -->
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css">
	<![endif]-->
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	
	<!-- Apple iOS and Android stuff - don't remove! -->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<!-- Use Google CDN for jQuery and jQuery UI -->
<!--	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
-->	
	<!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
	
	<!-- some basic functions -->
	<script src="<?=base_url()?>js/functions.js"></script>
		
	<!-- all Third Party Plugins and Whitelabel Plugins -->
	<script src="<?=base_url()?>js/plugins.js"></script>
	<script src="<?=base_url()?>js/editor.js"></script>
	<script src="<?=base_url()?>js/calendar.js"></script>
	<script src="<?=base_url()?>js/flot.js"></script>
	<script src="<?=base_url()?>js/elfinder.js"></script>
	<script src="<?=base_url()?>js/datatables.js"></script>
	<script src="<?=base_url()?>js/wl_Alert.js"></script>
	<script src="<?=base_url()?>js/wl_Autocomplete.js"></script>
	<script src="<?=base_url()?>js/wl_Breadcrumb.js"></script>
	<script src="<?=base_url()?>js/wl_Calendar.js"></script>
	<script src="<?=base_url()?>js/wl_Chart.js"></script>
	<script src="<?=base_url()?>js/wl_Color.js"></script>
	<script src="<?=base_url()?>js/wl_Date.js"></script>
	<script src="<?=base_url()?>js/wl_Editor.js"></script>
	<script src="<?=base_url()?>js/wl_File.js"></script>
	<script src="<?=base_url()?>js/wl_Dialog.js"></script>
	<script src="<?=base_url()?>js/wl_Fileexplorer.js"></script>
	<script src="<?=base_url()?>js/wl_Form.js"></script>
	<script src="<?=base_url()?>js/wl_Gallery.js"></script>
	<script src="<?=base_url()?>js/wl_Multiselect.js"></script>
	<script src="<?=base_url()?>js/wl_Number.js"></script>
	<script src="<?=base_url()?>js/wl_Password.js"></script>
	<script src="<?=base_url()?>js/wl_Slider.js"></script>
	<script src="<?=base_url()?>js/wl_Store.js"></script>
	<script src="<?=base_url()?>js/wl_Time.js"></script>
	<script src="<?=base_url()?>js/wl_Valid.js"></script>
	<script src="<?=base_url()?>js/wl_Widget.js"></script>
	
	<!-- configuration to overwrite settings -->
	<script src="<?=base_url()?>js/config.js"></script>
		
	<!-- the script which handles all the access to plugins etc... -->
	<script src="<?=base_url()?>js/script.js"></script>
	
	
</head><?php */?>


	
<?php $this->load->view('admincontrol/includes/header'); ?>

<body onload="initialize();">
			<?php  $this->load->view('admincontrol/includes/nav'); ?>

			<?php $this->load->view('admincontrol/includes/header_sec');?>

			<?php  $this->load->view('admincontrol/includes/left_nav');?>	
		
			
		
		<?php echo $content;?>
		
		
		<footer>Copyright by globus.ae 2013</footer>
</body>
</html>