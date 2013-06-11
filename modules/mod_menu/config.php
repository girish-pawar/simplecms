

<select name="menuid"> 
<?php
$menus = $db->get_results("SELECT * FROM menu_table");
foreach($menus as $menu){ ?>
<option value="<?php echo $menu->m_id;?>"><?php echo $menu->m_title; ?></option>
<?php }
?>
</select>


<select name="display">
<option value="1">yes</option>
<option value="0">no</option>
</select>