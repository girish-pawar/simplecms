
<label>Select Sets:</label>
<select name="set_name" />
<?php
$getsets = $db->get_results("SELECT * FROM sets");
if($getsets)
{
		foreach($getsets as $getset)
		{
				?>
				
<option value="<?php echo $getset->set_id;?>"><?php echo $getset->set_title; ?></option>

				<?php
				
				
			
			}	
	}
?>
</select>

<label>Specify Interval Time:</label>
<input type="text" name="time" value="" />






