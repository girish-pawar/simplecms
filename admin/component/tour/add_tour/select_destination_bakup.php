


<form method='POST' action=''>
<h3> Select Destination</h3>

<?php
$t_id = $_GET['t_id'];
$getcids = $db->get_row("SELECT * FROM tour_country WHERE t_id = '$t_id'");
$getcats = $db->get_row("SELECT * FROM tour_category WHERE t_id = '$t_id'");

//echo 'getcids';
$getids = array();
$getcidss = rtrim($getcids->c_id,',');
$getids = explode(',',$getcidss);
//print_r($getids);

$instructers = '';
$getcountry = '';
foreach($getids as $getid)
{
	
	$getcountry .= $db->get_results("SELECT d_id FROM destination WHERE c_id LIKE '%$getid%'");
	//echo $getcountry;
	echo 'country:';
	print_r($getcountry);
	echo '</br>';
	
	/*$destcids = $db->get_results("SELECT * FROM destination");
	foreach($destcids as $destcid)
	{
		echo 'hi is:';
		print_r($destcid);
		echo '</br>';
	*/	//}
		/*$destcidsss = array();
		$destcidss = rtrim($destcid->c_id,',');
		//$destcidsss = explode(',',$destcids);
		//print_r($destcidss);
		print_r("SELECT d_id FROM destination,tour_country WHERE tour_country.t_id = '$t_id' AND FIND_IN_SET('$getid','	$destcidss')");	
	$instructers .= $db->get_results("SELECT d_id FROM destination,tour_country WHERE tour_country.t_id = '$t_id' AND FIND_IN_SET('$getid','$destcidss')  " );
*//*echo '<pre>';
print_r($instructers);
echo '<?pre>';	*/

	//}
	//break 1;
//print_r("SELECT d_id FROM destination,tour_country WHERE tour_country.t_id = '$t_id' AND FIND_IN_SET('$getid','c_id')");	
}
//SELECT * FROM yourtable WHERE Options LIKE '%2,3%';
//$instructer= $db->get_results("SELECT * FROM destination WHERE ct_id = '$getcats->ct_id' AND c_id = '$getcids->c_id'");

//$instructers= $db->get_results("SELECT * FROM destination,tour_country WHERE tour_country.t_id = '$t_id' AND FIND_IN_SET('1','destination.c_id') ");
//$instructers= $db->get_results("SELECT * FROM destination,tour_country,tour_category WHERE tour_country.t_id = tour_category.t_id = '$t_id' AND FIND_IN_SET('ct_id','$getcats->ct_id') ");


//$instructers= $db->get_results("SELECT * FROM destination,tour_country WHERE FIND_IN_SET('$getcids->c_id','destination.c_id') " );
//$instructers = $db->get_results("SELECT destination.d_t FROM destination,tour_country WHERE tour_country.t_id = '$t_id' AND FIND_IN_SET('1','destination.c_id')  " );


//print_r("SELECT c_id FROM destination,tour_country WHERE tour_country.t_id = '$t_id' AND FIND_IN_SET('$getcids->c_id','destination.c_id') ");
print_r($instructers);


if($instructer)
{
foreach($instructer as $ins)
{
?>


<input type='checkbox' name='d_id[]' value='<?php echo $ins->d_id;?>'><?php echo $ins->d_t;?><br />



<?php

}  // foreach close
} //if close
?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>
<input type='hidden' name='t_id' value='<?php echo $_GET['t_id'];?>'>
<input type='hidden' name='seo_table' value=''>

<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='tour_destination'>
<input type='submit' class="btn " name='submit'>
	<input type='submit' class="btn btn-primary" name='SaveAndCont' value='Save & Continue'>
</form>
<?php




?>