


<form method='POST' action=''>
<h3>Fee Type</h3>
<?php

$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
$currency= $db->get_results("SELECT * FROM currency");
foreach($currency as $curr)
{
?>
<h3> <?php echo $curr->cr_ty;?></h3>
<?php
foreach($batch_charges as $fee)
{
?>
<h3><?php echo $fee->bc_ty;?></h3>
<input type='text' name='bc_id[<?php echo $curr->cr_id;?>][<?php echo $fee->bc_id;?>]' value=''>
<?php

}
}
?><br />
<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='submit' class="btn " name='submit_batchfee' >
<input type='submit' class="btn btn-primary" name='submit_batchfee_skip' value='Skip & Continue '>
</form>
