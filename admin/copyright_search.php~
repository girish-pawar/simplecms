<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
session_start();
?>

<?php
//print_r($_SESSION);
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
include_once('../admin/includes/conn.php');
include_once('../admin/includes/function.php');
include_once('../admin/includes/defination.php');

if(isset($_GET['setid']))
{
$setid = $_GET['setid'];
    
$getsets = $db->get_row("SELECT * FROM sets WHERE set_id = '$setid'");

//echo $getsets->set_copyright;
if($getsets->set_copyright == 'yes')
{
	?>
	<label>Add Copyright Name:</label>
<input type="text" name="copyright_name" />
<?php

}else{
	echo 'not selected';
	
	}



}
}
?>

