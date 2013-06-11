<?php
session_start();
	if(!isset($_SESSION['ad_id']))
	{
	header('location:admin_login.php');
	}
	else
	{
	?>
	<?php
include_once('/includes/header.php');
?>
<?php
session_start();
if(!isset($_SESSION['ad_id']))
{
header('location:admin_login.php');
}
else
{
include_once('./includes/header.php');
include_once('./includes/function.php');
?>

<?php

if(isset($_POST['insert']))
{

$name= $_POST['name'];
$email= $_POST['emailid'];
$phone= $_POST['phone'];
$username= $_POST['username'];
$password= md5($_POST['password']);
$type= $_POST['type'];
$date= date('Y-m-d H:i:s');
$insert= $db->query("INSERT INTO fgusers3 VALUES('','$name','$email','$phone','$username','$password','$date','y','$type')");
$userid= $db->insert_id;
$seo_title= $_POST['seo_title'];
$seo= $db->query("INSERT INTO seo_title_table VALUES('','$userid','$seo_title')");
}


 
?>





    <div class="content">
        
        <div class="header">
            <div class="stats">
    <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p>
</div>


		

        </div>
     
                <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Dashboard</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    


<div class="block span12">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Add Destination<span class="label label-warning">+10</span></a>
      
        		 asedfgveswgrvredsf
            
			 
			  
		   </div>
	
		   </div>
	
		   
              
            <p><a href="users.html">More...</a></p>
        
</div>
    </div>
  

   





                    
                    <footer>
                        <hr>
                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                        <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                        

                        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                    </footer>
                    
            </div>
        </div>
    </div>
	
	<?php
include_once('includes/footer.php');
?>
<?php
}
?>
    
    <?php
	}
	?>