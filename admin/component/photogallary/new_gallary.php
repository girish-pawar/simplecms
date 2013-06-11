<?php
include_once($_SERVER["DOCUMENT_ROOT"].'/admin/includes/defination.php');
global $db;
if(isset($_GET['types']))
{
if($_GET['types']=='new_gallary')
{

//echo $_SERVER["DOCUMENT_ROOT"];
?>
<label>Gallary Title</label>
<label><input type='text' name='g_title'></label>
<label>Status</label><label>
<select name='g_status'>
<option value='show'>Show</option>
<option value='hide'>Hide</option>
</select></label>
<label>Folder Name :</label>
<label><input type='text' name='g_folder' id='find_folder' onkeyup='search_folder();'></label>

<?php

}
else
{
$existing_gallery= $db->get_results("SELECT * FROM gallery");
if($existing_gallery)
{
?>
Select Gallery:<br />
<?php
foreach($existing_gallery as $gallery)
{
?>
<input type='checkbox' name='select_gallery[]' value='<?php echo $gallery->g_id;?>'><?php echo $gallery->g_title;?><br />
<?php

}
?>

<input type='submit' class='btn btn-primary' name='submit_gallery_link' value='Create New Gallery'>
<?php

}
?>


<?php

}

}
?>


<?php

if(isset($_GET['folder']))
{
$folder= $db->get_row("SELECT * FROM gallery WHERE g_folder='$_GET[folder]'");

if($folder)
{
?>
<div class="alert alert-error">
  This folder already exit 
</div>
<?php

}
else
{
?>

<input type='submit' class='btn btn-primary' name='submit' value='Create New Gallery'>
<?php

}


}
?>