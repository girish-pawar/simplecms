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
    <h1 class="dashboard">New Menu</h1>
    </div>
    <!--RIGHT TEXT/CALENDAR-->
    <div class="grid_6" id="eventbox"><a href="#" class="inline_calendar">You don't have any events for today! Yay!</a>
        <div class="hidden_calendar"></div>
    </div>
    <!--RIGHT TEXT/CALENDAR END-->
    <div class="clear">
    </div>
    <!--  TITLE END  -->
    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left">
      <!--THIS IS A PORTLET-->
        <div class="portlet">
            <div class="portlet-header"><img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> &nbsp;</div>
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



        <?php
        if($_GET['m_id'])
        {

        if(isset($_POST['submitted']))
        {

        $type= $_POST['type'];
        $linkto_another= $_POST['link'];
        //$link_type= $_POST['link_type'];
        $title =$_POST['title'];
        $main= $_POST['main'];
        $auto= $_POST['auto'];
        $publish= $_POST['publish'];

        $insert= $db->query("INSERT INTO menu_links VALUES('','$_GET[m_id]','$linkto_another','$type','$title','$main','$auto','$publish')");
        }

        ?>
<form method='POST' action=''>
<?php 
        
        $selectitem = explode(',',$tablearrays);
        //print_r($selectitem);
//$count = count($arrays);
//echo $count;
 //echo 'tablearray is:'.$arrays['1']; 
?>        
     
Link : <select name='type' id='searchtext' onblur='suggest();'/>
<option value="hash">Homepage</option>
<?php
foreach($selectitem as $key=>$value)
{
?>
        <option value='<?php echo $value; ?>'><?php echo $value; ?></option>
 <?php } ?>     
							</select>
							<?php echo $tablearray; ?>
        <div id='test'>
        </div>
        <br />

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
        <input type='submit' name='submitted' value='submit'>


        </form>
        <?php
        }





        ?>

            </div>
        </div>
      <!--THIS IS A PORTLET-->
        <div class="portlet">
        <div class="portlet-header">Anything  (no icon too if you like it better)</div>

        <div class="portlet-content">
          <p>This can be any content you want. I placed a basic form here with text editor so you can see the functionality of the forms too.</p>
          <h3>This is a form</h3>
          <form id="form1" name="form1" method="post" action="">
            <label>Some title</label>
             <input type="text" name="textfield" id="textfield" class="smallInput" />
            <label>Large input box</label>
            <input type="text" name="textfield2" id="textfield2" class="largeInput" />
            <label>This is a textarea</label>
            <textarea name="textarea" cols="45" rows="3" class="smallInput" id="textarea"></textarea>
            <a class="button"><span>Submit in blue</span></a>
            <a class="button_grey"><span>Submit this form</span></a>
          </form>
          <p>&nbsp;</p>
        </div>
        </div>
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
      <!--THIS IS A PORTLET-->
      <div class="portlet">
        <div class="portlet-header"><img src="images/icons/comments.gif" width="16" height="16" alt="Comments" />Latest Comments</div>

        <div class="portlet-content">
         <p class="info" id="success"><span class="info_inner">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span></p>
    <p class="info" id="error"><span class="info_inner">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span></p>
    <p class="info" id="warning"><span class="info_inner">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span></p>
<p class="info" id="info"><span class="info_inner">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</span></p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit</div>
       </div>
      <!--THIS IS A PORTLET-->
      <div class="portlet">
        <div class="portlet-header"><img src="images/icons/feed.gif" width="16" height="16" alt="Feeds" />Your selected News source                    </div>
        <div class="portlet-content">
        <ul class="news_items">
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean  adipiscing massa quis arcu interdum scelerisque. Duis vitae nunc nisi.  Quisque eget leo a nibh gravida vulputate ut sed nulla. <a href="#">Donec quis  lectus turpis, sed mollis nibh</a>. Donec ut mi eu metus ultrices  porttitor. Phasellus nec elit in nisi</li>
            <li>Nunc convallis, enim quis tincidunt dictum, ante ipsum  interdum massa, consequat sodales arcu magna nec eros.<a href="#"> Vivamus nec  placerat odio.</a> Sed nec mi sed orci mattis feugiat. Etiam est dui,  rutrum nec dictum vel, accumsan id sem. </li>
            <li>Nunc convallis, enim quis tincidunt dictum, ante ipsum  interdum massa, consequat sodales arcu magna nec eros.<a href="#"> Vivamus nec  placerat odio.</a> Sed nec mi sed orci mattis feugiat. Etiam est dui,  rutrum nec dictum vel, accumsan id sem. </li>
            <li>Nunc convallis, enim quis tincidunt dictum, ante ipsum  interdum massa, consequat sodales arcu magna nec eros.<a href="#"> Vivamus nec  placerat odio.</a> Sed nec mi sed orci mattis feugiat. Etiam est dui,  rutrum nec dictum vel, accumsan id sem. </li>
            <li>Nunc convallis, enim quis tincidunt dictum, ante ipsum  interdum massa, consequat sodales arcu magna nec eros.<a href="#"> Vivamus nec  placerat odio.</a> Sed nec mi sed orci mattis feugiat. </li>
        </ul>
        <a href="#">&raquo; View all news items</a>
        </div>
       </div>
    </div>
    <!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Last Registered users Table Example</div>
        <div class="portlet-content nopadding">

        </div>
      </div>
<!--  END #PORTLETS -->
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->
  </div>
<div class="clear"> </div>

        <!-- This contains the hidden content for modal box calls -->
        <div class='hidden'>
            <div id="inline_example1" title="This is a modal box" style='padding:10px; background:#fff;'>
            <p><strong>This content comes from a hidden element on this page.</strong></p>

            <p><strong>Try testing yourself!</strong></p>
            <p>You can call as many dialogs you want with jQuery UI.</p>
            </div>
        </div>
</div>
<!-- WRAPPER END -->
<!-- FOOTER START -->
<div class="container_16" id="footer">
Website Administration by <a href="../index.htm">WebGurus</a></div>
<!-- FOOTER END -->
<?php }
?>

</div>
</div>
</div>
</div>

</body>
</html>
