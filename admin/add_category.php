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
include_once('./includes/header.php');
$msg .= '';
?>

<style type="text/css">
.space{
	float:left; margin-left:20px;height:50px;
	}
	.space1{
	float:left;
	 margin-left:20px;
	 margin-top: 50px;
	}
</style>

<div class="content">

<?php 
if(isset($_GET['catid']))
{
$ct_id = $_GET['catid'];	
	}	else {
		$ct_id = null;
	}
?>

<?php 
global $db;
					if(isset($_POST['submit'])) 
					{
						$metatitle = $_POST['metatitle'];
						$metadesc = $_POST['metadesc'];
						$metakey = $_POST['metakey'];
						$seotitle = $_POST['seotitle'];
						$title = $_POST['title'];
						$desc = $_POST['description1'];
					
					
$errors = array();
	if(!isset($metatitle) OR empty($metatitle))
	{
		$errors[] = 'Enter metatitle.';
	}
	if(!isset($metakey) OR empty($metakey))
	{
		$errors[] = 'Enter metakeywords.';
	}
	if(!isset($metadesc) OR empty($metadesc))
	{
		$errors[] = 'Enter metadesc.';
	}
	if(!isset($seotitle) OR empty($seotitle))
	{
		$errors[] = 'Enter seotitle.';
	}
	if(!isset($title) OR empty($title))
	{
		$errors[] = 'Enter category title.';
	}
	if(!strlen(trim($desc))) 
	{
	 $errors[] = 'Enter Category Description.';
	 }
	 if (empty($errors)) 
	 { // Success!

 $str = str_replace(" ", "_", $seotitle, $count);
					//echo $str;
									if($count != 0)
									{
									$str = $str;	
										}else{
									$str = $seotitle;		
											}
					
					$insertcat = $db->query("INSERT into category values('','$title','$desc')");
					$ctid = $db->insert_id;
					if($insertcat)
					{
					$insertseo = $db->query("INSERT into seo_detail values('','category','$ctid','$str','$metatitle','$metakey','$metadesc')");
					if($insertseo)
					{
					$msg .='<div class="alert alert-warning">
					   <p>Category added Successfully.</p>
					    </div>';	
						}
					
					}else {
					echo 'unsuccess';	
					}

	 } 
	 else { // Report the errors.

		 echo '<div class="alert alert-error"><p>Problems exist with the following field(s):<ul>';

			 foreach ($errors as $error) 
				 {
	 				echo "<li>$error</li>\n";
				 }
	 echo '</ul></p></div>';
 }					
					
					
					
					
					
					}
?>


<?php 

//$db->debug();
?>


<?php
/*
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if ($pos === false) {
    echo "The string '$findme' was not found in the string '$mystring'";
} else {
    echo "The string '$findme' was found in the string '$mystring'";
    echo " and exists at position $pos";
}*/
?>

<?php 
/*function getoptions()
{
	global $db;
	$tablenames = array("batch_fee", "discount_value", "discount_type", "pre_camp_value");

foreach ( $db->get_col("SHOW TABLES",0) as $tablename )
{
if (in_array($tablename, $tablenames))
{
	}else{

	?>
 <a href="#<?php echo $tablename; ?>-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i><?php echo $tablename; ?></a>
<ul id="<?php echo $tablename; ?>-menu" class="nav nav-list collapse">
            <li ><a href="add.php?type=<?php echo $tablename; ?>&tmpl=default"><?php echo 'Add '.$tablename; ?></a></li>
            <li ><a href="view.php?type=<?php echo $tablename; ?>&tmpl=default"><?php echo 'View all '.$tablename; ?></a></li>
           
            
        </ul>

<?php 
}//else close
}//foreach
	}//function
	
	$a = getoptions();
	echo $a; */
?>

<?php




$type = 'destination';


foreach($db->get_col("SHOW TABLES", 0) as $tablename)
{
if($tablename != $type)
{
	$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field = 'ct_id' AND Extra = 'auto_increment' ");
	//echo $getfirstcolumn;
		if($getfirstcolumn)
		{
			
		//print_r($getfirstcolumn);
			$getresults = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
			foreach($getresults as $getresult)
			{ echo $tablename;
				$cat1 = $db->get_row("SELECT * FROM $tablename WHERE ct_id = '1'");
print_r($cat1);
}
}
}
}


/*$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
foreach($getcolms as $getcolm)
{ 
print_r($getcolm->Field);
$mystring = $getcolm->Field;
$findme   = '_id';
$pos = strpos($mystring, $findme);

if ($pos === false) 
{
    echo "The string was not found in the string '$mystring' <br />";
} else {
	if($getcolm->Field != $ctid)
	{
    
    
    echo "The string '$findme' was found <br />";
  }
 }
 }*/
 ?>




<?php

//$buttons = array('save');
$buttons = array('save','continue');
//$button[] = 'save';
//$button[] = 'continue';
$count = count($buttons);
echo $count;
 
if($count == '1')
{?>
	<input type="button" name="<?php echo $buttons['0']; ?>" value="<?php echo $buttons['0']; ?>" class="btn btn-success" /> 
	
<?php	}elseif($count > 1){
foreach($buttons as $button)
{
//echo $button;
?>

	<input type="button" name="<?php echo $button; ?>" value="<?php echo $button; ?>" class="btn btn-inverse" />  
	 
<?php	
}

}


?>
        
        <div class="header">
            <div class="stats">
    <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p>
									</div> <!-- end div stats -->
	    </div>  <!-- end div header -->
     
                <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Dashboard</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
       <?php if($msg != null)
       {
echo $msg;       	
       	} ?>            


<div class="block span12">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Add Category<span class="label label-warning">+10</span></a>
      
<form method="post" >
			
					<div class="space">
					meta title &nbsp;&nbsp;&nbsp;
					<input type="text" name="metatitle" 
					value="<?php if($ct_id !=  null )
					{   
					echo $sql->metatitle;
					}else { echo '';} ?>" />		
				</div>					
				<br></br><br></br>
				<div  class="space">
					meta desc &nbsp;&nbsp;&nbsp;
					<input type="text" name="metadesc" value="<?php if($ct_id !=  null )
					{   
					echo $sql->metadesc;
					}else { echo '';} ?>" />		
				</div>			
				<br></br><br></br>
				<div  class="space">
					meta keywords &nbsp;&nbsp;&nbsp;
					<input type="text" name="metakey" value="<?php if($ct_id !=  null )
					{   
					echo $sql->metakeywords;
					}else { echo '';} ?>" />		
				</div>					
				<br></br><br></br>
				<div  class="space">
					seo title &nbsp;&nbsp;&nbsp;
					<input type="text" name="seotitle" value="<?php if($ct_id !=  null )
					{   
					echo $sql->seotitle;
					}else { echo '';} ?>" />		
				</div>					
				<br></br><br></br>
				<div  class="space">					
					Category Title &nbsp;&nbsp;&nbsp;
					<input type="text" name="title" value="<?php if($ct_id !=  null )
					{   
					echo $sql->title;
					}else { echo '';} ?>" />
				</div>
				<br></br><br></br>
				<div style="float:left;margin-left:20px; ">
					
		Description
			<textarea id="description1" name="description1" rows="15" cols="80" style="width: 70%">
		<?php 	if($ct_id !=  null )
					{   
					echo $sql->description;
					}else { echo '';} ?>
			</textarea>
			</div>
				 	<br></br><br></br>
				 		<div  class="space1">		
					<input type='submit' name ='submit' value='Submit' class='btn btn-inverse' />
					<input type="reset" value="clear" name="clear" class="form-reset"  />
					</div>
</form>
			  
		   </div> <!-- end block span12 -->
	
		   </div> <!-- end row fluid -->
	             
            <p><a href="users.html">More...</a></p>
    
</div> <!-- end container fluid -->
    </div> <!-- end div content -->
  

   





                    
                    <footer>
                        <hr>
                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                        <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                        

                        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                    </footer>
     
	<?php
include_once('includes/footer.php');
	}
	?>