<?php
if(isset($_GET['insert']) || isset($_GET['bfid'])) 
{
$insert = $_GET['insert'];	
$bfid = $_GET['bfid'];
}else{
$insert = null;	
$bfid = null;
	}
	
	
if($insert == '11' || $insert == '3')
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 1:New Batch Details added Successfully.</strong>
<!-- <a href="index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=1&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>-->
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
 
 <div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 2:Add Batch Fee Details.</strong>
 <?php
 if($bfid == '1')
 {
 ?>
 <a href="index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=22&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 3</a>
<?php  } ?>
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '2')
{
	//echo $update;
	?>
	<div class="alert fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 2: Batch Fee Details Updated Successfully!</strong>
	 <?php
 if($bfid == '2')
 {
 ?>
	 <a href="index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=22&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 3</a>
<?php  } ?>
 </div>
	<?php
	}

?>


<form method='POST' action=''>
<h3>Fee Type</h3>
<?php

$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
$currency= $db->get_results("SELECT * FROM currency");
foreach($currency as $curr)
{
?>
<h3> <?php echo $curr->cr_ty;?></h3>
<?php
foreach($batch_charges as $fee)
{
?>
<h3><?php echo $fee->bc_ty;?></h3>
<?php

	if(isset($_GET['bfid']))
	{
	$batch_fee= $db->get_row("SELECT * FROM batch_fee WHERE (b_id='$_GET[b_id]' AND bf_cr_id='$curr->cr_id') AND (bc_id='$fee->bc_id')");
			if($batch_fee)
			{
?>
<input type='text' name='bc_id[<?php echo $curr->cr_id;?>][<?php echo $fee->bc_id;?>]'  value='<?php if ($batch_fee) { echo $batch_fee->bf_value; } ?>'>
<?php
}
}else{
	?>
<input type='text' name='bc_id[<?php echo $curr->cr_id;?>][<?php echo $fee->bc_id;?>]'  value=''>
<?php
	
	}



}
}
?><br />
<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='submit' class="btn " name='submit_batchfee' >
<input type='submit' class="btn btn-primary" name='submit_batchfee_skip' value='Skip & Continue '>

<?php
$b='3,4';
$button= getbutton($b);
?>
</form>
