<?php




foreach($db->get_col("SHOW TABLES", 0) as $tablename)
{
if($tablename != $type)
{
	$getfirstcolumn = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field = '$column->Field'");
		if($getfirstcolumn)
		{
		//print_r($getfirstcolumn);
			$getresults = $db->get_results("SHOW FULL COLUMNS FROM $tablename");
			foreach($getresults as $getresult)
			{ 
			echo '<pre>';
			print_r($getresult);
echo '</pre>';
}
}
}
}

				$title = $db->get_row("SHOW FULL COLUMNS FROM $tablename WHERE Field LIKE '%_t'");
				
				
				?>