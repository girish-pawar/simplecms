<script type="text/javascript">
var xmlhttp;
function suggest1()
{
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp= new ActiveXObject('Micosoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("testblock").innerHTML=xmlhttp.responseText;
}
}
var userList = $('input[type=checkbox]:checked').serialize();
xmlhttp.open('GET','/component/batch/explore_destination.php?'+userList,true);
xmlhttp.send();
}
</script>


<?php
global $db;

$countries = $db->get_results("SELECT * FROM country");
echo '<h3>Countries</h3>';
foreach($countries as $country) { ?>
<input type="checkbox" name="country[]" onclick="javascript:suggest1();" class="check-with-label" value="<?php echo $country->c_id ?>" id="c<?php echo $country->c_id ?>" />
<label for="c<?php echo $country->c_id ?>" class="label-for-check"><?php echo $country->c_t; ?></label>
<div class="module_spacer"> </div>
<?php } ?>

<?php $today = date('Y-m-d H:i:s'); ?>
<h3>Select Month of Travel</h3>

 

<?php 
//$array = array();
$month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novemeber", "December");
foreach($month as $monthname)
{?>
<input type="checkbox" name="monthyear[]" onclick="javascript:suggest1();"  class="check-with-label"  id="my<?php echo $monthname ?>" value="<?php echo $monthname ?>" />
<label for="my<?php echo $monthname ?>" class="label-for-check"><?php echo $monthname; ?></label>

<?php
}
?>
<div class="module_spacer"> </div>
<h3>Interest</h3>
<?php $getcats = $db->get_results("SELECT * FROM category");
foreach($getcats as $getcat) { ?>
	<input type="checkbox" name="category[]" id="ct<?php echo $getcat->ct_id ?>" onclick="javascript:suggest1();" class="check-with-label" value="<?php echo $getcat->ct_id ?>" /> 
	<label for="ct<?php echo $getcat->ct_id ?>" class="label-for-check"><?php echo $getcat->ct_t ?></label>

<div class="module_spacer"> </div>
<?php }
?>
<style type="text/css">
div.module_spacer{
	width:100%;
	float:left;
	height:10px;
}

.check-with-label{
	display:none;
}

.check-with-label:checked + .label-for-check {
  font-weight: bold;
}

</style>