<?php
$getinfo = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id'");
$gettime = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id' AND md_param_name = 'time' ");
//echo $topmodule->md_id;
$si_ids = '';


//$getpath = $db->get_row("SELECT * FROM moduleparams WHERE md_param_name = 'set_name' AND mp_id='$topmodule->mp_id'");
//echo $getpath->md_param_data;

if($getinfo)
{
$id = $getinfo->md_param_data;
//echo 'id is'.$id;
$getsets = $db->get_row("SELECT * FROM sets WHERE set_id = '$id' AND set_status = 'publish'");
$firstimage = $db->get_row("SELECT * FROM set_image WHERE set_id='$id'");
$getimages = $db->get_results("SELECT * FROM set_image WHERE set_id='$id'");

					if($getimages)
					{
								foreach($getimages as $getimage)
								{
												if($getimage->si_id != $firstimage->si_id)
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
$time = $gettime->md_param_data;
//echo 'time is:'.$time;
//echo $getsets->set_width;
?>

    <div id="myCarousel" class="carousel slide" style="width:<?php echo $getsets->set_width; ?>; height:<?php echo $getsets->set_height; ?>; ">
                <ol class="carousel-indicators">
                 <li data-target="#myCarousel" data-slide-to="<?php echo $firstimage->si_id;?>" class="active"></li>
                <?php
                foreach($ids as $id)
                {?>
                	<li data-target="#myCarousel" data-slide-to="<?php echo $id;?> "></li>
                <?php	}
                 $imageurl = '../gowild/admin/component/slideshow/images';
                ?>
             
                </ol>
               <div class="carousel-inner">
                  <div class="item active">
                    <img src="<?php echo '../gowild/admin/component/slideshow/images/'.$firstimage->si_id.'.jpg'; ?>" alt="">
                    <div class="carousel-desc">
                      <h4><?php echo $firstimage->image_title; ?></h4>  
                      <p><?php echo $firstimage->image_desc; ?></p>                    
                    </div>
                    <div class="carousel-caption">
                      <h4><?php echo $firstimage->copyright_name; ?></h4>                      
                    </div>
                  </div>
                
                  <?php
                 
                  //echo $imageurl;
                  foreach($ids as $id)
                  {
                  	$image = $db->get_row("SELECT * FROM set_image WHERE si_id='$id' ");
                  	//echo $id;
                  
                  		?>    
  															<div class="item">
                    <img src="<?php echo '../gowild/admin/component/slideshow/images/'.$id.'.jpg'; ?>" alt="">
                    <div class="carousel-desc">
                      <h4><?php echo $image->image_title; ?></h4>  
                      <p><?php echo $image->image_desc; ?></p>                    
                    </div>
                   
                   <div class="carousel-caption">
                      <h4><?php echo $image->copyright_name; ?></h4>                      
                    </div>
                  </div>
              		 <?php 
              		}
                  ?>
          
                </div>
               <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>-->
              </div>
<?php
//$time = '2500';
?>


<script type="text/javascript" >
	
$('.carousel').carousel({
  interval: <?php echo $time; ?>
})
</script>
