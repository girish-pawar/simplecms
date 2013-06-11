<link href="../admin/css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" />
<script src="../admin/js/bootstrap-datetimepicker.min.js"></script>
<form action="" method="post" enctype='multipart/form-data'>

<?php head11(); 

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
 <strong>Step 1:New Batch Created Successfully.</strong>
 <a href="index.php?option=component&kind=batch&method=add_batch&process=batch_fee&type=batch_table&insert=11&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '2')
{
	echo $update;
	?>
	<div class="alert fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Updated Successfully!</strong>
 <a href="index.php?option=component&kind=batch&method=add_batch&process=batch_fee&type=batch_table&insert=11&b_id=<?php echo $_GET['b_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>
 </div>
	<?php
	}



if($insert == '')
{
	//echo $update;
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 1:Create New Batch.</strong>
 
 </div>
	<?php
	}


if(isset($_GET['b_id']))
{
	$b_id = $_GET['b_id'];
$getbatch = $db->get_row("SELECT * FROM batch_table WHERE b_id = '$b_id'");	
	}else{
$b_id = null;		
		}
?>


<h3>Batch Title</h3>
<input type='text' name='b_t' value="<? if(isset($getbatch)) { echo $getbatch->b_t; } ?>">

<?php
if(isset($getbatch)) { 
$tourids = $getbatch->dest_id;
//echo $getbatch->dest_id; 
}

if(isset($tourids))
{
	$t_ids = array();
$tour_ids = rtrim($tourids,',');
$t_ids = explode(',',$tour_ids);
}

$tour= $db->get_results("SELECT * FROM tour");
?>
<h3>Tour</h3>
<?php
foreach($tour as $tours)
{
if(isset($t_ids))
{
	if (in_array($tours->t_id, $t_ids))
{?>
<input type='radio' checked="true" name='dest_id[]' value='<?php echo $t_id;?>'><?php echo $tours->t_t;?><br />
	
<?php	
	}	else{
	?>

<input type='radio' name='dest_id[]' value='<?php echo $tours->t_id;?>'><?php echo $tours->t_t;?><br />
<?php
}
}	else{
	?>

<input type='radio' name='dest_id[]' value='<?php echo $tours->t_id;?>'><?php echo $tours->t_t;?><br />
<?php
}
}
?>

 <h3>Start Date  </h3>
  <div id="datetimepicker1" class="input-append date">
    <input data-format="yyyy/MM/dd hh:mm:ss" type="text" name="b_s_date" value="<? if(isset($getbatch)) { echo $getbatch->b_s_date; } ?>"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
   <h3>End Date </h3>
  <div id="datetimepicker2" class="input-append date">
    <input data-format="yyyy/MM/dd hh:mm:ss" type="text" name="b_e_date" value="<? if(isset($getbatch)) { echo $getbatch->b_e_date; } ?>"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>

<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
	    $('#datetimepicker2').datetimepicker({
      language: 'pt-BR'
    })
  });
</script>


<h3>Batch Includes</h3>
<textarea name='b_includes'>
<? if(isset($getbatch)) { echo $getbatch->b_includes; } ?>
</textarea>

<h3>Batch Excludes</h3>
<textarea name='b_excludes'>
<? if(isset($getbatch)) { echo $getbatch->b_excludes; } ?>
</textarea>


<input type='hidden' name='b_tags' value="">


<h3>Batch Accomodation</h3>
<textarea name='b_accomodation'>
<? if(isset($getbatch)) { echo $getbatch->b_accomodation; } ?>
</textarea>

<h3>status</h3>
<select name='b_status'>
<option value='active'>Active</option>
<option value='inactive'>Inctive</option>

</select><br />

<h3>Terms and Conditions</h3>
<textarea name='b_terms_condition'>
<? if(isset($getbatch)) { echo $getbatch->b_terms_condition; } ?>
</textarea>

<?php
$seo_table='seo_detail';
//$id=null;

$extra = '1';

$seo_form=Get_SeoForm($seo_table,$b_id,$extra,$_GET['type']);
echo $seo_form;

?>
<!--<input type='submit' name='submit'>!-->
<input type='hidden' name='seo_table' value='123'>
<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
</form>