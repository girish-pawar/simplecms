<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap-responsive.css">
<?php
include_once('../admin/includes/defination.php');
//$seotitle = $_GET['seotitle']	;
	//$article = $db->get_row("SELECT * FROM article WHERE seotitle='$seotitle'");
	//print_r($article);
	
	?>
	<div class="span9">
	
<h3>Get in touch with us </h3>	
<h5>I Heart Wildlife</h5>
<div class="span3"></div>
<div class="span6 well well-block">
2, Guru-Deep,
# 8 Jeeven Chhaya Soc.,
Paud Road, Pune 411038
India
Email:  info@vinzai.com
Telephone: +91-20-2544-2185
Mobilephone: +91-982-303-4264
</div>

<div class="span12 borders">
<?php 
if(isset($_POST['submit']))
{
	
	$msg = '';
$errors = array();
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
$type = 'contact';
	
	$sql = $db->query("INSERT into contactdata values ('','$name','$email','$mobile','$message','$type','$date' )");
	if($sql)
	{
		echo "<div class='alert alert-warning'><h5>Details Send Successfully.</h5></div>\n";
		}else{
echo "<div class='alert alert-warning'><h5>Details Not Send.</h5></div>\n";			
			}
	
	//header('refresh:5;url=www.vinzai.com/newsite/');
		
} 
	 
	 
	if($msg !=''){ 
    						echo $msg; 
    						}
								if(!empty($errors)){
	
		 echo '<div class="alert alert-danger"><h2>Problems exist with the following field(s):</h2></div>';

			 foreach ($errors as $error) 
				 {
	 				echo "<div class='alert alert-danger'><h5>".$error."</h5></div>\n";
	 				//echo "<h5>".$error."</h5>\n";
				 }
	 //echo '</div>';
 }        						
 }   						
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
    <div class="controls"> 
    <button type="submit" class="btn btn-inverse" name="submit">Send</button>
    </div>
    </div>
    </form>
</div>
	
	</div>