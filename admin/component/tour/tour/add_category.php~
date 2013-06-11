<?php
ini_set('upload_max_filesize','20M');
include_once('../admin/includes/defination.php');
include_once('../admin/component/downloads/config.php');
global $db;

head1();
?>

<div class="block span11">     
             <a href="#tablewidget" class="block-heading" data-toggle="collapse">File Configure</a>   
             <div id="tablewidget">         
             
<form method="post">
<h2>This is Add Category landing page.</h2>

<?php
//}
$extra = null;
if(isset($_GET['id']))
{
$id = $_GET['id'];
}
else
{
$id=null;
}

/*if($type== 'article_table')
{
	$extra = '1';
$currency = GetForm($_GET['type'],$id,$extra);
echo $currency.'<br />';
}else{
*/	$extra = null;
$currency = GetForm('downloads_category',$id,$extra);
echo $currency.'<br />';
//}
$b='1,2';
$button= getbutton($b);
?>

<?php
//$seo_table='';
//$id=null;
//$seo_form=Get_SeoForm($seo_table,$id,$extra,$type);
//echo $seo_form;
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
<input type='hidden' name='table' value='downloads_category'>
</div>
</div>