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
//print_r($_SESSION);
?>

<?php
include_once('../admin/includes/conn.php');
include_once('../admin/includes/function.php');
include_once('../admin/includes/defination.php');

if(isset($_GET['checkall']))
{
	
					if(isset($_GET['id']) == '0')
					{
								$checkall = $_GET['checkall'];
								$tablename = $checkall;
								global $db;
								
								$getrows = $db->get_results("SHOW FULL COLUMNS FROM $tablename ");
								foreach($getrows as $getrow)
								{
								
												$pos1 = strpos($getrow->Field, "_id");
												$pos11 = strpos($getrow->Field, "_t");
													if($pos1)
													{
															 	if(!isset($field1))
															 	{
															 	 $field1 = $getrow->Field;
															 }
													 	 //echo $field1;
													 }elseif($pos11){
													 	$field2= $getrow->Field;
													 	 //echo $field2;
													 	
													 	} 
									
									}
				echo $field1;
				
				
									$getmenus = $db->get_results("SELECT * FROM $tablename");
									if($getmenus)
									{
										foreach($getmenus as $getmenu)
										{?>
									
									<!--<input type="checkbox" name="fieldsarray[]" checked="true" value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?><br/>-->
									<!--<input type="checkbox" name="fieldsarray[]" checked="true" value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?>-->
									<input type="checkbox" name="<?php echo $tablename.'[]';?>"  value="<?php echo $getmenu->$field1;?>" /><?php echo $getmenu->$field2;?><br></br>
										
										<?php
												}
										?>
										<?php
										}
				}
				
				if(isset($_GET['id']) == '1')
				{
								$deselectall = $_GET['checkall'];
								$tablename = $deselectall;
								   
								$m_id = $deselectall;
								$getmenus = $db->get_results("SELECT * FROM $tablename");
								
								$getrows = $db->get_results("SHOW FULL COLUMNS FROM $tablename ");
								foreach($getrows as $getrow)
								{
								
											$pos1 = strpos($getrow->Field, "_id");
											$pos11 = strpos($getrow->Field, "_t");
												if($pos1)
												 {
												 	if(!isset($field1))
												 	{
												 	 $field1 = $getrow->Field;
												 }
												 	 //echo $field1;
												 }elseif($pos11){
												 	$field2= $getrow->Field;
												 	 //echo $field2;
												 	
												 	} 
									
									}
				
				
									if($getmenus)
									{
									?>	
										<input type="hidden" name="<?php echo $tablename;?>" value="all" />
									<?php
									
										}
				}
	
}


if(isset($_GET['searchseo']))
{
	//echo $_GET['searchseo'];
	$searchseo = $_GET['searchseo'];
	$searchspace=strpos($searchseo,' ');
				if($searchspace)
				{
							$seo_t= str_replace(' ', '_', $_GET['searchseo']);
							//echo 'found space';
				}
				else
				{
							$seo_t=$_GET['searchseo'];
							//echo'not found space';
				}
			//	echo $seo_t;
	$seo_detail= $db->get_row("SELECT * FROM menu_links WHERE seo_title = '$seo_t'");
					if($seo_detail)
					{
								?>
								<div class="alert alert-error">
								Seo Title Already Exist
								</div>
								<?php
					}else
					{
					?>
				 <input type='submit' name='submitted' value='submit'>					
					<?php
					}
	
	}

}
?>
