<?php


if(isset($_POST['update_batch_fee']))
{
$b_id= $_POST['id'];
$userid= $_POST['userid'];
//print_r($_POST);
foreach($_POST as $key=>$value)
{
//echo 'key '.$key.'<br />';
$currency= $db->get_results("SELECT * FROM currency");
foreach($currency as $cu)
{
$batch_charges= $db->get_results("SELECT * FROM batch_charges_type");
foreach($batch_charges as $fee)
{
//print_r($value[2]);
echo'bc_id'.$fee->bc_id.'cr_id'.$cu->cr_id. 'value '.$value[$cu->cr_id][$fee->bc_id].'<br />';
$values=$value[$cu->cr_id][$fee->bc_id];
if($values=='')
{
$batch_fe= $db->get_row("SELECT * FROM batch_fee WHERE (b_id='$b_id' AND bc_id='$fee->bc_id') AND (bf_cr_id='$cu->cr_id')");
if($batch_fe)
{
$delete= $db->query("DELETE FROM batch_fee WHERE(b_id='$b_id' AND bc_id='$fee->bc_id') AND (bf_cr_id='$cu->cr_id')");
}
}
if($values!='')
{
$batch_fees= $db->get_row("SELECT * FROM batch_fee WHERE b_id='$b_id' AND bc_id='$fee->bc_id'");
if($batch_fees)
{

//echo'value'.$batch_fees->bf_value.'<br />';
$date=date('Y-m-d H:i:s');
if($batch_fees->bf_value==$values)
{
echo 'value '.$values.'<br />';
}
else
{


echo 'value'.$batch_fees->bf_value.'new value'.$values.'<br />';
$original_value=$batch_fees->bf_value;

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='batch_fee' AND type_id='$batch_fees->bf_id') AND(field_change='bf_value') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_fee','$batch_fees->bf_id','bf_value','$original_value','$values','$date','$userid','$change_count')");

}

if($batch_fees->bf_cr_id==$cu->cr_id)
{
}
else
{
$original_value=$batch_fees->bf_cr_id;
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_fee','$b_id','bf_cr_id','$original_value','$cu->cr_id','$date','$userid','$change_count')");
}
$update= $db->query("UPDATE batch_fee SET bf_value='$values',bf_cr_id='$cu->cr_id' WHERE b_id='$b_id' AND bc_id='$fee->bc_id'");
}
else
{
$batch_fee= $db->query("INSERT INTO batch_fee VALUES('','$fee->bc_id','$values','$cu->cr_id','$b_id')");
}


//$up="UPDATE batch_fee SET bc_id='$fee->bc_id',bf_value='$values',bf_cr_id='$cu->cr_id' WHERE b_id='$b_id' AND bc_id='$fee->bc_id'";

//echo $up.'<br />';
}

}
}
break 1;
}

}




if(isset($_POST['update_discount']))
{
$b_id= $_POST['id'];
//print_r($_POST);
$userid= $_POST['userid'];
foreach($_POST as $key=>$value)
{
//echo 'key '.$key.'<br />';
$discount_type= $db->get_results("SELECT * FROM discount_type");
foreach($discount_type as $offer)
{
//print_r($value[2]);
echo'dt_id'.$offer->dt_id. 'value '.$value[$offer->dt_id].'<br />';
$values=$value[$offer->dt_id];
//if($values!='')
//{

$discount_value= $db->get_row("SELECT * FROM discount_value WHERE dv_bid='$b_id' AND dt_id='$offer->dt_id'");
if($discount_value)
{

if($discount_value->dv_value==$values)
{

}
else
{
echo'value'.$discount_value->dv_value.'new value'.$values.'<br />';
$original_value= $discount_value->dv_value;
$date=date('Y-m-d H:i:s');

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='discount_value' AND type_id='$discount_value->dv_id') AND(field_change='dv_value') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','discount_value','$discount_value->dv_id','dv_value','$original_value','$values','$date','$userid','$change_count')");


}

$update_discount= $db->query("UPDATE discount_value SET dv_value='$values' WHERE dv_bid='$b_id' AND dt_id='$offer->dt_id'");
}
else
{
$batch_fee= $db->query("INSERT INTO discount_value VALUES('','$offer->dt_id','$values','$b_id')");

}



//}
//header('location:add.php?type=schedule_type&tmpl=default&b_id='.$b_id);
//foreach($value[$cu->cr_id] as $val)
//{
//echo 'value '.$val.'<br />';
//print_r($key);
//echo 'key '.$key.' Value'.$value.'<br />';
//}
}
break 1;
}
}
?>



<?php

if(isset($_POST['submit_sche']))
{
 
//print_r($_POST);
$schedule= $db->get_results("SELECT * FROM schedule_type");
$b_id= $_POST['id'];
$bath_schedule= $db->get_row("SELECT * FROM schedule_value WHERE b_id='$b_id' ORDER BY group_id DESC LIMIT 1");
if($bath_schedule)
{
$group_id= $bath_schedule->group_id + 1;
}
else
{
//echo 'group id'.$bath_schedule->group_id.'<br />';
$group_id='1';
}

foreach($schedule as $schedules)
{

foreach($_POST as $key=>$value)
{

//echo 'key'. $key.'<br />';
//print_r($value);
//echo 'value'.$value[2];
if(!empty($value[$schedules->st_id]))
{
$values=$value[$schedules->st_id];
//echo $value[$schedules->st_id].'<br >';

if($values!='' && $values!='b' && $values!='u')
{
echo 'scid :'.$schedules->st_id.'<br />';
//echo 'values'.$values.'<br />';
echo $schedules->st_ty. $value[$schedules->st_id];
//echo $key[$schedules->st_id].'<br />';
//echo 'type'.$schedules->st_ty.'value'.$value[$schedules->st_id];
//echo'title'. $value['Title'][1];

$insert= $db->query("INSERT INTO schedule_value VALUES('','$schedules->st_id','$group_id','$b_id','$values')");
}
}
//break ;
}
//break 1;
}

}
?>



<?php
if(isset($_POST['delete_schedule']))
{
	$table= $_POST['table'];
	$svid= $_POST['sv_id'];
	
	delete($svid,$table);
	}

?>
<?php
if(isset($_POST['update_schedule']))
{
$sv_id= $_POST['sv_id'];
$userid= $_POST['userid'];
if(isset($_POST['title']))
{
$sv_value= $_POST['title'];
}

if(isset($_POST['description']))
{

$sv_value= $_POST['description'];
}

$schedule= $db->get_row("SELECT * FROM schedule_value WHERE sv_id='$sv_id'");
if($schedule->sv_value==$sv_value)
{
echo'equal ';
}
else
{

$original_value= $schedule->sv_value;
$date=date('Y-m-d H:i:s');

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='schedule_value' AND type_id='$sv_id') AND(field_change='sv_value') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','schedule_value','$sv_id','sv_value','$original_value','$sv_value','$date','$userid','$change_count')");


}

$update= $db->query("UPDATE schedule_value SET sv_value='$sv_value' WHERE sv_id='$sv_id'");
}
?>

<?php
if(isset($_POST['update_inst']))
{
$b_id= $_POST['id'];
$inst_id= $_POST['instructer_id'];
$userid= $_POST['userid'];
$inst_idd='';
if($inst_id!='') {
foreach($inst_id as $instruct_id)
{

$inst_idd.=$instruct_id.',';
} }

$batch_instructer= $db->get_row("SELECT * FROM batch_instructer WHERE b_id='$b_id'");
if($batch_instructer->instructer_id==$inst_idd)
{
//echo 'value equal';
}
else
{

$original_value= $batch_instructer->instructer_id;
$date=date('Y-m-d H:i:s');

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='batch_instructer' AND type_id='$batch_instructer->bi_id') AND(field_change='instructer_id') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','batch_instructer','$batch_instructer->bi_id','instructer_id','$original_value','$inst_idd','$date','$userid','$change_count')");
}
$update= $db->query("UPDATE batch_instructer SET instructer_id='$inst_idd' WHERE b_id='$b_id'");
}
?>
<?php
if(isset($_POST['update_precamp']))
{
$b_id= $_POST['id'];
$pre_camp_id= $_POST['pre_camp'];
$userid= $_POST['userid'];
$date= $_POST['date'];
$time= $_POST['time'];

$pre_camp= $db->get_row("SELECT * FROM pre_camp_value WHERE batch_id='$b_id'");
if($pre_camp->pc_id!=$pre_camp_id)
{



$original_value= $pre_camp->pc_id;
$date_change=date('Y-m-d H:i:s');

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='pc_id') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','pc_id','$original_value','$pre_camp_id','$date_change','$userid','$change_count')");


}

if($pre_camp->date_pre!=$date)
{



$original_value= $pre_camp->date_pre;
$date_change=date('Y-m-d H:i:s');

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='date_pre') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','date_pre','$original_value','$date','$date_change','$userid','$change_count')");



}

if($pre_camp->time_pre!=$time)
{





$original_value= $pre_camp->time_pre;
$date_change=date('Y-m-d H:i:s');

$admin_count= $db->get_row("SELECT * FROM admin_change WHERE (type='pre_camp_value' AND type_id='$pre_camp->pcv_id') AND(field_change='time_pre') ORDER BY ac_id DESC");
if($admin_count)
{
$change_count=$admin_count->change_count + 1;
}
else
{
$change_count='1';
}
$insert_admin= $db->query("INSERT INTO admin_change VALUES('','pre_camp_value','$pre_camp->pcv_id','time_pre','$original_value','$time','$date_change','$userid','$change_count')");

}


$update= $db->query("UPDATE pre_camp_value SET pc_id='$pre_camp_id',date_pre='$date',time_pre='$time' WHERE batch_id='$b_id'");

}

?>
 
		<link href="http://thoughtfulviewfinder.in/demo/gowild/admin/css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" />
<script src="http://thoughtfulviewfinder.in/demo/gowild/admin/js/bootstrap-datetimepicker.min.js"></script>

<?php 
				global $db;
				$batch= $db->get_row("SELECT * FROM batch_table WHERE b_id='$_GET[id]'");
				?>
				
				<h3>Batch Title : <?php echo $batch->b_t;?></h3>
<div class="bs-docs-example">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Batch </a></li>
              <li class=""><a href="#profile" data-toggle="tab">Fee</a></li>
			    <li class=""><a href="#discount" data-toggle="tab">Discount</a></li>
				  <li class=""><a href="#schedule" data-toggle="tab">Schedule</a></li>
				   <li class=""><a href="#instructer" data-toggle="tab">Instructer</a></li>   
				    <li class=""><a href="#precamp" data-toggle="tab">Pre Camp Venue</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                  <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
                </ul>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
                <p>
				<?php
				$type='batch_table';
				$field='b_t';
				$id=$_GET['id'];
				$count=admin_change_count($type,$field,$id);
				
				//$admin_change= $db->get_results("SELECT * FROM admin_change WHERE (type='$type' AND type_id='$_GET[id]') AND (field_change='$field')");
				//print_r($admin_change);
				
				$view_b_t= admin_change_display($type,$field,$id);
				?>
				<form method='POST' action=''>
<h3>Batch Title <?php echo $count;?> <?php echo $view_b_t;?></h3>
<input type='text' name='b_t' value='<?php echo $batch->b_t;?>'>

<?php
$dest= $db->get_results("SELECT * FROM destination");
?>
<?php
$type='batch_table';
				$field='dest_id';
				$id=$_GET['id'];
				$count_dest=admin_change_count($type,$field,$id);
				$view_dest_id= admin_change_display($type,$field,$id);
				//$admin_change= $db->get_results("SELECT * FROM admin_change WHERE (type='$type' AND type_id='$_GET[id]') AND (field_change='$field')");
				//print_r($admin_change);
				
?>
<h3>Destination <?php echo $count_dest;?> <?php echo $view_dest_id;?> </h3>
<?php $ch_id='';
foreach($dest as $destination)
{
$ch_id.=$destination->d_id.',';
?>

<!--<input type='checkbox' name='dest_id[]' value='<?php echo $destination->d_id;?>'><?php echo $destination->d_t;?><br />!-->
<?php

}
?>


<?php

$dataid=explode(',',$batch->dest_id);
				$chk_id=explode(',',$ch_id);
	//print_r($dataid);			
	//print_r($chk_id);	

//checked destination

foreach($dataid as $id)
{
if($id!='')
{
$dest= $db->get_row("SELECT * FROM destination WHERE d_id='$id'");
if($dest)
{
?>

<input type='checkbox' checked name='dest_id[]' value='<?php echo $dest->d_id;?>'><?php echo $dest->d_t;?><br />
<?php
}
}

}	
		


//not selected
	$diff_id=array_merge(array_diff($dataid,$chk_id),array_diff($chk_id,$dataid));

foreach($diff_id as $chkid)
{
if($chkid!='')
{
$dest= $db->get_row("SELECT * FROM destination WHERE d_id='$chkid'");
if($dest)
{
?>

<input type='checkbox' name='dest_id[]' value='<?php echo $dest->d_id;?>'><?php echo $dest->d_t;?><br />
<?php

}
}

}			
?>
<?php
$type='batch_table';
				$field='b_s_date';
				$id=$_GET['id'];
				$count_date=admin_change_count($type,$field,$id);
				$view_b_s_date= admin_change_display($type,$field,$id);
				?>
 <h3>Start Date :  <?php echo $count_date;?> <?php echo $view_b_s_date;?> <?php //echo $batch->b_s_date;?> </h3>
  <div id="datetimepicker1" class="input-append date">
    <input data-format="yyyy-MM-dd hh:mm:ss" value="<?php echo $batch->b_s_date;?>" type="text" name="b_s_date"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  <?php
$type='batch_table';
				$field='b_e_date';
				$id=$_GET['id'];
				$count_date_e=admin_change_count($type,$field,$id);
				$view_b_e_date= admin_change_display($type,$field,$id);
				?>
   <h3>End Date :  <?php echo $count_date_e;?> <?php echo $view_b_e_date;?> <?php //echo $batch->b_e_date;?> </h3>
  <div id="datetimepicker2" class="input-append date">
    <input data-format="yyyy-MM-dd hh:mm:ss" value="<?php echo $batch->b_e_date;?>" type="text" name="b_e_date"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  

  <?php
$type='batch_table';
				$field='b_includes';
				$id=$_GET['id'];
				$count_b_includes=admin_change_count($type,$field,$id);
				$view_b_includes= admin_change_display($type,$field,$id);
				?>

<h3>Batch Includes <?php echo $count_b_includes;?> <?php echo $view_b_includes;?></h3>
<textarea name='b_includes'><?php echo $batch->b_includes;?></textarea>

  <?php
$type='batch_table';
				$field='b_excludes';
				$id=$_GET['id'];
				$count_b_excludes=admin_change_count($type,$field,$id);
				$view_b_excludes= admin_change_display($type,$field,$id);
				?>
				
<h3>Batch Excludes  <?php echo $count_b_excludes;?> <?php echo $view_b_excludes;?></h3>
<textarea name='b_excludes'><?php echo $batch->b_excludes;?></textarea>

  <?php
$type='batch_table';
				$field='b_tags';
				$id=$_GET['id'];
				$count_b_tags=admin_change_count($type,$field,$id);
				$view_b_tags= admin_change_display($type,$field,$id);
				?>
				
<h3>Batch Tags <?php echo $count_b_tags;?> <?php echo $view_b_tags;?></h3>
<input type='text' name='b_tags' value='<?php echo $batch->b_tags;?>'>


  <?php
$type='batch_table';
				$field='b_accomodation';
				$id=$_GET['id'];
				$count_b_accomodation=admin_change_count($type,$field,$id);
				$view_b_accomodation= admin_change_display($type,$field,$id);
				?>
				
<h3>Batch Accomodation <?php echo $count_b_accomodation;?> <?php echo $view_b_accomodation;?></h3>
<textarea name='b_accomodation'><?php echo $batch->b_accomodation;?></textarea>
<?php
$status=array('active','inactive');
?>


  <?php
$type='batch_table';
				$field='b_status';
				$id=$_GET['id'];
				$count_b_status=admin_change_count($type,$field,$id);
				$view_b_status= admin_change_display($type,$field,$id);
				?>
<h3>status <?php echo $count_b_status;?> <?php echo $view_b_status;?></h3>
<select name='b_status'>
<?php

foreach($status as $stats)
{
if($stats==$batch->b_status)
{

?>
<option value='<?php echo $stats;?>' selected><?php echo $stats;?></option>


<?php
}
else
{

?>
<option value='<?php echo $stats;?>'><?php echo $stats;?></option>


<?php
}


}

?>

</select><br />

<?php

$seo_table='seo_detail';

$id=$_GET['id'];
$extra=null;
$sd_type='batch_table';
$seo_form=Get_SeoForm($seo_table,$id,$extra,$sd_type);
echo $seo_form;

?>
<!--<input type='submit' class="btn " name='submit'>!-->
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='seo_table' value='123'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
</form>
				</p>
              </div>
              <div class="tab-pane fade" id="profile">
                <p>
					<form method='POST' action=''>
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

$batch_fee= $db->get_row("SELECT * FROM batch_fee WHERE (b_id='$_GET[id]' AND bf_cr_id='$curr->cr_id') AND (bc_id='$fee->bc_id')");

//print_r($batch_fee);
?>

					 <?php
$type='batch_fee';
				$field='bf_value';
				$id=$batch_fee->bf_id;
				$count_bf_value=admin_change_count($type,$field,$id);
				$view_bf_value= admin_change_display($type,$field,$id);
				?>
				
<h3><?php echo $fee->bc_ty;?> <?php echo 'bf_id'.$batch_fee->bf_id;?></h3>
<?php
if($curr->cr_ty=='dollar')
{
?>
<div class="input-prepend input-append">
  <span class="add-on">$</span>
  <?php
  }
  else
  {
  ?>
  <div class="input-prepend input-append">
  <span class="add-on">Rs</span>
  <?php
  
  }
  ?>


<input type='text' class='span2' id='appendedPrependedInput' name='bc_id[<?php echo $curr->cr_id;?>][<?php echo $fee->bc_id;?>]' value='<?php if ($batch_fee) { echo $batch_fee->bf_value; } ?>'>

 <span class="add-on"></span>
</div>
<h3><?php echo $count_bf_value;?><?php echo $view_bf_value;?></h3>
<?php

}
}
?><br />

<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='batch_fee'>
	<input type='submit' class="btn btn-primary" name='update_batch_fee' value='Update'>
	</form>
	
				</p>
              </div>
			  <div class="tab-pane fade" id="discount">
                <p>
					<form method='POST' action=''>
					

				<?php

$discount_type= $db->get_results("SELECT * FROM discount_type");
?>

<?php
foreach($discount_type as $offer)
{

$discount_value= $db->get_row("SELECT * FROM discount_value WHERE dv_bid='$_GET[id]' AND dt_id='$offer->dt_id'");

?>
					 <?php
$type='discount_value';
				$field='dv_value';
				$id=$discount_value->dv_id;
				$count_dv_value=admin_change_count($type,$field,$id);
				$view_dv_value= admin_change_display($type,$field,$id);
				?>
 
<h3><?php echo $offer->dt_ty;?><?php echo $count_dv_value;?><?php echo $view_dv_value;?> </h3>
<input type='text' name='dt_id[<?php echo $offer->dt_id;?>]' value='<?php if($discount_value) { echo $discount_value->dv_value; } ?>'>
<?php

}

?><br />
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='discount_value'>
	<input type='submit' class="btn btn-primary" name='update_discount' value='Update'>
	</form>
				</p>
              </div>
			  
			  
			  <div class="tab-pane fade" id="schedule">
                <p>
			
				
				
				
				<!-- Button to trigger modal -->
<a href="#myModal124" role="button" class="btn btn-primary" data-toggle="modal">Add Schedule</a>
 
<!-- Modal -->
<div id="myModal124" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
    <h3 id="myModalLabel">Schedule Add</h3>
  </div>
  <div class="modal-body">
    <p>
	
						<form method='POST' action=''>
				<h3> Schedule</h3>
<?php

$schedule_type= $db->get_results("SELECT * FROM schedule_type");
?>

<?php
foreach($schedule_type as $schedule)
{
if($schedule->st_form=='input')
{
?>
<h3><?php echo $schedule->st_ty;?></h3>
<input type='input' name='<?php echo $schedule->st_ty;?>[<?php echo $schedule->st_id;?>]' value=''>
<?php
}
if($schedule->st_form=='textarea')
{
?>
<h3><?php echo $schedule->st_ty;?></h3>
<textarea name='<?php echo $schedule->st_ty;?>[<?php echo $schedule->st_id;?>]'></textarea>
<?php

}
}

?><br />
			
	
	
	</p>
  </div>
  <div class="modal-footer">
  <input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='seo_table' value=''>
  <input type='submit' class="btn btn-primary" name='submit_sche' value='Submit'>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  	
  </form>
  </div>
</div>
				
				
				
<?php

$schedule_value= $db->get_results("SELECT * FROM schedule_value WHERE b_id='$_GET[id]'");
if($schedule_value)
{

?>
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Users<span class="label label-warning"></span></a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
               
           </thead>
              <tbody>
			  <tr><th>schedule</th><th>option</th></tr>


				<?php
				foreach($schedule_value as $schedules)
				{
				$schedule_type= $db->get_row("SELECT * FROM schedule_type WHERE st_id='$schedules->st_id'");
				?>
				<tr>

				<td><?php echo'<h3>'. $schedule_type->st_ty.'</h3>'. $schedules->sv_value;?></td>
					<td>
										 <?php
$type='schedule_value';
				$field='sv_value';
				$id=$schedules->sv_id;
				$count_sv_value=admin_change_count($type,$field,$id);
				$view_sv_value= admin_change_display($type,$field,$id);
				?>
				<?php echo $count_sv_value;?><?php echo $view_sv_value;?> 
					<a href="#myModal<?php echo $schedules->sv_id;?>" role="button" class="btn" data-toggle="modal">Edit</a><?php //echo $schedules->sv_id;?>
					<a href="#myModal1<?php echo $schedules->sv_id;?>" class="btn btn-primary" role="button" class="btn" data-toggle="modal">Delete</a><?php //echo $schedules->sv_id;?>
					</td></tr>
					
					
						<form method='POST' action=''>
						
<div class="modal small hide fade" id="myModal1<?php echo $schedules->sv_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the Schedule?</p>
    </div>
    <div class="modal-footer">
	  	<input type='submit' class="btn btn-primary" name='delete_schedule' value='Delete'>
			
	<input type='hidden' name='sv_id' value='<?php echo $schedules->sv_id;?>'>
		<input type='hidden' name='table' value='schedule_value'>
		
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		
        
    </div>
</div>
					
					<!-- Button to trigger modal -->

 
<!-- Modal -->
<div id="myModal<?php echo $schedules->sv_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>

<?php

$schedule_values= $db->get_row("SELECT * FROM schedule_value WHERE sv_id='$schedules->sv_id'");
	$schedule_types= $db->get_row("SELECT * FROM schedule_type WHERE st_id='$schedule_values->st_id'");
if($schedule_types->st_ty=='Title')
{
?>
Title :

<input type='input' name='title' value='<?php echo $schedule_values->sv_value;?>'>
<?php
}
if($schedule_types->st_ty=='Description')
{
?>
Description :
<textarea name='description'><?php echo $schedule_values->sv_value;?></textarea>
<?php

}
?>
	
	<input type='hidden' name='sv_id' value='<?php echo $schedules->sv_id;?>'>
	</p>
  </div>
  <div class="modal-footer">
  <input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
  	<input type='submit' class="btn btn-primary" name='update_schedule' value='Update'>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</form>
  </div>
</div>
				<?php
				
				}
				     
						?>
						


						
</tbody>
</table>						
</div>

<?php

}




?>
				
				</p>
              </div>
			   <div class="tab-pane fade" id="instructer">
                <p>
				<h3>Selected Instructer</h3>
					<form method='POST' action=''>
				<?php
				$batch_instructer= $db->get_row("SELECT * FROM batch_instructer WHERE b_id='$_GET[id]'");
				if($batch_instructer)
				{
				
				?>
				
														 <?php
$type='batch_instructer';
				$field='instructer_id';
				$id=$batch_instructer->bi_id;
				$count_instructer_id=admin_change_count($type,$field,$id);
				$view_instructer_id= admin_change_display($type,$field,$id);
				?>
				<?php echo $count_instructer_id;?><?php echo $view_instructer_id;?><br />
				<?php
				$instructer_id= explode(',',$batch_instructer->instructer_id);
				foreach($instructer_id as $in_id)
				{
				if($in_id!='')
				{
				$instructer= $db->get_row("SELECT * FROM instructor WHERE i_id='$in_id'");
				
				?>
				<input type='checkbox' checked name='instructer_id[]' value='<?php echo $instructer->i_id;?>'><a href="#" rel="tooltip" title="<?php echo $instructer->i_d;?>"><?php echo $instructer->i_ty;?></a><br />
				<?php
				}
				}
				}
				
				$all_instructer= $db->get_results("SELECT * FROM instructor");
				$inst_id='';
				foreach($all_instructer as $all)
				{
				$inst_id.=$all->i_id.',';
				
				}
				
				$chk_id=explode(',',$inst_id);
					$diff_id=array_merge(array_diff($instructer_id,$chk_id),array_diff($chk_id,$instructer_id));
					
					foreach($diff_id as $unch_id)
					{
					
						$instructer= $db->get_row("SELECT * FROM instructor WHERE i_id='$unch_id'");
					?>
					<input type='checkbox' name='instructer_id[]' value='<?php echo $instructer->i_id;?>'><a href="#" rel="tooltip" title="<?php echo $instructer->i_d;?>"><?php echo $instructer->i_ty;?></a><br />
					<?php
					
					}
				?>
				<br />
					<input type='submit' class="btn btn-primary" name='update_inst' value='Update'>
				<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='batch_instructer'>
	
</form>
				</p>
              </div>
			  
			  <div class="tab-pane fade" id="precamp">
                <p>
				
				<form method='POST' action=''>
				<?php
				$pre_camp= $db->get_row("SELECT * FROM pre_camp_value WHERE batch_id='$_GET[id]'");
				
				?>
																		 <?php
$type='pre_camp_value';
				$field='pc_id';
				$id=$pre_camp->pcv_id;
				$count_pc_id=admin_change_count($type,$field,$id);
				$view_pc_id= admin_change_display($type,$field,$id);
				?>
				
				<?php echo $count_pc_id;?><?php echo $view_pc_id;?><br />
				
				<?php
				$pre_camp_venue= $db->get_results("SELECT * FROM pre_camp_venue");
				foreach($pre_camp_venue as $pre_venue)
				{
				
				
				if($pre_venue->pc_id==$pre_camp->pc_id)
				{
				?>
				<input type='radio' checked name='pre_camp' value='<?php echo $pre_venue->pc_id;?>'><a href="#" rel="tooltip" title="<?php echo $pre_venue->pc_geo;?>"><?php echo $pre_venue->pc_t;?></a>	<br />
				<?php
				
				}
				else
				{
				?>
				<input type='radio' name='pre_camp' value='<?php echo $pre_venue->pc_id;?>'><a href="#" rel="tooltip" title="<?php echo $pre_venue->pc_geo;?>"><?php echo $pre_venue->pc_t;?>	</a><br />
				<?php
				
				}
				
				}
				
				
				
				?>
			 <?php
$type='pre_camp_value';
				$field='date_pre';
				$id=$pre_camp->pcv_id;
				$count_date_pre=admin_change_count($type,$field,$id);
				$view_date_pre= admin_change_display($type,$field,$id);
				?>
				
				
				
				<h3> Date  : <?php echo $count_date_pre;?><?php echo $view_date_pre;?></h3>
  <div id="datetimepicker124" class="input-append date">
    <input data-format="yyyy-MM-dd" type="text" name="date" value="<?php echo $pre_camp->date_pre;?>"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  

		 <?php
$type='pre_camp_value';
				$field='time_pre';
				$id=$pre_camp->pcv_id;
				$count_time_pre=admin_change_count($type,$field,$id);
				$view_time_pre= admin_change_display($type,$field,$id);
				?>
				

<h3> Time <?php echo $count_time_pre;?><?php echo $view_time_pre;?></h3>
<input type='text' name='time' value='<?php echo $pre_camp->time_pre;?>'><br />
				
				<input type='submit' class="btn btn-primary" name='update_precamp' value='Update'>
				<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<input type='hidden' name='seo_table' value=''>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='batch_instructer'>
</form>
				</p>
              </div>
			  
              <div class="tab-pane fade" id="dropdown1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>
		  
		  
		    
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
	    $('#datetimepicker2').datetimepicker({
      language: 'pt-BR'
    })
  });
</script>

<script type="text/javascript">
  $(function() {
    $('#datetimepicker124').datetimepicker({
      language: 'pt-BR'
    });
	   
  });
</script>