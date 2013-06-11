<?php
session_start();
?>
<?php
if(!isset($_SESSION['ad_id']) )
{
header('location:admin_login.php');
}
else
{ 
session_start();
$ad_id= $_SESSION['ad_id'];
include_once('./includes/header.php');
include_once('./includes/config.php');
?>

<body>
<!-- WRAPPER START -->

<!-- HIDDEN SUBMENU END -->

<!-- CONTENT START -->
<div class="content">
   <div class="container-fluid">
            <div class="row-fluid">
<div class="block span12">

    <div class="span12" id="content">
    <!--  TITLE START  -->
    <div class="grid_9">
    <h2 class="dashboard">New Menu</h2>
    </div>
   
   
    <!--  TITLE END  -->
    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left">
      <!--THIS IS A PORTLET-->
        <div class="portlet">
            
            <div class="portlet-content">
            <!--THIS IS A PLACEHOLDER FOR FLOT - Report & Graphs -->



<script type="text/javascript">
var xmlhttp;
function suggest()
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
document.getElementById("test").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','new_menu_search.php?select='+document.getElementById('searchtext').value,true);
xmlhttp.send();
}
</script>


<script type="text/javascript">
var xmlhttp;
function suggest1()
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
document.getElementById("test1").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','new_menu_search.php?asd='+document.getElementById('searchtext').value+'&opt='+document.getElementById('searchtext1').value,true);
xmlhttp.send();
}
</script>


<script type="text/javascript">
var xmlhttp;
function suggest12(category,id)
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
	
document.getElementById(category).innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','new_active_batch_search.php?checkall='+category+'&id='+id,true);
xmlhttp.send();
}
</script>

<script type="text/javascript">
var xmlhttp;
function suggest_seo_title()
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
document.getElementById("seo").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','new_active_batch_search.php?searchseo='+document.getElementById('searchseo').value,true);
xmlhttp.send();
}
</script>

	 

        <?php
        if($_GET['m_id'])
        {

        if(isset($_POST['submitted']))
        {
        	/*echo '<pre>';
        	print_r($_POST);
        	echo '</pre>';*/

        $type= $_POST['type'];
        $linkto_type= $_POST['link'];
        
							        $searchspace=strpos($_POST['searchseo'],' ');
											if($searchspace)
											{
														$search_seo= str_replace(' ', '_', $_POST['searchseo']);
														//echo 'found space';
											}
											else
											{
														$search_seo = $_POST['searchseo'];
														//echo'not found space';
											}
        //$search_seo = $_POST['searchseo'];
        //$link_type= $_POST['link_type'];
        $title =$_POST['title'];
        $main= $_POST['main'];
        $auto= $_POST['auto'];
        $publish= $_POST['publish'];

     			if(isset($_POST['link1']))
     			{
     							 $linkto_another= $_POST['link1'];
     				}
        //$insert= $db->query("INSERT INTO menu_links VALUES ('','$_GET[m_id]','$linkto_another','$type','$linkto_type','$title','$main','$auto','$publish')");
        
        //$ml_id = $db->insert_id;
        //$insert1 = $db->query("INSERT INTO config VALUES ('','$ml_id','$no_of_records','$no_of_colm','$image_display')");
       $eachvalue = '';
       $menuparams = '';
 								foreach($_POST as $key => $value)
								{
									        if ($key != "title" && $key !="main" && $key !="auto" && $key !="publish" && $key !="type" && $key !="link1" && $key !="submitted" && $key !="select-all" && $key !="searchseo")
									        {
													        	if(is_array($value))
													        	{
																							//echo 'hi</br>';
																							$arrays = array();
																							$arrays = $value;
																							foreach($arrays as $array)
																							{
																									$eachvalue .= $array.',';
																																													
																								} 
																								$menuparams .= $key.':'.$eachvalue.'|'; 										        		
																								//$menuparams .= = $db->query("INSERT INTO menuparams VALUES('','$ml_id','$key','$eachvalue')");										        		
													        		
													        		}else{
				       																//$insert = $db->query("INSERT INTO menuparams VALUES('','$ml_id','$key','$value')");
				       																$menuparams .= $key.':'.$value.'|';
				       												}
       										}
    					}  
    					$insert= $db->query("INSERT INTO menu_links VALUES ('','$_GET[m_id]','$linkto_another','$type','$title','$main','$auto','$publish','$search_seo','$menuparams')");
        }

        ?>
<form method='POST' action=''>
<?php 
        
        //$selectitem = explode(',',$tablearrays);
        //print_r($selectitem);
//$count = count($arrays);
//echo $count;
 //echo 'tablearray is:'.$arrays['1'];
 
 $items = $db->get_results("SELECT * FROM component"); 
?>        
     
Link : <select name='type' id='searchtext' onblur='suggest();'/>
<option value="hash">Homepage</option>
<?php
foreach($items as $item)
{
?>
       <a href="" > <option value='<?php echo $item->comp_id 	; ?>'><?php echo $item->comp_t; ?></option></a>
 <?php } ?>     
							</select>
							<?php // echo $tablearray; ?>
							<?php // echo $tablearray; ?>
        <div id='test'>
        </div>
        <br />
        
        <div id='test1'>
        </div>

        Title :<input type='text' name='title'><br />

        Link to sub link: <select name='main'>
        <option value='0'>main link</option>

        <?php

        $menu= $db->get_results("SELECT * FROM menu_links");
        if($menu)
        {
        foreach($menu as $menus)
        {
        ?>

        <option value='<?php echo $menus->ml_id;?>'><?php echo $menus->title;?></option>

        <?php
        }

        }
        ?>
        </select><br />
        auto :<input type='text' name='auto'><br />
        publish :<select name='publish'>
        <option value='yes'>yes</option>
        <option value='no'>no</option>
        </select>
        
        <label>Insert SEO TITLE:</label>
  <input type='text' id='searchseo' name='searchseo' onkeyup='suggest_seo_title();' value=''>
  
<div id="seo">        
        <input type='submit' name='submitted' value='submit'>
</div>


        </form>
        <?php
        }
        ?>

            </div>
        </div>
      
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      
  
<!--  END #PORTLETS -->
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->
  </div>


       
</div>
<!-- WRAPPER END -->

<?php }
?>

</div>
</div>
</div>
</div>

</body>
</html>
