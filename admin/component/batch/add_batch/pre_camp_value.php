
<?php
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


if($insert == '1' || $insert == '3' || $insert == '44')
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 4:Instructor Added Successfully.</strong>
 </div>
 
 <div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 5:Specify Pre Camp Values.</strong>
 <?php
 if($ins == '1')
 {
 ?>
<a href="index.php?option=component&kind=batch&method=batch&process=view&type=batch_table&insert=55" class="btn btn-inverse" style="float:right;" >Proceed For Continue..</a>
<?php  } ?>
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '44')
{

 if($ins == '2')
 {
 ?>
 	<div class="alert fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 5: Pre Camp Values Updated Successfully!</strong>
 	 <a href="index.php?option=component&kind=batch&method=batch&process=view&type=batch_table&insert=55" class="btn btn-inverse" style="float:right;" >Proceed For Continue..</a>
<?php  } ?>
 </div>
	<?php
	}


if($insert == '55')
{
	//echo $update;
	?>
	<div class="alert alert-warning fade in">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Step 5:Batch Fees not added.</strong>
 </div>
	<?php
	}
	
	
if($_GET['ins'] != null)
{
		$bid = $_GET['b_id'];
		$getdata = $db->get_row("SELECT * FROM pre_camp_value WHERE batch_id = '$_GET[b_id]'");
				if($getdata)
				{
							$pcids = $getdata->pc_id	;
							$pc_ids = rtrim($pcids,',');
							$array = array();
							$array = explode(',',$pc_ids);
							$dates = $getdata->date_pre;
							echo $getdata->date_pre;
							$date1 = $getdata->date_pre;
							$date22 = date('d/m/Y',strtotime(str_replace("-","/",$date1)));
							echo 'date is'.$date22;
										
							$getvenue = $db->get_row("SELECT * FROM pre_camp_venue WHERE pc_id = '$getdata->pc_id'");
							$pcid = $getvenue->pc_id;
							$pctitle = $getvenue	->pc_t;	
							$id = $pcid;			
					}

		
}

?>

<form method='POST' action=''>
<?php

/*if(isset($_GET['id']))
{
$id = $_GET['id'];
}
else
{
$id=null;
}*/

?>

<div class="alert alert-info">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <strong>Note:</strong> Please select single pre camp venue.
    </div>

<?php
/*$extra = 1;

$id1 = $_GET['pcv_id'];
echo 'id is:'.$id1;
$pre_camp_value = GetForm($_GET['process'],$id1,$extra);
echo $pre_camp_value;*/

//$seo_table='seo_detail';
//$seo_form=Get_SeoForm($seo_table,$id);
//echo $seo_form;

//$b='1,2';
//$button= getbutton($b);

$venues = $db->get_results("SELECT * FROM pre_camp_venue");
if($venues)
{
			foreach($venues as $venue)
			{
				
					if($_GET['ins'] != null)
					{
						 if(in_array($venue->pc_id,$array))
						 {
						 		?>				
				<input type="checkbox" name="pc_id[]" checked="true" value="<?php echo $venue->pc_id; ?>" /><?php echo $venue->pc_t; ?><br />
				<?php
				}else{	
					?>				
				<input type="checkbox" name="pc_id[]" value="<?php echo $venue->pc_id; ?>" /><?php echo $venue->pc_t; ?><br />
				<?php
				}
			}else{
						?>				
				<input type="checkbox" name="pc_id[]" value="<?php echo $venue->pc_id; ?>" /><?php echo $venue->pc_t; ?><br />
				<?php
				}		
	
	}
}
?>
<?php
if($ins)
{
?>
<!--<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>-->
<input type='hidden' name='pcv_id' value='<?php echo $getdata->pcv_id;?>'>
<?php
}
?>
<!--<?php if(isset($getdata)){ echo $getdata->date_pre ; } ?>
data-date-viewmode="years" data-date-minviewmode="months"
data-date="<?php if(isset($getdata)){ echo $getdata->date_pre ; } ?>" 

-->
 <h3> Date  :</h3>
  <div id="datetimepicker3" class="input-append date">
    <input data-date-format="MM/dd/yyyy" type="text" name="date_pre"  value="<?php if(isset($getdata)){ echo $date22 ; } ?>"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  


<h3> Time</h3>
<input type='text' name='time_pre' value="<?php if(isset($getdata)){ echo $getdata->time_pre ; } ?>"><br />
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='batch_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<!--<input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>-->
<!--<input type='hidden' name='type_id' value='<?php echo $_GET['b_id'];?>'>-->
<input type='hidden' name='table' value='<?php echo $_GET['process'];?>'>
<?php


//$b='1,2';
//$button= getbutton($b);
?>
<input type='submit' class="btn " name='submit'>
	<input type='submit' class="btn btn-primary" name='next_precamp_value' value='Skip & Continue'>
<!--<input type='submit' name='submit'>!-->
<?php
$b='3,4';
$button= getbutton($b);
?>
</form>