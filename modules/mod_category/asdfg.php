<?php
if(isset($_GET['seotitle']) == 'all')
{ 

			$get_results = $db->get_results("SELECT * FROM category ");
						
				if($get_results)
				{
					
					?>
					
							
						<div id="leftpart"> <!--top icons ends-->
						
						<div id="sidemenu" class="sidemenus">
											<ul>
					<?php
						foreach($get_results as $get_result)
						{
								$id = $get_result->ct_id;
								$seo_catgories = $db->get_row("SELECT * FROM seo_detail WHERE sd_ty = 'category' AND sd_ty_id = '$id'");
								if($seo_catgories)
								{ ?>
									
											
										    <li><a href="../gowild/index.php?type=category&seotitle=<?php echo $seo_catgories->sd_t ?>"><?php echo $get_result->ct_t;?></a> </li>
										 									  
									<?php	}
							
						}
						?>
						  				</ul>
											</div>
						  <div id="vertdownload">
										    <img src="images/download_image.jpg" alt="download" width="163" height="510" hspace="10%" />
										    </div>
										</div>
										<!--left coloum ends-->
					<?php
						
				}
				
}else{
	
	?>

<?php
//$getmenu = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id' ");
//$md_id = $getmenu->md_id;
//$getlinks = $db->get_results("SELECT * FROM menu_links WHERE main_links ='0'");

$md_id = $topmodule->md_id;
$get_menu_positions = $db->get_row("SELECT * FROM module_menu_position WHERE md_id = '$md_id'");

//echo $get_menu_positions->ml_id;
$ml_ids = rtrim($get_menu_positions->ml_id,',');
$mlids = array();
$mlids = explode(',',$ml_ids);

$mainlink = '';


$getlinks = $mlids;

/*echo '<pre>';
print_r($getlinks);
echo '</pre>';
//echo '<ul>';*/
foreach($getlinks as $getlink)
{
	
	echo $getlink;
	$count = $db->get_var("SELECT COUNT(*) FROM menu_links WHERE main_links ='0' AND ml_id = '$getlink'");		
		$getdetail = $db->get_row("SELECT * FROM menu_links WHERE main_links ='0' AND ml_id = '$getlink'");		
		print_r($getdetail);
//	echo $count .'of'.$getdetail->title; 

	//$pass1 = $getdetail->link_to_another;					echo $pass1.'<br />';
//	$pass2 = $getdetail->link_type;										//echo $pass2.'<br />';
	//$linkto = Front_DetectLinks($pass1,$pass2);   //echo $getlink->link_type;
	if($pass1 != '0' && $pass2 != 'hash')
	{
		
$		
		
		}
	
	//print_r($linkto);
//}
//echo '<li><a  href='.$linkto.'><span>'.$getdetail->title.'</span></a>';
//echo '<li class="dropdown"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';	
/*echo '<ul class="nav nav-tabs"><li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';*/
	if($count == null)
	{
	//echo '</a>';
	echo 'hi';	
	} 
	elseif($count != null) 
	{
				$linkto = Front_DetectLinks($pass1,$pass2); 
			echo '<li>'.$linkto.'</li>';
			//echo '</a>';
		}
		
		$submenuscount = $db->get_var("SELECT COUNT(*) FROM menu_links WHERE main_links='$getlink'");
		$submenus = $db->get_results("SELECT * FROM menu_links WHERE main_links='$getlink'");
		
		if($submenuscount != 0)
		{ 
		/*	echo '<li class="dropdown"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';		
		echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';	
		*/	
		//echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
	//	echo '<li"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getdetail->title.'<b class="caret"></b></a>';		
	echo '<li"><a  href='.$linkto.'><span>'.$getdetail->title.'</span></a>';		

		//echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';	
		
		foreach($submenus as $submenu)
		{
				$pass3 = $submenu->link_to_another;
				$pass4 = $submenu->link_type;
				//echo 'pass3:'.$pass3;
				//echo 'pass 4:'.$pass4;
				$linkto1 = Front_DetectLinks($pass3,$pass4);
						
			//echo '<li><a href='.$linkto1.'><span>'.$submenu->title.'</span></a></li>';	
			}
			//echo '</ul>';
		}else 
		{
			
			//echo '<li><a  href='.$linkto.'>'.$getdetail->title.'</a>';		
			//echo '<li><a  data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';		
		//echo '<ul class="menu" role="menu" >';	
		//echo '<ul class="menu" role="menu" >';	

		}
			echo '</li>';
	
	
		}
		
?>


						
<?php	
	
	
	}


?>