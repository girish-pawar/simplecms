
<?php
global $db;
$kind = $select1;
$row = $db->get_row("SELECT * FROM component WHERE comp_id = '$kind' ");
$row->comp_foldername;


//$getresults = $db->get_results("SELECT * FROM $category");


echo 'Select Category:';
$category = 'category';
$category1 = '0';
$category2 = '1';
 ?>
<div>
<input type="radio" name="select-all" checked="false" id="select-all" onblur="suggest12('<?php echo $category; ?>','<?php echo $category1; ?>');" />Select Category
<input type="radio" name="select-all" id="deselect-all"  onblur="suggest12('<?php echo $category; ?>','<?php echo $category2; ?>');" />Select All Category
<div id="<?php echo $category; ?>">
	
	</div>

</div>	
<?php	echo 'Select Country:';
$category = 'country';
 ?>
 <div>
<input type="radio" name="select-all" checked="false" id="select-all" onblur="suggest12('<?php echo $category; ?>','<?php echo $category1; ?>');" />Select Category
<input type="radio" name="select-all" id="deselect-all" onblur="suggest12('<?php echo $category; ?>','<?php echo $category2; ?>');" />Select All Category
<div id="<?php echo $category; ?>">
	
	</div>
</div>
<?php	echo 'Select Destination:';
$category = 'destination';
 ?>
 <div>
<input type="radio" name="select-all" checked="false" id="select-all" onblur="suggest12('<?php echo $category; ?>','<?php echo $category1; ?>');" />Select Category
<input type="radio" name="select-all" id="deselect-all"  onblur="suggest12('<?php echo $category; ?>','<?php echo $category2; ?>');" />Select All Category
<div id="<?php echo $category; ?>">
	
	</div>

</div>
<?php	echo 'Select Tour:';
$category = 'tour';
 ?>
 <div>
<input type="radio" name="select-all" checked="false" id="select-all" onblur="suggest12('<?php echo $category; ?>','<?php echo $category1; ?>');" />Select Category
<input type="radio" name="select-all" id="deselect-all" onblur="suggest12('<?php echo $category; ?>','<?php echo $category2; ?>');" />Select All Category
<div id="<?php echo $category; ?>">
	
	</div>
</div>

<div>
<label> No. of records per page:</label>
<input type="text" name="no_of_records" value="" />
<label>No. of Columns Display per page:</label>
<input type="text" name="no_of_colm" value="" />
<label>Image Display:</label>
		<select name='image_display'>
  <option value='yes'>yes</option>
  <option value='no'>no</option>
  </select>
  
  <input type='text' id='searchseo' name='searchseo' onkeyup='suggest_seo_title();' value=''>
        </div>
	
	