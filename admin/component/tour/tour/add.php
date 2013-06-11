
<?php 
head11(); 

if(isset($_GET['insert']))
{
$insert = $_GET['insert'];	
}else{
$insert = null;	
	}


if(isset($_GET['id']))
{
$id=$_GET['id'];
}elseif(isset($_GET['t_id']))
{
$id=$_GET['t_id'];
}
else
{
$id=null;
}

if($insert == '1' || $insert == '3' || $insert == '11')
{
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 1:New Tour Added Successfully.</strong>
 <?php 
if($id != '')
{ 
 ?>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&insert=11&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>
<?php  } ?> 
 <!--<strong><?php echo 'New '.ucfirst($_GET['type']).' Inserted Successfully!';?></strong>-->
 
 </div>
	<?php
	//header('location:index.php?option=component&kind='.$_GET['kind'].'&method='.$_GET['method'].'&process='.$_GET['process'].'&type='.$_GET['type'].'id='.$insert);
}


if($insert == '2')
{
	//echo $update;
	?>
	<div class="alert fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Tour Details Updated Successfully!</strong>
  <?php 
if($id != '')
{ 
 ?>
 <a href="index.php?option=component&kind=tour&method=add_tour&process=select_country&type=tour&insert=11&t_id=<?php echo $_GET['t_id']; ?>" class="btn btn-inverse" style="float:right;" >Proceed For Step2</a>
<?php  } ?>  
 </div>
	<?php
	}



if($insert == '')
{
	//echo $update;
	?>
	<div class="alert alert-success fade in">
 <button data-dismiss="alert" class="close" type="button">×</button>
 <strong>Step 1:Create New Tour.</strong>
 
 </div>
	<?php
	}



$category = GetForm($_GET['type'],$id);
echo $category.'<br />';
$seo_table='seo_detail';
$extra = '1';

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