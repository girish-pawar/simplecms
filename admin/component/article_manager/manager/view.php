<?php
include_once('../admin/component/'.$_GET['kind'].'/config.php');
include_once('../admin/includes/config.php');

$sizes = explode('x',$size);
$width = current($sizes);
$height = end($sizes);



if(isset($_GET['id']))
{
	$id = $_GET['id'];	
	$table = $_GET['type'];
	}else{
		$id = null;		
		$table= null;
		}
		
if(isset($_GET['id']) && isset($_GET['action']))
{
	$tablename = 	$_GET['type'];
delete($_GET['id'],$tablename);	
}

/*if(isset($_GET['hvid']) && isset($_GET['action']))
{
	$tablename = 'video_gallery_items_table';
delete($_GET['hvid'],$tablename);	
}*/


if(isset($_POST['hide']))
{
	print_r($_POST['fieldsarray']);
echo 'in post ';	
	}


if($id == 'all' )
{
$tableids = $db->get_row("SHOW FULL COLUMNS FROM 	$table");
$fid = $tableids->Field;
//echo 'fid :'.$tableids->Field;

$idcount = $db->get_var("SELECT COUNT(*) FROM 	$table");	
$getgalleries =$db->get_results("SELECT * FROM 	$table");
require '../admin/includes/Zebra_Pagination.php';
						 $records_per_page = $record;
        $pagination = new Zebra_Pagination();        $pagination->records($idcount);        $pagination->records_per_page($records_per_page);        $countries = array_slice(           $getgalleries,                                             //  from the original array we extract            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records            $records_per_page                                       //  this many records        );	
	
	?>
	
	<?php 
head2();
?>
<!-- 	<form method="post"> -->
<div class="block span12">
        <a data-toggle="collapse" class="block-heading" href="#tablewidget"><h2>View all <?php echo $table; ?>.</h2></a>
        <div class="block-body in collapse" id="tablewidget" style="height: auto;">
            <table class="table table-bordered" class="countries" >
              <thead>
                <tr>	
<?php
echo '';	
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $table");
foreach($getcolms as $getcolm)
{
	
?>
                 <th><?php echo $getcolm->Comment; ?></th>
               <?php
 }              
               
               ?>
               <th>Options</th>
                </tr>
              </thead>
              <tbody>
        
	<?php
	
foreach ($countries as $index => $country)
{
foreach($getgalleries as $getgallery)
{
	?>
	          <tr>
	<?php
foreach($getcolms as $getcolm)
{
	$field = $getcolm->Field;
$mystring = $field;
$findme   = '_t';
$pos = strpos($mystring, $findme);

if ($pos === false)
{ 	
 ?>
<td><?php echo $country->$field; ?></td>
    
<?php
}else{
?>
	<!-- <td><a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $country->$fid;?>" ><?php echo $country->$field; ?></a></td> -->
<td><?php echo $country->$field; ?></td>
	<?php
	
	 $vid = $country->$fid;
	// echo 'vid is:'.$vid;
 //$gettype = $db->get_row("SELECT * FROM video_gallery_type WHERE vg_id = '$vid'");	 
	}
	}

	?>
	
	<td>
	<?php //if($gettype){
	//	print_r($getgallery);
		?>
		<a href="../admin/index.php?option=component&kind=<?php echo $_GET['kind'];?>&method=<?php echo $_GET['method'];?>&process=view&id=<?php echo $country->$fid;?>&type=<?php echo $_GET['type'];?>" title="View <?php echo $_GET['type'];?>" ><i class="icon-list"></i></a>
	<a href="../admin/index.php?option=component&kind=<?php echo $_GET['kind'];?>&method=<?php echo $_GET['method'];?>&process=add&type=<?php echo $_GET['type'];?>&id=<?php echo $country->$fid;?>" title="Edit <?php echo $_GET['type'];?>"><i class="icon-edit"></i></a>
	<a href="#myModal<?php echo $country->$fid; ?>" role="button" data-toggle="modal" title="Delete <?php echo $_GET['type'];?>" ><i class="icon-trash"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $country->$fid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/index.php?option=component&kind=<?php echo $_GET['kind'];?>&method=<?php echo $_GET['method'];?>&process=view&id=<?php echo $country->$fid;?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div>
<?php //} ?>
	</td>

    </tr>
<?php 
break 1; }

}	?>
	
  
              </tbody>
            </table>
          <?php  // render the pagination links        $pagination->render();  ?>
        </div>
    </div>	
<?php
      	}else
	{
	//echo 'id is:'.$id;		
	//echo '<h2>No more  video galleries.</h2>';
	$row = $db->get_row("SHOW FULL COLUMNS FROM  $table");
	$sid = $row->Field;
	
	
		$rows = $db->get_results("SHOW FULL COLUMNS FROM  $table");
		foreach($rows as $row)
		{

	 $pos13 = strpos(	$row->Field, "_t");
	if($pos13)
	 {
	 	 $title = $row->Field;
		}
}
//			echo 'title is:'.$title;
	//echo 'sid is:'.$sid;
	
	$getitems = $db->get_row("SELECT * from $table WHERE $sid = '$id'");
	echo '<h2>View Details of '.$getitems->$title.'</h2>';
//$getitems = $db->get_results("SELECT * FROM video_gallery_items_table WHERE vg_id = '$id'");
$tmpl = 'default';
head2();
 display_details11($table,$id);

} ?>



<?php

function display_details11($tablename,$id)
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
				$iid = $getid->Field;
			$tablevalues = $db->get_row("SELECT * FROM $tablename WHERE $iid = $id");
		$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename"); 
				
				?>
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
				

<tr>
	<?php
	foreach($getcolms as $getcolm)
	{
		 $field = $getcolm->Field; 
?>

<td><?php echo $tablevalues->$field; ?></td>

<?php } ?>

<td>
<a href="../admin/index.php?option=component&kind=article_manager&method=manager&process=add&type=<?php echo $tablename; ?>&id=<?php echo $id; ?>" title="Edit <?php echo $tablename; ?>" ><i class="icon-edit"></i></a>
<!-- <a href="../admin/details.php?type=<?php echo $tablename; ?>&tmpl=<?php echo $tmpl ?>&id=<?php echo $id; ?>&action=delete" title="Delete <?php echo $tablename; ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a> -->

<a href="#myModal<?php echo $id; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=<?php echo $tmpl ?>&id=<?php echo $id; ?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div>

</td>

<?php //	}  ?>
</tr>
</table>
</div>
 </div>
 </div>
<!-- </div> -->	
<?php	}

}

 ?>    

