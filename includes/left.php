<?php if($_REQUEST) { ?>
<?php
	echo Front_loadModules('left','yes');				

?>
		
				
  <?php } else { ?>
  home page 
  
  			 <div id="homeleftpart">
	<div id="photowrkshoptitle"><h3> Photography Workshops</h3></div>
    <div id="photowrkshopimage">
    <img src="images/photography.png" align="left" alt="photography by Abhijit Gandhi" border="0" /> 
    </div>
    

	<div id="photowrkshoptitle" style="float:left; margin-top:23px;"><h3> Video Gallery</h3></div>
    <div id="photowrkshopimage">
  <img src="images/video1.png" alt="vedio 1" border="0" /><img src="images/video2.jpg" alt="vedio 2" border="0" align="centre"/></div>

</div>  <!--left coloum ends--> 
  <?php } ?>