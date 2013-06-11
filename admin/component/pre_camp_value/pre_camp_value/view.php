<?php
include_once('../admin/includes/config.php');
		head11();
if(isset($_GET['id']) && isset($_GET['type']) )
{
	$tablename = $_GET['type'];
//	$page = $_GET['page'];
	$ctid = $_GET['id'];
	}else {
		$tablename = null;
	$page = null;
	$ctid = null;
}

if(isset($_GET['id']) && isset($_GET['type']) && isset($_GET['action']) )
{
	$tablename = $_GET['type'];
	delete($_GET['id'],$tablename);
}
?>

	<div class="block span11">
				<?php 
		
						$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));				
?>
<a href="#tablewidget" class="block-heading" data-toggle="collapse">View All <?php echo $bar; ?></a>
<link rel="stylesheet" href="../admin/css/zebra_pagination.css" type="text/css">

<form method='POST' action=''>
 
<?php 
$tablename = $_GET['type'];
$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));	
?>
<div class="pull-right span4 offset-3">
<!--<a href="add.php?type=<?php echo $tablename; ?>&tmpl=default" class="btn btn-info" >Add New <?php echo $bar; ?></a>-->
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename; ?>" class="btn btn-info" >Add New <?php echo $bar; ?></a>
</div>

<div class="pull-left span11">

 
 
<?php
if($function == 1)
{ 
//echo $function;
view_table1($tablename,$record); 
}else{
	//echo $function;
	view_table($tablename,$record); 
	}

?> 


</div>

</form>
</div>


