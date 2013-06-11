<?php


$getresults = $db->get_results("SELECT * FROM video_gallery_items_table");
if($getresults)
{		
$getrows = $db->get_results("SHOW FULL COLUMNS FROM video_gallery_items_table");
$getid = $db->get_row("SHOW FULL COLUMNS FROM video_gallery_items_table");
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
echo 'Select Video name:';
echo '<select name=link1 >';
//echo '<select name="link"  onclick= "suggest1($select);">';
foreach($getresults as $getresult)
{
//	echo $selectoption;
//echo $getresult->$ids;
	echo '<option value="'.$getresult->$ids.'">'.$getresult->$field1.'</option><br />';	
}
echo '</select>';
	}
?>