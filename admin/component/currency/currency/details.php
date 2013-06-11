<?php

include_once('../admin/includes/config.php');
head11(); ?>
<?php
if($_GET)
{
if(isset ($_GET['type']) ||  isset($_GET['tmpl']) || isset($_GET['id']) )
{
	$tablename = $_GET['type'];
	$tmpl = $_GET['tmpl'];
	$id = $_GET['id'];
	}else{
		$tablename = null;
		$tmpl = null;
		$id = null;
		
		}
}

if(isset($_GET['id']) && isset($_GET['type']) && isset($_GET['action']) )
{
	$tablename = $_GET['type'];
	delete($_GET['id'],$tablename);
}
?>

<form method='POST' action=''> 
    <div class="block span12">
    <?php //if($id != null){ ?> 
       
        <div id="tablewidget" class="block-body collapse in">
        <table class="table" >
       <?php
        
       $getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
foreach($getcolms as $getcolm)
{       
       
foreach($db->get_col("SHOW TABLES", 0) as $table_name)
	{
		
																														if($table_name != $tablename) //tablename not equal to get table nAME 
																														{
																															
																															$getfirstcolumns = $db->get_results("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field'");
																															if($getfirstcolumns)
																																{
																																		
																														foreach($getfirstcolumns as $getfirstcolumn)
																														{
																															//echo 'tablename matched '.$table_name.'</br>';
																															//echo '<pre>';	
																															//	print_r($getfirstcolumn);
																															//echo '</pre>';
																																$id1 = $getfirstcolumn->Field;
																														//echo 'id is'.$id1;
																															
																															$getrows = $db->get_results("SHOW FULL COLUMNS FROM $table_name");
																																	foreach($getrows as $getrow)
																																	{
																																		//print_r($getrow);
																																			$mystring2 = $getrow->Field;
																																				$findme2   = '_t';
																																				$pos2 = strpos($mystring2, $findme2);
																																					if ($pos2 === false) 
																																					{
																																								   //echo "The string was not found in the string '$mystring1' <br />";
																																					}else
																																					{
																																									global $db;
																																									$name = $getrow->Field;
																																																												//echo 'name is'.$name;
																																								
																																									$getnamess = $db->get_results("SELECT * FROM $table_name ");
																																									//$getnames = $db->get_row("SELECT * FROM $table_name WHERE $name = '$cats' ");
																																								if($getnamess)
																																								{		
																																								foreach($getnamess as $getname)
																																								{
																																								
																																									$mystring123 = $getname->$id1;
																																									$findme123   = $id;
																																									
																																									$pos = strpos($mystring123, $findme123);
																																									    $name= $getrow->Field;
																																									
																																									
																																									// Note our use of ===.  Simply == would not work as expected
																																									// because the position of 'a' was the 0th (first) character.
																																									if ($pos === false) {
																																										
																																													?>
																																										 <thead>
                <tr><th>There is no category present in table <?php echo $table_name; ?></th></tr></thead><tbody>	<tr><td>
                <?php																																									
																			
																																									    //echo "The string '$findme123' was not found in the string '$mystring123' </br>";
																																									} else {
																																													?>
																																										 <thead>
                <tr><th><?php echo $table_name; ?></th></tr></thead><tbody>	<tr><td>
                <?php																																									
																			
																																									   // echo "The string '$findme123' was found in the string '$mystring123' </br>";
																																									    //echo 'name is '.$getrow->Field.'</br>';
																																									    $name= $getrow->Field;
																																									    //echo 'find123 is'.$findme123;
																																									    $getnames = $db->get_results("SELECT * FROM $table_name WHERE $id IN ('$findme123')");
																																									    if($getnames)
																																									    {
																																									    	foreach($getnames as $getname)
																																									    	{ 
																																									    																																								    		//print_r($getname);
																																									echo $getname->$name.'</br>';
																																									    	
																																									    	}
																																									
																																									    	}
																																									    
																																									    
																																									    
																																									}
																																								
																																											break 1;																											
																																									}
																																																														
																																									//echo $getnames->$name;
																																									}
																																																																									
																																							}
																																		
																																			}
	}																													
				}																									
																													
																															
																																
																														} // end $getfirstcolm 
																														} //check table name 
																														} //foreach show all tables 
																														
																											
																				?>        
       
</td>            
            </tr>
            </tbody>
            </table>
            
        </div>
        <?php //} ?>
    
    </div>
 
 <?php
 display_details($tablename,	$tmpl,$id);
   ?>
  </form>
  
  
    