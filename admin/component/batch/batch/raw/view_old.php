<?php
include_once('../admin/includes/defination.php');
include_once('../admin/component/downloads/config.php');
include_once('../admin/includes/config.php');
head1();

if(isset($_GET['id']) && isset($_GET['action']))
{
$tablename = 'downloads';
delete($_GET['id'],$tablename);	
}


if(isset($_GET['process']) == 'view')
{
$tableids = $db->get_row("SHOW FULL COLUMNS FROM downloads");
$fid = $tableids->Field;
//echo 'fid :'.$tableids->Field;

$idcount = $db->get_var("SELECT COUNT(*) FROM downloads");	
$getgalleries =$db->get_results("SELECT * FROM downloads");
if($getgalleries)
{
require '../admin/includes/Zebra_Pagination.php';

						 $records_per_page = $record;
        $pagination = new Zebra_Pagination();        $pagination->records($idcount);        $pagination->records_per_page($records_per_page);        $countries = array_slice(           $getgalleries,                                             //  from the original array we extract            (($pagination->get_page() - 1) * $records_per_page),    //  starting with these records            $records_per_page                                       //  this many records        );	
	
	?>

	<div class="row-fluid">
    <div class="block span12">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">View all Files</a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table table-bordered" class="countries">
              <thead>
                                <tr>	
<?php
echo '';	
$getcolms = $db->get_results("SHOW FULL COLUMNS FROM downloads");
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
 ?>
<td><?php echo $country->$field; ?></td>
	<?php
	
	 $vid = $country->$fid;
	// echo 'vid is:'.$vid;
// $gettype = $db->get_row("SELECT * FROM video_gallery_type WHERE vg_id = '$vid'");	 
//	}
	}

	?>
	
	<td>
	<!-- 		<a href="../admin/index.php?option=component&kind=videogallery&method=gallery&process=view&id=<?php echo $country->$fid;?>" title="View Video Gallery" ><i class="icon-list"></i></a> -->
	<a href="../admin/index.php?option=component&kind=<?php echo $_GET['kind'];?>&method=<?php echo $_GET['method']; ?>&process=add&vid=<?php echo $vid;?>" title="Edit Link of File"><i class="icon-edit"></i></a>
	<a href="#myModal<?php echo $country->$fid; ?>" role="button" data-toggle="modal" title="Delete File" ><i class="icon-trash"></i></a>
<div class="modal small hide fade" id="myModal<?php echo $country->$fid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete this file?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/index.php?option=component&kind=<?php echo $_GET['kind'];?>&method=<?php echo $_GET['method']; ?>&process=view&id=<?php echo $country->$fid; ?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div>

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
</div>
<?php
	
}else{ 

echo 'No more records.';

}//close getgalleries	
	}
?>
