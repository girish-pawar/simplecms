<?php

if(isset($_GET['type']))
{
$Table = $_GET['type'];	
	
	}
?>
<meta charset='utf-8'/>
		<title>ColorBox Examples</title>
		
		<link rel="stylesheet" href="http://thoughtfulviewfinder.in/demo/gowild/admin/css/colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://thoughtfulviewfinder.in/demo/gowild/admin/js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});
				
				//Example of preserving a JavaScript event for inline calls.
				//$("#click").click(function(){ 
					//$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					//return false;
				//});
			});
		</script>
 
		<link href="http://thoughtfulviewfinder.in/demo/gowild/admin/css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" />
<script src="http://thoughtfulviewfinder.in/demo/gowild/admin/js/bootstrap-datetimepicker.min.js"></script>

<?php 
				global $db;
				$batch= $db->get_row("SELECT * FROM batch_table WHERE b_id = '$_GET[id]'");
				?>
				
				<!-- <h3>Batch Title : <?php echo $batch->b_t;?></h3> -->
<div class="bs-docs-example">
            <ul id="myTab" class="nav nav-tabs">
     <li class="active"><a href="#home" data-toggle="tab">Batch </a></li>
      <li class=""><a href="#profile" data-toggle="tab">Fee</a></li>
			   <li class=""><a href="#discount" data-toggle="tab">Discount</a></li>
				  <li class=""><a href="#schedule" data-toggle="tab">Schedule</a></li>
				  <li class=""><a href="#instructer" data-toggle="tab">Instructer</a></li>   
				  <li class=""><a href="#precamp" data-toggle="tab">Pre Camp Venue</a></li>
				  <li class=""><a data-toggle="tab" href="#video">Video Gallery</a></li>
      <li class=""><a data-toggle="tab" href="#photo">Photo Gallery</a></li>
      <li class=""><a data-toggle="tab" href="#downloads">Downloads</a></li>
      <!--   <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                  <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
                </ul> 
              </li> -->
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
                <p>
	
				<form method='POST' action=''>
<h3>Batch Title is: </h3>
<p><?php echo $batch->b_t;?></p>


<?php
$dest= $db->get_results("SELECT * FROM destination");
?>

<h3>Tour Title is : </h3>
<?php 
$destids = explode(',',$batch->dest_id);
foreach($destids as $destid)
{
//echo $destid;	
//print_r($destids);

if (is_numeric($destid)) 
{
$getdests = $db->get_results("SELECT * FROM tour WHERE t_id = '$destid'");
//print_r($getdests);
if($getdests)
{
foreach($getdests as $getdest)
{
if($getdest)
{
echo '<p>'.$getdest->t_t.'</p>';
}	
}
}
}
else{
	
	}	
	
}

?>

 <h3>Start Date is : </h3> 
 <p><?php echo $batch->b_s_date;?></p> 

   <h3>End Date is :</h3>
   <p><?php echo $batch->b_e_date;?> </p>

<h3>Batch Includes <?php //echo $count_b_includes;?> <?php //echo $view_b_includes;?></h3>
<p><?php echo $batch->b_includes;?></p>
	
<h3>Batch Excludes : </h3>
<p><?php echo $batch->b_excludes;?></p>
	
<h3>Batch Tags are :</h3>
<p> <?php echo $batch->b_tags;?></p>

<h3>Batch Accomodation is: </h3>
<p><?php echo $batch->b_accomodation;?></p>

<h3>Batch Status is:</h3>
<p> <?php echo $batch->b_status;?></p>

<br />


<?php

function gettitle($Table,$Field)
{
$field = $Field;
$table = $Table;
global $db;
$getfirstcolum = $db->get_row("SHOW FULL COLUMNS FROM $table WHERE Field = '$field'");
if($getfirstcolum)
{
echo $getfirstcolum->Comment;
}

}
?>

</form>
				</p>
              </div>
              <div class="tab-pane fade" id="profile">
                <p>
					<form method='POST' action=''>
				<?php

$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
$currency= $db->get_results("SELECT * FROM currency");
foreach($currency as $curr)
{
?>
<h3>Currency Type is :</h3>
<p><?php echo $curr->cr_ty;?></p>
<h2>Batch Charges Types :</h2>
<?php
foreach($batch_charges as $fee)
{
$batch_fee= $db->get_row("SELECT * FROM batch_fee WHERE (b_id='$_GET[id]' AND bf_cr_id='$curr->cr_id') AND (bc_id='$fee->bc_id')");
//print_r($batch_fee);
?>

<h3>Batch Charges Type Title is:</h3>
<p><?php echo $fee->bc_ty;?> <!-- <?php echo 'bf_id'.$batch_fee->bf_id;?> --></p>

<?php 
if ($batch_fee) 
{ echo '<h3>Fee is:</h3><p>'.$batch_fee->bf_value.'</p>'; } ?>

<?php

}
}
?><br />

	</form>
	
				</p>
              </div>
			  <div class="tab-pane fade" id="discount">
                <p>
					<form method='POST' action=''>
				
				<?php
$discount_type= $db->get_results("SELECT * FROM discount_type");
?>
<?php
foreach($discount_type as $offer)
{
$discount_value= $db->get_row("SELECT * FROM discount_value WHERE dv_bid='$_GET[id]' AND dt_id='$offer->dt_id'");
?>

<h3>Discount Type Title is:</h3><p><?php echo $offer->dt_ty;?><!-- <?php echo $count_dv_value;?> --><?php echo $view_dv_value;?> </p>
<h3>Discount Value is:</h3><p> <?php if($discount_value) { echo $discount_value->dv_value; } ?></p>
<?php

}

?><br />

	</form>
				</p>
              </div>			  
			  <div class="tab-pane fade" id="schedule">
                <p>
				
<?php

$schedule_value= $db->get_results("SELECT * FROM schedule_value WHERE b_id='$_GET[id]'");
if($schedule_value)
{
?>
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Schedule</a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
              
           </thead>
              <tbody>
				<?php
				foreach($schedule_value as $schedules)
				{
				$schedule_type= $db->get_row("SELECT * FROM schedule_type WHERE st_id='$schedules->st_id'");
				?>
				<tr>

				<td><?php echo'<h3>'. $schedule_type->st_ty.'</h3>'. $schedules->sv_value;?></td>
				
				</tr>
		
						<form method='POST' action=''>
						
						<div id="myModal<?php echo $schedules->sv_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>

<?php

$schedule_values= $db->get_row("SELECT * FROM schedule_value WHERE sv_id='$schedules->sv_id'");
	$schedule_types= $db->get_row("SELECT * FROM schedule_type WHERE st_id='$schedule_values->st_id'");
if($schedule_types->st_ty=='Title')
{
?>
Title :

<input type='input' name='title' value='<?php echo $schedule_values->sv_value;?>'>
<?php
}
if($schedule_types->st_ty=='Description')
{
?>
Description :
<textarea name='description'><?php echo $schedule_values->sv_value;?></textarea>
<?php

}
?>
	
	<input type='hidden' name='sv_id' value='<?php echo $schedules->sv_id;?>'>
	</p>
  </div>
  <div class="modal-footer">
  <input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
  	<input type='submit' class="btn btn-primary" name='update_schedule' value='Update'>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</form>
  </div>
</div>
				<?php
				
				}
				     
						?>
									
</tbody>
</table>						
</div>
<?php
}
?>
				
				</p>
              </div>
			   <div class="tab-pane fade" id="instructer">
                <p>
				<h3>Selected Instructors are:</h3>
					<form method='POST' action=''>
				<?php
				$batch_instructer= $db->get_row("SELECT * FROM batch_instructer WHERE b_id='$_GET[id]'");
				if($batch_instructer)
				{
				
				?>
				<?php
				$instructer_id= explode(',',$batch_instructer->instructer_id);
				foreach($instructer_id as $in_id)
				{
				if($in_id!='')
				{
				$instructer= $db->get_row("SELECT * FROM instructor WHERE i_id='$in_id'");
				
				?>
				<h3>Instructor Name is:</h3>
				<p><?php echo $instructer->i_ty;?></p>
				<?php
				}
				}
				}
				
				$all_instructer= $db->get_results("SELECT * FROM instructor");
				$inst_id='';
				foreach($all_instructer as $all)
				{
				$inst_id.=$all->i_id.',';
				
				}
				
				$chk_id=explode(',',$inst_id);
					$diff_id=array_merge(array_diff($instructer_id,$chk_id),array_diff($chk_id,$instructer_id));
					
					foreach($diff_id as $unch_id)
					{
					
						$instructer= $db->get_row("SELECT * FROM instructor WHERE i_id='$unch_id'");
					?>
					<!-- <input type='checkbox' name='instructer_id[]' value='<?php echo $instructer->i_id;?>'><a href="#" rel="tooltip" title="<?php echo $instructer->i_d;?>"><?php echo $instructer->i_ty;?></a><br /> -->
					<?php
					
					}
				?>

</form>
				</p>
              </div>
			  
			  <div class="tab-pane fade" id="precamp">
                <p>
				
				<form method='POST' action=''>
				<?php
				$pre_camp= $db->get_row("SELECT * FROM pre_camp_value WHERE batch_id='$_GET[id]'");
				
				?>
				<?php
				$pre_camp_venue= $db->get_results("SELECT * FROM pre_camp_venue");
				foreach($pre_camp_venue as $pre_venue)
				{
						
				if($pre_venue->pc_id==$pre_camp->pc_id)
				{
				?>
			<h3>Pre camp Title is :</h3><p><?php echo $pre_venue->pc_t;?></p><br />
				<?php
					}
				else
				{
				?>
				<!-- <input type='radio' name='pre_camp' value='<?php echo $pre_venue->pc_id;?>'><a href="#" rel="tooltip" title="<?php echo $pre_venue->pc_geo;?>"><?php echo $pre_venue->pc_t;?>	</a><br /> -->
				<?php
				}
				}	?>
				
				
				<h3> Date  : </h3>
  <p><?php echo $pre_camp->date_pre;?></p>
  

<h3> Time </h3>
<p><?php echo $pre_camp->time_pre;?></p><br />
	

</form>
				</p>
              </div>
 <?php
   $getgalleries = $db->get_results("SELECT * FROM video_gallery_type WHERE vgt_type = '$_GET[type]' AND vgt_ty_id = '$_GET[id]'");
if($getgalleries)
{   
   foreach($getgalleries as $getgallery)
   {
		//					echo $getgallery->vg_id;   	
   	}
  }
?> 

  <div id="video" class="tab-pane fade">
<div>
<p><a href="index.php?option=component&kind=videogallery&method=gallery&process=add&type=<?php echo $tablename; ?>&id=<?php echo $id; ?>&step=1" class="btn btn-info" >Add New Videogallery</a></p>
</div>  
  
              <?php
      if($getgalleries)
{           
foreach($getgalleries as $getgallery)
   {
   	$vgid = $getgallery->vg_id;
   	$gettitle = $db->get_row("SELECT * FROM video_gallery WHERE vg_id = '$vgid'");
   	echo '<h2>'.$gettitle->vg_t.'</h2>'; 
   	
   	$getitems = $db->get_results("SELECT * FROM video_gallery_items_table WHERE vg_id = '$vgid'");
if($getitems)
{			
			foreach($getitems as $getitem)
			{ 
			$service = $getitem->vg_service;
					if($service == 'youtube')
					{
					
					$url = 'http://www.youtube.com/v/';	
					}	elseif($service == 'vimeo')
					{
					$url = 'http://vimeo.com/';	
				}else{
					
				$url = 'hi';	
					}			
			?>
				<div class="row-fluid">
            <ul class="thumbnails">
              <li class="span6">
                <div class="thumbnail">
  
<embed width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="<?php echo $url.$getitem->vgi_code ; ?>"
type="application/x-shockwave-flash">
</embed>  
           <!-- http://youtu.be/A1VTaAYH3Hc
           http://vimeo.com/63115838
src="http://www.youtube.com/v/XGSy3_Czz8k"           
            -->     
                  <div class="caption">
                    <h3><?php echo $getitem->vgi_t;?></h3>
                    <a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=<?php echo $_GET['tmpl']; ?>&id=<?php echo $_GET['id'];?>&hvid=<?php echo $getitem->vgi_id; ?>" name="hide" class="btn btn-primary"  >Hide</a>
                  </div>
                </div>
              </li>
             </ul>
  </div>				
			<?php	}				
		}//if close			  	
   	} }?>              
              
											               
              </div>
			  
			  
              <div id="photo" class="tab-pane fade">
                <p>
<div>

<p> <a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $_GET['type'];?>&id=<?php echo $_GET['id'];?>&step=1' class="btn btn-primary">Add Photogallery</a></p>

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal">Image Upload</a>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>

<?php
//$image_link= $db->get_row("SELECT image_gallery_link .*, gallery.* FROM image_gallery_link LEFT JOIN gallery ON image_gallery_link.g_id = gallery.g_id WHERE image_gallery_link.type='$_GET[type]' AND image_gallery_link.type_id='$_GET[id]'");
 //print_r($image_link);
?>
Image Upload :<input type='file' name='image_upload'><br />
<input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>
<input type='hidden' name='type_id' value='<?php echo $_GET['id'];?>'>
<input type='submit' name='upload_image' value='Upload Image'>
 

	</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>
</div>                
                
				<?php
				$gallery= $db->get_results("SELECT * FROM image_gallery_link WHERE type='$_GET[type]' AND type_id='$_GET[id]'");
				if($gallery)
				{
				
				foreach($gallery as $images)
				{
				$folder_name= $db->get_row("SELECT * FROM gallery WHERE g_id='$images->g_id'");
				$image= $db->get_results("SELECT * FROM images WHERE g_id='$images->g_id'");
				foreach($image as $img)
				{
				?>
				
           
              <li class="span4">
                <div class="thumbnail">
				
                  <img data-src="holder.js/300x200" alt="300x200" style="width: 300px; height: 200px;" src="<?php echo component.'photogallary/'.$folder_name->g_folder.'/thumbnail/'.$img->im_id;?>.jpg">
                
			

				<div class="caption">
                    <b>Title Image :
                    <?php
					$title=explode('.jpg',$img->im_title);
					?>
					<?php echo $title[0];?></b><br /> 
					
                 <b>   Image Status :
                 
					<?php echo $img->im_status;?></b><br />
					<b>   Gallery Title :
                 
					<?php echo $folder_name->g_title;?></b><br />
				   
				   		 <center>
				    <p><a class="group3" href="<?php echo component.'photogallary/'.$folder_name->g_folder.'/full/'.$img->im_id;?>.jpg" title="On the Ohoopee as an adult"><span class="label label-info">Preview</span></a>
					
							<?php
					$im_id=$img->im_id;
					$folder=$folder_name->g_folder;
					$show=Delete_image($im_id,$folder);
					?>
					
					<?php echo $show;?>
					<!--<a href='./index.php?img_id=<?php echo $img->im_id;?>&folder=<?php echo $folder_name->g_folder;?>'><span class="label label-important">Delete</span></a>!-->
				 <a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $_GET['type'];?>&id=<?php echo $_GET['id'];?>&step=3'><span class="label label-primary">Edit</span></a>
				 </center>
					
                  </div>
                </div>
              </li>
			 
             

				<?php
				
				}
				
				}
				
				}
				
				?>
				</p>
              </div>			  

          <div id="downloads" class="tab-pane fade">
                <p>
<div>
<a href="./index.php?option=component&kind=downloads&method=files&process=add&type=<?php echo $_GET['type'];?>&ty_id=<?php echo $_GET['id'];?>" class="btn btn-primary" >Add New Document</a>
</div>
<div class="span10">
<?php
$id = $_GET['id'];
$getresults = $db->get_results("SELECT * FROM downloads_type WHERE dt_ty = '$Table' AND dt_ty_id = '$id'");
if($getresults)
{ 
foreach($getresults as $getresult)
{
	$did = $getresult->d_id;
	$getrow = $db->get_row("SELECT * FROM downloads WHERE d_id = '$did'");
	if($getrow)
	{
		$url = '../admin/component/downloads/documents/'.$getrow->d_t; 
if(is_file($url))
{		
?>
	<a href="../admin/component/downloads/documents/<?php echo $getrow->d_t; ?>" ><?php echo $getrow->d_link; ?></a>
<?php }else{ ?>
<!-- <p>File is deleted.</p>
	<a href=""><?php echo $getrow->d_link; ?></a> -->


	 <?php
	 
}
}	 
	 }
	  }
?>
</div>
</p>
              </div>		

              <div class="tab-pane fade" id="dropdown1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>
	