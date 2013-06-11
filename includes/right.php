<?php if($_REQUEST) {
	$id = $_GET['linkid'];
$linkinfo = $db->get_row("SELECT * FROM menu_links WHERE ml_id=$id");
$comp_title = $linkinfo->link_type;
$component = $db->get_row("SELECT * FROM component WHERE comp_t = '$comp_title'");	
//$folder = $component->comp_foldername;
	$explodethis = $linkinfo->menuparams;
	
	$explode = explode('|', $explodethis);
	echo '<pre>';
	print_r($explode);	
	echo '</pre>';
	
	foreach($explode as $arrayvalue)
	{
		$explode2 = explode(':', $arrayvalue);
							
		$stack = $explode2[0];
		${$stack} = $explode2[1];

		
		}
		$url = './component/batch/display/'.$link.'.php';
		include_once($url);
		//print_r($link);
	
} ?>