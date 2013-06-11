<?php
include_once('../admin/component/videogallery/config.php');
	include_once('../admin/includes/config.php');

$sizes = explode('x',$size);
$width = current($sizes);
$height = end($sizes);

if(isset($_GET['id']))
{
	$id = $_GET['id'];	
	}else{
		$id = null;		
		}

if(isset($_GET['hvid']) && isset($_GET['action']))
{
	$tablename = 'video_gallery_items_table';
delete($_GET['hvid'],$tablename);	
}

if(isset($_GET['vgi_id']) && isset($_GET['action']))
{
	$tablename = 'video_gallery_items_table';
delete($_GET['vgi_id'],$tablename);	
}

if($id == 'all' )
{
$tableids = $db->get_row("SHOW FULL COLUMNS FROM video_gallery_items_table");
$fid = $tableids->Field;
//echo 'fid :'.$tableids->Field;

$idcount = $db->get_var("SELECT COUNT(*) FROM video_gallery_items_table");	
//$items =$db->get_col("SHOW FULL COLUMNS FROM video_gallery_items_table");
//print_r($items);
$items = array("vgi_code","vg_service");

$getgalleries =$db->get_results("SELECT * FROM video_gallery_items_table");
require '../admin/includes/Zebra_Pagination.php';
						 $records_per_page = $record;
        $pagination = new Zebra_Pagination();        $pagination->records($idcount);        $pagination->records_per_page($records_per_page);        $countries = array_slice(           $getgalleries,                                             //  from the original array we extract            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records            $records_per_page                                       //  this many records        );	
	
	?>
	<?php 
head();
?>
	<form method="post">
<div class="block span12">
        <a data-toggle="collapse" class="block-heading" href="#tablewidget"><h2>View all Videos.</h2></a>
        <div class="block-body in collapse" id="tablewidget" style="height: auto;">
            <table class="table table-bordered" class="countries" >
              <thead>
                <tr>	
<?php
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM video_gallery_items_table");
foreach($getcolms as $getcolm)
{
	$field = $getcolm->Field;

if (in_array($field, $items))
{
	}else{	
		$comment = $getcolm->Comment;
?>
                 <th><?php echo $comment; ?></th>
               <?php
}
  }              
      ?> 
<th>Options</th>

                </tr>
              </thead>
              <tbody>
        
	<?php
	
foreach ($countries as $index => $country)
{
foreach($getgalleries as $getgallery)
{
	?>
	          <tr>
	<?php
foreach($getcolms as $getcolm)
{
	$field = $getcolm->Field;
$mystring = $field;
$findme   = '_t';
$pos = strpos($mystring, $findme);

if ($pos === false)
{ 
if (in_array($field, $items))
{
	}else	if($field == 'vg_id')
	{
		//echo 'cuntry->field is:'.$country->$field;
		$vgid = $country->$field;
		//echo 'vgid is'.$vgid;
		$names = $db->get_row("SELECT * FROM video_gallery WHERE vg_id = '$vgid'");
		//if($names)	{
		?>
<td><a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $names->vg_id; ?>" ><?php echo $names->vg_t; ?></a></td>
    
<?php
//}
$vid = $names->vg_id;
		$gettype = $db->get_row("SELECT * FROM video_gallery_type WHERE vg_id = '$vid'");
		}else
	{	

	
		$comment = $getcolm->Comment;
	
 ?>
<td><?php echo $country->$field; ?></td>
    
<?php
}
}else{
?>
	<td><a href="../admin/index.php?option=component&kind=videogallery&method=items&process=view&id=<?php echo $country->$fid;?>" ><?php echo $country->$field; ?></a></td>
	<?php 
	
	//echo $vid;
	
	}
	}?>
	<td>
	<?php if($gettype){
		//$infos = $

		?>
		<a href="../admin/index.php?option=component&kind=videogallery&method=items&process=view&id=<?php echo $country->$fid;?>" title="View Video Details" ><i class="icon-list"></i></a>
	<a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=add&type=<?php echo $gettype->vgt_type; ?>&id=<?php echo $gettype->vgt_ty_id;?>&step=3&vg_id=<?php echo $gettype->vg_id;  ?>&vgi_id=<?php echo $country->$fid;?>" title="Edit Video Details"><i class="icon-edit"></i></a>
	<a href="#myModal<?php echo $country->$fid; ?>" role="button" data-toggle="modal" title="Delete Video" ><i class="icon-trash"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $country->$fid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/index.php?option=component&kind=videogallery&method=items&process=view&id=all&vgi_id=<?php echo $country->$fid; ?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div>
<?php } ?>
	</td>
    </tr>
<?php 
break 1; }

}	?>
	
  
              </tbody>
            </table>
          <?php  // render the pagination links        $pagination->render();  ?>
        </div>
    </div>	
<?php
      	}else{
	//echo 'id is:'.$id;		
	//	echo '<h2>No more  video galleries.</h2>';
	$getname = $db->get_row("SELECT * from video_gallery WHERE vg_id = '$id'");
	//echo '<h2>Video Items of  '.$getname->vg_t.'  Video Gallery.</h2>';
$getitems = $db->get_results("SELECT * FROM video_gallery_items_table WHERE vgi_id = '$id'");

if($getitems)
{			
			foreach($getitems as $getitem)
			{ 
			$service = $getitem->vg_service;
	if($service == 'youtube')
{
	
$url = 'http://www.youtube.com/v/';	
	}	elseif($service == 'vimeo')
	{
	$url = 'http://vimeo.com/';	
}else{
	
$url = 'hi';	
	}			
			?>
				<div class="row-fluid">
            <ul class="thumbnails">
              <li class="span6">
                <div class="thumbnail">
  
<embed width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="<?php echo $url.$getitem->vgi_code ;?>"
type="application/x-shockwave-flash">

</embed>  
           <!-- http://youtu.be/A1VTaAYH3Hc
           http://vimeo.com/63115838
src="http://www.youtube.com/v/XGSy3_Czz8k"           
            -->     
                  <div class="caption">
                    <h3><?php echo $getitem->vgi_t; ?></h3>
                    <!--  <a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $_GET['id'];?>&hvid=<?php echo $getitem->vgi_id; ?>" name="hide" class="btn btn-primary"  >Hide</a> -->
                 <a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $_GET['id'];?>&hvid=<?php echo $getitem->vgi_id; ?>&action=delete" name="hide"  class="btn btn-inverse" >Delete Video</a> 
  												
                  </div>
                  <input type="submit" name="hide" class="btn btn-success" value="Hide" ></input>
                </div>
              </li>
             </ul>
  </div>	
  </form>			
			<?php	}	 //foreach close			
		} //if close
}// else close
?>