<?php
/*if(isset($_GET['id']))
{*/
//session_start();
    //print_r($_SESSION);	
  //  $_SESSION['array'] = array();
require_once("include/membersite_config.php");
include_once('admin/includes/function.php');
//include_once('../admin/includes/defination.php');
include_once('admin/includes/tinymce.php');
global $db;
global $pixels;
//$userinfo = UserInfo($_SESSION['username']);

if($_GET)
{
if(isset($_GET['id']))
{
$rid = $_GET['id'];	
}else {
	$rid = null;
}	
	
}

if(isset($_POST['submitted']))
{
		
  if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.html");
   }
}	
	
if(isset($_POST['Submit']))
{
/*echo 'in post';	
echo '<pre>';
print_r($_POST);
echo '</pre>';*/
$confirm_code = $_POST['code'];
$array =  $fgmembersite->GetSelfScript($_POST);
	print_r($array);
	 }?>

	<?php	
//} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Contact us</title>
    <link rel="STYLESHEET" type="text/css" href="../gowild/users/style/fg_membersite.css" />
    <script type='text/javascript' src='../gowild/users/scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="../gowild/users/style/pwdwidget.css" />
    <script src="../gowild/users/scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->
<div id='fg_membersite'>
<!-- <form id='register' action='<?php echo $fgmembersite->GetSelfScript($_POST); ?>' method='post' accept-charset='UTF-8'> -->
<form id='register' method='post'  accept-charset='UTF-8' >

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<input type='hidden' name='code' id='code' value='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>'/>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' /> 
<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<a href="<?php echo '../../gowild'; ?>" >Back</a>
<table>
<?
global $db;
$fields = $db->get_results("SELECT field_reference.*, field_types.* FROM field_reference LEFT JOIN field_types ON field_reference.ft_id = field_types.f_id WHERE field_reference.status='1'");
foreach($fields as $field)
{ 
?>
	<tr>

<td><label><?php echo $field->title; ?></label></td>	

<td><?php
if($field->field_type == 'inputbox'){ ?>
	<div class='container1'>
<!--<input type="hidden" name="fieldsarray[]" value="<?php echo $field->rf_id?>" />-->
 	<!-- <input type="text" id='fieldsarray[<?php echo $field->rf_id?>]' value='<?php echo $fgmembersite->SafeDisplay("fieldsarray[$field->rf_id]") ?>' maxlength="50" name="fieldsarray[<?php echo $field->rf_id?>]" /> -->		
 	<input type="text" id='<?php echo $field->rf_id?>' value='<?php echo $fgmembersite->SafeDisplay("$field->title") ?>' maxlength="50" name="<?php echo $field->rf_id?>" />		
	<span id='register_name_errorloc' class='error'></span>
	</div>
	<?php } elseif($field->field_type == 'textarea') 	{ ?> 
		<div class='container1'>
	<!--<input type="hidden" name="fieldsarray[]" value="<?php echo $field->rf_id?>" />-->
	<textarea name="<?php echo $field->rf_id?>" id='<?php echo $field->rf_id?>'  maxlength="500">
	 <?php echo $fgmembersite->SafeDisplay("$field->title") ?>
	</textarea>
	<span id='register_name_errorloc' class='error'></span>
	</div>
<? if($field->title == 'Notes'){ ?>

<!-- <a href="" class="add-new">Add New Notes</a> -->

<!-- <button type="button" data-toggle="modal" data-target="#myModal">Add New Notes</button> -->

<?php } ?>
</td>
<td>	
<?php } elseif($field->field_type == 'select list'){ 
?>
<!--<input type="hidden" name="fieldsarray[]" value="<?php echo $field->rf_id?>" />-->
<select name="<?php echo $field->rf_id ?>]" class="styledselect_form_1">
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
	<tr>
	<td>
<div class='container1'>
    <label for='username' >UserName*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>
</td>
</tr>

<tr>

<td>
<div class='container1' style='height:80px;'>
    <label for='password' >Password*:</label><br/>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <noscript>
    <input type='password' name='password' id='password' maxlength="50" />
    </noscript>    
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
</div>
</td>	
	</tr>
	</table>
<!-- <div id="submitform"> -->
<!-- <input type="submit" value="submitform" name="submitform" class="btn btn-inverse"/> -->
<!--  <input type="submit" value="submitform" name="submituser" class="btn btn-inverse" /> 

</div> -->

<div class='container1'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</form>
<!--</div>-->

</body>
</html>
