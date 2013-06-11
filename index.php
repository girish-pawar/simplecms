<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 
include_once('admin/includes/defination.php');
include_once('includes/head.php');
require_once("users/include/membersite_config.php");
?>


<body>
<?php if($_GET){ ?>

<?php include_once('includes/top.php'); ?> 




<div class="maincontainer">

	<div class="leftmodule">
	
<?php 
$linkid = $_GET['linkid'];

echo Front_LoadModules('left',$linkid); ?>
	</div>
	<div class="rightbody">
		<?php include_once('includes/right.php'); ?>
	</div>

</div>
<?php include_once('includes/footer.php'); ?>    
<?php } else { ?>
home page

<?php } ?>