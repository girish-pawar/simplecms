<?php
include_once('../admin/includes/defination.php');
include_once('../admin/component/videogallery/config.php');
global $db;

if(isset($_GET['step']))
{
$type = $_GET['type'];
$id = $_GET['id'];
$step = $_GET['step'];	
$type1 = 'video_gallery';
}

if(isset($_POST['vgstep3']))
{
//	print_r($_POST);
$vgititle = $_POST['vgi_t'];
$vgicode = $_POST['vgi_code'];
$vgistatus = $_POST['vgi_status'];
$vgid = $_GET['vg_id'];
$vgservice = $servicetype; 

$code = explode('.',$vgicode);
$code1 = explode('/',end($code));
$code2 = end($code1);

$insertvgi = $db->query("INSERT into video_gallery_items_table values ('','$vgititle','$code2','$vgistatus','$vgid','$vgservice') ");
$insertvgty = $db->query("INSERT into video_gallery_type values ('','$type','$id','$vgid') ");

$type1 = 'video_gallery';
//echo 'vgid is'.$vgid;
if($insertvgi)
{
	?> 
	<a href="../admin/index.php?option=<?php echo $_GET['option']; ?>&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=<?php echo $_GET['process'];?>&type=<?php echo $_GET['type']; ?>&id=<?php echo $_GET['id']; ?>&step=4&vg_id=<?php echo $vgid; ?>" >Click here For Continue..</a>    
    
<?php 
}//close vgi check
}	elseif(isset($_POST['vgstep31']))
{
//	print_r($_POST);
$vgititle = $_POST['vgi_t'];
$vgicode = $_POST['vgi_code'];
$vgistatus = $_POST['vgi_status'];
$vgid = $_GET['vg_id'];
$vgservice = $servicetype; 
$vgi_id = $_GET['vgi_id'];

$code = explode('.',$vgicode);
$code1 = explode('/',end($code));
$code2 = end($code1);

$insertvgi = $db->query("UPDATE video_gallery_items_table SET vgi_t = '$vgititle' , vgi_code = '$code2' , vgi_status = '$vgistatus', vg_id = '$vgid' , vg_service =  '$vgservice' WHERE vgi_id = '$vgi_id' ");
//$insertvgty = $db->query("INSERT into video_gallery_type values ('','$type','$id','$vgid') ");

$type1 = 'video_gallery';
//echo 'vgid is'.$vgid;
if($insertvgi)
{
	?> 
	<a href="../admin/index.php?option=<?php echo $_GET['option']; ?>&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=<?php echo $_GET['process'];?>&type=<?php echo $_GET['type']; ?>&id=<?php echo $_GET['id']; ?>&step=4&vg_id=<?php echo $vgid; ?>" >Click here For Continue..</a>    
    
<?php 
}//close vgi check
}	 //close post
?>


<script type="text/javascript">
var xmlhttp;
function suggest()
{
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp= new ActiveXObject('Micosoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("test").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','../admin/<?php echo $_GET['option']; ?>/<?php echo $_GET['kind']; ?>/<?php echo $_GET['method']; ?>/video_search.php?type=<?php echo $_GET['type'] ?>&id=<?php echo $_GET['id'] ?>&option=<?php echo $_GET['option']; ?>&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&select='+document.getElementById('searchtext').value,true);
xmlhttp.send();
}
</script>

<div class="block span11">
<form method="post">


<?php

if(isset($_POST['exist']))
{
	//$fieldarrays = $_POST['fieldarrays'];
		$arrays = $_POST['fieldsarray'];
	$_SESSION['fieldsarray']  = $arrays;		
	$fieldsarray = $_SESSION['fieldsarray'];
	//print_r($_SESSION);
	//echo 'f1 ='; 
	//print_r($_SESSION['fieldsarray']);
	if(isset($_SESSION['fieldsarray']) != null	)
	{
	foreach($fieldsarray as $fieldsarr )
	{
	$insert = $db->query("INSERT into video_gallery_type values ('','$type','$id','$fieldsarr')");
	//header('location:./details.php?type='.$_GET['type'].'&tmpl=default&id='.$_GET['id']);
}
}
}

//print_r($_SESSION);
//print_r($_SESSION);

if($step == 1)
{
?>
	
<div>
Select Video gallery:
<select name="videogallery" id='searchtext' onblur='suggest();' >
<option value="new">Add New Video Gallery</option>
<option value="exist">Select Existing Video Gallery</option>
</select>
</div>

<input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" />
<input type="hidden" name="type_id" value="<?php echo $_GET['id']; ?>" />
<input type="submit" name="exit_gallary" value="Back" class="btn btn-success" />

  <div id='test'>
  </div>	

	<?php
}elseif($step == 2)
{
if(isset($_GET['vgid']))
{
$vgid = $_GET['vgid'];
$getrow = $db->get_row("SELECT * FROM video_gallery WHERE vg_id = '$vgid'");
}else{
	$vgid = null;
	}	
	
	?>

	
	<div class="space1">
	Video Gallery name:
	<input type="text" name="vg_t" value="<?php if($vgid != null){ echo $getrow->vg_t; }else{ }?>" />
		</div>
		
		<div class="space1">
	Video Gallery Status Display:
	<select name="vg_status">
	<option value="yes">yes</option>
	<option value="no">no</option>
		</div>
		<div class="space1">
<?php 


$seo_detail = 'seo_detail';
$extra = null;
$table = 'video_gallery';
Get_SeoForm($seo_detail,$_GET['vgid'],$extra,$table)  ?>
</div>		
		<div class="space1">
<input type="hidden" name="table" value="video_gallery" />
<?php if(isset($_GET['vgid']))
{?>
<input type="hidden" name="id" value="<?php echo $_GET['vgid']; ?>" />
<?php } ?>		
<input type="hidden" name="seo_table" value="124" />		
		</div>		

		
		
	<?php
}elseif($step == 3)
{ 
if(isset($_GET['vgi_id']))
{
$vgi_id = $_GET['vgi_id'];
$getrow = $db->get_row("SELECT * FROM video_gallery_items_table WHERE vgi_id = '$vgi_id'");
}else{
$vgi_id = null;	
	}
?>
<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Step 2 Add Video Items in video gallery.
    </div>	
<div class="space1">
	Video Gallery Item Title:
	<input type="text" name="vgi_t" value="<?php if($vgi_id != null){ echo $getrow->vgi_t; }else{ }?>" />
		</div>
		
		<div class="space1">
	Video Gallery Item Code:
	<input type="text" name="vgi_code" value="<?php if($vgi_id != null){ echo $getrow->vgi_code; }else{ }?>" />
		</div>
		<div class="space1">
	Video Gallery Display Status:
	<select name="vgi_status">
	<option value="yes">yes</option>
	<option value="no">no</option>
		</div>    
    
	<div class="space1">
	
	<?php if(isset($_GET['vgi_id']))
{?>
<input type="submit" name="vgstep31" value="Update" class="btn btn-success" />	 
<?php }else{ ?>		
<input type="submit" name="vgstep3" value="Submit" class="btn btn-success" />	 
<?php } ?>

<?php	}elseif($step == 4)
	{
		
		$getvideos = $db->get_results("SELECT * FROM video_gallery_items_table WHERE vg_id = '$_GET[vg_id]'")	;
$getname = $db->get_row("SELECT * from video_gallery WHERE vg_id = '$_GET[vg_id]'");
if($getvideos)
{?>
<h2>Videos From <?php //echo $getname->vg_t; ?> Video Gallery</h2>	
<div class="pull-right span4 offset-3">
<a class="btn btn-info" href="details.php?type=<?php echo $_GET['type']; ?>&tmpl=default&id=<?php echo $_GET['id']; ?>">Back to <?php echo $_GET['type']; ?></a>
</div>


	<?php 
//	echo 'service type is:'.$servicetype;
	
	foreach($getvideos as $getvideo)
	{
		if($getvideo->vg_service == 'youtube')
{
	
$url = 'http://www.youtube.com/v/';	
	}	elseif($getvideo->vg_service == 'vimeo')
	{
	$url = 'http://vimeo.com/';	
}else{
	
$url = 'hi';	
	}
	?>
	<div class="row-fluid">
            <ul class="thumbnails">
              <li class="span8">
                <div class="thumbnail">
  
<embed width="420" height="345" src="<?php echo $url.$getvideo->vgi_code ;?>"
type="application/x-shockwave-flash">
</embed>  
           <!-- http://youtu.be/A1VTaAYH3Hc
           http://vimeo.com/63115838
src="http://www.youtube.com/v/XGSy3_Czz8k"           
            -->     
                  <div class="caption">
                    <h3><?php echo $getvideo->vgi_t; ?></h3>
                  </div>
                </div>
              </li>
             </ul>
  </div>
	<div class="space1">
	<h2><?php //echo $getvideo->vgi_t; ?></h2>
	
	
	</div>
<!-- 	<input type="hidden" name="vgt_type" value="<?php echo $_GET['type']; ?>" />
<input type="hidden" name="vgt_ty_id" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="vg_id" value="<?php echo $_GET['vg_id']; ?>" />
<input type="hidden" name="table" value="video_gallery_type" />
<input type="hidden" name="seo_table" value="" />

<input type="submit" name="submit" value="Submit" class="btn btn-success" /> -->
	
<?php
}//foreach close
}//if close

		
		}else{
			
			}
		
		?>
		</form>
		</div>