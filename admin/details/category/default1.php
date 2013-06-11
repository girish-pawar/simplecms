
<?php
if($_GET)
{
if(isset ($_GET['type']) ||  isset($_GET['tmpl']) || isset($_GET['id']) )
{
	$tablename = $_GET['type'];
	$tmpl = $_GET['tmpl'];
	$id = $_GET['id'];
	}else{
		$tablename = null;
		$tmpl = null;
		$id = null;
		
		}
}
?>


<form method='POST' action=''>
			<?php
			if($id != null)
			{ ?>
			<!-- <div class="row-fluid"> -->
			<div class="block span11">
			<table class="table">
			
			<?php
			$values = $db->get_results("SELECT * FROM $tablename");
				$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename"); ?>
<tr>
<?php
//print_r($getcolms);
foreach($getcolms as $getcolm)
{ 
//print_r($getcolm);
?>

<th><?php echo $getcolm->Comment; ?></th>

<?php } ?>
<th>Options</th>
</tr>				
				
				
			<?php	
foreach($values as $val)
{ ?>
<tr>
	<?php
	foreach($getcolms as $getcolm)
	{
		 $field = $getcolm->Field; 
?>

<td><?php echo $val->$field; ?></td>

<?php } ?>

<td>
<p><a href="../admin/add.php?type=<?php echo $tablename ?>&tmpl=<?php echo $tmpl ?>&id=<?php echo $val->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a></p>
<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=<?php echo $tmpl ?>&id=<?php echo $val->$ctid; ?>" title="Delete <?php echo $tablename ?>" ><i class="icon-trash"></i></a>
</td>

<?php 	}  ?>
</tr>
</table>
</div>
<!-- </div> -->	
<?php	}?>
</form>



