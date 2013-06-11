<?php
//include_once('../admin/includes/conn.php');


if(isset($_GET['insert']) || isset($_GET['ins']))
{
	global $db;
$insert = $_GET['insert'];	
$ins = $_GET['ins'];
//echo  'ins is:'.$ins;
	}else{
$insert = null;	
$ins = null;
	}


if($insert == '1' || $insert == '3' || $insert == '33')
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 3:Batch Discount values added Successfully.</strong>
 </div>
 
 <div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 4:Select Instructor for batch.</strong>
 <?php
 if($ins == '1')
 {
 ?>
 <a href="index.php?option=component&kind=batch&method=add_batch&process=pre_camp_value&type=batch_table&insert=44&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 4</a>
<?php  } ?>
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '33')
{

 if($ins == '2')
 {
 ?>
 	<div class="alert fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 3: Batch Discount values Updated Successfully!</strong>
 	 <a href="index.php?option=component&kind=batch&method=add_batch&process=pre_camp_value&type=batch_table&insert=44&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 4</a>
<?php  } ?>
 </div>
	<?php
	}


if($insert == '44')
{
	//echo $update;
	?>
	<div class="alert alert-warning fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 2:Batch Fees not added.</strong>
 </div>
	<?php
	}
	
if($_GET['ins'] != null)
{
		$bid = $_GET['b_id'];
		$getdata = $db->get_row("SELECT * FROM batch_instructer WHERE b_id = '$_GET[b_id]'");
			if($getdata)
				{
							$ins_ids = $getdata->instructer_id;
							$gettrim = rtrim($getdata->instructer_id,",");
							$explode = array();
							$explode = explode(',',$gettrim); 	
						}

		
}
	?>


<form method='POST' action=''>
<h3> Select Instructer</h3>

<?php
$instructers = $db->get_results("SELECT * FROM instructor");
foreach($instructers as $instructer)
{
	$ins_id = $instructer->i_id;
	if($explode)
	{	
			if(in_array($ins_id,$explode))
			{
				?>
<input type='checkbox' name='instructer_id[]' checked="true" value='<?php echo $instructer->i_id;?>'><?php echo $instructer->i_ty;?><br />
<?php
		}else{
				?>
<input type='checkbox' name='instructer_id[]'  value='<?php echo $instructer->i_id;?>'><?php echo $instructer->i_ty;?><br />
<?php		
			}
		}else{
?>
<input type='checkbox' name='instructer_id[]' value='<?php echo $instructer->i_id;?>'><?php echo $instructer->i_ty;?><br />
<?php
}
}
?>

<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>
<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='batch_instructer'>
<input type='submit' class="btn " name='submit'>
<input type='submit' class="btn btn-primary" name='next_precamp' value='Skip & Continue'>
	
<?php
$b='3,4';
$button= getbutton($b);
?>
</form>
<?php




?>