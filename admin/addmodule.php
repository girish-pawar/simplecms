<?php
include_once('./includes/defination.php');
include_once('./includes/header.php');
?>

<!--<script src="js/bootstrap.min.js" type="text/javascript"></script>-->

<div class="content">
   <div class="container-fluid">
            <div class="row-fluid">
<div class="block span12">
<?php
global $db;
if($_POST){
echo '<pre>';
print_r($_POST);
echo '</pre>';	
	
    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $position = $_POST['position'];
        $status = $_POST['status'];
        $modid = $_POST['modid'];
        $display = $_POST['display'];
        
        
         $arr = '';
     
     if($_POST['fieldsarray'])
     {
							$fieldsarray = $_POST['fieldsarray'];
							if($fieldsarray)
							{
										foreach($fieldsarray as $fieldsarr)
										{
													$arr .= $fieldsarr.',';											
											}						
									
								}     	
     	}
     	
     	
        if($selectall == '1')
        {
  									if($arr == '')
  									{	?>
     							<div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading">Error!</h4>
            <p>Please select menus to display this module. select = 1</p>
          </div>
     							<?
  										}     	
        	
        	}
        
        
        
  
        //$insert1 = $db->query("");
    
     	if($arr == '')
     	{
 								$selectall = $_POST['select-all']; 								
 								if($selectall == '0')
 								{    
 								
 										
				  							$insertquery = $db->query("INSERT INTO moduledata VALUES ('','$title','','$status','$modid','','$position','$display')");
				         $addedid = $db->insert_id;
							         foreach($_POST as $key => $value)
															{
												    			echo 'key is:'.$key.'';
												    //echo '<br />';
															    if ($key != "title" && $key !="status" && $key !="position" && $key !="modid"  && $key !="fieldsarray" && $key !="display" && $key != "Submit")
															    	{
															        $insert = $db->query("INSERT INTO moduleparams VALUES('','$addedid','$key','$value')");        
															    		}
												   }		
												   
		     				$select = '0';
		     				$insertquery = $db->query("INSERT INTO module_menu_position VALUES ('','$addedid','$select') ");
     			}else{
     							//$select = '0';
     							?>
     							<div class="alert alert-block alert-error fade in">
            <h4 class="alert-heading">Error!</h4>
            <p>Please select menus to display this module.</p>
          </div>
     							<?
		     				//$insertquery = $db->query("INSERT INTO module_menu_position VALUES ('','$addedid','$select') ");
     				}
     		}/*else{
     
				$insertquery = $db->query("INSERT INTO module_menu_position VALUES ('','$addedid','$arr') ");
				}*/
					if($selectall != '0')
 					{    
 								
 											if(isset($_POST['fieldsarray']))
 											{
 								  $insertquery = $db->query("INSERT INTO moduledata VALUES ('','$title','','$status','$modid','','$position','$display')");
				         $addedid = $db->insert_id;
							         foreach($_POST as $key => $value)
															{
												    			echo 'key is:'.$key.'';
												    //echo '<br />';
															    if ($key != "title" && $key !="status" && $key !="position" && $key !="modid"  && $key !="fieldsarray" && $key !="display" && $key != "Submit")
															    	{
															        $insert = $db->query("INSERT INTO moduleparams VALUES('','$addedid','$key','$value')");        
															    		}
												   }		
												   
		     				$select = $arr;
		     				$insertquery = $db->query("INSERT INTO module_menu_position VALUES ('','$addedid','$select') ");
     							
     						}
				  					
     			}
				
				
}
}
?> 
<script type="text/javascript">
var xmlhttp;
function suggest(m_id)
{
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp= new ActiveXObject('Micosoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
	var block = m_id+'block';	
document.getElementById(block).innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','new_check_search.php?checkall='+m_id,true);
xmlhttp.send();
}






function suggest1(m_id)
{
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp= new ActiveXObject('Micosoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
var block = m_id+'block';	
	
document.getElementById(block).innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','new_check_search.php?deselectall='+m_id,true);
xmlhttp.send();
}
</script>
<?php
            if(isset($_GET['modid'])){ ?>
                <form method="post" action="">
                    <input type="text" name="title" value="" />
                    <input type="hidden" value="<?php echo $_GET['modid'] ?>" name="modid" />
                    <select name="status">
                        <option selected="selected" value="1">Active</option>
                        <option value="0">InActive</option>

                    </select>
                    <select name="position">
                    <option value="topleft">Top Left</option>
                    <option value="topright">Top Right</option>
                    <option value="left"> Left </option>
                    <option value="right">Right</option>
                    <option value="top">Top</option>
                    <option value="bot1">Bottom Left </option>
                    <option value="bot2">Bottom Right</option>
                    </select>
																		
																		
<div class="space1">
Show Title or Not:
<select name="display">
<option value="1">yes</option>
<option value="0">no</option>
</select>
</div>

            <p class="info" id="info"><span class="info_inner">Module Configuration</span></p>

            <?php
            $modid = $_GET['modid'];
            //echo 'modid'.$modid;
            $getmodinfo = $db->get_row("SELECT * FROM moduletype WHERE mod_id='$modid'");
 //include_once(admin.'/modules/'.$getmodinfo->mod_folder.'/config.php');
 include_once('../modules/'.$getmodinfo->mod_folder.'/config.php');
            ?>
           
<?php
global $db;
$gettitles = $db->get_results("SELECT * FROM menu_table");

	?>

<div class="row-fluid"> 
<div class="well">
    <ul class="nav nav-tabs">
     <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
    <?php
  if($gettitles)
		{
    foreach($gettitles as $gettitle)
    {
    //	print_r($gettitle);
   // echo '<li><a href=#.'$gettitle->m_id data-toggle="tab">'.$gettitle->title.'</a></li>';
    ?>
      <li><a href="#<?php echo $gettitle->m_id;?>" data-toggle="tab"><?php echo $gettitle->m_title;?></a></li>
      <?php
       } 
       }?>
      <!--<li><a href="#profile" data-toggle="tab">Password</a></li>
      
      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Password</a></li>-->
    </ul>
    <div id="myTabContent" class="tab-content">
    
    <div class="tab-pane active in" id="home">
    
        <label>New Password</label>
        <input type="password" class="input-xlarge">
        <div>
            <button class="btn btn-primary">Update</button>
        </div>
   
    </div>
    
    
    
<?php
if($gettitles)
{
	?>
	
	<?php
	
 foreach($gettitles as $gettitle)
 {
 ?>
 
  
	
 
     <div class="tab-pane fade" id="<?php echo $gettitle->m_id;?>">
    <?php
    if(isset($_GET['deselectall']))
    {
    ?>
    <input type="radio" name="select-all" checked="true" id="select-all" value="0" onclick="suggest('<?php echo $gettitle->m_id;?>')" />Select All</br>
    <input type="radio" name="select-all" id="deselect-all" checked="false" value="1" onclick="suggest1(<?php echo $gettitle->m_id;?>)" />Deselect All </br>
    <?php
 }elseif(isset($_GET['selectall'])){
?>
<input type="radio" name="select-all" checked="false" id="select-all" value="0" onclick="suggest('<?php echo $gettitle->m_id;?>')" />Select All </br>
    <input type="radio" name="select-all" id="deselect-all" checked="true" value="1" onclick="suggest1(<?php echo $gettitle->m_id;?>)" />Deselect All  </br>
<?php }else{
	?>
	<input type="radio" name="select-all" checked="false" id="select-all" value="0" onclick="suggest('<?php echo $gettitle->m_id;?>')" />Select All </br>
<input type="radio" name="select-all" id="deselect-all" checked="false" value="1" onclick="suggest1(<?php echo $gettitle->m_id;?>)" />Deselect All</br>

	
<?php	} ?>
<div id="<?php echo $gettitle->m_id?>block">  
     <?php
  //   if(isset($_GET['checkall']))
$m_id = $gettitle->m_id;
$getmenus = $db->get_results("SELECT * FROM menu_links WHERE m_id = '$m_id'");
if($getmenus)
{
	foreach($getmenus as $getmenu)
	{?>

<input type="checkbox" name="fieldsarray[]" value="<?php echo $getmenu->ml_id;?>" /><?php echo $getmenu->title;?>
	
	<?php
	}
	?>
		<div id="<?php echo $getmenu->title;?>">
		
		
		</div>
		<?php		
	
}

	?>
    </div>   <!--hjhjhj-->
     </div>
      <?php
       } 
       
       }?>
     
  </div>

</div>


</div>


 <input type="submit" name="Submit" class="btn btn-info" />
</form>

            <?php } else {

            $getmods = $db->get_results("SELECT * FROM moduletype");
            foreach($getmods as $getmod){
                echo '<a href="addmodule.php?modid='.$getmod->mod_id.'">'.$getmod->mod_name.'</a><br></br>';
//add.php?type=addmodule&modid=1
            }}
            ?>
</div>


</div>
</div>


<!--<script type="text/javascript" >

// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
});
</script>-->