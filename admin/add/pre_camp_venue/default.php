


<form method='POST' action=''>
<?php
$extra = '';
if(isset($_GET['id']))
{
$id = $_GET['id'];
}
else
{
$id=null;
}
$pre_camp_venue = GetForm($_GET['type'],$id,$extra);
echo $pre_camp_venue.'<br />';


$b='1,2';
$button= getbutton($b);
?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>
<input type='hidden' name='seo_table' value=''>

<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
<!--<input type='submit' name='submit'>!-->
</form>
<?php




?>