
<!-- <label>Select Sets:</label>
<select name="set_name" />
<?php
$getcats = $db->get_results("SELECT * FROM category,seo_detail WHERE seo_detail.sd_ty = 'category' AND category.ct_id = seo_detail.sd_ty_id ");
//print_r($getcats);
if($getcats)
{
		foreach($getcats as $getcat)
		{
				?>
				
<option value="<?php echo $getcat->ct_id;?>"><?php echo $getcat->ct_t; ?></option>

				<?php
				
				
			
			}	
	}
?>
</select> -->







