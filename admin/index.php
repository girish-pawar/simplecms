<?php
session_start();
	if(!isset($_SESSION['ad_id']))
	{
	header('location:admin_login.php');
	}
	else
	{
include_once('./includes/header.php');
?>
    <div class="content">
   
        <div class="container-fluid">
            <div class="row-fluid">
            
 
<?php
/*if(isset($_GET['method']))
{
	
include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'.php');	
	}
	else	
	{
		include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/index.php');	
		
		} */
		
		if(isset($_GET['process']))
		{
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/'.$_GET['process'].'.php');		
		}
	else	
	{
		include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/index.php');	
		
		}
?>

	
	<?php
include_once('./includes/footer.php');
?>
    <?php
	}
	?>
	</div>
	</div>
	</div>