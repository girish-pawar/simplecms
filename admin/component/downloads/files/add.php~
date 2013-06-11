<?php
ini_set('upload_max_filesize','20M');
include_once('../admin/includes/defination.php');
include_once('../admin/component/downloads/config.php');
global $db;

head1();

function uploaddoc($files,$types,$id,$link,$servicetype,$typ)
{
	include_once('../admin/component/downloads/config.php');
	global $db;
	$file = $_FILES[$files];

	$filename = $file['name'];
	$type = $file['type'];
	$tmppath =$file['tmp_name'];
	$size =$file['size'];
	$date = date("Y-m-d H:i:s");  
	//$filename = $id.'.jpg';
if($filename != '')
{
$type1 = explode('/',$type);
$stypes = explode(',',$servicetype);
$type2 = end($type1);
echo 'type2 = '.$type2;

foreach ($stypes as $value)
{
if($type2 == $value)
{
echo 'type match';	
$location = '../admin/component/downloads/documents/'.$filename;
$check=move_uploaded_file($tmppath, $location);		

if($check)
{
	
	echo $typ;
if($typ == 'insert')	
	{
		
		if(isset($_GET['ty_id']) && isset($_GET['type']))
	{
	$ty = $_GET['type'];
	$iid = $_GET['ty_id'];
		}else{
	$ty = null;
	$iid = null;
			}
//$ty = $_GET['type'];		
//$iid = $_GET['ty_id'];
$dcid = $_POST['dc_id'];
$insert = $db->query("INSERT into downloads values ('','$dcid','$filename','$link')");
$id1 = $db->insert_id;
$insert1 = $db->query("INSERT into downloads_type values ('','$ty','$iid','$id1')");
}elseif($typ == 'update'){
$insert = $db->query("UPDATE downloads SET d_t = '$filename' , d_link = '$link' WHERE d_id = '$id'");	
	}else{}
	
	
if($insert)
{echo 'insert success file upload';
}else {
echo 'not insert';	
	}
	
	}else {
echo ' file not upload';
}

}else{
		echo 'type not match';
		}

	}
	
}

}

if(isset($_GET['vid']))
{
$tablename= $_GET['kind'];
$id = $_GET['vid'];

}else{
$id = null;	
	}

if(isset($_GET['vid']) && isset($_GET['action']))
{
$tablename = 'downloads';
$idss = $_GET['vid'];
$getrow = $db->get_row("SELECT * FROM $tablename WHERE d_id = '$idss' ");
$url = '../admin/component/downloads/documents/'.$getrow->d_t;
//echo $url;
$fp = fopen($url,'w') or die("can't open file");
if($fp)
{
$deleted = unlink($url);
echo $deleted;
echo 'file deleted';
}else{
echo 'file not deleted';	
	}
	
}



if(isset($_POST['submitdoc']))
{	
//print_r($_POST);
	$docname = 'doc';
	$types = $_GET['process'];
	if(isset($_GET['ty_id']) && isset($_GET['type']))
	{
	$id = $_GET['ty_id'];		
		}else{
	$id = null;			
			}

	$link	= $_POST['link'];
	$typ = 'insert';
	uploaddoc($docname,$types,$id,$link,$servicetype,$typ);
}

if(isset($_POST['updatedoc']))
{	
//print_r($_POST);
	$docname = 'doc';
	$types = $_GET['process'];
	$id = $_GET['id'];
	$link	= $_POST['link'];
	$typ = 'update';
	uploaddoc($docname,$types,$id,$link,$servicetype,$typ);
}

?>

<?php if($id != null){
$getrow = $db->get_row("SELECT * FROM $tablename WHERE d_id = '$id'");
}
?>

<form method="post" enctype="multipart/form-data">		
<?php
global $db;
$getlists = $db->get_results("SELECT * FROM downloads_category");
?>
Select Download Category:<select name="dc_id">  
<?php
if($getlists)
{
	foreach($getlists as $getlist)
	{
?>
<option value="<?php echo $getlist->dc_id; ?>"><?php echo $getlist->dc_t; ?></option>
<?php
}
}
?>
</select>

<?php 
if(isset($deleted) || isset($_GET['ty_id']))
{ ?>	
					<div class="space">
					Select document:
					<input type="file" name="doc" value="<?php if($id != null){ echo $getrow->d_t;}else{} ?>" />
					</div>
					<?php }  ?>
					<div class="space1">
					Enter Link Name:
	 		 		<input type="text" name="link" value="<?php if($id != null){ echo $getrow->d_link;}else{} ?>" />
	 		 	</div>
	 		 
<?php
if($id != null){ 
if(!$deleted)
{
	$url = '../admin/component/downloads/documents/'.$getrow->d_t; 
if(is_file($url))
{
?>
	<a href="../admin/component/downloads/documents/<?php echo $getrow->d_t; ?>" ><?php echo $getrow->d_link; ?></a>
	<a href="../admin/index.php?option=component&kind=<?php echo $_GET['kind'];?>&method=<?php echo $_GET['method']; ?>&process=add&vid=<?php echo $id; ?>&action=delete" class="btn btn-danger" >Delete old file</a>
	<?php }else{ ?>
<p>Old File is deleted.</p>
	<a href=""><?php echo $getrow->d_link; ?></a>
	<div class="space">
					Upload New File:
					<input type="file" name="doc" value="<?php if($id != null){ echo $getrow->d_t;}else{} ?>" />
					</div>
	<?php } ?>
 
 <?php } ?>
<input type="submit" name="updatedoc" value="Update">
<?php }else{ 
if(!isset($_GET['type']) && !isset($_GET['ty_id']))
{
?>	 
		 		
	<div class="space">
					Upload New File:
					<input type="file" name="doc" value="<?php if($id != null){ echo $getrow->d_t;}else{} ?>" />
				</div>
				<?php } ?>
<input type="submit" name="submitdoc" value="Submit">	 		 		
	 		 		 <?php } ?>
			</div>
			
				
		</form>