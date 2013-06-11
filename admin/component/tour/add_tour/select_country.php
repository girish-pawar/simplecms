
<?php 

if(isset($_GET['id']))
{
			$id=$_GET['id'];
}
elseif(isset($_GET['t_id']))
{
			$id=$_GET['t_id'];
}
else
{
$id=null;
}



if(isset($_GET['ins']) )
{
			$ins_value = $_GET['ins'];
}
else
{
			$ins_value = null;
} 
		
		
if($id != null)
{
	$getrecord = $db->get_row("SELECT * FROM tour_country WHERE t_id = '$id'");
			$record = rtrim($getrecord->tour_c_id,',');
			$records = array();
			$records = explode(',',$record);	
			//print_r($records);
			$tcid = $getrecord->tc_id;
	
	}
		
if(isset($_GET['insert']))
{
$insert = $_GET['insert'];	
}else{
$insert = null;	
	}


if($insert == '1' || $insert == '3' || $insert == '11')
{
	?>
		<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 1:New Tour Added Successfully.</strong>
</div> 
 
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 2:Select Countries.</strong>
 <?php 
if($ins_value == '1')
{ 
 ?>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=select_category&type=tour&insert=22&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step3</a>
<?php  } ?> 
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '11' || $insert == '2')
{
	
if($ins_value == '2')
{ 
 ?>
 <!--	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 1:New Tour Added Successfully.</strong>
</div>-->
 	<div class="alert fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 2:Countries Updated Successfully!</strong>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=select_category&type=tour&insert=22&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step3</a>
<?php  } ?>  
 </div>
	<?php
	}

?>

<form method='POST' action=''>
<h3>Select Country</h3>

<?php
$instructer= $db->get_results("SELECT * FROM country");
foreach($instructer as $ins)
{
if($id)
{
	if(in_array($ins->c_id,$records))
	{
?>
<input type='checkbox' checked="true" name='tour_c_id[]' value='<?php echo $ins->c_id;?>'><?php echo $ins->c_t;?><br />
<?php
}else{
	?>
<input type='checkbox' name='tour_c_id[]' value='<?php echo $ins->c_id;?>'><?php echo $ins->c_t;?><br />
<?php
}

}

//}

elseif(isset($_GET['t_id']) != null){
?>
<input type='checkbox' name='tour_c_id[]' value='<?php echo $ins->c_id;?>'><?php echo $ins->c_t;?><br />
<?php
	}else{
		?>
<input type='checkbox' name='tour_c_id[]' value='<?php echo $ins->c_id;?>'><?php echo $ins->c_t;?><br />
<?php
		}
}
?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $getrecord->tc_id;?>'>
<?php
}
if($_GET['t_id'] != null )
{
?>
<input type='hidden' name='t_id' value='<?php echo $_GET['t_id'];?>'>
<input type='hidden' name='tc_id' value='<?php echo $getrecord->tc_id;?>'>
<?php
}
else{
	?>
<input type='hidden' name='t_id' value='<?php echo $_GET['id'];?>'>
	<!--<input type="hidden" name="tc_id" value="<?php echo $tcid; ?>" />-->
<?php } ?>

<input type='hidden' name='seo_table' value=''>

<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='tour_country'>

<?php

/*if($t_id != null )
{*/
?>
<input type='submit' class="btn " name='submit'>
<input type='submit' class="btn btn-primary" name='SaveAndCont' value='Skip & Continue'>

<?php
/*}
else{*/
	?>
<!--<input type='submit' class="btn " name='update_tour_countrty'>
<input type='submit' class="btn btn-primary" name='SaveAndCont' value='Save & Continue'>-->
<?php //} ?>
<?php
$b='3,4';
$button= getbutton($b);
?>

</form>
<?php




?>