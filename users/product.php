<div class="span12 borders">

<?php
require_once(includesfolder.'/recaptchalib.php');
$msg = '';
global $msg;
?>



<?php
if(isset($_POST['submit']))
													{
														
														$msg = '';
													$errors = array();
													
$privatekey = "6LfSqt4SAAAAAEqYUWO9sVuzd1T0NdtIxVR3Bn9r";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    
   //echo  "<div class='alert alert-warning'><h5>The reCAPTCHA wasnt entered correctly.</h5></div>";
   $errors[] = 'The reCAPTCHA wasnt entered correctly.';
    //die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
      //   "(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
  								
													
													
														if(!isset($_POST['name']) OR empty($_POST['name']))
														{
															$errors[] = 'Please enter name';
														}
														if (!ctype_digit($_POST['mobile'])) 
														{
														 $errors[] = 'Please enter valid mobile number';
													 	}
													 	if(!strlen(trim($_POST['message'])))
													 	{
														 $errors[] = 'Message incomplete';
														 }
														 if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
													    $errors[] =  "This (email_a) email address is not considered valid.";
													}
														 if (empty($errors)) 
														 { 
														 //	print_r($_POST);
													$name = $_POST['name'];
													$email = $_POST['email'];
													$mobile = $_POST['mobile'];
													$message = $_POST['message'];
													$date = date('m/d/Y h:i:s');
													$type = 'enquiry';
													$from = 'girish.suresh.pawar@gmail.com';
														
														$sql = $db->query("INSERT into contactdata values ('','$name','$email','$mobile','$message','$type','$date' )");
														if($sql)
														{
															
														$check = mail($email,'Test Mail',$message, $from);
														if($check)
														{
echo 'mail sent';															
															}
															echo "<div class='alert alert-warning'><h5>Details Send Successfully.</h5></div>\n";
															}else{
													echo "<div class='alert alert-warning'><h5>Details Not Send.</h5></div>\n";			
																}
														
														//header('refresh:5;url=www.vinzai.com/newsite/');
															
													} 
														 
														 
												/* 		if($msg !=''){ 
													    						echo $msg; 
													    						}
																					if(!empty($errors))
																					{
														
															 echo '<div class="alert alert-danger"><h4>Problems exist with the following field(s):</h4></div>';
													
																 foreach ($errors as $error) 
																	 {
														 				echo "<div class='alert alert-danger'><h5>".$error."</h5></div>\n";
														 				//echo "<h5>".$error."</h5>\n";
																	 }
														 //echo '</div>';
													 } //!empty errors close  */      						
													 }   		//else captch ok
												}//$_POST				
												
												?>


<?php 
    $id = $pr->prid;
    $type = $_GET['type'];
    	$photos = $db->get_results("SELECT * from photogallery WHERE id = '$id' and type = '$type' ");		
    	$pdfs = $db->get_results("SELECT * FROM downloads WHERE prid = '$id'");
    	$videos = $db->get_results("SELECT * FROM videogallery WHERE prid = '$id'");
   // print_r($pdfs);
?>    
    
    
<div class="hero-unit">
<h2><?php echo $pr->title ?></h2>
    </div>
   <div class="span10 offset-1">
		  <ul class="nav nav-tabs">
    <li class="active"><a href="#features" data-toggle="tab">Features</a></li>
    <li><a href="#package" data-toggle="tab">Package</a></li>
    <li><a href="#technical" data-toggle="tab">Technical Details</a></li>
    <li><a href="#enquiry" data-toggle="tab">Enquiry</a></li>
  <?php if($pdfs)
  { ?>
  	    <li><a href="#download" data-toggle="tab">Downloads</a></li>
  <?php 	}?>


<?php if($videos){ ?>
	<li><a href="#video" data-toggle="tab">Videos</a></li>
<?php } ?>  
  
    <?php  if($photos){   ?>
    <li><a href="#photo" data-toggle="tab">Photos</a></li>  
     <?php } ?>
    
    </ul>     
     
    <div class="tab-content">
    
     <?php 
     	 if(!empty($errors)){   ?>
    <div class="tab-pane" id="features"><?php echo $pr->features ?></div>  
    <?php  } else{?>
    <div class="tab-pane active" id="features"><?php echo $pr->features ?></div>
   <?php } ?> 
  
    
				<?php if($pdfs)
				{
			 ?>
				<div class="tab-pane" id="download">
				<?php foreach($pdfs as $pdf)	{ 
$file = frontsite.'/downloads/'.$pdf->filename;						
				?>
				<img src="../../css/pdf.png" alt="" ><a href="<?php echo $file ?>"><h4><?php echo $pdf->link; ?></h4></a>
						<?php 	} ?>
				</div>	
				<?php 	}?> 

     	 
		     
	<?php if($videos){ ?>     
						    <div class="tab-pane" id="video">
						<?php foreach($videos as $video)
						{ ?>    
						   <h4><?php echo $video->videoname; ?></h4> 
						<?php  } ?>     
						    </div>
						<?php } ?> 
    
    
		<?php if($photos){  ?>
			<div class="tab-pane" id="photo">
<?php //echo 'photo gallery'; 
foreach($photos as $photo){ 			
			$pid = $photo->id;
			$photoid = $photo->photoid;
		 $imageURL =	frontsite.'/vinzaiimages/'.$pid.'/thumb/'.$photoid.'.jpg';
		 $imageURL1 =	frontsite.'/vinzaiimages/'.$pid.'/full/'.$photoid.'.jpg';  ?>
		 			<div class="span5"> 
			<ul class="thumbnails">
 <li class="span12">
  <div class="thumbnail">
<p><a class="group2" href="<?php echo $imageURL1 ?>" ><img class="grayscale" src="<?php echo $imageURL ?>" title="<?php echo $photo->link; ?>" ></a></p>
<h4><?php echo $photo->link; ?> </h4>
</div>
</li>
</ul>
</div>
<?php } ?>
</div>	
<?php	}?>	 
		
 
<?php if(!empty($errors)){   ?>
     <div class="tab-pane active" id="enquiry">
<div class="span12 borders">
													
													<?php		if($msg !=''){ 
													    						echo $msg; 
													    						}
																					if(!empty($errors))
																					{
														
															 echo '<div class="alert alert-danger"><h4>Problems exist with the following field(s):</h4></div>';
													
																 foreach ($errors as $error) 
																	 {
														 				echo "<div class='alert alert-danger'><h5>".$error."</h5></div>\n";
														 				//echo "<h5>".$error."</h5>\n";
																	 }
														 //echo '</div>';
													 } //!empty errors close  
													 
													 ?>
													
													    <form class="form-horizontal" method="post">
													    	
													    	 <div class="control-group">
													    <label class="control-label" >Name</label>
													    <div class="controls">
																	<input type="text" placeholder="Name" name="name">    
													    </div>
													    </div>
													    <div class="control-group">
													    <label class="control-label" for="inputEmail">Email</label>
													    <div class="controls">
													    <input type="text" id="inputEmail" placeholder="Email" name="email">
													    </div>
													    </div>
													       <div class="control-group">
													    <label class="control-label" for="inputNumber" >Mobile Number</label>
													    <div class="controls">
													     <input type="text" placeholder="Mobile number" name="mobile" maxlength="10">
													    </div>
													    </div>
													   
													    <div class="control-group">
													    <label class="control-label" >Message</label>
													    <div class="controls">
													    <textarea rows="3" name="message"></textarea>
													    </div>
													    </div>
													    <div class="control-group">
													    <label class="control-label" >Please Verify Following code</label>
													    <div class="controls">
													    <?php
													     $publickey = "6LfSqt4SAAAAAMGcdULAxi42w8Agn9zae6ly0Bha"; // you got this from the signup page
																  echo recaptcha_get_html($publickey); ?>
																  </div>
													    </div>
																  
													    <div class="control-group">
													    <div class="controls"> 
													    <button type="submit" class="btn btn-inverse" name="submit">Send</button>
													    </div>
													    </div>
													    </form>
													</div> <!-- span12 inside tabe pane  -->     
													
													</div>
     
     
<?php } else { ?>
<div class="tab-pane" id="enquiry">
    
     <div class="span12 borders">
													
													<?php		if($msg !=''){ 
													    						echo $msg; 
													    						}
																					if(!empty($errors))
																					{
														
															 echo '<div class="alert alert-danger"><h4>Problems exist with the following field(s):</h4></div>';
													
																 foreach ($errors as $error) 
																	 {
														 				echo "<div class='alert alert-danger'><h5>".$error."</h5></div>\n";
														 				//echo "<h5>".$error."</h5>\n";
																	 }
														 //echo '</div>';
													 } //!empty errors close  
													 
													 ?>
													
													    <form class="form-horizontal" method="post">
													    	
													    	 <div class="control-group">
													    <label class="control-label" >Name</label>
													    <div class="controls">
																	<input type="text" placeholder="Name" name="name">    
													    </div>
													    </div>
													    <div class="control-group">
													    <label class="control-label" for="inputEmail">Email</label>
													    <div class="controls">
													    <input type="text" id="inputEmail" placeholder="Email" name="email">
													    </div>
													    </div>
													       <div class="control-group">
													    <label class="control-label" for="inputNumber" >Mobile Number</label>
													    <div class="controls">
													     <input type="text" placeholder="Mobile number" name="mobile" maxlength="10">
													    </div>
													    </div>
													   
													    <div class="control-group">
													    <label class="control-label" >Message</label>
													    <div class="controls">
													    <textarea rows="3" name="message"></textarea>
													    </div>
													    </div>
													    <div class="control-group">
													    <label class="control-label" >Please Verify Following code</label>
													    <div class="controls">
													    <?php
													     $publickey = "6LfSqt4SAAAAAMGcdULAxi42w8Agn9zae6ly0Bha"; // you got this from the signup page
																  echo recaptcha_get_html($publickey); ?>
																  </div>
													    </div>
																  
													    <div class="control-group">
													    <div class="controls"> 
													    <button type="submit" class="btn btn-inverse" name="submit">Send</button>
													    </div>
													    </div>
													    </form>
													</div> <!-- span12 inside tabe pane  -->
 						 
						  
    </div>  <!-- end tab pane -->
    
   <?php } ?> 
		 
	 
			 <div class="tab-pane" id="package"><?php echo $pr->package ?></div>
    <div class="tab-pane" id="technical"><?php echo $pr->technicaldetails ?></div>		 
     
     </div>  <!-- end tab content -->
     
     
    <script>
    $(function () {
    $('#myTab a:last').tab('show');
    })
    </script>


</div><!-- end of span 10 offset1 -->

</div>   <!-- span12 borders -->