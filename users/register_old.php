<?php
if(isset($_GET['id']))
{
	

require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.html");
   }
}


	
include_once('../admin/includes/function.php');
include_once('../admin/includes/defination.php');
include_once('../admin/includes/tinymce.php');
global $db;
global $pixels;
//$userinfo = UserInfo($_SESSION['username']);

/*
$date = date('dmYHis');
$rid = $_SESSION['username'].$date;
$memberid = $rid;
	

if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){
    //echo 'User resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
    $width = $_SESSION['screen_width'];
    $height = $_SESSION['screen_height'];
    $pixels = $width*$height;
    echo $pixels;
} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
    $_SESSION['screen_width'] = $_REQUEST['width'];
    $_SESSION['screen_height'] = $_REQUEST['height'];
    //header('Location: ' . $_SERVER['PHP_SELF']);
} else {
	echo '';
    //echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
}
*/

if($_GET)
{
if(isset($_GET['id']))
{
$rid = $_GET['id'];	
}else {
	$rid = null;
}	
	
}



if($_POST)
{
	
if(isset($_POST['submituser']))
{
	print_r($_POST);
$fieldsarray = $_POST['fieldsarray'];
//$gid = $fieldsarray['13'];
//echo $gid;
//$username = $_SESSION['username'];
$date1 = date('m/d/Y h:i:s', time());

$rid = $_GET['id'];
$newname = $rid.'.jpg';


foreach($fieldsarray as $key=>$value)
{
$insert = $db->query("INSERT INTO field_data VALUES('','$key','$rid','$value','')");
}

if($insert)
{
echo 'form submit';	
}
else{
echo 'form not submit';	
	}

//$userlevel = $userinfo->user_level;
if($userlevel == 0)
{
//header('location:view.php?id='.$gid.'&type=groupmembers');
}
else{
	header('location:menu.php');
	}

}


 if(isset($_POST['submitphoto']))
{
//print_r($_POST); 

$fieldsarray = $_POST['fieldsarray'];
$gid = $fieldsarray['13'];
//echo $gid;
$username = $_SESSION['username'];
$date1 = date('m/d/Y h:i:s a', time());
$rid = $_GET['id'];

foreach($fieldsarray as $key=>$value){

$insert = $db->query("INSERT INTO field_data VALUES('','$key','$rid','$value','$username')");
}

$blah = $_POST['blah'];
//print_r($_POST);
$data = $blah;       
$img = $data;
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$ourFileName = "images/".$rid.".jpeg";
$ourFileHandle = fopen($ourFileName, 'w+') or die("can't open file");

$success = file_put_contents($ourFileName, $data);
print $success ? $ourFileName : 'Unable to save the file.';

header('location:view.php?id='.$gid.'&type=groupmembers');
}


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Contact us</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />
<table>
<?
global $db;
$fields = $db->get_results("SELECT field_reference.*, field_types.* FROM field_reference LEFT JOIN field_types ON field_reference.ft_id = field_types.f_id WHERE field_reference.status='1'");
foreach($fields as $field){ 
?>
	<tr>
<td><?php echo $field->title; ?>	

</td>	

<td><?php
if($field->field_type == 'inputbox'){ ?>
<input type="hidden" name="fieldsarray[]" value="<?php echo $field->rf_id?>" />
 	<input type="text" value="" name="fieldsarray[<?php echo $field->rf_id?>]" />		
	
	<?php } elseif($field->field_type == 'textarea') 	{ ?> 
	
	<input type="hidden" name="fieldsarray[]" value="<?php echo $field->rf_id?>" />
	<textarea name="fieldsarray[<?php echo $field->rf_id?>]">
	</textarea>
<? if($field->title == 'Notes'){ ?>

<!-- <a href="" class="add-new">Add New Notes</a> -->

<!-- <button type="button" data-toggle="modal" data-target="#myModal">Add New Notes</button> -->

<?php } ?>
</td>
<td>	
<?php } elseif($field->field_type == 'select list'){ 
?>
<input type="hidden" name="fieldsarray[]" value="<?php echo $field->rf_id?>" />
<select name="fieldsarray[<?php echo $field->rf_id ?>]" class="styledselect_form_1">
<?php
$getrows = $db->get_results("SELECT * 	$date = date('dmYHis');from groups")	;
foreach($getrows as $getrow)	
	{
	?>	
<option value='<?php echo $getrow->grp_id ?>'><?php echo $getrow->grp_name ?></option>	
<?php 
//$gid = $getrow->grp_id;
} ?>	
</select>
</td>	
	
	</tr>
<?php }	
		
	} ?>
	</table>
<div id="submitform">
<!-- <input type="submit" value="submitform" name="submitform" class="btn btn-inverse"/> -->
 <input type="submit" value="submitform" name="submituser" class="btn btn-inverse" /> 

</div>
</form>
</div>
</body>
</html>
<?php }else{
	
	}?>


