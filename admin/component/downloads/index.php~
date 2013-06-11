<?php
if(isset($_POST['config']))
{
	print_r($_POST);
$fp = fopen("../admin/".$_GET['option']."/".$_GET['kind']."/config.php","w");
if($fp)
{
fprintf($fp,"<?php  ");
fwrite($fp, '$servicetype = ');
fwrite($fp, "'".$_POST['servicetype']."'; ?>");

fclose($fp);	
	
echo 'file open';	
	}	else{
		echo 'not file open';
		}
	
	}
	include_once('../admin/component/downloads/config.php');

?>

<?php 

if(isset($_GET['kind']))
{

	head1();
	}

if(isset($_GET['method']))
{
	?>
<div class="block span11">     
             <a href="#tablewidget" class="block-heading" data-toggle="collapse">File Configure</a>   
             <div id="tablewidget">         
             
<form method="post">
<h2>This is files landing page.</h2>

<!--<div class="space1">
Enter File Types
<input type="text" name="servicetype" placeholder="Filetype"  />
</div>-->

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
	$extra = null;*/
$currency = GetForm('downloads_category',$id,$extra);
//echo $currency.'<br />';
//}
//$b='1,2';
//$button= getbutton($b);
?>

<?php
//$seo_table='seo_detail';
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
<?php
/*
$b='1,2';
 echo $button= getbutton($b);*/ ?>
<!--<input type='submit' name='submit'>!-->
</form>

</div>
</div>

<?php } ?>