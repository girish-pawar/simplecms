

<div class="space1">
Select Category Name:
<select name="destcat"> 
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
<select name="destcatlimit"> 
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
<option value="d_t">Destination Title Ascending</option>
<option value="d_t desc">Destination Title Descending</option>
</select>
</div>


<!-- <div class="space1">
Display on hompage or not:
<select name="display">
<option value="1">yes</option>
<option value="0">no</option>
</select>
</div> -->