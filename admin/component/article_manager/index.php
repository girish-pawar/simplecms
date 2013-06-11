<?php
if(isset($_POST['config']))
{
$fp = fopen("../admin/".$_GET['option']."/".$_GET['kind']."/config.php","w");
if($fp)
{
fprintf($fp,"<?php  ");
fwrite($fp, '$servicetype = ');
fwrite($fp, "'".$_POST['servicetype']."';");
fwrite($fp, '   $size = ');
fwrite($fp, "'".$_POST['size']."'; ?>");
fclose($fp);	
	
echo 'file open';	
	}	else{
		echo 'not file open';
		}
	
	}
	include_once('../admin/component/'.$_GET['kind'].'/config.php');

?>

<!-- <a href="../admin/index.php?option=<?php echo $_GET['option']; ?>&kind=<?php echo $_GET['kind']; ?>&method=<?php echo $_GET['method']; ?>&process=<?php echo $_GET['process'];?>&type=<?php echo $_GET['type']; ?>&id=<?php echo $_GET['id']; ?>&step=2&vg_id=<?php echo $vgid; ?>" class="btn btn-success"  >Step 2</a>   -->  

<?php 
head2();
?>
 
<?php 
//echo $_GET['method'];
if(isset($_GET['method']) == 'config')
{
	?>
<div class="block span11">     
             <a href="#tablewidget" class="block-heading" data-toggle="collapse">Video Gallery</a>   
             <div id="tablewidget">
            
             
             
<form method="post">
<h2>This is landing video page.</h2>

<div class="space1">
Enter Service Type
<input type="text" name="servicetype" placeholder="youtube"  />
</div>

<div class="space1">
Select Video Resolution:
<select name="size">
<option value="120 x 90">120 x 90</option>
<option value="320 x 180">320 x 180</option>
<option value="320 x 240">320 x 240</option>
<option value="420 x 345">420 x 345</option>
<option value="480 x 360">480 x 360</option>
<option value="720 x 480">720 x 480</option>
<option value="720 x 540">720 x 540</option>
<option value="800 x 600">800 x 600</option>
<option value="864 x 486">864 x 486</option>
<option value="960 x 720">960 x 720</option>
<option value="1024 x 576">1024 x 576</option>
<option value="1280 x 720">1280 x 720</option>
<option value="1920 x 1080">1920 x 1080</option>
</select>
</div>

<div class="space1">
<input type="submit" name="config" value="Configure" class="btn btn-success" />
</div>
</form>
</div>
</div>

<?php }
?>
<?php
if(isset($_GET['method']) == 'menu_config')
{
?>	
	
<h2>In menu config page</h2>
	
<?php 	}elseif(isset($_GET['method']) == null)
{
	echo 'method';
	
	}
else{
echo 'no method';	
	} 

?>

