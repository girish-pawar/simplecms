
<?php
head11();
if(isset($_GET['id']))
{
$id=$_GET['id'];
}
else
{
$id=null;
}

if($_GET['type'] == 'destination')
{
	$extra = '1';
	
	
	}else{
$extra = null;		
		
		}


if($_GET['insert'] == '1' || $_GET['insert'] == '3')
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($_GET['insert'] == '2')
{
	echo $update;
	?>
	<div class="alert fade in">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <strong>Updated Successfully!</strong>
          </div>
	<?php
	}



$category = GetForm($_GET['type'],$id,$extra) ;
echo $category.'<br />';

$seo_table='seo_detail';

//$extra = '1';

$seo_form=Get_SeoForm($seo_table,$id,$extra,$_GET['type']);
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