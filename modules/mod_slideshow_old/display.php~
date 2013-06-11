<?php
$getinfo = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id'");
//echo $topmodule->md_id;


$getpath = $db->get_row("SELECT * FROM moduleparams WHERE md_param_name='folderpath' AND md_id='$topmodule->md_id'");
//echo $getpath->md_param_data;
//echo $getpath;
$getwidth = $db->get_row("SELECT * FROM moduleparams WHERE md_param_name='width' AND md_id='$topmodule->md_id'");
$getheight = $db->get_row("SELECT * FROM moduleparams WHERE md_param_name='height' AND md_id='$topmodule->md_id'");

?>

<div style="width:<?php echo $getwidth->md_param_data ?>; " >
<!-- <div style="width:<?php echo $getwidth->md_param_data ?>; height:<?php echo $getheight->md_param_data; ?>; " > -->
    <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="<?php echo $getpath->md_param_data; ?>slide1.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>First Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="<?php echo $getpath->md_param_data; ?>slide2.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>Second Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="<?php echo $getpath->md_param_data; ?>slide3.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>Third Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                   <div class="item">
                    <img src="<?php echo $getpath->md_param_data; ?>slide4.jpg" alt="">
                    <div class="carousel-caption">
                      <h4>Third Thumbnail label</h4>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>

</div> 