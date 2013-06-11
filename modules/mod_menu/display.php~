<!-- <link href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/modules/mod_menu/css/style.css" rel="stylesheet" /> -->
<?php
$getmenu = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id' ");
$getlinks = $db->get_results("SELECT * FROM menu_links WHERE main_links ='0'");
//echo '<ul>';
foreach($getlinks as $getlink)
{
	
	$count = $db->get_var("SELECT COUNT(*) FROM menu_links WHERE main_links='$getlink->ml_id'");				//echo $count .'of'.$getlink->title; 
	$pass1 = $getlink->link_to_another;					//echo $pass1.'<br />';
	$pass2 = $getlink->link_type;											//echo $pass2.'<br />';
	//$linkto = Front_DetectLinks($pass1,$pass2);   //echo $getlink->link_type;
	
	//print_r($linkto);
//}

//echo '<li class="dropdown"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';	
/*echo '<ul class="nav nav-tabs"><li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';*/
	if($count == null){
	//echo '</a>';	
	} 
	elseif($count != null) 
	{
$linkto = Front_DetectLinks($pass1,$pass2); 
echo '<li>'.$linkto.'</li>';
			//echo '</a>';
		}
		
		$submenuscount = $db->get_var("SELECT COUNT(*) FROM menu_links WHERE main_links='$getlink->ml_id'");
		$submenus = $db->get_results("SELECT * FROM menu_links WHERE main_links='$getlink->ml_id'");
		
		if($submenuscount != 0)
		{ 
		/*	echo '<li class="dropdown"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';		
		echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';	
		*/	
		echo '<li"><a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';		
		//echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';	
		
		foreach($submenus as $submenu)
		{
				$pass3 = $submenu->link_to_another;
				$pass4 = $submenu->link_type;
				$linkto1 = Front_DetectLinks($pass3,$pass4);
						
			echo '<li><a href='.$linkto1.'>'.$submenu->title.'</a></li>';	
			}
			
		}else 
		{
			
			echo '<li><a  href='.$linkto.'>'.$getlink->title.'</a>';		
			//echo '<li><a  data-target="#" href='.$linkto.'>'.$getlink->title.'<b class="caret"></b></a>';		
		//echo '<ul class="menu" role="menu" >';	
		//echo '<ul class="menu" role="menu" >';	

		}
			echo '</li>';
	
	
		}
		
?>

<script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>  
