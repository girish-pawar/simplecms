<?php
function Admin_Login($username,$password)
{
global $db;
$admin_login= $db->get_row("SELECT * FROM admin WHERE ad_username='$username' AND ad_password='$password'");
$html='';
if($admin_login)
{
session_start();
//if($admin_login->ad_type=='super admin')
//{
$_SESSION['ad_id']=$admin_login->ad_id;
header('location:index.php');
//}
}
else{
$html.='Login Error Try Again';
}
return $html;
}
function User_info($userid)
{
global $db;
$admin= $db->get_row("SELECT * FROM admin WHERE ad_id='$userid'");
return $admin;
}

function Category_info($catid)
{
global $db;
$category = $db->get_row("SELECT * FROM category WHERE ct_id = '$catid'");
return $category;
}
?>
<?php
function Seo_detail($sd_ty_id) 
{
	global $db;
$seodetail = $db->get_row("SELECT * FROM seo_detail WHERE sd_ty_id = '$sd_ty_id'");
return $seodetail;
}
?>
<?php
function GetForm($type,$id=null,$extra=null){
global $db;
?>
</form>
<form method='POST' action='' enctype='multipart/form-data'>
<?php
$columns = $db->get_results("SHOW FULL COLUMNS FROM $type");
if(isset($id))
{ 
$table = $db->get_row("SHOW FULL COLUMNS FROM $type");
$data= $db->get_row("SELECT * FROM $type WHERE $table->Field ='$id'");
print_r($data);
}
foreach($columns as $column){ 
//print_r($column);
?>
<h3><?php echo $column->Comment;?></h3>
<?php
foreach($db->get_col("SHOW TABLES", 0) as $tablename){
if($tablename != $type){
if($extra == '1'){
	$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field = '$column->Field'");
		if($getfirstcolumn){
		//print_r($getfirstcolumn);
			$getresults = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
			foreach($getresults as $getresult){ 
			//echo '<pre>';
			//print_r($getresult);
//echo '</pre>';
				$title = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field LIKE '%_t'");
				// echo $title->Field.'<br />';
				echo'<b>Match This Table : </b>'. $tablename;
				// display table data
				
					 echo '<b> Showing This Row  </b>'.$title->Field.'<br />';
				
				// display table data
				
				
				$ch_id='';
				$category= $db->get_results("SELECT * FROM $tablename");
				if($category)
				{
				$getid = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
				if($id=='')
				{
				?>
				<h3><?php echo $title->Comment;?></h3>
				<?php
				}
				foreach($category as $cate)
				{
			
				
				$field=$title->Field;
				$cat_id=$getid->Field;
				$ch_id.=$cate->$cat_id.',';
				//echo $cate->$field;
					if($id=='')
				{
				echo "<input type='checkbox' name='".$getid->Field."[]' value='".$cate->$cat_id."'>".$cate->$field."<br />";
				
				}
				
				}
				
				}
				//print_r($ch_id);
				
				//update follwing code
				if($id != '')
				{
						$getid = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
						?>
						<h3><?php echo $title->Comment;?></h3>
						<?php
						
							$cat_id=$getid->Field;
							$field=$title->Field;
				$dataid=explode(',',$data->$cat_id);
				foreach($dataid as $data_id)
				{
				if($data_id!='')
				{
					$chk= $db->get_row("SELECT * FROM $tablename WHERE $cat_id='$data_id'");
				
				if($chk)
				{
			
				echo "<input type='checkbox' checked name='".$getid->Field."[]' value='".$chk->$cat_id."'>".$chk->$field."<br />";
				

				}
				
				
			
				
				
				}
				 
				} 
				
				}
				
				//not selected chk
				
				
							if($id!='')
				{
						$getid = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
						?>
						
						<?php
						
							$cat_id=$getid->Field;
							$field=$title->Field;
				$dataid=explode(',',$data->$cat_id);
				$chk_id=explode(',',$ch_id);
				//print_r($dataid);
				//print_r($chk_id);
				$diff_id=array_merge(array_diff($dataid,$chk_id),array_diff($chk_id,$dataid));
				
				//print_r($diff_id);
				
				foreach($diff_id as $not_select_id)
				{
					$chk_not_select= $db->get_row("SELECT * FROM $tablename WHERE $cat_id='$not_select_id'");
				
				if($chk_not_select)
				{
			
				echo "<input type='checkbox' name='".$getid->Field."[]' value='".$chk_not_select->$cat_id."'>".$chk_not_select->$field."<br />";
				

				}
				
				
				}
				
				}
			
		
				
				
			
				
				
				
				
				
				//print_r($title);
				if($title){
				//echo 'this is title';
				} else {
				$value = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Comment = 'value'");
					if($value){
					echo 'this is value';
					}
				}
			
			break 1;
			
			
			?>
			
<?php		}



		}
}
}
}


//echo 'Table '.$column->Field.'<br />';
$exact='_t'; 
$pos = strpos($column->Field, "_t");
	 if ($pos)
	 {
	 $field= $column->Field;
	 ?>

	 <input type='text' name='<?php echo $column->Field; ?>' value='<?php if($id!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	 //this use only currency
	 $pos11 = strpos($column->Field, "_symb");
	  if ($pos11)
	 {
	 $field= $column->Field;
	 ?>

	 <input type='text' name='<?php echo $column->Field; ?>' value='<?php if($id!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	 
	  //this use only instructer facebook link
	 $pos11 = strpos($column->Field, "_f");
	  if ($pos11)
	 {
	 $field= $column->Field;
	 ?>

	 <input type='text' name='<?php echo $column->Field; ?>' value='<?php if($id!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	 
	 //use only pre camp venue
	  
	  
	   $pos11 = strpos($column->Field, "_geo");
	  if ($pos11)
	 {
	 $field= $column->Field;
	 ?>

	 <input type='text' name='<?php echo $column->Field; ?>' value='<?php if($id!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	 
	 
 
	 
	 $pos1 = strpos($column->Field, "_add");
	if($pos1)
	 {
	 	 $field1= $column->Field;
	 ?>
	<textarea name='<?php echo $column->Field;?>'><?php if($id!='') { echo $data->$field1; } ?></textarea>
	 <?php
	 
	 }
	 
	 
	 
	 
	 $pos1 = strpos($column->Field, "_d");
	if($pos1)
	 {
	 	 $field1= $column->Field;
	 ?>
	<textarea name='<?php echo $column->Field;?>'><?php if($id!='') { echo $data->$field1; } ?></textarea>
	 <?php
	 
	 }
?>
<?php /*if($column->Type == 'text') { ?>
<h2><?php echo $column->Comment; ?></h2>
<textarea name='<?php echo $column->Field ?>'> </textarea>
<?php } elseif($column->Type == 'varchar(30)') { ?>
<h2><?php echo $column->Comment; ?></h2>
<input type='text' name='<?php echo $column->Field ?>' />
<?php }*/}

$button = array('save');
//getbutton($button);

}
function Get_SeoForm($type,$id=null,$extra=null,$typename=null){
?>
<!--</form>GetForm
<form method='POST' action='' enctype='multipart/form-data'>-->
<?php
//$type=seo_table name
//$id=sd_type_id
//extra=1 if 1 then display all data & update seo 
//$typename=ex. sd_ty='category',sd_ty='batch'; 
global $db;
$columns = $db->get_results("SHOW FULL COLUMNS FROM $type");
if(isset($id))
{ 
$table = $db->get_row("SHOW FULL COLUMNS FROM $type");
$data= $db->get_row("SELECT * FROM $type WHERE sd_ty_id ='$id' AND sd_ty='$typename'");
//print_r($data);
}
foreach($columns as $column){ 
//print_r($column);
?>

	 <h3><?php echo $column->Comment;?></h3>
<?php
foreach($db->get_col("SHOW TABLES", 0) as $tablename){
if($tablename != $type){
if($extra == '1'){
	$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field = '$column->Field'");
		if($getfirstcolumn){
		//print_r($getfirstcolumn);
			$getresults = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
			if($getresults)
			{
			foreach($getresults as $getresult){ 
			//echo '<pre>';
			//print_r($getresult);
//echo '</pre>';
				$title = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field LIKE '%_t'");
				$desc = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field LIKE '%_d'");
				// echo $title->Field.'<br />';
				
				// display table data
				
					 //echo $title->Field.'<br />';
				
				// display table data
				
	
				//print_r($ch_id);
				
				//update follwing code
				
				//not selected chk
				//print_r($title);
				if($title){
				//echo 'this is title';
				} else {
				$value = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Comment = 'value'");
					if($value){
					echo 'this is value';
					}
				}
			
			break 1;
			} //foreach close
} //if close


		}
}
}
}


//echo 'Table '.$column->Field.'<br />';
$exact='_t'; 

	 if ($column->Field=='sd_t')
	 {
	 $field= $column->Field;
	 ?>
	 
<script type="text/javascript">
var xmlhttp;
function suggest_seo()
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
document.getElementById("seo").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','./includes/search_seo_title.php?s='+document.getElementById('searchtext').value,true);
xmlhttp.send();
}
</script>

	 <input type='text' id='searchtext' name='<?php echo $column->Field; ?>' onkeyup='suggest_seo();' value='<?php if($id!='' && $data!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	 
	 
//if(isset($_GET['type']) == 'article_category')
//{ ?>
<!--<script type="text/javascript">
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
xmlhttp.open('GET','../admin/component/article_manager/manager/new_menu_search.php?select='+document.getElementById('searchtext1').value,true);
xmlhttp.send();
}
</script>-->


<!--<script type="text/javascript">
var xmlhttp;
function suggest1()
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
document.getElementById("test1").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','../admin/component/article_manager/manager/new_menu_search.php?asd='+document.getElementById('searchtext1').value+'&opt='+document.getElementById('searchtext2').value,true);
xmlhttp.send();
}
</script>	-->

<!-- 

        Link to : <select name='main_links' id='searchtext1' onblur='suggest();'>
        <option value='main_link'>main_link</option>
        <option value='sub_link'>sub_link</option>
        <option value='child_link'>child_link</option>
        </select> -->
	
<?php
	//} ?>
<?php

	// $pos11 = strpos($column->Field, "_mt");
	  if ($column->Field=='sd_mt')
	 {
	 $field= $column->Field;
	 ?>

	 <input type='text' name='<?php echo $column->Field; ?>' value='<?php if($id!='' && $data!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	 
	 
	 //$pos12 = strpos($column->Field, "_mk");
	  if ($column->Field=='sd_mk')
	 {
	 $field= $column->Field;
	 ?>

	 <input type='text' name='<?php echo $column->Field; ?>' value='<?php if($id!='' && $data!='') { echo $data->$field; }?>'>
	 <?php
	// echo'_ include'.$column->Field;
	 }
	// $pos1 = strpos($column->Field, "_md");
	 if ($column->Field=='sd_md')
	 {
	 	 $field1= $column->Field;
	 ?>
	<textarea name='<?php echo $column->Field;?>'><?php if($id!='' && $data!='') { echo $data->$field1; } ?></textarea>
	 <?php
	 
	 }
	 
	 
	 
	 
?>


<?php /*if($column->Type == 'text') { ?>
<h2><?php echo $column->Comment; ?></h2>
<textarea name='<?php echo $column->Field ?>'> </textarea>
<?php } elseif($column->Type == 'varchar(30)') { ?>
<h2><?php echo $column->Comment; ?></h2>
<input type='text' name='<?php echo $column->Field ?>' />
<?php }*/}

?>
<br />

<?php
if($id!='')
{

//$file=$_SERVER["DOCUMENT_ROOT"].'/gowild/admin/seo_images/'.$typename.'/'.$data->sd_id.'.jpg';
@$read=fopen($_SERVER["DOCUMENT_ROOT"].'/images/items/'.$typename.'/'.$data->sd_ty_id.'.jpg','r');
if(@$read)
{ $image='<img src=/images/items/'.$typename.'/'.$data->sd_ty_id.'.jpg>';
echo $image;
?><br />
<a href='../admin/includes/header.php?image_folder=<?php echo $typename;?>&image_name=<?php echo $data->sd_ty_id;?> '>Delete Image</a>
<?php
}
else
{
	echo 'file path:'.$_SERVER['DOCUMENT_ROOT'];
@$read_PNG=fopen($_SERVER["DOCUMENT_ROOT"].'/images/items/'.$typename.'/'.$data->sd_ty_id.'.png','r');
if($read_PNG)
{
 $image='<img src=/images/items/'.$typename.'/'.$data->sd_ty_id.'.png>';
echo $image;
?><br />
<a href='../admin/includes/header.php?image_folder=<?php echo $typename;?>&image_name=<?php echo $data->sd_ty_id;?> '>Delete Image</a>
<?php

}
else
{

?>
Image Upload:<input type='file' name='image'>
<?php
}
}
}
else
{
?>
Image Upload:<input type='file' name='image'>
<?php
}
?>




<div id='seo'>
<?php
$b='1,2,3,4';
$button= getbutton($b);
?>
</div>
<!--</form>-->
<?php
$button = array('save');
//getbutton($button);

}
function Form_insert($type,$seo_table=null)
{
global $db;
//print_r($_POST);
$query = 'INSERT INTO '.$type.' (';
foreach($_POST as $key=>$value){
if($key!='submit' && $key!='SaveAndCont' && $key!='saveandclose' && $key!='image' && $key!='table' && $key!='type' && $key!='type_id' && $key!='seo_table' && $key!='userid' && $key!='sd_t' && $key!='sd_mt' && $key!='sd_mk' && $key!='sd_md')
{
$query .=  $key.',';
 } }
 $query1= substr($query,0,-1);
 //echo 'query1 :='.$query1.'<br />';
 //$query.=$query1;
$query .= ') VALUES (';
$query2=$query1.')VALUES(';
//echo 'query: ='.$query.'<br />';
foreach($_POST as $key=>$value){
if($key!='submit' && $key!='SaveAndCont' && $key!='saveandclose' && $key!='image' && $key!='table' && $key!='type' && $key!='type_id' && $key!='seo_table' && $key!='userid' && $key!='sd_t' && $key!='sd_mt' && $key!='sd_mk' && $key!='sd_md'){
if(is_array($value)){
//print_r($value);
	 $array = '';
	foreach($value as $array1=>$arrayvalue){
	$array .= $arrayvalue.',';
	}
	//print_r($array);
	if(isset($array)){
	$value = $array;
	}
	}
$query2 .= "'$value',";}
}
$query2 .= ')';
//$a=rtrim($query,',');
//echo'query 222 ='. $query2;
$sql= substr($query2,0,-2);
$que=$sql.')';
//echo 'query 333'.$sql.'<br />';
$result = $db->query($que);
//print_r($que);
$insert_id = $db->insert_id;

if($seo_table!='')
{
$seoinsert= Seo_Form_insert($seo_table,$insert_id,$type,$_POST);
}
if($result)
{
//echo 'Insert ';
}
else
{
//echo 'Not insert';
}
//echo '<br />';
//print_r($que);
/*
$id = $db->get_row("SHOW FULL COLUMNS FROM $type");
$columns = $db->get_results("SHOW FULL COLUMNS FROM $type WHERE Field !='$id->Field'");
//print_r($columns);
$value='';
foreach($columns as $column)
{
if(is_array($_POST[$column->Field]))
{
//print_r($_POST[$column->Field]);
foreach($_POST[$column->Field] as $array)
{
$value[$column->Field].=$array.',';
}
}
else
{
//echo $_POST[$column->Field];
}
}
*/
//print_r($value);
return $insert_id;
}
function Seo_Form_insert($table,$insertid,$type)
{
global $db;
//print_r($_POST);

$query = 'INSERT INTO '.$table.' ( sd_ty,sd_ty_id,sd_t,';
$value1='';
$seo_title=$_POST['sd_t'];
$searchspace=strpos($seo_title,' ');
if($searchspace)
{
$seo_t= str_replace(' ', '_', $seo_title);
}
else
{
$seo_t= $_POST['sd_t'];
}
foreach($_POST as $key=>$value){
if($key =='sd_mt' || $key =='sd_mk' || $key =='sd_md')
{

$query .=  $key.',';
//echo 'Key : ='.$key.'<br />';

//$value1.=','.$value.',';
 }
 }
 
 $query1= substr($query,0,-1);
 
 //echo 'query1 :='.$query1.'<br />';
 //$query.=$query1;
 //echo'query : ='.$query;
//$query2=$query.')VALUES(';
//echo 'query 2: ='.$query2.'<br />';
foreach($_POST as $key=>$value){
if($key =='sd_mt' || $key =='sd_mk' || $key =='sd_md' )
{

$query .=  $key.',';
//echo 'Key : ='.$key.'<br />';

$value1.="'$value',";
 }
 }
  $query_value= substr($value1,0,-1);
   $types="'$type'".','."'$insertid'";
   $seotitle="'$seo_t'";
$query11=$query1.') VALUES('.$types.','.$seotitle.','.$query_value.')';
//echo 'query 11'.$query11.'<br />';
//$query2 .= ')';
//$a=rtrim($query,',');
//echo'query 222 ='. $query2;
//$sql= substr($query2,0,-2);
//$que=$sql.')';
//echo 'query 333'.$sql.'<br />';
$result=$db->query($query11);
$seo_id= $db->insert_id;
if($result)
{
//echo 'Insert  Seo ';
}
else
{
//echo 'Not insert seo';
}
//echo '<br />';

//image uploader

$type_id=$insertid;
$image_height='142';
$image_width='168';
$upload=Image_upload($_FILES,$type_id,$type,$image_width,$image_height);
echo $upload;


}

function Image_upload($FILES,$seo_id,$type,$image_width,$image_height)
{
include_once('class.upload.php');

//echo gallery;
if(isset($_FILES['image']['name']))
{
$image_name= $_FILES['image']['name'];
if($image_name==TRUE)
{
$insert_id=$seo_id;
ini_set ( "memory_limit", "128M");
$a=file_exists($_SERVER["DOCUMENT_ROOT"].'/images/items/'.$type.'/');
if($a)
{
//echo'FILE EXISTS';
}
else
{
//echo'FOLODER NOT FOUND';
$folder=mkdir($_SERVER["DOCUMENT_ROOT"].'/images/items/'.$type, 0755);
}


	//echo'md5 '.$userfolder;

 $foo = new Upload($_FILES['image']['tmp_name']); 
 if ($foo->uploaded) {   
 // save uploaded image with no changes
 
   
 // save uploaded image with a new name 
 //$foo->file_new_name_body = 'foo';   
 //$foo->Process('./image/thumbnail');   
   
 // save uploaded image with a new name,  
 // resized to 100px wide 
 $foo->file_new_name_body = $insert_id; 
  //$a = mkdir(mainsite."/image/full/$section->seo_title/$seo_title", 0755);
 $foo->image_resize = true;  
  $foo->image_convert = 'jpg';   
  $foo->image_x = $image_width;  
  $foo->image_y = $image_height; 
  $foo->image_ratio_y = true;  
//$foo->image_background_color = '#FF00FF';
//$foo->image_watermark       = $_SERVER['DOCUMENT_ROOT'].'/images/1banner_frame.jpg';
 $foo->Process($_SERVER["DOCUMENT_ROOT"].'/images/items/'.$type);  
 if ($foo->processed) {   
 //echo 'image renamed, resized x=600 and converted to GIF<br />';    
 
 }

 

 
 
}
}
}
}
function Form_Update($type,$id,$seo_table=null)
{
	global $db;
/*	echo $type;

echo '<pre>';
print_r($_POST);	
echo '</pre>';*/
$userid=$_POST['userid'];
$column = $db->get_row("SHOW FULL COLUMNS FROM $type");
$last_value= $db->get_row("SELECT * FROM $type WHERE $column->Field='$id'");

$query = 'UPDATE '.$type.' SET ';

foreach($_POST as $key=>$value){
if($key!='submit' && $key!='SaveAndCont' && $key!='saveandclose' && $key!='table' && $key!='seo_table' && $key!='userid' && $key!='id' && $key!='sd_t' && $key!='sd_mt' && $key!='sd_mk' && $key!='sd_md')
{



if(is_array($value))
{
$array = '';
	foreach($value as $array1=>$arrayvalue){
	$array .= $arrayvalue.',';
	}
	//print_r($array);
	if(isset($array)){
	$value = $array;
	}

}

if($last_value->$key == $value)
{
//echo 'value :'.$last_value->$key.'<br />';
}
else
{
$date=date('Y-m-d, H:i:s');
//echo 'not value :'.$key.$last_value->$key.'new value'.$value.'<br />';
$original_value=$last_value->$key;
$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='$type' AND type_id='$id') AND(field_change='$key') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','$type','$id','$key','$original_value','$value','$date','$userid','$change_count')");
}
$query .=  $key.'='."'".$value."',";


 } }
 
 $sql= substr($query,0,-1);
 //echo'sql :'. $sql.'<br />';
$query12=$sql.' WHERE '.$column->Field.'='."'$id'";
//echo 'perfect query'.$query;
$query1= $query12;
//echo 'query 1 : ='.$query1.'<br />';
//$a=rtrim($query,',');
//echo'query 222 ='. $query2;
//$sql= substr($query2,0,-2);
//$que=$sql.')';

//echo '$id is:'.$id;
//echo 'query 333'.$sql.'<br />';
$update = $db->query($query1);
if($seo_table!='')
{
$table='seo_detail';
$seo=Seo_Form_Update($table,$id,$type);
}
if($update)
{
//echo 'update success ';
$update = '1';
return $update;

}
else
{
//echo 'Not update';
}
//  checking for update success. return value

}


function Form_Updatation($type,$id,$seo_table=null)
{
	
	global $db;
/*	echo $type;
echo '<pre>';
print_r($_POST);	
echo '</pre>';*/
$userid=$_POST['userid'];
$column = $db->get_row("SHOW FULL COLUMNS FROM $type");
$last_value= $db->get_row("SELECT * FROM $type WHERE $column->Field='$id'");

$query = 'UPDATE '.$type.' SET ';

foreach($_POST as $key=>$value){
if($key!='submit' && $key!='table' && $key!='seo_table' && $key!='userid' && $key!='id' && $key!='sd_t' && $key!='sd_mt' && $key!='sd_mk' && $key!='sd_md' && $key != 'update_tour_countrty')
{



if(is_array($value))
{
$array = '';
	foreach($value as $array1=>$arrayvalue){
	$array .= $arrayvalue.',';
	}
	//print_r($array);
	if(isset($array)){
	$value = $array;
	}

}

if($last_value->$key == $value)
{
//echo 'value :'.$last_value->$key.'<br />';
}
else
{
$date=date('Y-m-d, H:i:s');
//echo 'not value :'.$key.$last_value->$key.'new value'.$value.'<br />';
$original_value=$last_value->$key;
$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='$type' AND type_id='$id') AND(field_change='$key') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','$type','$id','$key','$original_value','$value','$date','$userid','$change_count')");
}
$query .=  $key.'='."'".$value."',";


 } }
 
 $sql= substr($query,0,-1);
 //echo'sql :'. $sql.'<br />';
$query12=$sql.' WHERE '.$column->Field.'='."'$id'";
//echo 'perfect query'.$query;
$query1= $query12;
//echo 'query 1 : ='.$query1.'<br />';
//$a=rtrim($query,',');
//echo'query 222 ='. $query2;
//$sql= substr($query2,0,-2);
//$que=$sql.')';
//echo 'query 333'.$sql.'<br />';
$update=$db->query($query1);
if($seo_table!='')
{
$table='seo_detail';
$seo=Seo_Form_Update($table,$id,$type);
}
if($update)
{
echo 'update success ';

}
else
{
echo 'Not update';
}




}


function Seo_Form_Update($table,$id,$type)
{
global $db;
//print_r($_POST);
$column = $db->get_row("SHOW FULL COLUMNS FROM $table");
$query = 'UPDATE '.$table.' SET ';

foreach($_POST as $key=>$value){
if($key =='sd_t' || $key =='sd_mt' || $key =='sd_mk' || $key =='sd_md')
{



$query .=  $key.'='."'".$value."',";



 } }
 
 $sql= substr($query,0,-1);
 //echo'sql :'. $sql.'<br />';
$query12=$sql.' WHERE sd_ty_id='."'$id'";
//echo 'perfect query'.$query;
$query1= $query12.' AND sd_ty='."'$type'";
//echo 'query 1 : ='.$query1.'<br />';
//$a=rtrim($query,',');
//echo'query 222 ='. $query2;
//$sql= substr($query2,0,-2);
//$que=$sql.')';
//echo 'query 333'.$sql.'<br />';
$update=$db->query($query1);
if($update)
{
//echo 'update success seo ';
$update = '1';
return $update;

}
else
{
//echo 'Not update';
}

//$file=$_SERVER["DOCUMENT_ROOT"].'/admin/seo_images/'.$type.'/'.$id.'.jpg';
@$read=fopen($_SERVER["DOCUMENT_ROOT"].'/frontsite_images/seo_images/'.$type.'/'.$id.'.jpg','r');
if(@$read)
{
//echo'<h1>IMAGE FOUND</h1>';
}
else
{

//echo'<h1>IMAGE NOT FOUND</h1>';
$sd= $db->get_row("SELECT * FROM seo_detail WHERE sd_ty_id='$id' AND sd_ty='$type'");
if($sd)
{
$seo_id=$sd->sd_id;
$image_height='142';
$image_width='168';
$upload=Image_upload($_FILES,$id,$type,$image_width,$image_height);
}
}


}
function getbutton($buttons)
{
	$buttonsnew = explode(',',$buttons);
	
	foreach($buttonsnew as $buttonnew){
		if($buttonnew =='1'){ ?><input value='Save' class='btn' name='submit' type='submit'>
		<?php } elseif($buttonnew == '2'){ ?>
			<input type='submit' class="btn btn-primary" value='Save and New' name='SaveAndCont'>
	<?php	}elseif($buttonnew == '3'){ ?>
			<input type='submit' class="btn btn-primary" id="saveclose" value='Save and Close' name='saveandclose'>
	<?php	}elseif($buttonnew == '4'){ ?>
			<input type='submit' class="btn btn-primary"  value='Skip/Close' name='close'>
	<?php	}
		else {};
	}

}
function delete($ids,$types) 
{
	global $db;
$idss = $ids;
$tablename = $types;
	$tableids = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
$ctid = $tableids->Field;
if($tablename == 'downloads')
{
$getrow = $db->get_row("SELECT * FROM $tablename WHERE $ctid = $idss");
$url = '../admin/component/downloads/documents/'.$getrow->d_t;
//echo $url;
$fp = fopen($url,'w') or die("can't open file");
if($fp)
{
unlink($url);
echo 'file deleted';	
}
	
}

$deleted = $db->query("DELETE FROM $tablename WHERE $ctid = $idss ");	
if($deleted)
{ 
  echo '<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Deleted Successfully!</strong></div>';
	}else{
 echo '<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Not Deleted!</strong></div>';
		}
	
	}
function display_details($tablename,	$tmpl,$id)
{
	global $db;
?>	
	<div class="row-fluid">
    <div class="block span12">    
	<?php
			if($id != null)
			{ ?>
				<?php 
						$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));				
				
				?>
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">View Deatils of  <?php echo $bar; ?></a>
        <div id="tablewidget" class="block-body collapse in">
			<table class="table table-bordered">
			
			<?php
				$getid = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
				if($tablename == 'menu_links')
				{
					$iid = 'm_id';
					$tablevalues = $db->get_results("SELECT * FROM $tablename WHERE $iid = $id");
					}else{
				$iid = $getid->Field;
				$tablevalues = $db->get_row("SELECT * FROM $tablename WHERE $iid = $id");
				}
		//	$tablevalues = $db->get_results("SELECT * FROM $tablename WHERE $iid = $id");
		$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename"); 
				
				?>
<tr>
<?php
//print_r($getcolms);
foreach($getcolms as $getcolm)
{ 
//print_r($getcolm);
$count = count($tablevalues); 
		 //echo $count;
		/* if($count > '1')
		 {
		 	 echo $field;
		 	 foreach($tablevalues as $tablevalue)
		 	 {
		 	 	print_r($tablevalue);
		 	 echo '<td>'.$tablevalue->$field.'</td>';
		 		}
		 	}else{ }*/
?>

<th><?php echo $getcolm->Comment; ?></th>

<?php } ?>
<th>Options</th>
</tr>				
				

<tr>
	<?php
	foreach($getcolms as $getcolm)
	{
		 $field = $getcolm->Field;
		
		 /*$count = count($tablevalues); 
		 echo $count;
		 if($count > '1')
		 {
		 	 //echo $field.'asdf';
		 	 	 	 	//print_r($tablevalues);
		 	 	 	foreach($tablevalues as $tablevalue)
			 	 {
					 	 //		 	 	print_r($tablevalue->$field);
					 	 echo '<td>'.$tablevalue->$field.'</td>';
					 	// break 1;
					 }
		 	}else{*/
?>

<td><?php echo $tablevalues->$field; ?></td>

<?php 
//}
} ?>

<td>
<?php if(isset($_GET['kind'])) 
{?>
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename; ?>&id=<?php echo $id; ?>" title="Edit <?php echo $tablename; ?>" ><i class="icon-edit"></i></a>
<?php }else{?>
<a href="../admin/add.php?type=<?php echo $tablename; ?>&tmpl=default&id=<?php echo $id; ?>" title="Edit <?php echo $tablename; ?>" ><i class="icon-edit"></i></a>
<?php } ?>
<!--<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=details&type=<?php echo $tablename; ?>&id=<?php echo $id; ?>&action=delete" title="Delete <?php echo $tablename; ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a>-->

<a href="#myModal<?php echo $id; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php if(isset($_GET['kind'])) 
{?>
        <a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=details&type=<?php echo $tablename ?>&id=<?php echo $id; ?>&action=delete" class="btn btn-danger" >Delete</a>
        <?php }else{?>
<a href="../admin/details.php?type=<?php echo $tablename; ?>&tmpl=default&id=<?php echo $id; ?>&action=delete" class="btn btn-danger" >Delete</a>
<?php } ?>
    </div>
</div>

</td>

<?php //	}  ?>
</tr>
</table>
</div>
<!-- </div> -->	
<?php	}?>    
 </div>
 </div>
	
<?php	} 
function view_table($tablename,$record)
{
	global $db;
$tableids = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
$ctid = $tableids->Field;
$idvalues = $db->get_results("SELECT $ctid FROM $tablename ");
$idcount = $db->get_var("SELECT COUNT(*) FROM $tablename");
//echo $idcount;

$values = $db->get_results("SELECT * FROM $tablename");
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");

 // include the pagination class
require '../admin/includes/Zebra_Pagination.php';

 // how many records should be displayed on a page?
 $records_per_page = $record;
        // instantiate the pagination object
        $pagination = new Zebra_Pagination();

        // the number of total records is the number of records in the array
        $pagination->records($idcount);

        // records per page
        $pagination->records_per_page($records_per_page);

        // here's the magick: we need to display *only* the records for the current page
        $countries = array_slice(
            $values,                                             //  from the original array we extract
            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
            $records_per_page                                       //  this many records
        );
?>	
	<table class="table table-bordered" class="countries" >

<?php

//$colms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
?>


<tr>
<?php
//print_r($getcolms);
foreach($getcolms as $getcolm)
{ 

$mystring2 = $getcolm->Field;
$findme2   = '_d';
$pos2 = strpos($mystring2, $findme2);
if($pos2 === false )
{
//echo 'not found';	
	

//print_r($getcolm->Field);
$mystring = $getcolm->Field;
$findme   = '_id';
$pos = strpos($mystring, $findme);

if ($pos === false) 
{ ?>
<th><?php echo $getcolm->Comment; ?></th>
    
<?php
} else {
												?>
<th>											
				<?php	
	if($getcolm->Field == $ctid)
	{
		echo $getcolm->Comment;
	}else{
			//	print_r($getcolm->Field);
				$field12 = $getcolm->Field;
									
										foreach($db->get_col("SHOW TABLES", 0) as $table_name)
										{
														if($table_name != $tablename)
														{
															$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field' AND Extra = 'auto_increment' ");
															//echo $getfirstcolumn;
																if($getfirstcolumn)
																{
																	
																//print_r($getfirstcolumn);
																	$getresults = $db->get_results("SHOW FULL COLUMNS FROM $table_name ");
																	foreach($getresults as $getresult)
																	{
																		//echo $field12;
																		echo $getresult->Comment;
																		//echo '<pre>';
																		//print_r($getresult);
																		//echo '</pre>';
																		
																		break 1;
																		}
					
																	}
														}
										}

   // echo "The string '$findme' was found <br />";
  }
  ?>
</th>
<?php
 }
 
 }else {
		//echo 'found'.$getcolm->Field.'<br />';
		$description = $getcolm->Field;
	} 
//print_r($getcolm);
?>

<!-- <th><?php echo $getcolm->Comment; ?></th> -->

<?php } ?>
<th>Options</th>
</tr>

 <?php 
  set_time_limit(200);

foreach ($countries as $index => $country)
{

foreach($values as $val)
{ 

?>
<tr>
	<?php
	$asd = '';

foreach($getcolms as $getcolm)
{
	$mystring22 = $getcolm->Field;
	//echo $mystring22;
	$findme22   = '_d';
	$pos22 = strpos($mystring22, $findme22);
	if($pos22 === false ) //remove description colm
	{
		//echo 'hi';
		//print_r($getcolm);
		$field = $getcolm->Field;
		//echo $field;
		$mystring = $val->$field;
		$findme   = ',';
		$pos = strpos($mystring, $findme);
		if ($pos === false) 
		{ 
//echo $index % 2 ? ' class="even"' : ''	;	
//print_r($country);
				if($idcount > 10)
				{	
	
		?>
		
		    <td><?php echo $country->$field; ?></td>
		    <?php }else{
		    	?>
		    	
		    <td><?php echo $country->$field; ?></td>
		 <?php }?>
		<?php } else {
			//echo 'array found';
			$rtrim = rtrim($country->$field, ','); 
								if($rtrim != null)
								{
								$catsss = explode( ',', $rtrim);
 // how many records should be displayed on a page?
 $records_per_page = 5;
        // instantiate the pagination object
        $pagination = new Zebra_Pagination();

        // the number of total records is the number of records in the array
        $pagination->records($idcount);

        // records per page
        $pagination->records_per_page($records_per_page);

        // here's the magick: we need to display *only* the records for the current page
        $countries = array_slice(
            $values,                                             //  from the original array we extract
            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
            $records_per_page                                       //  this many records
        );								
								
								
								?>	<td><?php
														foreach($catsss as $cats)
														{
																				//print_r($cats);
																				$mystring1 = $getcolm->Field;
																				$findme1   = '_id';
																				$pos1 = strpos($mystring1, $findme1);
																				
																				
																				
																				if ($pos1 === false) 
																				{
																				   //echo "The string was not found in the string '$mystring1' <br />";
																				}else 
																				{
																								if($getcolm->Field != $ctid)
																								{
																							
																								//print_r($getcolm->Field);
																																//echo 'id is'.$getcolm->Field	;	
																										$cid = $getcolm->Field	;
																										foreach($db->get_col("SHOW TABLES", 0) as $table_name)
																										{
																														if($table_name != $tablename) //tablename not equal to get table nAME 
																														{
																															$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field' AND Extra = 'auto_increment' ");
																													
																																if($getfirstcolumn)
																																{
																																			$id = $getfirstcolumn->Field;
																																			$getrows = $db->get_results("SHOW FULL COLUMNS FROM $table_name");
																																	foreach($getrows as $getrow)
																																	{
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
																																									//echo $name;
																																									//echo 'name is'.$name;
																																									//echo $cats;
																																									//echo $table_name;
																																									$getnamess = $db->get_results("SELECT * FROM $table_name ");
																																									//$getnames = $db->get_row("SELECT * FROM $table_name WHERE $name = '$cats' ");
																																								if($getnamess)
																																								{		
																																								foreach($getnamess as $getname)
																																								{
																																								//	echo 'hi';
																																									//echo $getname->$cid;
																																									
																																									if($getname->$cid == $cats)
																																									{ 																																									
																																								
																																													 echo $getname->$name.','; 
																																							
																																								
																																									//print_r($getname);
																																										//break 1;	
																																									}
																																																																					
																																									}
																																																														
																																									//echo $getnames->$name;
																																									}
																																																																									
																																									//print_r($getnames);
																																									//echo $getnames->$name;
																																									//echo $getnames->$name;
																														//											echo $getrow->Field;
																																									}
																																		}  //print_r($asd);		
																																	//print_r($getrow);
																																		$cats1 = $db->get_row("SELECT * FROM $table_name WHERE $getcolm->Field = '$cats'");
																														//print_r($cats1);
																				break 1;										
																														
																														} // end $getfirstcolm 
																														} //check table name 
																														} //foreach show all tables 
																				
																				    //echo "The string '$findme' was found <br />";
																				 }			//getcolm if close	
																		}   //pos1 else close
														//echo $cats.'<br />';
														} //foreach catsss close
														
						//	}
			
			?>
			<!-- <td><?php echo $rtrim; ?></td>  -->
						</td>
<?php 

}else{
echo '';	
	}

}	//else closedelete($ctid,$tablename)
	
}else{
//echo 'found'.$getcolm->Field.'<br />'		;
		} //pos close

}//foreach close
?>

<td>


<?php
if(isset($_GET['type']) == 'tour')
{
?>	
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename ?>&t_id=<?php echo $country->$ctid; ?>&insert=1" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>	
	<?php }else{
?>
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename ?>&id=<?php echo $country->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>
<?php  } ?>



<!-- <a href="" ><i class="icon-plus"></i></a> -->
<!--<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=edit&type=<?php echo $tablename ?>&id=<?php echo $country->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>-->
<a href="#myModal<?php echo $country->$ctid; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $country->$ctid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div>


<!-- 
<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" title="Delete <?php echo $tablename ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a> -->
<a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a>
</td>
<?php

break 1;
	}// foreach country
?>	
	
	<?php
} ?>
<?php 
$ctid = $tableids->Field;
$idvalues = $db->get_results("SELECT $ctid FROM $tablename");
?>


</tr>

</table>	
<?php
       // render the pagination links
        $pagination->render();
        ?>

<?php	} 
function admin_change_count($type,$field,$id)
{
global $db;

$admin_change= $db->get_results("SELECT * FROM admin_change WHERE (type='$type' AND type_id='$id') AND (field_change='$field')");
	$count=count($admin_change);	
	if($count=='0')
	{
	$value='';
	return $value;
	}
	else
	{
	return $count;
	}
}
function admin_change_display($type,$field,$id)
{
global $db;
				$count=admin_change_count($type,$field,$id);
				if($count!='')
				{
				$html='';
$admin_change= $db->get_results("SELECT * FROM admin_change WHERE (type='$type' AND type_id='$id') AND (field_change='$field')");

?>
<!-- Button to trigger modal -->
<?php
	$title = $db->get_row("SHOW FULL COLUMNS FROM $type WHERE Field ='$field'");
$html.="<a href='#myModal$field$id' role='button' class='btn' data-toggle='modal'>View History</a>";
 
 ?>
<!-- Modal -->

<div id="myModal<?php echo $field.$id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>
	<table class="table">
	<?php
	if($type=='batch_fee')
	{
	$batch_fee= $db->get_row("SELECT * FROM batch_fee WHERE bf_id='$id'");
	$batch_charges= $db->get_row("SELECT * FROM batch_charges_type WHERE bc_id='$batch_fee->bc_id'");
	?>
	
	<h3><?php echo $batch_charges->bc_ty;?></h3>
	<?php
	}
	?>
		<?php
	if($type=='discount_value')
	{
	$discount_value= $db->get_row("SELECT * FROM discount_value WHERE dv_id='$id'");
	$discount_type= $db->get_row("SELECT * FROM discount_type WHERE dt_id='$discount_value->dt_id'");
	?>
	
	<h3><?php echo $discount_type->dt_ty;?></h3>
	<?php
	}
	?>
	
	<tr><th>Original <?php //$html.= $title->Comment;?></th><th>Change <?php //$html.= $title->Comment;?></th><th>date</th><th>username</th></tr>
	<?php $original='';
	foreach($admin_change as $ad_change)
	{
	if($field=='dest_id')
	{
	$dest_id=explode(',',$ad_change->original);
	foreach($dest_id as $destid)
	{
	if($destid!='')
	{
	$tour= $db->get_row("SELECT * FROM tour WHERE t_id='$destid'");
	if($tour)
	{
	$original.=$tour->t_t.','; 
	}
	}
	}
	$org_value=explode(',',$original);
	$unique=array_unique($org_value);
	//print_r($unique);
	$org_id='';
	foreach($unique as $unique_id)
	{
	if($unique_id!='')
	{
	$org_id.='<li>'.$unique_id.'</li>';
	}
	}
	}
	else
	{
	$org_id.=$ad_change->original;
	
	}
	?>
	
	
	<?php
	
	if($field=='dest_id')
	{
	$change='';
	$org_id_change='';
	$dest_id=explode(',',$ad_change->change);
	foreach($dest_id as $destid)
	{
	if($destid!='')
	{
	$tour= $db->get_row("SELECT * FROM tour WHERE t_id='$destid'");
	if($tour)
	{
	$change.=$tour->t_t.','; 
	}
	}
	}
	$org_value=explode(',',$change);
	$unique=array_unique($org_value);
	//print_r($unique);
	
	foreach($unique as $unique_id)
	{
	if($unique_id!='')
	{
	$org_id_change.='<li>'.$unique_id.'</li>';
	}
	}
	}
	else
	{
	$org_id_change.=$ad_change->change;
	
	}
	?>
	
	<?php
	
	if($field=='instructer_id')
	{
	$original_instructer_id='';
	$instructer_id=explode(',',$ad_change->original);
	foreach($instructer_id as $destid)
	{
	if($destid!='')
	{
	$instructor_original= $db->get_row("SELECT * FROM instructor WHERE i_id='$destid'");
	if($instructor_original)
	{
	$original_instructer_id.=$instructor_original->i_ty.','; 
	//$original_instructer_id.=$destid.',';
	}
	}
	}
	$org_value=explode(',',$original_instructer_id);
	$unique=array_unique($org_value);
	//print_r($unique);
	$org_id='';
	foreach($unique as $unique_id)
	{
	if($unique_id!='')
	{
	$org_id.='<li>'.$unique_id.'</li>';
	}
	}
	}
	?>

		<?php
	
	if($field=='instructer_id')
	{
	$change='';
	$org_id_change='';
	$dest_id=explode(',',$ad_change->change);
	foreach($dest_id as $destid)
	{
	if($destid!='')
	{
	$instructor= $db->get_row("SELECT * FROM instructor WHERE i_id='$destid'");
	if($instructor)
	{
	$change.=$instructor->i_ty.','; 
	}
	}
	}
	$org_value=explode(',',$change);
	$unique=array_unique($org_value);
	//print_r($unique);
	
	foreach($unique as $unique_id)
	{
	if($unique_id!='')
	{
	$org_id_change.='<li>'.$unique_id.'</li>';
	}
	}
	}
	?>
	
	<?php
	if($field=='pc_id')
	{
	$pre_camp_original= $db->get_row("SELECT * FROM pre_camp_venue WHERE pc_id='$ad_change->original'");
	$org_id= $pre_camp_original->pc_t;
		$pre_camp_change= $db->get_row("SELECT * FROM pre_camp_venue WHERE pc_id='$ad_change->change'");
			$org_id_change= $pre_camp_change->pc_t;
	}
	
	?>
	<?php
	if($field!='dest_id' && $field!='instructer_id' && $field!='pc_id')
	{
	$org_id=$ad_change->original;
	$org_id_change= $ad_change->change;
	}
	
	?>
	
	<tr><td><?php echo $org_id;?></td><td><?php echo $org_id_change;?></td><td><?php echo $ad_change->ac_date_time;?></td><td><?php echo $ad_change->ad_id;?></td></tr>
	<?php
	
	}
	
	?>
	</table>
	</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>
<?php
return $html;
}
}
function configure($tablename)
{
if(isset($_POST['config']))
{
$values = $_POST;
$c = count($_POST);
	//echo $c;
$d = +($c-1);
 $outputs = array_slice($values, 0, $d);;
	//print_r($asd);
//mkdir('../admin/config', 0777);
$fp = fopen("../admin/config/".$_GET['type'].".php","w"); 
if($fp)
	{
		fwrite($fp,'<?php ');
			//echo 'file open';
			}
foreach($outputs as $output)
{
	if($fp)
	{
			echo 'file open';
			
			fwrite($fp,$output.';');
		}else{
echo 'file not open';			
			}
	
	}		
		if($fp)
	{
		fwrite($fp,'?> ');
	}	

	}
	
	
//$tablename = $_GET['type'];
$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));	
?>
<a href="#myModal" role="button" class="btn" data-toggle="modal">Configure <?php echo $bar; ?></a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<?php 
$getcomponents = $db->get_results("SELECT * FROM component");
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Configure <?php echo $bar ?></h3>
</div>
<div class="modal-body">


<?php foreach($getcomponents as $getcomponent)
{
?>	
<div class="space1">
<label><?php echo $getcomponent->comp_t ?></label>
<input type="radio" value="<?php echo '$'.$getcomponent->comp_t.'= yes '; ?>"  name="<?php echo $getcomponent->comp_t; ?>" />
<input type="radio" value="<?php echo '$'.$getcomponent->comp_t.'= no ';?>"  name="<?php echo $getcomponent->comp_t; ?>" />
</div>
<?php }?>

</div>


<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<input type="submit" name="config" class="btn btn-primary">Save changes</button>
</div>
</div>
<?php } 
function view_table1($tablename,$record)
{
	global $db;
$tableids = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
//print_r($tableids);
$ctid = $tableids->Field;
$Comment = $tableids->Comment;


$idcount = $db->get_var("SELECT COUNT(*) FROM $tablename");
//echo $idcount;

$values = $db->get_results("SELECT * FROM $tablename");
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");

 // include the pagination class
require '../admin/includes/Zebra_Pagination.php';

 // how many records should be displayed on a page?
 $records_per_page = $record;
        // instantiate the pagination object
        $pagination = new Zebra_Pagination();

        // the number of total records is the number of records in the array
        $pagination->records($idcount);

        // records per page
        $pagination->records_per_page($records_per_page);

        // here's the magick: we need to display *only* the records for the current page
        $countries = array_slice(
            $values,                                             //  from the original array we extract
            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
            $records_per_page                                       //  this many records
        );
        
        $colms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
        //print_r($colms);
$cols = array("_id", "_t");
?>
<table class="table table-bordered" class="countries" >
<tr> 
<th><?php echo $Comment; ?></th>
<?php
foreach ( $colms as $colm )
{

$mystring2 = $colm->Field;
$findme2   = '_t';
$pos2 = strpos($mystring2, $findme2);
if($pos2 === false )
{
	//echo 'not present </br>';
	
}else{
	$title1 = $colm->Field;
	?>
<th><?php	echo $title = $colm->Comment; ?></th>
	
<?php	} 
	}      
?>
<th>Options</th>	
</tr>
 


<?php
//echo 'title is :'.$title1;
//echo 'id is :'.$ctid;

	global $db;
	$colmnames = array($ctid, $title1);
foreach ($countries as $index => $country)
{
foreach($values as $val)
{ 
foreach ($getcolms as $getcolm)
{
		$field = $getcolm->Field;
?>
<tr>
<?php		
if(in_array($field, $colmnames))
{
		$field = $getcolm->Field;
		//echo $field;
if($field = $ctid)
{
?>
	<td><?php echo $country->$ctid; ?></td>
	<?php
	}?>
	
<?php if($field = $title1)	{
		//echo $val->$title1;
		?>
		<td><?php echo $country->$title1; ?></td>
<?php }
?>
<td>
<?php
if(isset($_GET['kind']))
{ 
if(isset($_GET['type']) == 'tour')
{
?>	
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename ?>&t_id=<?php echo $country->$ctid; ?>&insert=1" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>	
	<?php }else{
?>
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=add&type=<?php echo $tablename ?>&id=<?php echo $country->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>
<?php  } 
}else{?>
<a href="../admin/add.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" title="Edit <?php echo $tablename ?>" ><i class="icon-edit"></i></a> 
<?php }?>
<a href="#myModal<?php echo $country->$ctid; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $country->$ctid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?php
if(isset($_GET['kind']))
{ ?>
        <a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=view&type=<?php echo $tablename ?>&id=<?php echo $country->$ctid; ?>&action=delete" class="btn btn-danger" >Delete</a>
					<?php }else{?>        
        <a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>&action=delete" class="btn btn-danger" >Delete</a>
							<?php }?>    
    </div>
</div>


<!-- 
<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" title="Delete <?php echo $tablename ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a> -->
<?php
if(isset($_GET['kind']))
{ ?>
<a href="index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=details&type=<?php echo $tablename ?>&id=<?php echo $country->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a>
<?php }else{?>
<a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $country->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a> 
<?php }?>
</td>
	<?php
break 1;	
	}
else{}	
?>

</tr>
<?php
	 //in array close
}
break 1;
}

}

?>

</table>
	
<?php
       // render the pagination links
        $pagination->render();
        ?>

<?php	} 
function Display_item()
{
global $db;
?>

<link rel="stylesheet" href="http://thoughtfulviewfinder.in/demo/admin/css/colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://thoughtfulviewfinder.in/demo/admin/js/jquery.colorbox.js"></script>
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
<?php
					$gallery= $db->get_results("SELECT * FROM gallery WHERE g_status='show'");
					if($gallery)
					{
					$image_id='';
					foreach($gallery as $images)
					{
					//$image= $db->get_results("SELECT * FROM images WHERE g_id='$images->g_id'");
					$folder_name= $db->get_row("SELECT * FROM gallery WHERE g_id='$images->g_id'");
					$image_gallery= $db->get_row("SELECT * FROM image_gallery_link WHERE g_id='$images->g_id'");
				$image= $db->get_results("SELECT * FROM images WHERE g_id='$images->g_id' AND im_status='show'");
				if($image)
				{
				foreach($image as $img)
				{
				$image_id.=$img->im_id.',';
				?>
				
           <!--
              <li class="span4">
                <div class="thumbnail">
				
                  <img data-src="holder.js/300x200" alt="300x200" src="<?php //echo component.'photogallary/'.$folder_name->g_folder.'/thumbnail/'.$img->im_id;?>.jpg" height='120' width='200' class='img-polaroid'>
                
			

				<div class="caption">
                    <b>Title Image :
                    
					<?php //echo $img->im_title;?></b><br />
					
                 <b>   Image Status :
                 
					<?php //echo $img->im_status;?></b><br />
					<b>   Gallery Title :
                 
					<?php //echo $folder_name->g_title;?></b><br />
				   
				   		 <center>
				    <p><a class="group3" href="<?php //echo component.'photogallary/'.$folder_name->g_folder.'/full/'.$img->im_id;?>.jpg" title="On the Ohoopee as an adult"><span class="label label-info">Preview</span></a>
						<?php
					//$im_id=$img->im_id;
					//$folder=$folder_name->g_folder;
					//$show=Delete_image($im_id,$folder);
					?>
					
					<?php //echo $show;?>
					
					<a href='./index.php?img_id=<?php// echo $img->im_id;?>&folder=<?php //echo $folder_name->g_folder;?>'><span class="label label-important">Delete</span></a>
				 <a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php //echo $image_gallery->type;?>&id=<?php //echo $image_gallery->type_id;?>&step=3'><span class="label label-primary">Edit</span></a>
				 </center>
					
                  </div>
                </div>
              </li>  
			 !-->
           

				<?php
				
				}	
				
				}
					
					}
					
					}
					?>
					
					
     

        <?php
$img_id= explode(',',$image_id);
        // let's paginate data from an array...
        //$countries = array('1','2','3','4');
		$countries =$img_id;

        // how many records should be displayed on a page?
        $records_per_page = 4;
 
        // include the pagination class
     require '../admin/includes/Zebra_Pagination.php';

        // instantiate the pagination object
        $pagination = new Zebra_Pagination();

        // the number of total records is the number of records in the array
        $pagination->records(count($countries));

        // records per page
        $pagination->records_per_page($records_per_page);

        // here's the magick: we need to display *only* the records for the current page
        $countries = array_slice(
            $countries,                                             //  from the original array we extract
            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records
            $records_per_page                                       //  this many records
        );

        ?>

        <table class="countries" border="1">

        	<div class='span12'>

            <?php foreach ($countries as $index => $country):?>
			<?php if($country!='')
			{
			?>

  
			
			<?php
$image_title= $db->get_row("SELECT * FROM images WHERE im_id='$country' AND im_status='show'");		
$folder_name= $db->get_row("SELECT * FROM gallery WHERE g_id='$image_title->g_id' AND g_status='show'");	
			?>
			
			
                
			       <tr<?php echo $index % 2 ? ' class="even"' : ''?>> </tr>
			     <?php //echo $country;?>
				 
				   <li class="span4 offset-2">
                <div class="thumbnail">
				
                  <img data-src="holder.js/300x200" alt="300x200" src="<?php echo component.'photogallary/'.$folder_name->g_folder.'/thumbnail/'.$country;?>.jpg" height='120' width='200' class='img-polaroid'>
                
			

				<div class="caption">
                    <b>Title Image :
                    
					<?php echo $image_title->im_title;?></b><br />
					
                 <b>   Image Status :
                 
					<?php echo $image_title->im_status;?></b><br />
					<b>   Gallery Title :
                 
					<?php //echo $folder_name->g_title;?></b><br />
				   
				   		 <center>
				    <p><a class="group3" href="<?php echo component.'photogallary/'.$folder_name->g_folder.'/full/'.$country;?>.jpg" title="On the Ohoopee as an adult"><span class="label label-info">Preview</span></a>
						<?php
					$im_id=$img->im_id;
					$folder=$folder_name->g_folder;
					$show=Delete_image($country,$folder);
					?>
					
					<?php echo $show;?>
					
					<!--<a href='./index.php?img_id=<?php //echo $img->im_id;?>&folder=<?php //echo $folder_name->g_folder;?>'><span class="label label-important">Delete</span></a>!-->
				 <a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $image_gallery->type;?>&id=<?php echo $image_gallery->type_id;?>&step=3'><span class="label label-primary">Edit</span></a>
				 </center>
					
                  </div>
                </div>
              </li> 
			  
				  
           
			<?php
			}
			?>

            <?php endforeach?>
			</div>

        </table>
  	<div class='span12'>
        <?php

        // render the pagination links
        $pagination->render();

        ?>
		</div>

    </body>

</html>
<?php


}
function Delete_image($im_id,$folder)
{

?>

<a href="#myModal<?php echo $im_id;?>" role="button" data-toggle="modal"><span class="label label-important">Delete</span></a>
 
<!-- Modal -->
<div id="myModal<?php echo $im_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"> Delete Image</h3>
  </div>
  <div class="modal-body">
    <p>
	
	<img data-src="holder.js/300x200" alt="300x200" src="<?php echo component.'photogallary/'.$folder.'/thumbnail/'.$im_id;?>.jpg" height='120' width='200' class='img-polaroid'>
	</p>
  </div>
  <div class="modal-footer">
  <center>
    <a href='./index.php?img_id=<?php echo $im_id;?>&folder=<?php echo $folder;?>' class='btn btn-primary'>Yes</a>
  <button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
	</center>
  </div>
</div>
<?php
}
?>
<?php
function head()
{
if(isset($_GET['option']) && isset($_GET['kind']))
{
?>
		<a href="./index.php?option=component&kind=videogallery&method=config">Config </a>|
		<a href="./index.php?option=component&kind=videogallery&method=gallery&process=view&id=all">Galleries</a>|
		<a href="./index.php?option=component&kind=videogallery&method=items&process=view&id=all">Videos</a> 
		<?php
}
}?>
<?php
function head1()
{
if(isset($_GET['option']) && isset($_GET['kind']))
{
?>
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=config">Config </a>|
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=add">Upload File</a>|
			<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=add_category">Add Download Category</a>|
			<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=view_category" >View All Download Category</a>|
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=view">View all files</a>		
		<?php
}
}	
?>
<?php
function head2()
{
if(isset($_GET['option']) && isset($_GET['kind']))
{
?>
		<!--<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=config">Config </a>|-->
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=manager&process=add&type=article_category">Add Category </a>|
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=manager&process=add&type=article_table">Add Article</a>|
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=manager&process=view&id=all&type=article_table">View all Articles</a>| 
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=manager&process=view&id=all&type=article_category">View all Category</a> 
		<?php
}
}?>
<?php
function head11()
{
if(isset($_GET['option']) && isset($_GET['kind']))
{
?>
		<!--<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=config">Config </a>|
		<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=add">Upload File</a>|
			<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=add_category">Add Download Category</a>|
			<a href="./index.php?option=component&kind=<?php echo $_GET['kind']; ?>&method=files&process=view_category" >View All Download Category</a>|-->
		<a href="./index.php?option=component&kind=batch&method=batch&process=view&type=batch_table">View all Batches</a>	|
		<a href="./index.php?option=component&kind=category&method=category&process=view&type=category">View all Categories</a>	|	
		<a href="./index.php?option=component&kind=destination&method=destination&process=view&type=destination">View all Destination</a>|		
		<a href="./index.php?option=component&kind=tour&method=tour&process=view&type=tour">View all Tour</a>	|	
		<a href="./index.php?option=component&kind=country&method=country&process=view&type=country">View all Countries</a>	|	
		<a href="./index.php?option=component&kind=discount_type&method=discount_type&process=view&type=discount_type">View all Discount Type</a>	|	
		<a href="./index.php?option=component&kind=batch_charges_type&method=batch_charges_type&process=view&type=batch_charges_type">View all Batch Charges Type</a>	|	
		<a href="./index.php?option=component&kind=instructor&method=instructor&process=view&type=instructor">View all Instructor</a>	|	
		<a href="./index.php?option=component&kind=instructor_type&method=instructor_type&process=view&type=instructor_type">View all Instructor Type</a>	|	
		<a href="./index.php?option=component&kind=pre_camp_venue&method=pre_camp_venue&process=view&type=pre_camp_venue">View all Pre Camp Venue</a>	|	
		<a href="./index.php?option=component&kind=currency&method=currency&process=view&type=currency">View all Currency Type</a>	|	
		<!--<a href="./index.php?option=component&kind=pre_camp_value&method=pre_camp_value&process=view&type=pre_camp_value">View all Pre Camp Value</a>	|-->	
		<?php
}
}	
?>
<?php
function head_set()
{ ?>
<a href="./index.php?option=component&kind=slideshow&method=image&process=add">Add Images</a>|
<a href="./index.php?option=component&kind=slideshow&method=sets&process=view&id=all">View all Sets</a>
<?php
}

function Delete_imageSlideshow($im_id,$folder)
{
?>
<a href="#myModal<?php echo $im_id;?>" role="button" data-toggle="modal"><span class="label label-important">Delete</span></a>
 
<!-- Modal -->
<div id="myModal<?php echo $im_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"> Delete Image</h3>
  </div>
  <div class="modal-body">
    <p>
	
	<img data-src="holder.js/300x200" alt="300x200" src="../admin/component/slideshow/<?php echo $folder.'/'.$im_id;?>.jpg" height='120' width='200' class='img-polaroid'>
	</p>
  </div>
  <div class="modal-footer">
  <center>
    <a href='./index.php?si_id=<?php echo $im_id;?>&imagefolder=<?php echo $folder;?>' class='btn btn-primary'>Yes</a>
  <button type="button" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
	</center>
  </div>
</div>
<?php
}
?>