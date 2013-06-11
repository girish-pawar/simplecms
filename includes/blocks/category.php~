<div class="span12 borders">
<?php 
$seotitle = $_GET['seotitle']	;
//$id = $cat->cid;
    $type = $_GET['type'];
	$cat = $db->get_row("SELECT * FROM category WHERE seotitle='$seotitle'");
	//print_r($cat); 
$id = $cat->cid;
$getconfig = $db->get_var("SELECT COUNT(*) FROM cconfig WHERE catid='$cat->cid' ");
if($getconfig == 1){
	$config = $db->get_row("SELECT * FROM cconfig WHERE catid='$cat->cid' ");
	} else {
	$config = $db->get_row("SELECT * FROM cconfig WHERE catid='0'");
		}
		//print_r($config);
?>
<div class="well">
<a href="" ><h2><?php echo $cat->title ?></h2></a>
    </div>
	   
	    <div class="span10 offset-1">

		  <ul class="nav nav-tabs">
    <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
<?php 
     $photos = $db->get_results("SELECT * from photogallery where id = '$cat->cid' and type = '$type' ");
if($photos){   ?> 
    <li><a href="#photo" data-toggle="tab">Photo Gallery</a></li>  
     <?php } ?> 
     
   </ul>     
    
    <div class="tab-content">
    <div class="tab-pane active" id="description"><h6><?php echo $cat->description ?></h6></div>
 <?php

if($photos)
{			
?> 
			<div class="tab-pane" id="photo">
			
			<?php //echo 'photo gallery'; 
foreach($photos as $photo)
{ 			
			$pid = $photo->id;
			$photoid = $photo->photoid;
		 $imageURL =	frontsite.'/vinzaiimages/'.$pid.'/thumb/'.$photoid.'.jpg';
		 $imageURL1 =	frontsite.'/vinzaiimages/'.$pid.'/full/'.$photoid.'.jpg';
		 ?>
		
<div class="span5"> 
		 <ul class="thumbnails">
 <li class="span12">
	<div class="thumbnail">
	<p><a class="group2" href="<?php echo $imageURL1 ?>" ><img class="grayscale" src="<?php echo $imageURL ?>" title="<?php echo $photo->link; ?>" ></a></p>
							<!-- 	<a class="group2" style="background:url(<?php echo $imageURL ?>)" title="Sample Image 1" href="<?php echo $imageURL ?>"> -->
								<!-- <img class="grayscale" src="<?php echo $imageURL ?>" alt="Sample Image 1"></a> -->
	
<!-- 	<a href="#" ><img src="<?php echo $imageURL ?>" alt="" >	</a> -->
	<h6><?php echo $photo->link; ?> </h6>
	</div>
</li>
</ul>
</div>
<?php } //foreach close ?>	 

</div>
<?php } //if close ?>	  
				 
</div> <!-- end tab content -->
		<script type="text/javascript">
    $(function () {
    $('#myTab a:last').tab('show');
    })
    </script>	

</div>		<!-- div span10 offset1 -->


</div> <!-- div12 borders end -->


<div class="span12">     


<?php
$getleads = $db->get_row("SELECT * FROM product WHERE catid='$cat->cid' ORDER BY '$config->orderby'");
$proseotitle = $getleads->seotitle;
$protype = 'product';

       $html = ''; 
if($config->leadid == 1)
{
$countrow = $db->get_var("SELECT COUNT(*) FROM product WHERE catid='$cat->cid'");
if($countrow != 0)
{
	
$html .= $getleads->prid; ?>
			
<div class="span12 hero-unit">
 <a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" >	<h5 class="label label-important"> <?php echo $getleads->title; ?></h5></a> 
<!--  <?php echo $getleads->title; ?></h5> -->
<div class="span12">
<div class="span6">
<?php
$length = $config->wordcount; // 80 words max
$phrase = $getleads->features; // populate this with the text you want to display
$abody = (str_word_count($phrase,2));
$c = count($abody);

if($c >= $length)
{ 
// gotta cut
 $tbody = array_keys($abody);			?>
<a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" ><h6><?php echo substr($phrase,0,$tbody[$length]); ?></h6></a>

<?php	} else {				// put the whole thing 
?>
<a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" ><h6><?php echo $phrase; ?></h6></a>

			<?php } ?>

<a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" ><h6>read more...</h6></a>
</div>		

	
<div class="span6" id="photo">
			<ul class="thumbnails">
			 <li class="span6">
  <div class="thumbnail">
			<?php //echo 'photo gallery'; 
		$productphoto = $db->get_row("SELECT * from photogallery where id = '$getleads->prid' and type = 'product' ");	
		if($productphoto)
		{			
			$proid = $getleads->prid;
			$photoid = $productphoto->photoid;
		 $imageurl =	frontsite.'/vinzaiimages/'.$proid.'/thumb/'.$photoid.'.jpg';
	 ?>
											<img src="<?php echo $imageurl ?>" >					
											<h6><?php echo $productphoto->link; ?> </h6>										
												<?php }else{ 
												$imageurl =	frontsite.'/vinzaiimages/index.png';												
												?>
												
												<img src="<?php echo $imageurl ?>" > 
												<h6><?php echo 'empty'; ?> </h6>
												<?php }?>
<!-- <a href="#" >
<img src="<?php echo $imageURL ?>" alt="" >
</a> -->
<!-- <h6><?php echo $productphoto->link; ?> </h6> -->
</div>
</li>

</ul>
</div>

		</div>	
</div>


			<?php
			

		} //check countrow
		else {
			echo 'Products not found';
			}

			} elseif($config->leadid == 0){
				
				} elseif($config->leadid > 1)
				{
					$limit = $config->leadid;
					$orderby = $config->orderby;
					$getleads = $db->get_results("SELECT * FROM product where catid = '$cat->cid' LIMIT $limit");					
					foreach($getleads as $getlead){
					$html .=$getlead->prid.',';		
?>
<div class="span12 hero-unit">
<div class="span6">
 	<h5 class="label label-important"> <?php echo $getlead->title; ?></h5> 
<?php
$length = $config->wordcount; // 80 words max
$phrase = $getlead->features; // populate this with the text you want to display
$abody = (str_word_count($phrase,2));
$c = count($abody);
//echo $c;
if($c >= $length)
{ // gotta cut
  $tbody = array_keys($abody);			
?>
<p><?php echo substr($phrase,0,$tbody[$length]); ?></p>

<?php
} else {				// put the whole thing 
?>
<p><?php echo $phrase; ?></p>

			<?php } ?>
<?php
$proseotitle = $getlead->seotitle;
$protype = 'product';
?>
<a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" ><h6>read more...</h6></a>
</div>		

	
<div class="span6" id="photo">
			<ul class="thumbnails">
			 <li class="span6">
  <div class="thumbnail">

			<?php //echo 'photo gallery';
$productphoto = $db->get_row("SELECT * from photogallery where id = '$getlead->prid' and type = 'product' ");	
		if($productphoto)
		{			
			$proid = $getlead->prid;
			$photoid = $productphoto->photoid;
		 $imageurl =	frontsite.'/vinzaiimages/'.$proid.'/thumb/'.$photoid.'.jpg';
	 ?>
											<img src="<?php echo $imageurl ?>" >					
											<h6><?php echo $productphoto->link; ?> </h6>										
												<?php }else{ 
												$imageurl =	frontsite.'/vinzaiimages/index.png';												
												?>
												
												<img src="<?php echo $imageurl ?>" > 
												<h6><?php echo 'empty'; ?> </h6>
												<?php }?>			

</div>
</li>
</ul>
</div>
</div>

<?php				
						}
						}else{
						}
?>
</div>

<div class="span12">
<?php
//print($html);					
			$array = rtrim($html,',');
			//echo $array;
		
		$getsecs = $db->get_results("SELECT * FROM product WHERE prid NOT IN ( $array ) AND catid='$cat->cid'");
		$count = count($getsecs);
		//echo $count;
if($count != 0)
{
		if ($config->lcid == 2)
		{				
		foreach($getsecs as $getsec)
		{
				?>
	<div class="span12">			
				<div class="span6 hero-unit">
<div class="span3">				
		 	<h5 class="label label-important">		 <?php echo $getsec->title; ?></h5> 
				<?php
$length = $config->wordcount; // 80 words max
$phrase = $getsec->features; // populate this with the text you want to display
$abody = (str_word_count($phrase,2));
$c = count($abody);
//echo $c;
if($c >= $length)
{ // gotta cut
  $tbody = array_keys($abody);			
?>
<h6><?php echo substr($phrase,0,$tbody[$length]); ?></h6>

<?php
} else {				// put the whole thing 
?>
<h6><?php echo $phrase; ?></h6>

			<?php } ?>
	
				<?php
$proseotitle = $getsec->seotitle;
$protype = 'product';
?>
<a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" ><h6>read more...</h6></a>
				</div>	

	
<div class="span3" id="photo">
			<ul class="thumbnails">
			<?php //echo 'photo gallery'; 
		$productphoto = $db->get_row("select * from photogallery where id = '$getsec->prid' and type = '$type' ");		
			$proid = $getsec->prid;
			$photoid = $productphoto->photoid;
		 $imageURL =	frontsite.'/vinzaiimages/'.$proid.'/thumb/'.$photoid.'.jpg';
		 ?>
 <li class="span3">
  <div class="thumbnail">
<a href="#" >
<img src="<?php echo $imageURL ?>" alt="" >
</a>
<h3><?php echo $productphoto->link; ?> </h3>
</div>
</li>
</ul>
</div>
				</div>
					</div>		
				<?php } }elseif($config->lcid == 3)
		{	?>			
	
		<div class="span12">
		
	<?php
$count = count($getsecs);	
if($count != 0)
{	
	foreach($getsecs as $getsec)
		{
				?>
				
				<div class="span4">
<div class="span">				
			 	<h5 class="label label-important">	 <?php echo $getsec->title; ?></h5> 
<?php
$length = $config->wordcount; // 80 words max
$phrase = $getsec->features; // populate this with the text you want to display
$abody = (str_word_count($phrase,2));
$c = count($abody);
//echo $c;
if($c >= $length)
{ // gotta cut
  $tbody = array_keys($abody);			
?>
<h6><?php echo substr($phrase,0,$tbody[$length]); ?></h6>

<?php
} else {				// put the whole thing 
?>
<h6><?php echo $phrase; ?></h6>

			<?php } ?>
	
				<?php
$proseotitle = $getsec->seotitle;
$protype = 'product';
?>
<a href="../../<?php echo $protype ?>/<?php echo $proseotitle ?>/" ><h6>read more...</h6></a>
				</div>	

	
<div class="span2" id="photo">
			<ul class="thumbnails">
			<?php //echo 'photo gallery';
$photocount = $db->get_var("SELECT COUNT(*) FROM photogallery where id = '$getsec->prid' and type = '$type' ");
if($photocount != 0)
{		 
		$productphoto = $db->get_row("SELECT * FROM photogallery where id = '$getsec->prid' and type = '$type' ");		
			$proid = $getsec->prid;
			$photoid = $productphoto->photoid;
		 $imageURL =	frontsite.'/vinzaiimages/'.$proid.'/thumb/'.$photoid.'.jpg';
		 ?>
   <div class="thumbnail">
<a href="#" >
<img src="<?php echo $imageURL ?>" alt="" >
</a>
<h3><?php echo $productphoto->link; ?> </h3>
</div>
<?php } //check photo count ?>
</ul>
</div>
				</div>
				
				
				<?php } //check count
				
				 } //end for loop ?>
				</div>

<?php				 }//check count of getsecs 
}
?>
				
			 <script>
    $(function () {
    $('#myTab a:last').tab('show');
    })
    </script>	
				<script>
$(document).ready(function(){
    $('.delete').on('click', function(e){
        alert('delete');
        e.preventDefault();
    });
});
</script>
<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
			<p><strong>This content comes from a hidden element on this page.</strong></p>
			<p>The inline option preserves bound JavaScript events and changes, and it puts the content back where it came from when it is closed.</p>
			<p><a id="click" href="#" style='padding:5px; background:#ccc;'>Click me, it will be preserved!</a></p>
			
			<p><strong>If you try to open a new ColorBox while it is already open, it will update itself with the new content.</strong></p>
			<p>Updating Content Example:<br />
			<a class="ajax" href="../../js/ajax.html">Click here to load new content</a></p>
			</div>
		</div>				
			<div id="cboxOverlay" style="opacity: 1; cursor: auto; visibility: visible; display: none;"></div>	
				
				</div> 
			
    <!--  </div> -->

	