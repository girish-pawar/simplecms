


<form method='POST' action=''>
<h3>Discount Type</h3>
<?php

$discount_type= $db->get_results("SELECT * FROM discount_type");
?>

<?php
foreach($discount_type as $offer)
{
?>
<h3><?php echo $offer->dt_ty;?></h3>
<input type='text' name='dt_id[<?php echo $offer->dt_id;?>]' value=''>
<?php

}

?><br />
<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='submit' class="btn " name='submit_discount' >
<input type='submit' class="btn btn-primary" name='submit_discount_skip' value='Skip & Continue '>
<!--<input type='submit' name='submit'>!-->
</form>
<?php




?>