<?php
include_once('../admin/includes/config.php');
head11();

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

if(isset($_GET['insert']))
{
$insert = $_GET['insert'];	
}else{
$insert = null;	
	}


if(isset($insert))
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">�</button>
 <strong>New Batch Added Successfully.</strong>
<!-- <a href="index.php?option=component&kind=batch&method=add_batch&process=batch_fee&type=batch_table&insert=1&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>-->
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
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
<div class="pull-right span4 offset-2">
<!--<a href="add.php?type=<?php echo $tablename; ?>&tmpl=default" class="btn btn-info" >Add New <?php echo $bar; ?></a>-->
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename; ?>" class="btn btn-info" >Add New <?php echo $bar; ?></a>
<!--<a href="index.php?option=component&kind=batch_charges_type&method=<?php echo $_GET['method']; ?>&process=add&type=batch_charges_type" class="btn btn-info" >Add New Batch Charges Type</a>
<a href="index.php?option=component&kind=discount_type&method=<?php echo $_GET['method']; ?>&process=add&type=discount_type" class="btn btn-info" >Add New Discount Type</a>
--></div>

<div class="pull-right span4 offset-3">
<?php include_once('../admin/includes/gallery_config.php'); ?>

</div>
<!--<div class="pull-right span4 offset-3">
<?php //include_once('../admin/includes/gallery_config.php'); ?>

</div>-->

<div class="pull-left span11">

 
 
<?php
if($function == 1)
{ 
//echo $function;
//view_table1($tablename,$record);
view_batch_table1($tablename,$record); 
}else{
	//echo $function;
	view_table($tablename,$record); 
	}

?> 


</div>

</form>
</div>
<?php

function view_batch_table1($tablename,$record)
{
	global $db;
$tableids = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
//print_r($tableids);
$ctid = $tableids->Field;
$Comment = $tableids->Comment;


$idcount = $db->get_var("SELECT COUNT(*) FROM $tablename");
//echo $idcount;

$values = $db->get_results("SELECT * FROM $tablename");
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");

 // include the pagination class
require '../admin/includes/Zebra_Pagination.php';

 // how many records should be displayed on a page?
 $records_per_page = $record;
        // instantiate the pagination object
        $pagination = new Zebra_Pagination();

        // the number of total records is the number of records in the array
        $pagination->records($idcount);

        // records per page
        $pagination->records_per_page($records_per_page);

        // here's the magick: we need to display *only* the records for the current page
        $countries = array_slice(
            $values,                                             //  from the original array we extract
            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
            $records_per_page                                       //  this many records
        );
        
        $colms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
        //print_r($colms);
$cols = array("_id", "_t");
?>
<table class="table table-bordered" class="countries" >
<tr> 
<th><?php echo $Comment; ?></th>
<?php
foreach ( $colms as $colm )
{

$mystring2 = $colm->Field;
$findme2   = 'b_t';
$pos2 = strpos($mystring2, $findme2);
if($pos2 === false )
{
	//echo 'not present </br>';
	
}else{
	$title1 = $colm->Field;

	?>
<th><?php	echo $title = $colm->Comment;  ?></th>
	
<?php	
break 1;
} 

	}      
?>
<th>Options</th>	
</tr>
 


<?php
//echo 'title is :'.$title1;
//echo 'id is :'.$ctid;

	global $db;
	$colmnames = array($ctid, $title1);
foreach ($countries as $index => $country)
{
foreach($values as $val)
{ 
foreach ($getcolms as $getcolm)
{
		$field = $getcolm->Field;
?>
<tr>
<?php		
if(in_array($field, $colmnames))
{
		$field = $getcolm->Field;
		//echo $field;
if($field = $ctid)
{
?>
	<td><?php echo $country->$ctid; ?></td>
	<?php
	}?>
	
<?php if($field = $title1)	{
		//echo $val->$title1;
		?>
		<td><?php echo $country->$title1; ?></td>
<?php }
?>
<td>
<!--<a href="../admin/add.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>-->
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=edit&type=<?php echo $tablename; ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>
<a href="#myModal<?php echo $country->$ctid; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $country->$ctid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <!--<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" class="btn btn-danger" >Delete</a>-->
        <a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=view&type=<?php echo $tablename; ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" class="btn btn-danger" >Delete</a>
    </div>
</div>


<!-- 
<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" title="Delete <?php echo $tablename ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a> -->
<!-- <a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a> -->
<!--<a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=custom&id=<?php echo $country->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a>-->
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=details&type=<?php echo $tablename; ?>&tmpl=custom&id=<?php echo $country->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a>
</td>
	<?php
break 1;	
	}
else{}	
?>

</tr>
<?php
	 //in array close
}
break 1;
}

}

?>

</table>
	
<?php
       // render the pagination links
        $pagination->render();
        ?>

<?php	} ?>

