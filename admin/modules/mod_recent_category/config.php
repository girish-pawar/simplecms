

<div class="space1">
Select Batches:
<select name="batchcat"> 
<option value="0">All</option>
<?php
$menus = $db->get_results("SELECT * FROM batch_table");
foreach($menus as $menu){ ?>
<option value="<?php echo $menu->b_id;?>"><?php echo $menu->b_t; ?></option>
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
<option value="ct_t">Category Title Ascending</option>
<option value="ct_t desc">Category Title Descending</option>
</select>
</div>

