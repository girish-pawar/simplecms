<?php

$getresults = $db->get_results("SELECT * FROM $select1");
if($getresults)
{		
$getrows = $db->get_results("SHOW FULL COLUMNS FROM $select1");
foreach($getrows as $getrow)
{

$pos1 = strpos($getrow->Field, "_id");
$pos11 = strpos($getrow->Field, "_t");
	if($pos1)
	 {
	 	 $field1= $getrow->Field;
	 	 //echo $field1;
	 }elseif($pos11){
	 	$field2= $getrow->Field;
	 	 //echo $field2;
	 	
	 	} 
	
	}

echo 'Select Gallery name:';
echo '<select name=link1 >';
//echo '<select name="link"  onclick= "suggest1($select);">';
foreach($getresults as $getresult)
{
//	echo $selectoption;
	echo '<option value="'.$getresult->$field1.'">'.$getresult->$field2.'</option><br />';	
}
echo '</select>';
	}
?>