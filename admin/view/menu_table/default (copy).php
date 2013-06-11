<?php
if(isset($_GET['id']))
{
	
	$tablename = $_GET['type'];
	$ctid = $_GET['id'];
	delete($ctid,$tablename);
	}

?>


<form method='POST' action=''>
 
<?php
$tablename = $_GET['type'];
$tableids = $db->get_row("SHOW FULL COLUMNS FROM $tablename");
//print_r($tableids->Field);
$ctid = $tableids->Field;
$idvalues = $db->get_results("SELECT $ctid FROM $tablename");

?> 



<?php 



$tablename = $_GET['type'];
				$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));	
?>
<div class="pull-right span4 offset-3">
<a href="add.php?type=<?php echo $tablename; ?>&tmpl=default" class="btn btn-info" >Add New <?php echo $bar; ?></a>
</div>

<div class="pull-left span11">
<table class="table table-bordered">

<?php
$tablename = $_GET['type'];
$values = $db->get_results("SELECT * FROM $tablename");
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
//$colms = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
?>


<tr>
<?php
//print_r($getcolms);
foreach($getcolms as $getcolm)
{ 

$mystring2 = $getcolm->Field;
$findme2   = '_d';
$pos2 = strpos($mystring2, $findme2);
if($pos2 === false )
{
//echo 'not found';	
	

//print_r($getcolm->Field);
$mystring = $getcolm->Field;
$findme   = '_id';
$pos = strpos($mystring, $findme);

if ($pos === false) 
{ ?>
<th><?php echo $getcolm->Comment; ?></th>
    
<?php
} else {
												?>
<th>											
				<?php	
	if($getcolm->Field == $ctid)
	{
		echo $getcolm->Comment;
	}else{
			//	print_r($getcolm->Field);
				$field12 = $getcolm->Field;
									
										foreach($db->get_col("SHOW TABLES", 0) as $table_name)
										{
														if($table_name != $tablename)
														{
															$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field' AND Extra = 'auto_increment' ");
															//echo $getfirstcolumn;
																if($getfirstcolumn)
																{
																	
																//print_r($getfirstcolumn);
																	$getresults = $db->get_results("SHOW FULL COLUMNS FROM $table_name");
																	foreach($getresults as $getresult)
																	{
																		//echo $field12;
																		echo $getresult->Comment;
																		//echo '<pre>';
																		//print_r($getresult);
																		//echo '</pre>';
																		
																		break 1;
																		}
					
																	}
														}
										}

   // echo "The string '$findme' was found <br />";
  }
  ?>
</th>
<?php
 }
 
 }else {
		//echo 'found'.$getcolm->Field.'<br />';
		$description = $getcolm->Field;
	} 
//print_r($getcolm);
?>

<!-- <th><?php echo $getcolm->Comment; ?></th> -->

<?php } ?>
<th>Options</th>
</tr>

 <?php 
  set_time_limit(200);
foreach($values as $val)
{ 

?>
<tr>
	<?php
	$asd = '';

	
foreach($getcolms as $getcolm)
{
	$mystring22 = $getcolm->Field;
	//echo $mystring22;
	$findme22   = '_d';
	$pos22 = strpos($mystring22, $findme22);
	if($pos22 === false ) //remove description colm
	{
		//echo 'hi';
		//print_r($getcolm);
		$field = $getcolm->Field;
		//echo $field;
		$mystring = $val->$field;
		$findme   = ',';
		$pos = strpos($mystring, $findme);
		if ($pos === false) 
		{ ?>
		    <td><?php echo $val->$field; ?></td>
		<?php } else {
			//echo 'array found';
			$rtrim = rtrim($val->$field, ','); 
								if($rtrim != null)
								{
								$catsss = explode( ',', $rtrim);
								?>	<td><?php
														foreach($catsss as $cats)
														{
																				
																				$mystring1 = $getcolm->Field;
																				$findme1   = '_id';
																				$pos1 = strpos($mystring1, $findme1);
																				
																				
																				
																				if ($pos1 === false) 
																				{
																				   //echo "The string was not found in the string '$mystring1' <br />";
																				}else 
																				{
																								if($getcolm->Field != $ctid)
																								{
																							
																								//print_r($getcolm->Field);
																																//echo 'id is'.$getcolm->Field	;	
																										$cid = $getcolm->Field	;
																										foreach($db->get_col("SHOW TABLES", 0) as $table_name)
																										{
																														if($table_name != $tablename) //tablename not equal to get table nAME 
																														{
																															$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $table_name WHERE Field = '$getcolm->Field' AND Extra = 'auto_increment' ");
																													
																																if($getfirstcolumn)
																																{
																																			$id = $getfirstcolumn->Field;
																																			$getrows = $db->get_results("SHOW FULL COLUMNS FROM $table_name");
																																	foreach($getrows as $getrow)
																																	{
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
																																									//echo $name;
																																									//echo 'name is'.$name;
																																									//echo $cats;
																																									//echo $table_name;
																																									$getnamess = $db->get_results("SELECT * FROM $table_name ");
																																									//$getnames = $db->get_row("SELECT * FROM $table_name WHERE $name = '$cats' ");
																																								if($getnamess)
																																								{		
																																								foreach($getnamess as $getname)
																																								{
																																								//	echo 'hi';
																																									//echo $getname->$cid;
																																									
																																									if($getname->$cid == $cats)
																																									{ 																																									
																																									?>
																																													
																																										<a href="../admin/details.php?type=<?php echo $table_name ?>&tmpl=default&id=<?php echo $getname->$id; ?>" title="View All Details About This <?php echo $table_name ?>" ><?php echo $getname->$name.',' ?></a>
																																									<?php
																																									//print_r($getname);
																																										//break 1;	
																																									}
																																																																					
																																									}
																																																														
																																									//echo $getnames->$name;
																																									}
																																																																									
																																									//print_r($getnames);
																																									//echo $getnames->$name;
																																									//echo $getnames->$name;
																														//											echo $getrow->Field;
																																									}
																																		}  //print_r($asd);		
																																	//print_r($getrow);
																																		$cats1 = $db->get_row("SELECT * FROM $table_name WHERE $getcolm->Field = '$cats'");
																														//print_r($cats1);
																				break 1;										
																														
																														} // end $getfirstcolm 
																														} //check table name 
																														} //foreach show all tables 
																				
																				    //echo "The string '$findme' was found <br />";
																				 }			//getcolm if close	
																		}   //pos1 else close
														//echo $cats.'<br />';
														} //foreach catsss close
														
						//	}
			
			?>
			<!-- <td><?php echo $rtrim; ?></td>  -->
						</td>
<?php 

}else{
echo '';	
	}

}	//else closedelete($ctid,$tablename)
	
}else{
//echo 'found'.$getcolm->Field.'<br />'		;
		} //pos close

}//foreach close
?>

<td>

<!-- <a href="" ><i class="icon-plus"></i></a> -->
<a href="../admin/add.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a>
<a href="#myModal<?php echo $val->$ctid; ?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $val->$ctid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" class="btn btn-danger" >Delete</a>
    </div>
</div>


<!-- 
<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" title="Delete <?php echo $tablename ?>" onclick="delete($ctid,$tablename)" ><i class="icon-trash"></i></a> -->
<a href="../admin/details.php?type=<?php echo $tablename ?>&tmpl=default&id=<?php echo $val->$ctid; ?>" title="View All Details About This <?php echo $tablename ?>" ><i class="icon-list"></i></a>
</td>

<?php 


	}//   ?>
<?php 
$ctid = $tableids->Field;
$idvalues = $db->get_results("SELECT $ctid FROM $tablename");
?>


</tr>

</table>

<div class="pagination pagination-right">
<ul>
<li><a href="#">Prev</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">Next</a></li>
</ul>
</div>
</div>

</form>
