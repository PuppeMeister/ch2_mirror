<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<!-- <title>AverageExtraction</title> -->
<title></title>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo base_url('assets/css/style.css'); ?>" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" href="<?php echo base_url('assets/css/flexslider.css'); ?>" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/JFFormStyle-1.css'); ?>" />
<!-- <link href="<?php echo base_url('assets/css/datatables.min.css'); ?>" type="text/css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>"/>
<!-- js -->
<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/modernizr.custom.js'); ?>"></script>
<!-- //js -->
<!-- fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,500italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //fonts -->	
<script type="text/javascript">
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true   // 100% fit in a container
			});
		});
	</script>
<!--pop-up-->
<script src="js/menu_jquery.js"></script>
<!--//pop-up-->	
</head>
<body>
	<!--Loading Page -->
	<!-- End of Loading Page-->
	<?php //$this->view('loadingPage');?>
	<!-- Main Content -->
	<!--header-->
	<div id='mainContent'>
	<div class="header">
		<div class="container">
			<div class="header-grids">
				<div class="logo">
				<div class="clearfix"> </div>
			</div>
			<div class="nav-top">
				<div class="top-nav">
					<span class="menu"><img src="images/menu.png" alt="" /></span>
					<ul class="nav1">
					</ul>
					<div class="clearfix"> </div>
					<!-- script-for-menu -->
							 <script> 
							   $( "span.menu" ).click(function() {
								 $( "ul.nav1" ).slideToggle( 300, function() {
								 // Animation complete.
								  });
								 });
							
							</script>
						<!-- /script-for-menu -->
				</div>
				<div class="dropdown-grids">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--//header-->
	<!-- banner -->
	<div class="banner">
		<!-- container -->
		<div class="container">
			<!-- Tempat Form di sini -->
			<div class="col-md-20 banner-right">
				<div class="sap_tabs">	
					 <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">  
						  <ul class="resp-tabs-list">
							  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Active Alarm</span></li>
							  <!-- <li class="resp-tab-item" aria-controls="tab_item-2" role="tab" id="tabActiveAlarm"><span>Page 3</span></li> -->
							  <div class="clearfix"></div>
						  </ul>
						  <?php $this->view('activeAlarmTable');?>
					  </div>	
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner -->
	<!-- banner-bottom -->
	<!-- popular-grids -->
	<!-- footer -->
	<!-- //footer -->
		<div class="container">
				<div class="footer-bottom-top-grids">
					<div class="clearfix"> </div>
					<div class="copyright">
						<p>Copyrights © 2015</a></p>
					</div>
				</div>
		</div>
	</div>
	</div>
	<!-- End of Main Contents-->
	<script type="text/javascript" src="<?php echo base_url('assets/js/booty.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/easyResponsiveTabs.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/refreshActiveAlarm.js'); ?>" type="text/javascript"></script>
	<!-- Jquery Data Tabel -->
	<script src="<?php echo base_url('assets/js/datatables.min.js'); ?>" type="text/javascript"></script>
	<!-- Active Alarm Refresh Script -->
	<!-- <script type="text/javascript" src="scripts/script.js"></script> -->
	<!-- <script type="text/javascript" src="scripts/controller.js"></script> -->
<script type="text/javascript">
//stacked modal
$(document)  
  .on('show.bs.modal', '.modal', function(event) {
    $(this).appendTo($('body'));
  })
  .on('shown.bs.modal', '.modal.in', function(event) {
    setModalsAndBackdropsOrder();
  })
  .on('hidden.bs.modal', '.modal', function(event) {
    setModalsAndBackdropsOrder();
  });

function setModalsAndBackdropsOrder() {  
  var modalZIndex = 1040;
  $('.modal.in').each(function(index) {
    var $modal = $(this);
    modalZIndex++;
    $modal.css('zIndex', modalZIndex);
    $modal.next('.modal-backdrop.in').addClass('hidden').css('zIndex', modalZIndex - 1);
});
  $('.modal.in:visible:last').focus().next('.modal-backdrop.in').removeClass('hidden');
}
</script>	
</body>
</html>