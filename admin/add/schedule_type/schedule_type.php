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
$update= $db->query("UPDATE schedule_value SET sv_value='$sv_value' WHERE sv_id='$sv_id'");
}
?>

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
<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='submit' class="btn" name='submit_schedule' >
	<!--<input type='submit' class="btn btn-info" name='next' value='Next'>!-->
	<?php
	if(!isset($_GET['extra']))
	{
	?>
	<input type='submit' class="btn btn-primary" name='next' value='Skip & Continue '>
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

$schedule_value= $db->get_results("SELECT * FROM schedule_value WHERE b_id='$_GET[b_id]'");
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
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the Schedule?</p>
    </div>
    <div class="modal-footer">
	  	<input type='submit' class="btn btn-primary" name='delete_schedule' value='Delete'>
			
	<input type='hidden' name='sv_id' value='<?php echo $schedules->sv_id;?>'>
		<input type='hidden' name='table' value='schedule_value'>
		
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		
        
    </div>
</div>
					
					<!-- Button to trigger modal -->

 
<!-- Modal -->
<div id="myModal<?php echo $schedules->sv_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>

<?php

$schedule_values= $db->get_row("SELECT * FROM schedule_value WHERE sv_id='$schedules->sv_id'");
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