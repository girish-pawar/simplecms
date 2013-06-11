<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
session_start();
?>
<?php
//print_r($_SESSION);

//if(!$_SESSION['ad_id'])
//{
	//print_r($_SESSION);
		//	header('location:admin_login.php');
//}
//else
//{
//$ad_id= $_SESSION['ad_id'];
//print_r($_SESSION);
?>

<?php
include_once('../admin/includes/conn.php');
include_once('../admin/includes/function.php');
include_once('../admin/includes/defination.php');

if(isset($_GET['checkall']))
{
$checkall = $_GET['checkall'];
    
$m_id = $checkall;
$getmenus = $db->get_results("SELECT * FROM menu_links WHERE m_id = '$m_id'");
if($getmenus)
{
	foreach($getmenus as $getmenu)
	{?>

<!--<input type="checkbox" name="fieldsarray[]" checked="true" value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?><br/>-->
<input type="checkbox" name="fieldsarray[]" checked="true" disabled="true" value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?>
	
	<?php
			}
	?>
	<?php
	}

	
}elseif(isset($_GET['deselectall']))
{
$deselectall = $_GET['deselectall'];
    
$m_id = $deselectall;
$getmenus = $db->get_results("SELECT * FROM menu_links WHERE m_id = '$m_id'");
if($getmenus)
{
	foreach($getmenus as $getmenu)
	{?>

<!--<input type="checkbox" name="fieldsarray[]" checked="false" value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?><br/>-->
<input type="checkbox" name="fieldsarray[]"  value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?>
	
	<?php
			}
	
	}
}else{
	echo 'not selected';
	
	}

if(isset($_GET['checkall']))
{
	?>

<!--<input /*type="checkbox" name="deselect-all" id="deselect-all" onclick="suggest1(<?php echo $gettitle->m_id;?>)" />Deselect All*/  -->
<?php	
}

//}
?>

