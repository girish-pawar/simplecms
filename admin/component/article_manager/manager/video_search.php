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

if(isset($_POST['exist']))
{
//	$_SESSION['fieldarrays']  = array();
	$fieldarrays = count($_POST['fieldsarray']);
	$_SESSION['f1']  = $fieldarrays;		
	//print_r($_SESSION);
	echo 'f1 ='; 
	print_r($_SESSION['f1']);
	
	}

?>

<?php
//include_once('../admin/includes/conn.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/demo/gowild/admin/includes/defination.php');
global $db;

$select = $_GET['select'];
//echo $select;
	$type = $_GET['type'];
		$id = $_GET['id'];
	
if($select == 'new')
{
	//include_once($_SERVER['DOCUMENT_ROOT']."/gowild/admin/".$_GET['option']."/".$_GET['kind']."/".$_GET['method']."/add_video.php");
	//include_once($_SERVER['DOCUMENT_ROOT']."/gowild/admin/component/videogallery/gallery/add_video.php");

?>
<a href="../admin/index.php?option=<?php echo $_GET['option']; ?>&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=<?php echo $_GET['process'];?>&type=<?php echo $_GET['type']; ?>&id=<?php echo $_GET['id']; ?>&step=2" >Add New Video gallery</a>

<?php }else{
//include_once($_SERVER['DOCUMENT_ROOT']."/gowild/admin/".$_GET['option']."/".$_GET['kind']."/".$_GET['method']."/add_video.php");	
//$_SESSION['fieldarrays']  = array();	
	$getids = $db->get_results("SELECT * FROM video_gallery ");	
	foreach($getids as $getid)
	{
		$vgid = $getid->vg_id;
		//$gettitle = $db->get_row("SELECT * FROM video_gallery WHERE vg_id = '$vgid'");
	?>
	<div class="space1">
	<input type="checkbox" name="fieldsarray[]" value="<?php echo $getid->vg_id; ?>"  /><?php echo $getid->vg_t; ?>
	</div>
<?php	
//$_SESSION['$getid->vg_id']=  $getid->vg_t;
}
?>
<input type="submit" name="exist" value="Submit" />
<?php } 
?>
</form>
<?php

//}

}//else close of session?>