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
		
			
				
if(isset($_GET['insert']))
{
$insert = $_GET['insert'];	
}else{
$insert = null;	
	}


if($insert == '1' || $insert == '3' || $insert == '44')
{
	?>
		<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 4:Destinations Added Successfully!</strong>
</div> 
 
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 5:Add Schedule.</strong>
 <?php 
if($ins_value == '1')
{ 
 ?>
 <a href="index.php?option=component&kind=tour&method=tour&process=view&type=tour&insert=44&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Continue..</a>
<?php  } ?> 
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}
	//}		

/*if($insert == '44' || $insert == '2')
{
	
if($ins_value == '2')
{ 
 ?>
<!-- 	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 2:Countries Added Successfully!</strong>
</div>-->
 	<div class="alert fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 4:Destinations Updated Successfully!</strong>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&insert=44&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 5</a>
<?php  } ?>  
 </div>
	<?php
	}*/
	

/*if($id != null)
{
$id = $_GET['t_id'];	
$getrecord = $db->get_row("SELECT * FROM tour_destination WHERE t_id = $id");
$record = rtrim($getrecord->tour_d_id,',');
$records = array();
$records = explode(',',$record);
			print_r($records);
			//$tcid = $getrecord->tcat_id;
	*/



?>


<?php
if(isset($_POST['delete_schedule']))
{
	$table= $_POST['table'];
	$svid= $_POST['sv_id'];
	
	delete($svid,$table);
	}

?>
<?php
if(isset($_POST['update_schedule']))
{
$sv_id= $_POST['sv_id'];
if(isset($_POST['title']))
{
$sv_value= $_POST['title'];
}

if(isset($_POST['description']))
{

$sv_value= $_POST['description'];
}
$update= $db->query("UPDATE tour_schedule_value SET sv_value='$sv_value' WHERE sv_id='$sv_id'");
}
?>


<script type="text/javascript">
var xmlhttp;
function suggest_destination()
{
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp= new ActiveXObject('Micosoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("test").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','destination_search.php?select='+document.getElementById('t_t').value,true);
xmlhttp.send();
}
</script>

<form method='POST' action=''>
<h3> Schedule</h3>
<?php

$schedule_type= $db->get_results("SELECT * FROM schedule_type");
?>

<?php
foreach($schedule_type as $schedule)
{
if($schedule->st_form=='input')
{
?>
<h3><?php echo $schedule->st_ty;?></h3>
<input type='input' name='<?php echo $schedule->st_ty;?>[<?php echo $schedule->st_id;?>]' value=''>
<?php
}
if($schedule->st_form=='textarea')
{
?>
<h3><?php echo $schedule->st_ty;?></h3>
<textarea name='<?php echo $schedule->st_ty;?>[<?php echo $schedule->st_id;?>]'></textarea>
<?php

}
}

?><br />
<input type='hidden' name='t_id' value='<?php echo $_GET['t_id'];?>'>
<input type='submit' class="btn" name='submit_schedule' >
	<!--<input type='submit' class="btn btn-info" name='next' value='Next'>!-->
	<?php
	if(!isset($_GET['extra']))
	{
	?>
	<input type='submit' class="btn btn-primary" name='schedule_skip' value='Skip & Continue '>
	<?php
	}
	?>
	<?php
	if(isset($_GET['extra']))
	{
	?>
		<input type='submit' class="btn btn-info" name='back' value='Back To Edit Page '>
	<?php
	}
	?>
<!--<input type='submit' name='submit'>!-->
</form>
<?php
if($_GET['id'] != null)
{
$schedule_value= $db->get_results("SELECT * FROM tour_schedule_value WHERE t_id='$_GET[id]'");	
	}else{
$schedule_value= $db->get_results("SELECT * FROM tour_schedule_value WHERE t_id='$_GET[t_id]'");		
		}

if($schedule_value)
{

?>
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Users<span class="label label-warning"></span></a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
               
           </thead>
              <tbody>
			  <tr><th>schedule</th><th>option</th></tr>


				<?php
				foreach($schedule_value as $schedules)
				{
				$schedule_type= $db->get_row("SELECT * FROM schedule_type WHERE st_id='$schedules->st_id'");
				?>
				<tr>

				<td><?php echo'<h3>'. $schedule_type->st_ty.'</h3>'. $schedules->sv_value;?></td>
					<td><a href="#myModal<?php echo $schedules->sv_id;?>" role="button" class="btn" data-toggle="modal">Edit</a><?php //echo $schedules->sv_id;?>
					<a href="#myModal1<?php echo $schedules->sv_id;?>" class="btn btn-primary" role="button" class="btn" data-toggle="modal">Delete</a><?php //echo $schedules->sv_id;?>
					</td></tr>
					
					
						<form method='POST' action=''>
						
<div class="modal small hide fade" id="myModal1<?php echo $schedules->sv_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the Schedule?</p>
    </div>
    <div class="modal-footer">
	  	<input type='submit' class="btn btn-primary" name='delete_schedule' value='Delete'>
			
	<input type='hidden' name='sv_id' value='<?php echo $schedules->sv_id;?>'>
		<input type='hidden' name='table' value='tour_schedule_value'>
		
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		
        
    </div>
</div>
					
					<!-- Button to trigger modal -->

 
<!-- Modal -->
<div id="myModal<?php echo $schedules->sv_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>

<?php

$schedule_values= $db->get_row("SELECT * FROM tour_schedule_value WHERE sv_id='$schedules->sv_id'");
$schedule_types= $db->get_row("SELECT * FROM schedule_type WHERE st_id='$schedule_values->st_id'");
if($schedule_types->st_ty=='Title')
{
?>
Title :

<input type='input' name='title' value='<?php echo $schedule_values->sv_value;?>'>
<?php
}
if($schedule_types->st_ty=='Description')
{
?>
Description :
<textarea name='description'><?php echo $schedule_values->sv_value;?></textarea>
<?php

}
?>
	
	<input type='hidden' name='sv_id' value='<?php echo $schedules->sv_id;?>'>
	</p>
  </div>
  <div class="modal-footer">
  	<input type='submit' class="btn btn-primary" name='update_schedule' value='Update'>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</form>
  </div>
</div>
				<?php
				
				}
				     
						?>
						


						
</tbody>
</table>						
</div>

<?php

}




?>