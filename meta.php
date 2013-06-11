<?php
include_once('admin/includes/conn.php');
global $db;
if($_GET)
{
if(isset($_GET['type']))
{
	$type = $_GET['type'];
	if($_GET['seotitle'] == 'all')
	{
				//echo 'in all';
				$m_t = 'Go Wild';		
				$m_d = 'Into the WILD with GO WILD';
				$m_k = 'jungle,safari,jungle safari, gowild, go wild, wildlife camps, camps, photography, adventure camps, history and culture, travel';
	}else
	{
			
			$seotitle = $_GET['seotitle']	;
			$getcolm = $db->get_row("SHOW FULL COLUMNS FROM $type");
			$first_colm = $getcolm->Field;
			//echo $first_colm;
				if($getcolm)
				{
						$cat = $db->get_row("SELECT * FROM $type WHERE $first_colm = '$seotitle'");
						
				}
				
				if($cat)
				{
					$id = $cat->$first_colm;
						$seocat = $db->get_row("SELECT * FROM seo_detail WHERE sd_ty = '$type' AND sd_ty_id = '$id'");		
				}
				
				if($seocat)
				{
							//print_r($cat); 
							$m_t = $seocat->sd_mt;
							$m_d = $seocat->sd_md;
							$m_k = $seocat->sd_mk;
				}
		}
	
	}	
		
	
	
	} 
	else 
	{
					$m_t = 'Go Wild';		
					$m_d = 'Into the WILD with GO WILD';
					$m_k = 'jungle,safari,jungle safari, gowild, go wild, wildlife camps, camps, photography, adventure camps, history and culture, travel';
	}

?>
