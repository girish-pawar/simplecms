


<form method='POST' action=''>
<?php
$extra = 1;
if(isset($_GET['id']))
{
$id = $_GET['id'];
}
else
{
$id=null;
}
$destination = GetForm($_GET['type'],$id,$extra);
echo $destination;

$seo_table='seo_detail';
$seo_form=Get_SeoForm($seo_table,$id);
echo $seo_form;

//$b='1,2';
//$button= getbutton($b);
?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>
<input type='hidden' name='seo_table' value='124'>

<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
<!--<input type='submit' name='submit'>!-->
</form>
<?php




?>