<?php
if(isset($_POST['config']))
{

//print_r($_POST);
//print_r($_FILES);
$location='';
if(isset($_FILES['logo']))
{
$file = $_FILES ['logo'];
$name1 = $file ['name'];
$type = $file ['type'];
$size = $file ['size'];
$tmppath = $file ['tmp_name']; 

if($name1!="")
{
$location.='./component/photogallary/images/'.$name1;

//$check=move_uploaded_file($tmppath,$location);


}

include_once(rootfolder.'/admin/includes/class.upload.php');
$foo = new Upload($_FILES ['logo']); 
 if ($foo->uploaded) {   
 // save uploaded image with no changes
 
   
 // save uploaded image with a new name 
 //$foo->file_new_name_body = 'foo';   
 //$foo->Process('./image/thumbnail');   
   
 // save uploaded image with a new name,  
 // resized to 100px wide 
 //$foo->file_new_name_body = 'image_full'; 
  //$a = mkdir(mainsite."/image/full/$section->seo_title/$seo_title", 0755);
 $foo->image_resize = true; 
 $foo->image_convert = 'png';  
 $foo->image_y = 123;   
 $foo->image_ratio_x = true;  

 $foo->Process('./component/photogallary/images/');  
 if ($foo->processed) {   
 echo 'image renamed, resized x=600      
 and converted to GIF<br />';    
 
 }
 //$foo->file_new_name_body = 'image_resized'; 
  //$a = mkdir(mainsite."/image/thumbnail/".$section->seo_title."/".$seo_title, 0755);
 //$foo->image_resize = true;   $foo->image_convert = jpg;   $foo->image_x = 200;   $foo->image_ratio_y = true;  
 //$foo->Process(mainsite.'/image/'.$section->seo_title.'/'.$seo_title.'/thumbnail');  
 //if ($foo->processed) {   
 //echo 'image renamed, resized x=200      
 //and converted to GIF';   
 //$foo->Clean(); 
 
 //} else 
 {     echo 'error : ' . $foo->error; 
 } 
 }


}
if(isset($_POST['location']))
{
$wt_position= $_POST['location'];
}
else
{
$wt_position='';
}

$position_watermark='$watermark_position='."'".$wt_position."'";
$full_height='$full_height='.$_POST['full_height'];
$full_width='$full_width='.$_POST['full_width'];
$thumb_height='$thumb_height='.$_POST['thumb_height'];
$thumb_width='$thumb_width='.$_POST['thumb_width'];
$logo_upload='$logo_upload='."'".$_POST['copyright']."'";
$file_name='./component/photogallary/config/config.php';
$loc=explode('.',$location[0].$location);
print_r($loc);
//echo 'location'.$location[0];
$path=$loc[2].'.'.$loc[3];
$image_path='$logo_path='."'".$path."'";
$file= fopen($file_name,"w+");
fwrite($file,'<?php '.$logo_upload.';'."\n".$image_path.';'."\n".$position_watermark.';'."\n".$full_height.';'."\n".$full_width.';'."\n".$thumb_height.';'."\n".$thumb_width.';'."\n".'?>');


?>
<?php
$url=$_SERVER["HTTP_REFERER"];
$page=explode('&method=config',$url);
//print_r($page);
?>
<a href='<?php echo $page[0];?>'><font color='green' size='4'><b>Successfully Insert Config  ( Click Back To Homepage)</b></font></a>

<?php
}
?>

<form method='POST' action='' enctype='multipart/form-data'>
<label>
Full Image Dimention :</label><input type='text' name='full_width' placeholder='width'>X<input type='text' name='full_height' placeholder='height'></label>
<label>Thumb Image Diemention :</label><input type='text' name='thumb_width' placeholder='width'>X<input type='text' placeholder='height' name='thumb_height'></label>
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
document.getElementById("copyright").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','./component/photogallary/config/upload_logo.php?logo='+document.getElementById('logo').value,true);
xmlhttp.send();
}
</script>
<label>
Upload Logo :<select name='copyright' id='logo' onblur='suggest();'>
<option value=''></option>
<option value='yes'>Yes</option>
<option value='no'>No</option>
</select></label>
<div id='copyright'>
</div>

<input type='submit' class='btn btn-primary' name='config' value='Submit'>

</form>