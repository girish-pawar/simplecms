
<?php


if(isset($_GET['insert']) || isset($_GET['bdid']))
{
$insert = $_GET['insert'];	
$bdid = $_GET['bdid'];
}else{
$insert = null;	
$bdid = null;
	}

if($insert == '1' || $insert == '3' || $insert == '22')
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 2:Batch Fees added Successfully.</strong>
<!-- <a href="index.php?option=component&kind=batch&method=add_batch&process=discount_value&type=batch_table&insert=1&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>-->
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
 
 <div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 3:Add Batch Discount values.</strong>
 <?php
 if($bdid == '1')
 {
 ?>
 <a href="index.php?option=component&kind=batch&method=add_batch&process=select_instructer&type=batch_table&insert=33&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 4</a>
<?php  } ?>
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '22')
{

 if($bdid == '2')
 {
 ?>
 	<div class="alert fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 3: Batch Discount values Updated Successfully!</strong>
 	 <a href="index.php?option=component&kind=batch&method=add_batch&process=select_instructer&type=batch_table&insert=33&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 4</a>
<?php  } ?>
 </div>
	<?php
	}


if($insert == '33')
{
	//echo $update;
	?>
	<div class="alert alert-warning fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 2:Batch Fees not added.</strong>
 </div>
	<?php
	}

?>

<form method='POST' action=''>
<h3>Discount Type</h3>
<?php

$discount_type= $db->get_results("SELECT * FROM discount_type");

foreach($discount_type as $offer)
{
?>
	
<h3><?php echo $offer->dt_ty;?></h3>
<?php	

	if(isset($_GET['bdid']) == '1')
	{
		$discount_value= $db->get_row("SELECT * FROM discount_value WHERE dv_bid='$_GET[b_id]' AND dt_id='$offer->dt_id'");
		if($discount_value)
		{
?>
<input type='text' name='dt_id[<?php echo $offer->dt_id;?>]' value='<?php if($discount_value) { echo $discount_value->dv_value; } ?>'>
<?php
}
}else{
	?>
<input type='text' name='dt_id[<?php echo $offer->dt_id;?>]' value=''>
<?php
	}
}
?><br />

<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='submit' class="btn " name='submit_discount' >
<input type='submit' class="btn btn-primary" name='submit_discount_skip' value='Skip & Continue '>
<!--<input type='submit' name='submit'>!-->

<?php
$b='3,4';
$button= getbutton($b);
?>
</form>