<?php
	//$getinfo = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id'");
//echo $topmodule->md_id;
$images = '';
$links = '';
$si_ids = '';
$topmodules = $db->get_results("SELECT * FROM sets WHERE set_status = 'Publish' ");
$getpath = $db->get_results("SELECT * FROM component WHERE comp_t = 'Slideshow' ");
if($topmodules)
{
foreach($topmodules as $topmodule)
{
$modtype = $topmodule->set_id;
//echo 'modtype is:'.$modtype;
	$getimages = $db->get_results("SELECT * FROM set_image WHERE set_id='$modtype'");
	
//print_r($getimages);
//$getpath = $db->get_row("SELECT * FROM moduleparams WHERE md_param_name='folderpath' AND md_id='$topmodule->md_id'");
if($getimages)
{
foreach($getimages as $getimage)
{
/*$images .= $getimage->image_name.',';
$links .= $getimage->image_title.',';*/
$si_ids .= $getimage->si_id.',';
} 
}

}

}

$sids = trim($si_ids,',');
$ids = array();
$ids = explode(',',$sids);

?>

    <div id="myCarousel" class="carousel-slide" style="width:1000px; height:430px; ">
                <ol class="carousel-indicators">
                 <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <?php
                foreach($ids as $id)
                {?>
                	<li data-target="#myCarousel" data-slide-to="<?php echo $id;?> "></li>
                <?php	}
                ?>
               <!--   <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li-->
                </ol>
               <div class="carousel-inner">
                  <div class="item active">
                    <img src="<?php echo '../gowild/admin/component/slideshow/images/default.jpg'; ?>" alt="">
                    <!--<div class="carousel-caption">
                      <h4>Deafult Thumbnail label</h4>                      
                    </div>-->
                  </div>
                
                  <?php
                  $imageurl = '../gowild/admin/component/slideshow/images';
                  //echo $imageurl;
                  foreach($ids as $id)
                  {
                  	$image = $db->get_row("SELECT * FROM set_image WHERE si_id='$id' ");
                  	//echo $id;
                  
                  		?>    
  															<div class="item">
                    <img src="<?php echo '../gowild/admin/component/slideshow/images/'.$id.'.jpg'; ?>" alt="">
                   <!-- <div class="carousel-caption">
                      <h4><?php echo $image->image_title; ?></h4>                      
                    </div>-->
                  </div>
              		 <?php 
              		}
                  ?>
                
                
                <!--<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>-->
                </div>
              </div>
