<?php
//include_once('../admin/includes/defination.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/gowild/admin/includes/defination.php');
//include_once($_SERVER['DOCUMENT_ROOT'].'/gowild/admin/includes/function.php');
//include_once($_SERVER['DOCUMENT_ROOT'].'/gowild/admin/includes/header.php');
?>

<!-- <form method="post">	
	
	<div class="space1">
	Video Gallery name:
	<input type="text" name="vg_t" value="" />
		</div>
		
		<div class="space1">
	Video Gallery Status Display:
	<select name="vg_status">
	<option value="0">yes</option>
	<option value="1">no</option>
		</div>
		<div class="space1">
<?php 
$seo_detail = 'seo_detail';
Get_SeoForm($seo_detail)  ?>
<input type="hidden" name="table" value="video_gallery" />
<input type="hidden" name="seo_table" value="124" />		
		</div>		

				</form> -->
				
<?php
if(isset($_POST['exist']))
{
	//$fieldarrays = $_POST['fieldarrays'];
		$fieldarrays = count($_POST['fieldsarray']);
	$_SESSION['f1']  = $fieldarrays;		
	//print_r($_SESSION);
	echo 'f1 ='; 
	print_r($_SESSION['f1']);
	
	$fp = fopen("../admin/component/videogadsmlkajglkjdsklgkdllery/config1.php","w");
if($fp)
{
	fwrite($fp,"<?php");
	foreach($fieldarrays as $fieldarray)
	{
fwrite($fp,"$fieldarray is = "."'".$fieldarray."';");
}
fwrite($fp," ?>");
fclose($fp);	
	
echo 'file open';	
	}	else{
		echo 'not file open';
		}
//return ($_POST['fieldsarray']);	
	}
	?>				
				
<form method="post" >
<?php
	$getids = $db->get_results("SELECT * FROM video_gallery ");	
	foreach($getids as $getid)
	{
		$vgid = $getid->vg_id;
		//$gettitle = $db->get_row("SELECT * FROM video_gallery WHERE vg_id = '$vgid'");
	?>
	<div class="space1">
	<input type="checkbox" name="fieldsarray[]" value="<?php echo $getid->vg_id; ?>" ><?php echo $getid->vg_t; ?></input>
	</div>
<?php	
}?>
<input type="submit" name="exist" value="Submit" />
</form>