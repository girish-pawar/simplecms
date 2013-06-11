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
	
	 margin-left:20px;
	 margin-top: 5px;
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


global $db;

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
			{ 
			//echo $tablename;
				$cat1 = $db->get_row("SELECT * FROM $tablename WHERE ct_id = '1'");
//print_r($cat1);
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
//echo $count;
 
if($count == '1')
{?>
	<!-- <input type="button" name="<?php echo $buttons['0']; ?>" value="<?php echo $buttons['0']; ?>" class="btn btn-success" /> --> 
	
<?php	}elseif($count > 1){
foreach($buttons as $button)
{
//echo $button;
?>

	<!-- <input type="button" name="<?php echo $button; ?>" value="<?php echo $button; ?>" class="btn btn-inverse" /> -->  
	 
<?php	
}

}


?>
 <div class="container-fluid">
   <div class="row-fluid">
       <?php if($msg != null)
       {
echo $msg;       	
       	} ?>            
<?php
global $db;

//echo 'record is :'.$record;
					if(isset($_POST['configure']))
					{
						$function = $_POST['view'];
						$records = $_POST['records'];
						$homerecords = $_POST['homerecords'];
				 //print_r($_POST);
						 $fieldsarray = $_POST['fieldsarray'];
						 print_r($fieldsarray);
						  $fp = fopen("../admin/includes/config.php", "w");
						if($fp)
						{
							fwrite($fp,'<?php $tablearrays ="');
					 foreach($fieldsarray as $fieldsarr)
							{
								fwrite($fp,$fieldsarr.",");
								//print_r($fieldsarr);
								}
								fwrite($fp,'"; ?>');
								}
							
						 //echo 'fieldsarray is</br>';
						// print_r($_POST['fieldsarray']);
						 //$fp = fopen("../admin/includes/config.php", "w");
						 if($fp)
						 {
									echo 'handel';				
								fwrite($fp, '<?php $function = '.$function.';  ');
								fwrite($fp, '$record = '.$records.';    ');
								fwrite($fp, '$homerecord = '.$homerecords.';  ?>');
								fclose($fp);
		 	
						 	}else{
								echo 'not handle';						 		
						 		}
					}
					include_once('../admin/includes/config.php');
?>


<div class="block span12">
       <form method="post"> 
       <div class="space1">      
        Select View Details:
        <select name="view">
        <?php
        if($function == 1)
        {
        ?>
        <option value="1" selected="selected">Simple View</option> 
     <?php }else{ ?>
     <option value="1" >Simple View</option>
     <?php } ?>
     
     <?php if($function == 2)
     {?>
        <option value="2" selected="selected">Detail View</option>
        <?php }else{ ?>
      <option value="2" >Detail View</option>
         <?php } ?>
        </select> 
        </div>
        <div class="space1">
        Select No.of Records show per page:
        
<select name="records">
<?php

if($record)
{
for ($i = 1; $i <= 20; $i++) 
{
if($record == $i)
{ 
	?>
   <option value="<?php echo $i; ?>" selected="selected"> <?php echo $i; ?></option>
   <?php }else{
   	
   	?>
   	   <option value="<?php echo $i; ?>"> <?php echo $i; ?></option> 
<?php 
}
}
}
?> 

</select>        
</div>

<div class="space1">
Select No.of Records show on Home Page:
<select name="homerecords">
<?php
if($homerecord)
{
for ($i = 1; $i <= 10; $i++) 
{
if($homerecord == $i)
{ 
	?>
   <option value="<?php echo $i; ?>" selected="selected"> <?php echo $i; ?></option>
   <?php }else{
 	?>
 <option value="<?php echo $i; ?>"> <?php echo $i; ?></option> 
<?php 
}
}
}
?> 

</select>        
</div>

        <?php
        	global $db;
	$tablenames = array("batch_fee", "discount_value", "pre_camp_value","moduledata","menu_table","menu_links","moduleparams","moduletype","admin","admin_change","admin_type","seo_detail");

$fieldsarray = '';
foreach ( $db->get_col("SHOW TABLES",0) as $tablename )
{
if (in_array($tablename, $tablenames))
{
	}else{ ?>
	<div class="space1">
							
        <input type="checkbox" name="fieldsarray[]" value="<?php echo $tablename; ?>" ><?php echo $tablename; ?></input>
        
        <?php
             $fieldsarray .= $tablename.',';
     ?>
         <!-- <input type="hidden" name="fieldsarray[]" value="<?php echo $tablename; ?>[]" />  -->
 </div>
<?php 
}}

//print_r($a);
//print_r($fieldsarray);
?>      
      
      <div class="space1">
        <input type="hidden" value="11" name="set" />
        <input type="submit" name="configure" class="btn btn-inverse"  />
        </div>
        </form>
		   </div> <!-- end block span12 -->
	
		   </div> <!-- end row fluid -->
	             
     
    
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

