<?php
head_set();

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	if($id)
	{
	$getresult = $db->get_row("SELECT * FROM sets WHERE set_id = '$id'");
}
	//print_r($getresult);
}
else{
$id = null;	
	}

?>




<form method='POST' action=''>
<br /><br /><h3>Add Sets</h3>
<label>Title :</label>
<input type='text' name='title' value="<?php if(isset($getresult)){ echo $getresult->set_title; }else{ echo '';} ?>">


<label>Status :</label><select name='status'>
<?php 
if(isset($getresult))
{ 
if($getresult->set_status == 'publish')
{
?>
<option selected="true" value="publish">Publish</option>
<option value="unpublish">Unpublish</option>
<?php }else{ 
?>
<option value="publish">Publish</option>
<option value="unpublish" selected="true">Unpublish</option>
<?php }?>
<?php }else{ 
?>
<option value="publish">Publish</option>
<option value="unpublish">Unpublish</option>
<?php
}
 ?>

</select><br />

<label>Height:</label>
<input type='text' name='height' value="<?php if(isset($getresult)){ echo $getresult->set_height; }else{ echo '';} ?>" />


<label>Width:</label>
<input type='text' name='width' value="<?php if(isset($getresult)){ echo $getresult->set_width; }else{ echo '';} ?>" />


<label>Add Copyright:</label>
<select name="copyright">
<?php 
if(isset($getresult))
{ 
if($getresult->set_copyright == 'yes')
{
?>
<option value="yes" selected="true">YES</option>
<option value="no">NO</option>
<?php }else{ 
?>
<option value="yes" >YES</option>
<option value="no" selected="true">NO</option>
<?php } ?>

<?php }else{ 
?>
<option value="yes" >YES</option>
<option value="no" selected="true">NO</option>
<?php
} ?>
</select>

<?php if(isset($getresult))
{ ?>
<input type='submit' name='update_sets' class='btn btn-primary' value='Update Set'>
<?php }else{ 
?>
<input type='submit' name='sets' class='btn btn-primary' value='Create Set'>
<?php
}
?>



</form>