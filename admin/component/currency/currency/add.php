<?php

include_once('../admin/includes/config.php');
head11(); ?>


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



if($_GET['insert'] == '1')
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

$currency = GetForm($_GET['type'],$id,$extra);
echo $currency.'<br />';


$b='1,2,3,4';
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