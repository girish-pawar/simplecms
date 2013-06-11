
<?php
include_once('../admin/component/videogallery/config.php');
$sizes = explode('x',$size);
$width = current($sizes);
$height = end($sizes);

if($_GET)
{
if(isset ($_GET['type']) ||  isset($_GET['tmpl']) || isset($_GET['id']) )
{
	$tablename = $_GET['type'];
	$tmpl = $_GET['tmpl'];
	$id = $_GET['id'];
	}else{
		$tablename = null;
		$tmpl = null;
		$id = null;
		
		}
}

if(isset($_GET['hvid']))
{
$hvid = $_GET['hvid'];
$insert = $db->query("INSERT into hide_video values ('','$hvid','hide')");
if($insert)
{
echo 'hide success';	
	}	else{
echo 'unhide';		
		}
	
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
	
<form method='POST' action='' enctype='multipart/form-data'>  
<div class="row-fluid">
    <div class="block span12">
    <?php //if($id != null){ ?> 
       
        <div id="tablewidget" class="block-body collapse in">
        <table class="table" >
       <?php
        
       $getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
foreach($getcolms as $getcolm)
{       
       
foreach($db->get_col("SHOW TABLES", 0) as $table_name)
	{
		
																														if($table_name != $tablename) //tablename not equal to get table nAME 
																														{
																															
																															$getfirstcolumns = $db->get_results("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field'");
																															if($getfirstcolumns)
																																{
																																		
																														foreach($getfirstcolumns as $getfirstcolumn)
																														{
																															//echo 'tablename matched '.$table_name.'</br>';
																															//echo '<pre>';	
																															//	print_r($getfirstcolumn);
																															//echo '</pre>';
																																$id1 = $getfirstcolumn->Field;
																														//echo 'id is'.$id1;
																															
																															$getrows = $db->get_results("SHOW FULL COLUMNS FROM $table_name");
																																	foreach($getrows as $getrow)
																																	{
																																		//print_r($getrow);
																																			$mystring2 = $getrow->Field;
																																				$findme2   = '_t';
																																				$pos2 = strpos($mystring2, $findme2);
																																					if ($pos2 === false) 
																																					{
																																								   //echo "The string was not found in the string '$mystring1' <br />";
																																					}else
																																					{
																																									global $db;
																																									$name = $getrow->Field;
																																																												//echo 'name is'.$name;
																																								
																																									$getnamess = $db->get_results("SELECT * FROM $table_name ");
																																									//$getnames = $db->get_row("SELECT * FROM $table_name WHERE $name = '$cats' ");
																																								if($getnamess)
																																								{		
																																								foreach($getnamess as $getname)
																																								{
																																								
																																									$mystring123 = $getname->$id1;
																																									$findme123   = $id;
																																									
																																									$pos = strpos($mystring123, $findme123);
																																									    $name= $getrow->Field;
																																									
																																									
																																									// Note our use of ===.  Simply == would not work as expected
																																									// because the position of 'a' was the 0th (first) character.
																																									if ($pos === false) {
																																										
																																													?>
																																										 <thead>
                <tr><th>There is no category present in table <?php echo $table_name; ?></th></tr></thead><tbody>	<tr><td>
                <?php																																									
																			
																																									    //echo "The string '$findme123' was not found in the string '$mystring123' </br>";
																																									} else {
																																													?>
																																										 <thead>
                <tr><th><?php echo $table_name; ?></th></tr></thead><tbody>	<tr><td>
                <?php																																									
																			
																																									   // echo "The string '$findme123' was found in the string '$mystring123' </br>";
																																									    //echo 'name is '.$getrow->Field.'</br>';
																																									    $name= $getrow->Field;
																																									    //echo 'find123 is'.$findme123;
																																									    $getnames = $db->get_results("SELECT * FROM $table_name WHERE $id IN ('$findme123')");
																																									    if($getnames)
																																									    {
																																									    	foreach($getnames as $getname)
																																									    	{ 
																																									    																																								    		//print_r($getname);
																																									echo $getname->$name.'</br>';
																																									    	
																																									    	}
																																									
																																									    	}
																																									    
																																									    
																																									    
																																									}
																																								
																																											break 1;																											
																																									}
																																																														
																																									//echo $getnames->$name;
																																									}
																																																																									
																																							}
																																		
																																			}
	}																													
				}																									
																													
																															
																																
																														} // end $getfirstcolm 
																														} //check table name 
																														} //foreach show all tables 
																														
																											
																				?>        
       
</td>            
            </tr>
            </tbody>
            </table>
            
        </div>
        <?php //} ?>
    </div>
    </div>
 
  <div class="pull-right span4 offset-3">
    <!-- <a href="#myModal" role="button" class="btn " data-toggle="modal">Image Upload</a> -->
	<p> <a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $_GET['type'];?>&id=<?php echo $_GET['id'];?>&step=1' class="btn btn-primary">Add Photogallery</a></p>
<p><a href="index.php?option=component&kind=videogallery&method=gallery&process=add&type=<?php echo $tablename; ?>&id=<?php echo $id; ?>&step=1" class="btn btn-info" >Add New Videogallery</a></p>
</div>
<!-- <div class="pull-right span4 offset-3">
		<a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $_GET['type'];?>&id=<?php echo $_GET['id'];?>&step=1' class="btn btn-primary">Add Photogallery</a>

<a href='./index<!-- .php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $_GET['type'];?>&id=<?php echo $_GET['id'];?>&step=3' class="btn btn-inverse">Gallery</a> 
		</div> -->
 
 
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
 
 <div class="pull-right span4 offset-2">
		
 </div>
 <?php
 //session_start();
 $pageURL =$_SERVER["REQUEST_URI"];
 //unset($_SESSION['header_location'];
 $_SESSION['header_location']=$pageURL;
 //echo $_SESSION['header_location'];
 //echo md5(1);
 ?>
 <?php
 display_details($tablename,	$tmpl,$id);
   ?>
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
      <div class="bs-docs-example">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a data-toggle="tab" href="#home">Video Gallery</a></li>
              <li class=""><a data-toggle="tab" href="#profile">Photo Gallery</a></li>
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a data-toggle="tab" href="#dropdown1">@fat</a></li>
                  <li><a data-toggle="tab" href="#dropdown2">@mdo</a></li>
                </ul>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div id="home" class="tab-pane fade active in">
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
			  
			  
              <div id="profile" class="tab-pane fade">
                <p>
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
              <div id="dropdown1" class="tab-pane fade">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div id="dropdown2" class="tab-pane fade">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>
     
    <script>
    $(function () {
    $('#myTab a:last').tab('show');
    })
    </script>
   
   
   
  </form>
  
  
    