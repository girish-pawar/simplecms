
	<head>
		<meta charset='utf-8'/>
		<title>ColorBox Examples</title>
		<style>
			body{font:12px/1.2 Verdana, sans-serif; padding:0 10px;}
			a:link, a:visited{text-decoration:none; color:#416CE5; border-bottom:1px solid #416CE5;}
			h2{font-size:13px; margin:15px 0 0 0;}
		</style>

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
	</head>
	<form method='POST' action=''>
	<?php
	if(isset($_GET['g_id']))
	{
	?>
<?php
$gallary= $db->get_row("SELECT * FROM gallery WHERE g_id='$_GET[g_id]'");
//print_r($gallery);
$images= $db->get_results("SELECT * FROM images WHERE g_id='$_GET[g_id]'");
//print_r($images);
foreach($images as $img)
{ set_time_limit('300');
$title=explode('.jpg',$img->im_title);
//print_r($title);
?>
<li class="span4">
              
             
<div class="thumbnail">
                 <img src='<?php echo component.'photogallary/'.$gallary->g_folder.'/thumbnail/'.$img->im_id;?>.jpg' height='120' width='200' class='img-polaroid'>
                  <div class="caption">
				  <b>Title :</b><input type='text' name='im_title[<?php echo $img->im_id;?>]' value='<?php echo $title[0];?>'>
                   
                  
                <?php
				$status=array('show','hide');
				?><br />
				<b>Status :</b><select name='img_status[<?php echo $img->im_id;?>]'>
				  <?php
				  foreach($status as $st)
				  {
				  if($img->im_status==$st)
				  {
				      ?>
				  <option value='<?php echo $st;?>' selected><?php echo $st;?></option>
				  <?php
				  }
				  else
				  {
				    ?>
				  <option value='<?php echo $st;?>'><?php echo $st;?></option>
				  <?php
				  }
				  
				  }
				  ?>
				  </select>
				  <center>
				    <p><a class="group3" href="<?php echo component.'photogallary/'.$gallary->g_folder.'/full/'.$img->im_id;?>.jpg" title="On the Ohoopee as an adult"><span class="label label-info">Preview</span></a>
					<?php
					$im_id=$img->im_id;
					$folder=$gallary->g_folder;
					$show=Delete_image($im_id,$folder);
					?>
					
					<?php echo $show;?>
					
					<!--<a href='./index.php?img_id=<?php echo $img->im_id;?>&folder=<?php echo $gallary->g_folder;?>'><span class="label label-important">Delete</span></a>!-->
				 </center>
				 </div>
                </div>

  </li>




<?php


}
?>
				  <input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>
<input type='hidden' name='type_id' value='<?php echo $_GET['id'];?>'>
<input type='submit' class='btn btn-primary' name='exit_gallary' value='Exit'>
<input type='submit' class='btn btn-primary' name='update_image' value='Update & Exit'>

<?php
}
else
{
?>
			<?php
				$gallery= $db->get_results("SELECT * FROM image_gallery_link WHERE type='$_GET[type]' AND type_id='$_GET[id]'");
				if($gallery)
				{
				//print_r($gallery);
				foreach($gallery as $images)
				{
				$folder_name= $db->get_row("SELECT * FROM gallery WHERE g_id='$images->g_id'");
				$image= $db->get_results("SELECT * FROM images WHERE g_id='$images->g_id'");
				foreach($image as $img)
				{
				$title=explode('.jpg',$img->im_title);
				?> 
				
           
              <li class="span4">
                <div class="thumbnail">
				
                  <img data-src="holder.js/300x200" alt="300x200" src="<?php echo component.'photogallary/'.$folder_name->g_folder.'/thumbnail/'.$img->im_id;?>.jpg" height='120' width='200' class='img-polaroid'>
                
			

				<div class="caption">
                 	  <b>Title :</b><input type='text' name='im_title[<?php echo $img->im_id;?>]' value='<?php echo $title[0];?>'>
                   
                  
                <?php
				$status=array('show','hide');
				?><br />
				<b>Status :</b><select name='img_status[<?php echo $img->im_id;?>]'>
				  <?php
				  foreach($status as $st)
				  {
				  if($img->im_status==$st)
				  {
				      ?>
				  <option value='<?php echo $st;?>' selected><?php echo $st;?></option>
				  <?php
				  }
				  else
				  {
				    ?>
				  <option value='<?php echo $st;?>'><?php echo $st;?></option>
				  <?php
				  }
				  
				  }
				  ?>
				  </select>
				  <input type='hidden' name='ig_id' value='<?php echo $images->ig_id;?>'>
				  <input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>
<input type='hidden' name='type_id' value='<?php echo $_GET['id'];?>'>
				  <center>
				    <p><a class="group3" href="<?php echo component.'photogallary/'.$folder_name->g_folder.'/full/'.$img->im_id;?>.jpg" title="On the Ohoopee as an adult"><span class="label label-info">Preview</span></a>
					
					<?php
					$im_id=$img->im_id;
					$folder=$folder_name->g_folder;
					$show=Delete_image($im_id,$folder);
					?>
					
					<?php echo $show;?>
					<!--<a href='./index.php?img_id=<?php echo $img->im_id;?>&folder=<?php echo $folder_name->g_folder;?>'><span class="label label-important">Delete</span></a>!-->
				 </center>
                  </div>
                </div>
              </li>
			 
             

				<?php
				
				}
				
				}
								?>
				
				<input type='submit' class='btn btn-primary' name='exit_gallary' value='Exit'>
<input type='submit' class='btn btn-primary' name='update_image' value='Update & Exit'>
<?php
				}
				

}


?>


</form>