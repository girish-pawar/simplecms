
		<link href="http://thoughtfulviewfinder.in/demo/gowild/admin/css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" />
<script src="http://thoughtfulviewfinder.in/demo/gowild/admin/js/bootstrap-datetimepicker.min.js"></script>

<form method='POST' action=''>
<?php
$extra = 1;
if(isset($_GET['id']))
{
$id = $_GET['id'];
}
else
{
$id=null;
}
$pre_camp_value = GetForm($_GET['type'],$id,$extra);
echo $pre_camp_value;

//$seo_table='seo_detail';
//$seo_form=Get_SeoForm($seo_table,$id);
//echo $seo_form;

//$b='1,2';
//$button= getbutton($b);
?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>

 <h3> Date  :</h3>
  <div id="datetimepicker1" class="input-append date">
    <input data-format="yyyy/MM/dd " type="text" name="date_pre"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  


<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
	   
  });
</script>
<h3> Time</h3>
<input type='text' name='time_pre'><br />
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='batch_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
				  <input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>
<input type='hidden' name='type_id' value='<?php echo $_GET['b_id'];?>'>
<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
<?php


//$b='1,2';
//$button= getbutton($b);
?>
<input type='submit' class="btn " name='submit'>
	<input type='submit' class="btn btn-primary" name='next_precamp_value' value='Skip & Continue'>
<!--<input type='submit' name='submit'>!-->
</form>
<?php




?>