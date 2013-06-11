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
print_r($_SESSION);
?>

<?php
if(!isset($_GET['select']))
{
}else{
$select = $_GET['select'];
//include_once('includes/definition.php');
if($select == 'product')
{
	global $db;
	$getprods = $db->get_results("SELECT * FROM product");
	echo '<select name="link">';
	foreach($getprods as $getprod){
		
	echo '<option value="'.$getprod->prid.'">'.$getprod->title.'</option><br />';	
		
	}
				echo '</select>';
}elseif($select == 'prodcat')
{
			global $db;
	$getprodcats = $db->get_results("SELECT * FROM category");
	echo '<select name="link">';
	foreach($getprodcats as $getprodcat){
		
	echo '<option value="'.$getprodcat->cid.'">'.$getprodcat->title.'</option><br />';	
		
	}
				echo '</select>';
}
elseif($select == 'art')
{
			global $db;
	$getarticles = $db->get_results("SELECT * FROM article");
	echo '<select name="link">';
	foreach($getarticles as $getarticle)
	{
		
	echo '<option value="'.$getarticle->aid.'">'.$getarticle->title.'</option><br />';	
		
	}
				echo '</select>';
}
elseif($select == 'artcat')
{
			global $db;
	$getartcats = $db->get_results("SELECT * FROM article_category");
	echo '<select name="link">';
	foreach($getartcats as $getartcat){
		
	echo '<option value="'.$getartcat->acid.'">'.$getartcat->title.'</option><br />';	
		
	}
				echo '</select>';
}
/*elseif($select == 'hash')
{
			global $db;
	//$getartcats = $db->get_results("SELECT * FROM article_category");

echo '<select name="link">';
echo '<option value="#">Home</option>';
echo '</select>';


}*/else {
}

}			

}
?>