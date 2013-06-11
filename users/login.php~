<?php
include_once('../admin/includes/defination.php');
global $db;
session_start();
ob_start();
 
if(isset($_POST['submit'])){


$username = $_POST['username'];
$pwd = md5($_POST['password']);

$check = $db->get_var("SELECT COUNT(*) FROM fgusers3 WHERE username = '$username' AND password='$pwd'");
echo $check; 
if($check != 0)
{
echo 'login success';
$_SESSION['username'] = $username;
header('location:menu.php');
}
else{
echo '    <div class="alert alert-error">
   <p>Incorrect username and Password.</p>
    </div>';
//echo 'username & pwd do not match';		
		}	
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>I Heart Wildlife</title>
<meta content="I Heart Wildlife">
<head>

<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap-responsive.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css"></link>

<script src="../js/bootstrap.js" type="text/javascript" ></script>
<script src="../js/bootstrap.min.js" type="text/javascript" ></script>
</head>

<div class="container">

      <form name="login" action="" method="post" class="form-signin">
        <h2 class="form-signin-heading">Sign in</h2>
        <input type="text" class="input-block-level" placeholder="username" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit" name="submit">Sign in</button>
      </form>
      
      </div>
      </body>
</html> 