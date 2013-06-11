
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

if(isset($_GET['id']) && isset($_GET['type']) && isset($_GET['action']) )
{
	$tablename = $_GET['type'];
	delete($_GET['id'],$tablename);
}
?>

<form method='POST' action=''> 
   
 
 <?php
 display_details_menu($tablename,	$tmpl,$id);
   ?>
   
   
<?php
function display_details_menu($tablename,	$tmpl,$id)
{
	global $db;
?>	
	<div class="row-fluid">
    <div class="block span12">    
	<?php
			if($id != null)
			{ ?>
				<?php 
						$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));				
				
				?>
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">View Deatils of  <?php echo $bar; ?></a>
        <div id="tablewidget" class="block-body collapse in">
			<table class="table table-bordered">
			
			<?php
				$getid = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
				$menuid = $getid->Field;
				if($tablename == 'menu_links')
				{
					$iid = 'm_id';
					$tablevalues = $db->get_results("SELECT * FROM $tablename WHERE $iid = $id");
					}else{
				$iid = $getid->Field;
				$tablevalues = $db->get_row("SELECT * FROM $tablename WHERE $iid = $id");
				}
		//	$tablevalues = $db->get_results("SELECT * FROM $tablename WHERE $iid = $id");
		$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename"); 
				
				?>
<tr>
<?php

foreach($getcolms as $getcolm)
{ 

$count = count($tablevalues); 

?>

<th><?php echo $getcolm->Comment; ?></th>

<?php } ?>
<th>Options</th>
</tr>				
				

	<tr>
	
	<?php
	foreach($tablevalues as $tablevalue)
		{
				foreach($getcolms as $getcolm)
				{
				 $field = $getcolm->Field;
		?>

<td><?php echo $tablevalue->$field; ?></td> 
<?php 

}
?>

<td>
<?php 
if(isset($_GET['kind'])) 
{?>
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename; ?>&id=<?php echo $tablevalue->ml_id; ?>" title="Edit <?php echo $tablename; ?>" ><i class="icon-edit"></i></a>
<?php }else{?>
<a href="../admin/add.php?type=<?php echo $tablename; ?>&tmpl=default&id=<?php echo $tablevalue->$menuid; ?>" title="Edit <?php echo $tablename; ?>" ><i class="icon-edit"></i></a>
<?php } ?>
<!--<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=details&type=<?php echo $tablename; ?>&id=<?php echo $id; ?>&action=delete" title="Delete <?php echo $tablename; ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a>-->

<a href="#myModal<?php echo $tablevalue->$menuid; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $tablevalue->$menuid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php if(isset($_GET['kind'])) 
{?>
        <a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=details&type=<?php echo $tablename ?>&id=<?php echo $id; ?>&action=delete" class="btn btn-danger" >Delete</a>
        <?php }else{?>
<a href="../admin/details.php?type=<?php echo $tablename; ?>&tmpl=default&id=<?php echo $tablevalue->$menuid; ?>&action=delete" class="btn btn-danger" >Delete</a>
<?php } ?>
    </div>
</div>

</td>


</tr>
<?php  } //}  ?>
</table>
</div>
<!-- </div> -->	
<?php	}?>    
 </div>
 </div>
	
<?php	} ?>   
   
  </form>
  
  
    