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
		
if(isset($_GET['vgid']) && isset($_GET['action']))
{
	$tablename = 'video_gallery';
delete($_GET['vgid'],$tablename);	
}

if(isset($_GET['hvid']) && isset($_GET['action']))
{
	$tablename = 'video_gallery_items_table';
delete($_GET['hvid'],$tablename);	
}


if(isset($_POST['hide']))
{
	print_r($_POST['fieldsarray']);
echo 'in post ';	
	}


if($id == 'all' )
{
$tableids = $db->get_row("SHOW FULL COLUMNS FROM video_gallery");
$fid = $tableids->Field;
//echo 'fid :'.$tableids->Field;

$idcount = $db->get_var("SELECT COUNT(*) FROM video_gallery");	
$getgalleries =$db->get_results("SELECT * FROM video_gallery");
require '../admin/includes/Zebra_Pagination.php';
						 $records_per_page = $record;
        $pagination = new Zebra_Pagination();        $pagination->records($idcount);        $pagination->records_per_page($records_per_page);        $countries = array_slice(           $getgalleries,                                             //  from the original array we extract            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records            $records_per_page                                       //  this many records        );	
	
	?>
	
	<?php 
head();
?>
	<form method="post">
<div class="block span12">
        <a data-toggle="collapse" class="block-heading" href="#tablewidget"><h2>View all video galleries.</h2></a>
        <div class="block-body in collapse" id="tablewidget" style="height: auto;">
            <table class="table table-bordered" class="countries" >
              <thead>
                <tr>	
<?php
echo '';	
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM video_gallery");
foreach($getcolms as $getcolm)
{
	
?>
                 <th><?php echo $getcolm->Comment; ?></th>
               <?php
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
 ?>
<td><?php echo $country->$field; ?></td>
    
<?php
}else{
?>
	<!-- <td><a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $country->$fid;?>" ><?php echo $country->$field; ?></a></td> -->
<td><?php echo $country->$field; ?></td>
	<?php
	
	 $vid = $country->$fid;
	// echo 'vid is:'.$vid;
 $gettype = $db->get_row("SELECT * FROM video_gallery_type WHERE vg_id = '$vid'");	 
	}
	}

	?>
	
	<td>
	<?php if($gettype)
	{
		?>
		<a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $country->$fid;?>" title="View Video Gallery" ><i class="icon-list"></i></a>
	<a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=add&type=<?php echo $gettype->vgt_type; ?>&id=<?php echo $gettype->vgt_ty_id;?>&step=2&vgid=<?php echo $vid;  ?>" title="Edit Video Gallery"><i class="icon-edit"></i></a>
	<a href="#myModal<?php echo $country->$fid; ?>" role="button" data-toggle="modal" title="Delete Video Gallery" ><i class="icon-trash"></i></a>
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
        <a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=all&vgid=<?php echo $country->$fid; ?>&action=delete" class="btn btn-danger" >Delete</a>
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
	echo '<h2>Video Items of  '.$getname->vg_t.'  Video Gallery.</h2>';
$getitems = $db->get_results("SELECT * FROM video_gallery_items_table WHERE vg_id = '$id'");

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
                
        <!--          <a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $_GET['id'];?>&hvid=<?php echo $getitem->vgi_id; ?>&action=delete" class="btn btn-inverse" >Delete Video</a> -->
                 
                 <a href="#myModal<?php echo $getitem->vgi_id; ?>" role="button" class="btn btn-primary" data-toggle="modal">Delete</a>
<div class="modal small hide fade" id="myModal<?php echo $getitem->vgi_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $_GET['id'];?>&hvid=<?php echo $getitem->vgi_id; ?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div> 
<!-- <a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=add&type=<?php echo $gettype->vgt_type; ?>&id=<?php echo $gettype->vgt_ty_id;?>&step=3&vg_id=<?php echo $getitem->vg_id;  ?>&vgi_id=<?php echo $getitem->vgi_id;?>" class="btn btn-danger" >Edit</a> -->
  														</div>                 
                 <!--  <input type="checkbox" name="fieldsarray" class="btn btn-success" value="<?php echo $getitem->vgi_id; ?>" ><?php echo $getitem->vgi_id; ?>If hide then Check.</input> -->
                  <!-- <a href="" name="hide" ><input type="submit" name="hide" class="btn btn-success" value="Hide" ></input></a> -->
                </div>
              </li>
             </ul>
  </div>	
  	
			<?php	}	 //foreach close			
		} //if close
?>		
<!-- <input type="submit" name="hide" value="Update" /> 		 -->
  </form>

<?php		
}// else close
?>