<form method='POST' action=''>
<?php
if(isset($_GET['id']))
{
$id=$_GET['id'];
}
else
{
$id=null;
}

$category = GetForm($_GET['type'],$id);
echo $category.'<br />';
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
<input type='hidden' name='seo_table' value='123'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
<!--<input type='submit' name='submit'>!-->
</form>
<?php




?>