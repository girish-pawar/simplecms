
<!-- Article Category Names:
<select name="artcat"> 
<?php
$menus = $db->get_results("SELECT * FROM article_category");
foreach($menus as $menu){ ?>
<option value="<?php echo $menu->acid;?>"><?php echo $menu->title; ?></option>
<?php }
?>
</select> -->

Select Login Type:
<select name="select_login"> 
<option value="by_form">By Form</option>
<option value="by_modal">By Modal</option>
</select>

