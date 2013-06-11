<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/includes/conn.php');
?>
<?php
global $db;
?>
<?
if($_GET){
	$query = '';
if(isset($_GET['country'])){
	$countrycsv = '';
	foreach($_GET['country'] as $key=>$value){
		$country .=$value.',';
		
	}
	$trimcountry = rtrim($country,',');
	echo $trimcountry;
	
	$query .="tour_country.tour_c_id IN ($trimcountry)";
	
	
	}

if(isset($_GET['category'])){ 
	foreach($_GET['category'] as $key=>$value){
		$category .= $value.',';	
		
	}
	$trimcategory =rtrim($category,',');
	
	echo 'category are:'.$trimcategory;
	
	if(isset($_GET['country'])){
	$query.="AND tour_category.tour_ct_id IN ($trimcategory)";
		
	} else{
		$query.="tour_category.tour_ct_id IN ($trimcategory)";
	}


};



if(isset($_GET['monthyear']))
{ 
$i = 0;

if(isset($_GET['country']) || isset($_GET['category']))
	{
									$query .=" AND "; 	
		}else{
									$query .="";
			}



	foreach($_GET['monthyear'] as $key=>$value){
		//$monthyear .= $value.',';	
		$i++;	
	}
echo 'count is'.$i;	
	
	
	
	echo 'monthyear are:'.$_GET['monthyear'];
	$count = count($trimmonthyear);
	//echo 'count is'.$count;
	if($i >= '2')
	{
			foreach($_GET['monthyear'] as $key=>$value){
								if($key == 0){
												$query .= "(batch_table.b_s_date LIKE ('%$value%')";									
									
									}	 else {
										
										
												$query .= "OR batch_table.b_s_date LIKE ('%$value%'))";									
										}
	
			}		
		
		
		}else{
					$trimmonthyear = current($_GET['monthyear']);
					$query .= "batch_table.b_s_date LIKE ('%$trimmonthyear%')";
		}
	
	
	
	


};

$process = "SELECT batch_table.*, tour.*, tour_category.*, tour_country.*  
FROM tour 
INNER JOIN batch_table ON (batch_table.dest_id = tour.t_id) 
INNER JOIN tour_category ON (tour.t_id = tour_category.t_id) 
INNER JOIN tour_country ON (tour.t_id = tour_country.t_id) WHERE $query";

echo $process;


		$getbatches = $db->get_results($process);

		echo '<pre>';
print_r($getbatches);
echo '</pre>';

	
}
?>

