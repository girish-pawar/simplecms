


<form method='POST' action=''>
<h3> Select Instructer</h3>

<?php
$instructer= $db->get_results("SELECT * FROM instructor");
foreach($instructer as $ins)
{
?>


<input type='checkbox' name='instructer_id[]' value='<?php echo $ins->i_id;?>'><?php echo $ins->i_ty;?><br />



<?php

}

?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>
<input type='hidden' name='b_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='seo_table' value=''>

<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>

<input type='hidden' name='table' value='batch_instructer'>
<input type='submit' class="btn " name='submit'>
	<input type='submit' class="btn btn-primary" name='next_precamp' value='Skip & Continue'>
</form>
<?php




?>