<?php
//session_start();
/*if(isset($_POST['login']))
{*/
	if(isset($_POST['submitted']))
{
//print_r($_POST);
if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("../gowild/login.php");
		 }
	
}


?>
<?php //echo Front_loadModules('right','yes'); ?>

<div id="rightpart">
<!--body text starts-->
<?php
//if(isset($_GET['type']) == 'register')
//{
  // 				include_once('./users/register1.php');
 //}  				
   				 ?>
<!--right coloum starts-->

<?php //echo Front_loadModules('left','yes'); ?> 

<!-- <a href="#myModalregister" role="button" class="btn" data-toggle="modal">Sign up</a> -->
<?php 	$date = date('dmYHis'); ?>
<ul>
	<li><a href="../gowild/users/register1.php"  >Sign up</a></li>
	<li><a href="../gowild/users/contact.php" >Contact Us</a></li>
	</ul>
	</div>
<?php
if(isset($_SESSION['username']))
{
echo 'Hello '.$_SESSION['username'];	
echo '<li><a href="../gowild/users/logout.php" >Logout</a></li>';
}else{
echo '<li><a href="#myModallogin" role="button"  data-toggle="modal">Login</a></li>';
echo '<li><a href="../gowild/users/login.php" >Login Form</a></li>';	
}
?>

 <form class="form-horizontal" accept-charset='UTF-8' method="post" name="login">
<!--<div id='fg_membersite'>-->




<!-- login using fgusers3-->

<div id="myModallogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Login</h3>
</div>
<div class="modal-body">
<div id='fg_membersite'>
<fieldset >
<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container' style='height:80px;'>
   <label for='username' >UserName*:</label>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>
<div class='container' style='height:80px;'>
  <label for='password' >Password*:</label>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <noscript>
    <input type='password' name='password' id='password' maxlength="50" />
    </noscript>    
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</fieldset >
</div>
    
</div>
<!--<div class="modal-footer">
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
<!--<button type="submit" name="login" class="btn">Sign in</button>
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

</div>-->
</div>
<!--</div>-->


<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    //frmvalidator.addValidation("name","req","Please provide your name");

    //frmvalidator.addValidation("email","req","Please provide your email address");

    //frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
</script>
 
<!-- Modal -->
<div id="myModalregister" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Modal header</h3>
</div>
<div class="modal-body">
<p>One fine body…</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary">Save changes</button>
</div>
</div>
</form>



<!-- Modal -->
<!--<div id="myModallogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Login</h3>
</div>
<div class="modal-body">
    
    <div class="control-group">
    <label class="control-label" for="inputEmail">Username</label>
    <div class="controls">
    <input type="text" id="inputEmail" placeholder="Username" name="username">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    <input type="password" id="inputPassword" placeholder="Password" name="password">
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <label class="checkbox">
    <input type="checkbox"> Remember me
    </label>
    
    </div>
    </div>
  
</div>
<div class="modal-footer">
<button type="submit" name="login" class="btn">Sign in</button>
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

</div>
</div>-->
