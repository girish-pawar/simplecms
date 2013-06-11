<?php
include_once('defination.php');
?>

<?php
if(isset($_GET['s']))
{
$searchspace=strpos($_GET['s'],' ');
if($searchspace)
{
$seo_t= str_replace(' ', '_', $_GET['s']);
//echo 'found space';
}
else
{
$seo_t=$_GET['s'];
//echo'not found space';
}
//echo $_GET['s'];

$seo_detail= $db->get_row("SELECT * FROM seo_detail WHERE sd_t='$seo_t'");
if($seo_detail)
{
?>
<div class="alert alert-error">
Seo Title Already Exist
</div>
<?php
}
else
{

//$b='1,2';
//$button= getbutton($b);
?>
<input type='submit' class="btn " name='submit' value='Submit'>
<input type='submit' class="btn btn-primary" value='Save and Continue' name='SaveAndCont'>
<input type='submit' class="btn btn-primary" value='Save and Close' name='saveandclose'>
<input type='submit' class="btn btn-primary" value='Skip/Close' name='close'>
<?php

}

}








?>