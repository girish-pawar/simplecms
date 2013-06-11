<?php

function Front_DisplayModule($modtype){
	global $db;
	$modfolder = $db->get_row("SELECT * FROM moduletype WHERE mod_id='$modtype'");
	return $modfolder->mod_folder.'/display.php';
}


function Front_loadModules($position,$type)
{
global $db;
$zero = '0';


$findmodules = $db->get_results("SELECT module_menu_position.*,moduledata.* FROM module_menu_position LEFT JOIN moduledata ON (module_menu_position.md_id = moduledata.md_id) WHERE position='$position' AND ml_id='$zero'");
if($findmodules){
foreach($findmodules as $topmodule)
{
if($topmodule->title == '1')
{
echo $topmodule->mod_name;         
}
$displaymodule = Front_DisplayModule($topmodule->mod_type);
include(rootfolder.'/modules/'.$displaymodule);
}
}

$findmodule2 = $db->get_results("SELECT module_menu_position.*,moduledata.* FROM module_menu_position LEFT JOIN moduledata ON (module_menu_position.md_id = moduledata.md_id) WHERE position='$position' AND ml_id  LIKE '%$type%'");
if($findmodule2){

foreach($findmodule2 as $topmodule2)
{
if($topmodule2->title == '1')
{
echo $topmodule2->mod_name;         
}
$displaymodule2 = Front_DisplayModule($topmodule2->mod_type);
include(rootfolder.'/modules/'.$displaymodule2);
}
}

}

function Front_DisplayComponent($modtype){
	global $db;
	$modfolder = $db->get_row("SELECT * FROM set_image WHERE set_id='$modtype'");
	return $modfolder->si_id;
	//return $modfolder->image_name;.'/display.php';
}

function Front_loadComponent($position)
{
global $db;
//$topmodules = $db->get_results("SELECT * FROM sets WHERE set_status = 'Publish' ");

include_once(rootfolder.'/admin/component/slideshow/display.php');

}

/*function Front_loadComponent($position)
{
global $db;
$topmodules = $db->get_results("SELECT * FROM sets WHERE set_status = 'Publish' ");
//echo '<ul class="nav nav-tabs">';

/*foreach($topmodules as $topmodule)
{
/*if($type == 'yes')
{
//echo'<img src=http://192.168.2.12/gowild/admin/component/slideshow/images/6.jpg>';
//echo $topmodule->mod_name;         //  display top or other	
//echo '<li><a href="" '.$topmodule->mod_name.'</a></li>';         //  display top or other
}

print_r($topmodule);
//$displaymodule = Front_DisplayComponent($topmodule->set_id);
//echo $displaymodule;
include_once(rootfolder.'/admin/component/slideshow/display.php');
}*/



function Front_DetectLinks($linkid,$linktype,$submenuid){
	global $linkto;
	global $db;
	
	if($linktype != 'hash')
	{
		$seo_detail = $db->get_row("SELECT * FROM seo_detail WHERE sd_ty = '$linktype' AND sd_ty_id = '$linkid'");
		if($seo_detail)
		{
							$linkto = '../gowild/'.$submenuid.'/'.$seo_detail->sd_ty.'/'.$seo_detail->sd_t;		
			}
	
		
		}else{
			
				$linkto = '#';
			
			}	
	

	return $linkto;
}


?>
