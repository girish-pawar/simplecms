<?php

head_set();
?>

<h3>View Sets </h3>

<div class="pull-right span4 offset-3">
<!--<button class="btn btn-success"><a href='././index.php?option=component&kind=slideshow&method=sets&process=add' ></a></button>-->
<a href='././index.php?option=component&kind=slideshow&method=sets&process=add'class="btn btn-info" >Add New Set</a>

</div>
<?php
if($_GET['id']=='all')
{
$set= $db->get_results("SELECT * FROM sets");
if($set)
{
?>
<table class='table'>
<tr><th>Set Title</th><th>Status</th><th>Option</th></tr>
<?php
foreach($set as $sets)
{

?>
<tr><td><?php echo $sets->set_title;?></td><td>
<?php

if($sets->set_status=='Publish')
{
?>
 <?php // echo $sets->set_status;?>
<a href='../admin/includes/header.php?set_idUn=<?php echo $sets->set_id;?>'>Click To Unpublish</a>
<?php
}
else
{
?>
<a href='../admin/includes/header.php?set_idPub=<?php echo $sets->set_id;?>'>Click to publish</a>
<?php //echo $sets->set_status;?>
<?php

}
?>


</td><td><a href='././index.php?option=component&kind=slideshow&method=sets&process=add&id=<?php echo $sets->set_id;?>' title="Edit Set"><i class="icon-edit"></i></a>
<a href='././index.php?option=component&kind=slideshow&method=sets&process=view&id=<?php echo $sets->set_id;?>' title="View All Details" ><i class="icon-list"></i></a></td>
<!--<a href='././index.php?option=component&kind=slideshow&method=sets&process=view&id=<?php echo $sets->set_id;?>' title="View All Details" >Config</a>-->
</tr>
<?php
}
?>
</table>
<?php

}
}
else
{

//echo'not all';
$set_image= $db->get_results("SELECT * FROM set_image WHERE set_id='$_GET[id]'");
if($set_image)
{
?>
<form method='POST' action=''>
  <input type='submit' name='update_set' value='Update & Exit' class='btn btn-primary'>
  <input type='submit' name='set_exit' value='Exit' class='btn btn-inverse'>
  <br />
  <input type='hidden' name='set_id' value='<?php echo $_GET['id'];?>'>
<?php
foreach($set_image as $img)
{
?>

<li class="span8">
              
             
<div class="thumbnail">
                 <img src='../admin/component/slideshow/images/<?php echo $img->si_id;?>.jpg'>
                  <div class="caption">
				  <b>Title :</b><input type='text' name='image_title[<?php echo $img->si_id;?>]' value='<?php echo $img->image_title;?>'>
				
				  <b> Image Description</b><textarea name='image_desc[<?php echo $img->si_id;?>]'><?php echo $img->image_desc;?></textarea>
               
                  
                <?php
				$status=array('publish','unpublish');
				?><br />
				<b>Status :</b><select name='status[<?php echo $img->si_id;?>]'>
				  <?php
				  foreach($status as $st)
				  {
				  if($img->status==$st)
				  {
				      ?>
				  <option value='<?php echo $st;?>' selected><?php echo $st;?></option>
				  <?php
				  }
				  else
				  {
				    ?>
				  <option value='<?php echo $st;?>'><?php echo $st;?></option>
				  <?php
				  }
				  
				  }
				  ?>
				  </select>
				  <center>
				 
					<?php
					$im_id=$img->si_id;
					$folder='images';
					
					$show=Delete_imageSlideshow($im_id,$folder);
					?>
					
					<?php echo $show;?>
					
					<!--<a href='./index.php?img_id=<?php echo $img->im_id;?>&folder=<?php echo $gallary->g_folder;?>'><span class="label label-important">Delete</span></a>!-->
				 </center>
				 </div>
                </div>

  </li>
  

<?php

}

}
}
?>


</form>