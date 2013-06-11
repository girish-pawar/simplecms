					<link rel="stylesheet" href="http://beyondwild.in/admin/css/zebra_pagination.css" type="text/css">

				
				<?php
				if(isset($_GET['method']))
				{
					if($_GET['method']=='gallery' && !isset($_GET['process']))
					{
					
					echo'<h1>gallery here</h1>';
					?>
					
						<table class='table'>
				<tr><th>Gallery Title</th><th>Type</th><th>View</th></tr>
				<?php
				
				$gallery= $db->get_results("SELECT * FROM gallery");
				if($gallery)
				{
				
				foreach($gallery as $images)
				{
				$gallery_type= $db->get_row("SELECT * FROM image_gallery_link WHERE g_id='$images->g_id'");
				if($gallery_type)
				{
				?>
				
				<tr><td><?php echo $images->g_title;?></td>
				<td><?php echo $gallery_type->type;?></td>
				<td><a href='./index.php?option=component&kind=photogallary&method=gallery&process=add&type=<?php echo $gallery_type->type;?>&id=<?php echo $gallery_type->type_id;?>&step=3' class="btn btn-primary">view</a></td></tr>
				<?php
				
				}
				}
				}
				?>
				</table>
					<?php
					}
					}
				?>

				
				
				
				
				
								<?php
				if(isset($_GET['method']))
				{
					if($_GET['method']=='item' && !isset($_GET['process']))
					{
					
					echo'<h1>Item here</h1>';
					
					$run= Display_item();
					echo $run;
					?>
					
						
					<?php
					}
					}
				?>

				
				
					
					<?php
					
					if(isset($_GET['method']))
					{
					if($_GET['method']!='gallery' && $_GET['method']!='item')
					{
					include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/index.php');
					}
					}
					else
					{
					?>
this is landing page of photo gallery
<?php
$pageURL =$_SERVER["REQUEST_URI"];
//echo $pageURL;
?>
<a href='<?php echo $_SERVER["REQUEST_URI"]; ?>&method=config'>Config</a>





<div class="bs-docs-example">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href='<?php echo $_SERVER["REQUEST_URI"]; ?>&method=config'>Config</a></li>
              <li class=""><a href='<?php echo $_SERVER["REQUEST_URI"]; ?>&method=gallery'>Gallery</a></li>
			  <li class=""><a href='<?php echo $_SERVER["REQUEST_URI"]; ?>&method=item'>Item</a></li>
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
				</p>
              </div>
              <div class="tab-pane fade" id="profile">
                <p>
			
				</p>
              </div>
			  <div class="tab-pane fade" id="item">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
              </div>
              <div class="tab-pane fade" id="dropdown1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div class="tab-pane fade" id="dropdown2">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>





<?php
	}
	?>
	
	
	
	<?php
	//this follwing code write in photogallery add.php file
	/*
	if(isset($_GET['step']))
	{
	if($_GET['step']=='1')
	{
	
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/add.php');
	
	}
	}
	?>
	
		<?php
	if(isset($_GET['step']))
	{
	if($_GET['step']=='2')
	{
	
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/upload.php');
	
	}
	}
	?>
	
	
		<?php
	if(isset($_GET['step']))
	{
	if($_GET['step']=='3')
	{
	
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/view.php');
	
	}
	} */
	?>