<?php

$getresults = $db->get_results("SELECT * FROM category");
if($getresults)
{		
$getrows = $db->get_results("SHOW FULL COLUMNS FROM category");
$getid = $db->get_row("SHOW FULL COLUMNS FROM category");
//echo $getid->Field;
foreach($getrows as $getrow)
{

$pos1 = strpos($getrow->Field, "_id");
$pos11 = strpos($getrow->Field, "_t");
	 if($pos11){
	 	$field1= $getrow->Field;
	 	 //echo $field1;
	 	}	
	 
	}
	
$ids = $getid->Field;
//echo $ids;
echo 'Select category name:';
echo '<select name=link1 >';
//echo '<select name="link"  onclick= "suggest1($select);">';
foreach($getresults as $getresult)
{
//	echo $selectoption;
//echo $getresult->$ids;
	echo '<option value="'.$getresult->$ids.'">'.$getresult->$field1.'</option><br />';	
}
echo '</select>';
?>

No. of records per page:
<input type="text" name="no_of_records" value="" />
No. of Columns Display per page:
<input type="text" name="no_of_colm" value="" />
Image Display:
<select name='image_display'>
        <option value='yes'>yes</option>
        <option value='no'>no</option>
        </select>
<!-- <input type='hidden' name='seo_table' value=''>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<?php $b='1,2';
echo $button= getbutton($b); ?>
<input type='hidden' name='table' value='<?php echo 'config';?>'> -->
</form>
	<?php
	} ?>
	