
<?php
global $db;
$kind = $select1;
$row = $db->get_row("SELECT * FROM component WHERE comp_id = '$kind' ");
$row->comp_foldername;

$category = 'destination';
$getresults = $db->get_results("SELECT * FROM $category");
if($getresults)
{		
$getrows = $db->get_results("SHOW FULL COLUMNS FROM $category ");
foreach($getrows as $getrow)
{

$pos1 = strpos($getrow->Field, "_id");
$pos11 = strpos($getrow->Field, "_t");
	if($pos1)
	 {
	 	if(!isset($field1))
	 	{
	 	 $field1 = $getrow->Field;
	 }
	 	 //echo $field1;
	 }elseif($pos11){
	 	$field2= $getrow->Field;
	 	 //echo $field2;
	 	
	 	} 
	
	}
echo $field1;
echo 'Select Destination:';
echo '<select name=link1 >';
//echo '<select name="link"  onclick= "suggest1($select);">';
foreach($getresults as $getresult)
{
//	echo $selectoption;
	echo '<option value="'.$getresult->$field1.'">'.$getresult->$field2.'</option><br />';	
}
echo '</select>';
	} ?>