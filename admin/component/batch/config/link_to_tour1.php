
<?php
global $db;
$kind = $select1;
$row = $db->get_row("SELECT * FROM component WHERE comp_t = '$kind' ");
$row->comp_foldername;

$category = 'tour';
$getresults = $db->get_results("SELECT * FROM tour");
if($getresults)
{		

echo 'Select Tour name:';
echo '<select name=link1 >';
//echo '<select name="link"  onclick= "suggest1($select);">';
foreach($getresults as $getresult)
{
//	echo $selectoption;
	echo '<option value="'.$getresult->$field1.'">'.$getresult->$field2.'</option><br />';	
}
echo '</select>';
	} ?>