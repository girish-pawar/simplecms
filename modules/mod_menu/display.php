
<?php

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
	
	$count = $db->get_var("SELECT COUNT(*) FROM menu_links WHERE main_links ='0' AND ml_id = '$getlink'");		
	//$getdetail = $db->get_row("SELECT * FROM menu_links WHERE main_links ='0' AND ml_id = '$getlink'");		
		//print_r($getdetail);
	//	echo 'count is:'.$count;
	
//echo '<li><a  href='.$linkto.'><span>'.$getdetail->title.'</span></a>';
//echo '<li class="dropdown"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';	
/*echo '<ul class="nav nav-tabs"><li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';*/
	
	
if($count == '1') //main link is found
{
	//echo '</a>';
	//echo 'hi';	
	$getdetail = $db->get_row("SELECT * FROM menu_links WHERE main_links ='0' AND ml_id = '$getlink'");		
				$pass1 = $getdetail->link_to_another;					//echo $pass1.'<br />';
				$pass2 = $getdetail->link_type;			
				$pass5 = null;
				//echo 'pass22 :'.$pass2.'<br />';
				$linkto = Front_DetectLinks($pass1,$pass2,$pass5);
				
					
		$submenuscount = $db->get_var("SELECT COUNT(*) FROM menu_links WHERE main_links='$getlink'");

		if($submenuscount != 0)
		{ 		
		
			$submenus = $db->get_results("SELECT * FROM menu_links WHERE main_links='$getlink'");
		
					echo '<li class="has-sub"><a  href='.$linkto.'><span>'.$getdetail->title.'</span></a><ul>';		
				//echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';	
		
		foreach($submenus as $submenu)
		{
				
		
			
				
				
				
				$pass3 = $submenu->link_to_another;
				$pass4 = $submenu->link_type;
				$pass5 = $submenu->ml_id;
				if($submenu->seo_title !=''){
				$seotitle = $submenu->seo_title;
				$url = 'index.php?linkid='.$pass5.'&seo_title='.$seotitle;
echo $url;			
}
				
				//echo 'pass3:'.$pass3;
				//echo 'pass 4:'.$pass4.'</br>';
	
				
				//$linkto1 = Front_DetectLinks($pass3,$pass4,$pass5);
						//echo $linkto1;
					echo '<li><a href='.$url.'><span>'.$submenu->title.'</span></a></li>';	
			}
			echo '</ul>';
		}else 
		{
			
			//echo '<li><a  href='.$linkto.'>'.$getdetail->title.'</a>';		
			//echo '<li><a  data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';		
		//echo '<ul class="menu" role="menu" >';	
		//echo '<ul class="menu" role="menu" >';	

		}
			echo '</li>';
					//$linkto = Front_DetectLinks($pass1,$pass2); 
	} 

/*if($count == '0')  //main link not found
	{
				$getdetail = $db->get_row("SELECT * FROM menu_links WHERE main_links ='0' AND ml_id = '$getlink'");	
				$pass22 = $getdetail->link_type;
				if($pass22 == 'Tour_Manager')
				{
							$menuparams = $db->get_row("SELECT * FROM menuparams WHERE ml_id = '$getlink'");
							print_r($menuparams);
					}
				$linkto = Front_DetectLinks($pass1,$pass2); 
				echo '<li>'.$linkto.'</li>';
			//echo '</a>';
		}*/
		
		
	
		} ?>