<?php
include_once( $_SERVER['DOCUMENT_ROOT'].'/gowild/admin/includes/defination.php');
//echo $_SERVER['DOCUMENT_ROOT']; 
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

?>

<?php

global $db;
if(isset($_GET['select']) || isset($_GET['asd']) )
{
if(isset($_GET['select']))
{
$select = $_GET['select'];
}

if(isset($_GET['asd']))
{
$select1 = $_GET['asd'];
//echo $_GET['asd'];
//echo $_GET['asd1'];
}

if(!isset($_GET['opt']))
{

//if($_GET['select'] == 'main_link')
//echo '$select is:'.$select;
if($_GET['select'] == 'main_link')
{
	echo '$select is:'.$select;
	?>

<input type='hidden' name='sub_links' value='0'>

	<?php
	}

elseif($_GET['select'] == 'sub_link')
{

global $db;
$kind = $select;
$options = $db->get_results("SELECT * FROM article_category WHERE link_category = 'main_link'");

if($options)
{
echo 'Select Sub link:<select name=sub_links  id=searchtext2 onblur=suggest1();>';
//echo '<select name=sub_links>';
foreach($options as $option)
{
	echo '<option value="'.$option->cat_id.'">'.$option->cat_t.'</option><br />';	

}
echo '</select>';
}


}elseif($_GET['select'] == 'child_link' )
{

global $db;
$kind = $select;
$options = $db->get_results("SELECT * FROM article_category WHERE link_category = 'sub_link' ");

if($options)
{
echo 'Select Child link:<select name=sub_links  id=searchtext2 onblur=suggest1();>';
//echo '<select name=sub_links>';
foreach($options as $option)
{
	echo '<option value="'.$option->cat_id.'">'.$option->cat_t.'</option><br />';	
	
}
echo '</select>';
}

}
}
elseif(isset($_GET['opt']))
{
?>
<input type='hidden' name='sub_links' value=<?php echo $_GET['opt']; ?> />

<?php
}else{
	
//$select1 = $_GET['asd'];
//$opt = $_GET['opt'];


	
}


} //get close
}// session close
?>