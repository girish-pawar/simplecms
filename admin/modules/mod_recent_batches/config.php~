
Article Category Names:
<select name="artcat"> 
<?php
$menus = $db->get_results("SELECT * FROM article_category");
foreach($menus as $menu){ ?>
<option value="<?php echo $menu->acid;?>"><?php echo $menu->title; ?></option>
<?php }
?>
</select>

Select Limit of Articles:
<select name="artlimit"> 
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>


<select name="display">
<option value="1">yes</option>
<option value="0">no</option>
</select>