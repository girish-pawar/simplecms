<?php	
	if(isset($_POST['config']))
{
		$values = $_POST;
		$c = count($_POST);
		//echo $c;
		$d = +($c-1);
 $outputs = array_slice($values, 0, $d);;
	//print_r($asd);
		//mkdir('../gowild/admin/config', 0777);
		$fp = fopen("../admin/config/".$_GET['type'].".php","w"); 
		if($fp)
	{
		fwrite($fp,'<?php ');
			//echo 'file open';
			}
foreach($outputs as $output)
{
	if($fp)
	{
			echo 'file open';
			
			fwrite($fp,$output.';');
		}else{
echo 'file not open';			
			}
	
	}		
		if($fp)
	{
		fwrite($fp,'?> ');
	}	

	}
	
	
//$tablename = $_GET['type'];
$bar = $_GET["type"];
$bar = ucwords($bar);             // HELLO WORLD!
$bar = ucwords(strtolower($bar));	
?>
<a href="#myModal" role="button" class="btn" data-toggle="modal">Configure <?php echo $bar; ?></a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<?php 
$getcomponents = $db->get_results("SELECT * FROM component");
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Configure <?php echo $bar ?></h3>
</div>
<div class="modal-body">


<?php foreach($getcomponents as $getcomponent)
{
?>	
<div class="space1">
<label><?php echo $getcomponent->comp_t ?></label>
<input type="radio" value="<?php echo '$'.$getcomponent->comp_t.'= yes '; ?>"  name="<?php echo $getcomponent->comp_t; ?>" />
<input type="radio" value="<?php echo '$'.$getcomponent->comp_t.'= no ';?>"  name="<?php echo $getcomponent->comp_t; ?>" />
</div>
<?php }?>

</div>


<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<input type="submit" name="config" class="btn btn-primary" value="Save changes" />
</div>
</div>