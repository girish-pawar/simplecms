<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
session_start();
?>
<?php
if(!isset($_SESSION['ad_id']))
{
header('location:admin_login.php');
}
else
{
$ad_id= $_SESSION['ad_id'];
//print_r($_SESSION);
?>

<?php
include_once('includes/conn.php');
$select = $_GET['select'];
//echo $select;
if($select == 'hash')
{
	
	
	}
	else{

global $db;
$getrows = $db->get_results("SHOW FULL COLUMNS FROM $select");
$getid = $db->get_row("SHOW FULL COLUMNS FROM $select");
$id = $getid->Field;
//echo '	id is:'.$id;()
//$comments = $db->vardump("DESC $select");
//print_r($comments);
$colms = '';
foreach($getrows as $getrow)
{
					$mystring2 = $getrow->Field;
					$findme2   = '_t';
					$pos2 = strpos($mystring2, $findme2);
						if ($pos2 === false) 
						{
									   //echo "The string was not found in the string '$mystring1' <br />";
						}else
						{
									$name = $getrow->Field;
									$colms .= $name.',';
							}
	}

	
	 	$array = explode(',',$colms);
	 	$count = count($array);
	 	//echo 'count is:'.$count;
	 	if($count > 2)
	 	{
		$name = current($array);
		$gettitles = $db->get_results("SELECT $id , $name FROM $select");
	}
	else{
			$gettitles = $db->get_results("SELECT $id , $name FROM $select");
		}
//	print_r($name);

	$getlists = $db->get_results("SELECT * FROM $select");

	echo '<select name="link">';
	foreach($gettitles as $gettitle){
		
	echo '<option value="'.$gettitle->$id.'">'.$gettitle->$name.'</option><br />';	
		
}echo '</select>';


}//else close of hash
/*$name = $getrow->Field;
										$findme3   = '_ty';
										$pos3 = strpos($name, $findme3);
										if($pos3 == false )
										{
										echo 'title is :'.$getrow->Field;
										$gettitles = $db->get_results("SELECT $id , $name FROM $select");
									}
									else{
										$name = $getrow->Field;
										$gettitles = $db->get_results("SELECT $id , $name FROM $select");
										} */

}
?>