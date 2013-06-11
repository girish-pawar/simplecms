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


<style ='text/css'>
.space{
float:left; margin-top:20px;margin-left:20px;}
</style>



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
      
        		<form method='POST' action=''>
				
				
					<div class= "space">	
			    Destination Title :
    
      <input type="text" id="inputEmail" class="input-xlarge">
	  </div><br></br><br></br>
	  
	  
	  	<div class= "space">	
   Select Category:
   
   <?php
   $category= $db->get_results("SELECT * FROM category");
   if($category)
   {
   foreach($category as $cate)
   {
   ?>
   
   <input type='chechbox' name='category[]' value='<?php echo $cate->ct_id;?>'><?php echo $cate->ct_name;?><br />
   
   <?php
   
   }
   
   }
   ?>
    </div><br></br><br></br>
	
	  <div class= "space">	
   Select Country:
	
	<select name='country'>
	<?php
	$country= $db->get_results("SELECT * FROM country");
	if($country)
	{
	foreach($country as $count)
	{
	?>
	<option value='<?php echo $count->c_id;?>'><?php echo $count->c_name;?></option>
	
	<?php
	
	}
	
	}
	
	?>
	</select>  </div><br></br><br></br>
	
	
 <div class= "space">	

 Destination
 
 </div><br></br><br></br>
				</form>
            
			 
			  
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