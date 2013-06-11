<?php
if(isset($_GET['id']) && isset($_GET['type']) )
{
	$tablename = $_GET['type'];
//	$page = $_GET['page'];
	$ctid = $_GET['id'];
	delete($_GET['id'],$tablename);
	}else {
		$tablename = null;
	$page = null;
	$ctid = null;
}

?>
<link rel="stylesheet" href="../admin/css/zebra_pagination.css" type="text/css">

<form method='POST' action=''>
 
<?php 
$tablename = $_GET['type'];
$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));	
?>
<div class="pull-right span4 offset-3">
<a href="add.php?type=<?php echo $tablename; ?>&tmpl=default" class="btn btn-info" >Add New <?php echo $bar; ?></a>
</div>

<div class="pull-left span11">
 
<?php view_table($tablename); ?> 


</div>

</form>
