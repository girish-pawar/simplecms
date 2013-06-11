<?php 
if(isset($_GET['id']))
{
			$id=$_GET['id'];
}
elseif(isset($_GET['t_id']))
{
			$id=$_GET['t_id'];
}
else
{
$id=null;
}



if(isset($_GET['ins']) )
{
			$ins_value = $_GET['ins'];
}
else
{
			$ins_value = null;
}
		
			
				
if(isset($_GET['insert']))
{
$insert = $_GET['insert'];	
}else{
$insert = null;	
	}


if($insert == '1' || $insert == '3' || $insert == '33')
{
	?>
		<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 3:Categories Added Successfully!</strong>
</div> 
 
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 4:Select Destinations.</strong>
 <?php 
if($ins_value == '1')
{ 
 ?>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&insert=44&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 5</a>
<?php  } ?> 
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '33' || $insert == '2')
{
	
if($ins_value == '2')
{ 
 ?>
<!-- 	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 2:Countries Added Successfully!</strong>
</div>-->
 	<div class="alert fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 4:Destinations Updated Successfully!</strong>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=schedule_type&type=tour&insert=44&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step 5</a>
<?php  } ?>  
 </div>
	<?php
	}
	

if($id != null)
{
$id = $_GET['t_id'];	
$getrecord = $db->get_row("SELECT * FROM tour_destination WHERE t_id = $id");
$record = rtrim($getrecord->tour_d_id,',');
$records = array();
$records = explode(',',$record);
			print_r($records);
			//$tcid = $getrecord->tcat_id;
	
	}		
				
				
/*	

if(isset($_GET['id']))
{
	
$id = $_GET['id'];	
$getrecord = $db->get_row("SELECT * FROM tour_destination WHERE t_id = $id");
$record = rtrim($getrecord->d_id,',');
$records = array();
$records = explode(',',$record);
	}else{
	
$id = null;		
		}*/ 
	
		?>


<form method='POST' action=''>
<h3> Select Destination</h3>

<?php
			//if(isset($_GET['id']))
				if($id != null)
			{
			$getcids = $db->get_row("SELECT * FROM tour_country WHERE t_id = $id");
			}else{
			$getcids = $db->get_row("SELECT * FROM tour_country WHERE t_id = '$id'");
			}
				if($getcids)
				{
				//echo 'getcids';
				$getids = array();
				$getcidss = rtrim($getcids->c_id,',');
				$getids = explode(',',$getcidss);
				//print_r($getids);
				
				$instructers = '';
				$get_cids = '';
							foreach($getids as $getid)
							{
											$getcountrys = $db->get_results("SELECT d_id FROM destination WHERE c_id LIKE '%$getid%'");
											//print_r($getcountrys);
											foreach($getcountrys as $getcountry)
											{
													$get_cids .= $getcountry->d_id.',';
												}
							
							}
				
				
				$ids = array();
				$idss = rtrim($get_cids,',');
				$ids = explode(',',$idss);	
					
				$result = array_unique($ids);
				//print_r($result);
				//print_r($instructers);
				}

						//if(isset($_GET['id']))
							if($id != null)
						{
						$getcatids = $db->get_row("SELECT * FROM tour_category WHERE t_id = $id");
						}else{
							$getcatids = $db->get_row("SELECT * FROM tour_category WHERE t_id = '$id'");
							}

				if($getcatids)
				{
				$catids = array();
				$catidss = rtrim($getcatids->ct_id,',');
				 //echo $catidss;
				$catids = explode(',',$catidss);
				
				$get_catids = '';
				
							foreach($catids as $catid)
							{
											foreach($result as $destination)
											{
																$getdests = $db->get_results("SELECT * FROM destination WHERE d_id = '$destination' AND ct_id LIKE '%$catid%' ");	
																if($getdests)
																{	
																	foreach($getdests as $getdest)
																	{
																$get_catids .= $getdest->d_id.',';
																}
																}
											
											
												}
							}
				//print_r($get_catids);
				$ids = array();
				$idss = rtrim($get_catids,',');
				$ids = explode(',',$idss);	
					
				$result1 = array_unique($ids);
				/*echo 'in get catids';
				print_r($result1);*/
				
				} 

		//	if(isset($_GET['id']))
			if($id != null)
			{
			$array = array();
			$arr = rtrim($getrecord->d_id,',');
			$array = explode(',',$arr);
			$results = array_diff($result1,$array);
		/*		echo 'after get catids';
				print_r($result1);*/
			//$results1 = array_unique($results);
			//print_r($results);
			}else {
				$results = null;
			}
//print_r($array);
/*if(isset($t_id))
{*/
if($results != null)
{ 

			foreach($results as $result)
			{
				
						if($records)
						{
							$ins = $db->get_row("SELECT * FROM destination WHERE d_id = $result");
							if(in_array($ins->d_id,$records))
							{
								?>
								<input type='checkbox' name='tour_d_id[]' checked="true" value='<?php echo $ins->d_id;?>'><?php echo $ins->d_t;?><br />
							<?php
								}else {
										?>
									<input type='checkbox' name='tour_d_id[]' value='<?php echo $ins->d_id;?>'><?php echo $ins->d_t;?><br />
		<?php  	} }else{ ?>
		<input type='checkbox' name='tour_d_id[]' value='<?php echo $ins->d_id;?>'><?php echo $ins->d_t;?><br />
		
		<?php
		} //if records close
		}  // foreach close
}else{
	
		if($result1)
		{
					foreach($result1 as $res)
					{
						$ins = $db->get_row("SELECT * FROM destination WHERE d_id = $res");
					?>
					
					<input type='checkbox' name='tour_d_id[]' value='<?php echo $ins->d_id;?>'><?php echo $ins->d_t;?><br />
					
					<?php
					
					}  // foreach close
		} //if close
}

//		if(isset($_GET['id']))
			/*if($id != null)
			{
						if($records)
						{
										foreach($records as $record)
										{
											$ins = $db->get_row("SELECT * FROM destination WHERE d_id = $record");
										?>
										
										<input type='checkbox' name='tour_d_id[]' checked="true" value='<?php echo $ins->d_id;?>'><?php echo $ins->d_t;?><br />
										
										<?php
										
										}  // foreach close
						} //if close
			}*/

?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $getrecord->td_id;?>'>
<?php
}
if($_GET['t_id'] != null )
{
?>
<input type='hidden' name='t_id' value='<?php echo $_GET['t_id'];?>'>
<input type='hidden' name='td_id' value='<?php echo $getrecord->td_id;?>'>
<?php
}
else{
	?>
<input type='hidden' name='t_id' value='<?php echo $_GET['id'];?>'>
	
<?php } ?>
<input type='hidden' name='seo_table' value=''>

<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='tour_destination'>
<input type='submit' class="btn " name='submit'>
	<input type='submit' class="btn btn-primary" name='SaveAndCont' value='Skip & Continue'>
	<?php
$b='3,4';
$button= getbutton($b);
?>
</form>
<?php




?>