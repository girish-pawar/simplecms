<?php
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");
//include_once('../admin/includes/defination.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/gowild/admin/includes/defination.php');
//
session_start();
//	print_r($_SESSION);	
if(isset($_SESSION['array']) != '')
{
session_destroy();	
	}
$_SESSION['array'] = '';

class FGMembersite
{
    var $admin_email;
    var $from_address;
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $error_message;
    
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'YourWebsiteName.com';
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        //$sid = $_GET['id'];
        //$formvars = $_POST['fieldsarray'];
        $fieldsarray = $_POST;
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
  						          
        if(!$this->SaveToDatabase($formvars))
	       {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleError("Please provide the confirm code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        echo 'login success';
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);
        
        if($user_rec['password'] != md5($pwd))
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
    		//$fieldsarray = $_POST['fieldsarray'];
    		//print_r($fieldsarray);
    		$url1 = $_SERVER['PHP_SELF'];
    		//print_r($_SERVER['PHP_SELF']);
        return htmlentities($url1);
						//echo 'hi is:';        
        //print_r($fgusers);
        //return $fgusers;
    }    
    
    function SafeDisplay($value_name)
    {
    				//echo 'value_name is:'.$value_name;
        if(empty($_POST[$value_name]))
        {
            return'';
        }
       //echo 'post value is:'.$_POST[$value_name];
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
    				//	echo 'inredirect';
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="nobody@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL($username);
        $pwdmd5 = md5($password);
        echo 'password is:'.$pwdmd5;
        global $db;
        $qry = $db->get_row("Select username, email from fgusers3 where username='$username' and password='$pwdmd5' and confirmcode='y'");
        
        if(!$qry)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }else{
        //$row = mysql_fetch_assoc($result);
              
        $_SESSION['name_of_user']  = $qry['username'];
        $_SESSION['email_of_user'] = $qry['email'];
        
        return true;
        }
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysql_query("Select name, email from $this->tablename where confirmcode='$confirmcode'",$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['name'] = $row['name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);
        
        $qry = "Update $this->tablename Set password='".md5($newpwd)."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "There was a request to reset your password at ".$this->sitename."\r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Your password is reset successfully. ".
        "Here is your updated login:\r\n".
        "username:".$user_rec['username']."\r\n".
        "password:$new_password\r\n".
        "\r\n".
        "Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
           echo $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
  						global $db;
 							$fieldsarray = $_POST;
 							echo 'in post';	
							echo '<pre>';
							print_r($fieldsarray);
							echo '</pre>';
 							$fields = $db->get_results("SELECT field_reference.*, field_types.* FROM field_reference LEFT JOIN field_types ON field_reference.ft_id = field_types.f_id WHERE field_reference.status='1'");
					if($fields)
					{ 				
					?>
							<div id='fg_membersite'>
							<?php
							$c = '';
					
 							foreach($fieldsarray as $key=>$value)
							{
												$keys = $db->get_row("SELECT * FROM field_reference WHERE rf_id = '$key'");
												if($keys)
												{
														//$validator = new FormValidator();
														//echo $validator->addValidation($value,'req','Please fill in '.$keys->title.'.');
																		//$validator = new FormValidator();
																		//$validator->addValidation("$keys->title","req","Please fill in ".$keys->title.".");
																				$validator = new FormValidator();																	
																	if($value != '')
																	{
																			$c .= $key.',';
																			$validator = new FormValidator();
																			if($keys->title == 'Email Id')
																			{
																								$validator->addValidation("$key","email","Please fill in ".$keys->title.".");									
																				}elseif($keys->title == 'Contact Number')
																				{
																									$validator->addValidation("$key","numeric","Please fill in ".$keys->title.".");
																					}elseif($keys->title == 'Name')
																				{
																									$validator->addValidation("$key","alpha","Please fill in ".$keys->title.".");
																					}else{			
																					//echo 'key title is:'.$keys->title;
																						$validator->addValidation("$key","req","Please fill in ".$keys->title.".");
																					}
																		//}
																			/*if(!$this->ValidateObject("$keys->title","req","Please fill in ".$keys->title."."))
																			{
																					return false;
																			}*/
																	}elseif($value == ''){
																		//echo '	<span id="register_name_errorloc" class="error"> </span></br/>';
																		echo '	<span id="register_name_errorloc" class="error">Please insert value in :'.$keys->title.'</span>in</br/>';
																		//$validator = new FormValidator();
																		//$validator->addValidation("$keys->title","req","Please fill in ".$keys->title.".");
																		//$validator->addValidation("$value","req","Please fill in ".$keys->title.".");
																		}elseif($c)
																		{
																					//print_r($c);																			
																			}
																		else{
																				echo 'noerror msg';										        	
										        	}
										        	
										        //	print_r($c);
													}
											//break 1;		
									}
									//print_r($c);
									$e = rtrim($c,',');
									$d = explode(',',$e);
									//echo '$d =';
									$count = count($d);
									echo $count; 
									$_SESSION['count'] = $count;
										if(!$count == 5)
												{
																 
									      		/*/*if(!$validator->ValidateForm())
									        {
									            $error='';*/
									           // echo 'error is:'.$error;
									               $error='';
									            $error_hash = $validator->GetErrors();
									           // print_r($error_hash);
									            foreach($error_hash as $inpname => $inp_err)
									            {
									                $error .= $inpname.':'.$inp_err."\n";
									                echo 'in error <?br>';
									                $this->HandleError($error);
									                //echo 'error is:'.$error;
									            }
									          				//echo 'error is:'.$error;
									            //$this->HandleError($error);
									            //return false;
									       /* }  
									        return true; */    
																
												}
												return true;
									?>
									</div>
									<?php
						}   
        /*	if(!$count == 5)
												{*/
																 
									    /* 		if(!$validator->ValidateForm())
									        {
									            $error='';
									           // echo 'error is:'.$error;
									            $error_hash = $validator->GetErrors();
									           // print_r($error_hash);
									            foreach($error_hash as $inpname => $inp_err)
									            {
									                $error .= $inpname.':'.$inp_err."\n";
									                //$this->HandleError($error);
									                //echo 'error is:'.$error;
									            }
									          				echo 'error is:'.$error;
									            //$this->HandleError($error);
									            //return false;
									        }*/  
									        //return true;    
																
											/*	}
												return true; */
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
						//echo 'in colector</br>';    	
       //$fieldsarray = $_POST['fieldsarray'];
       $fieldsarray = $_POST;
       //print_r($fieldsarray);
       foreach($fieldsarray as $key=>$value)
						{
							//echo $key; 
							$formvars[$key] = $this->Sanitize($value);
						}
     }
    
    function SendUserConfirmationEmail(&$formvars)
    {
    				echo 'in send mail</br>';
    	 //$fieldsarray = $_POST['fieldsarray'];
    	 //$fieldsarray = $formvars;
    	 //print_r($fdsarray);
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        //$mailer->AddAddress($formvars['email'],$formvars['name']);
        
        $mailer->Subject = "Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        //$confirmcode = $formvars['confirmcode'];
        
        //$confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code=1234';
        
        //$mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    //function SaveToDatabase($fieldsarray)
    function SaveToDatabase(&$formvars)
    { 			
    
    	    if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable())
        {
            return false;
        }
       //if(!$this->IsFieldUnique($fieldsarray,'Email Id'))
      	if(!$this->IsFieldUnique($formvars))
       {			
       				       			
            //$this->HandleError("This email is already registered");
            return false;
        }
       
        
      
      		if(!$this->InsertIntoDB($formvars))
        {
            //$this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique(&$formvars)
    {
    			    				
       $fieldsarray = $formvars;
    				global $db;
    				$count = '';
    				foreach($fieldsarray as $key=>$value)
    				{
    					$valid = $db->get_row("SELECT * from field_reference WHERE rf_id = '$key'");
			    					if($valid)
			    					{
			    							
						    					if($valid->validate == 'yes')
						    					{										
						    														
						    														$field_val = $this->SanitizeForSQL($fieldsarray[$key]);
						    														//echo 'field val is:'.$field_val.'</br>';
						    														//echo 'key is:'.$key;
						    														$qry = $db->get_var("SELECT COUNT(*) from $this->tablename where rfid ='$key' AND value = '$value' ");
						    														$count .= $qry.',';
						    														   
																      		if($qry && $qry > 0)
																        {  
																											echo '	<span id="register_name_errorloc" class="error">This '.$valid->title.' is already exist.</span></br/>';																	           
																										//$this->HandleError("This ".$valid->title." is already exist.");																	           
																           //$this->HandleError("This $valid->title is already exist."); 
																           //return false;
																        }
						    						}
			    					}
    					}
    					$sd ='';
								if($count)
    					{    					
    					//print_r($count);
    					$e = rtrim($count,',');
								$d = explode(',',$e);
																		
									$first = current($d);
									$end = end($d);
									//echo '$first ='.$first.'$end ='.$end.'</br>';
									//echo '$end ='.$end;
									if($first != '0' && $end != '0')
									{
									  		/*if(!$this->InsertIntoDB($fieldsarray,$_GET['id']))//,$confirm_code)
					        {
					            $this->HandleError("Inserting to Database failed!");*/
					            return false;
					       /* }
					        return true;*/
					    }elseif($first == '0' && $end == '0')
					    {
								    	foreach($formvars as $key=>$value)
					    				{
					    					if($value == '')
					    					{
																$sd .= $key;
																//echo 'value is 1:'.$value.'</br>';																		   
															   						
					    					}
					    				}
					    				/*echo 'in sd class:';
					    				
					    				print_r($sd);*/
					    				return true;
					    				//echo '</br>';
					    	}else
					    	{
					    				return false;
				    		}
					    
     				      
    				}
    		}
    
    function DBLogin()
    {

        //$this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);
        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable()
    {
        $result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
        /*$qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
                "password VARCHAR( 32 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";*/
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    }
    
    function InsertIntoDB($formvars)//,$confirm_code)
    {									
    //echo 'session array is:';
    //echo $_SESSION['array'];
    //echo $_SESSION['count'];
    //print_r($_SESSION);
    $array = rtrim($_SESSION['array'],',');
    $explode = explode(',',$array);
    //print_r($explode);
    //print_r($array);
    //echo '</br>';	
    foreach($explode as $key=>$value)
    {
						if($value == '0') 
						{
				    $cnt = '0';
						}else{
								$cnt = '1';	
					}	  
    	}
		
			  echo 'cnt is:'.$cnt;  		
			  if($cnt == '1' && $_SESSION['count'] == '0')
			  {								
    										$fieldsarray = $formvars;
    										
               global $db;
               $code = $formvars['code'];
               $emailid = $formvars['10'];
               $username1 = $formvars['username'];
               $pass = md5($formvars['password']);
              
														$insert1 = $db->query("INSERT INTO fgusers3 VALUES ('','$emailid','$username1','$pass','$code')");
												
									if($insert1)
									{				
													$rid = $db->insert_id;
													
             foreach($fieldsarray as $key=>$value)
												{ 
																	if(is_numeric($key))
																	{
																				$insert = $db->query("INSERT INTO field_data VALUES ('','$key','$rid','$value','')");
																	}
												}
										}
													if(!$insert)
							        {
							            $this->HandleDBError("Error inserting data to the table\nquery:$insert");
							            return false;
							        }else{
							        	
																			echo 'insert successful';							        	
							        	}
														  return true;
    							}
     } 
      
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);
							//echo '$str is :'.$str;
        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {			
            $str = stripslashes($str);
            //echo '$str is :'.$str;
        }
        return $str;
    }    
}
?>