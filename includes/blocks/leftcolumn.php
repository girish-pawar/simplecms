<!-- <h3 class="leftmod_title">Catalogue</h3> -->

<?php

if($_GET)
{
$cat = $_GET['seotitle'];	
}
$getcats = $db->get_results("SELECT * FROM category ");
foreach ($getcats as $getcat)
{
	$seotitle = $db->get_row("SELECT * FROM seo_detail WHERE sd_ty = 'category' AND sd_ty_id = $getcat->ct_id");
	if($seotitle){
	echo '<li><a href="'.site_root.'/category/'.$seotitle->sd_t.'/">'.$getcat->ct_t.'</a></li>';
	}
	}

?>

