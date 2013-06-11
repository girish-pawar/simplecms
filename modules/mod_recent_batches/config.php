

<div class="space1">
Select Category Name:
<select name="batchcat"> 
<option value="0">All</option>
<?php
$menus = $db->get_results("SELECT * FROM category");
foreach($menus as $menu){ ?>
<option value="<?php echo $menu->ct_id;?>"><?php echo $menu->ct_t; ?></option>
<?php }
?>
</select>
</div>

<div class="space1">
Select Limit of Categories:
<select name="batchcatlimit"> 
<?php
for($i = 0; $i<15; $i++)
{
?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php } ?>
</select>
</div>

<div class="space1">
Select Order By:
<select name="orderby">
<option value="b_t">Batch Title Ascending</option>
<option value="b_t desc">Batch Title Descending</option>
<option value="b_s_date">Batch Startdate Ascending</option>
<option value="b_s_date desc">Batch Startdate Descending</option>
</select>
</div>

