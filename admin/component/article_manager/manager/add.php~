<?php
include_once('../admin/includes/defination.php');
include_once('../admin/component/'.$_GET['kind'].'/config.php');
//include_once('../admin/includes/header.php');
//include_once('../admin/includes/function.php');
global $db;

if(isset($_GET['method']))
{
$type = $_GET['type'];
//$id = $_GET['id'];
$process = $_GET['process'];	
//$type1 = 'video_gallery';
}

if($_GET)
{
$component = isset($_GET['component']);
$kind = isset($_GET['kind']); 
$method = isset($_GET['method']);

}

        if(isset($_POST['submitted']))
        {

        $type= $_POST['type'];
        $linkto_type= $_POST['link'];
        $linkto_another= $_POST['link1'];
        //$link_type= $_POST['link_type'];
        $title =$_POST['title'];
        $main= $_POST['main'];
        $auto= $_POST['auto'];
        $publish= $_POST['publish'];

        $insert= $db->query("INSERT INTO menu_links VALUES('','$_GET[m_id]','$linkto_another','$type','$linkto_type','$title','$main','$auto','$publish')");
        }
?>

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
xmlhttp.open('GET','../admin/component/article_manager/manager/new_menu_search.php?select='+document.getElementById('searchtext1').value,true);
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
xmlhttp.open('GET','../admin/component/article_manager/manager/new_menu_search.php?asd='+document.getElementById('searchtext1').value+'&opt='+document.getElementById('searchtext2').value,true);
xmlhttp.send();
}
</script> 
<?php
if($type)
{
?>

<form method='POST' action=''>
<?php
 
if($type == 'article_category' )							
{							?>					
						
			

    <!--     Title :<input type='text' name='title'><br /> -->

        Link to : <select name='link_category' id='searchtext1' onblur='suggest();'>
        <option value='main_link'>main_link</option>
        <option value='sub_link'>sub_link</option>
        <option value='child_link'>child_link</option>
        </select>
        
        
        <div id='test'>
        </div>
        <br />
         <div id='test1'>
        </div>


<?php
}
$extra = null;

if(isset($_GET['id']))
{
$id = $_GET['id'];
}
else
{
$id=null;
}

if($type == 'article_table')
{
	$extra = '1';
$currency = GetForm($_GET['type'],$id,$extra);
echo $currency.'<br />';
}else{
$extra = null;
$currency = GetForm($_GET['type'],$id,$extra);
echo $currency.'<br />';
}
//$b='1,2';
//$button= getbutton($b);
?>

<?php
$seo_table='seo_detail';
//$id=null;
$seo_form=Get_SeoForm($seo_table,$id,$extra,$type);
echo $seo_form;
?>
<?php
if(isset($_GET['id']))
{
?>
<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
<?php
}
?>
<input type='hidden' name='seo_table' value='123'>
<input type='hidden' name='userid' value='<?php echo $_SESSION['ad_id'];?>'>
<input type='hidden' name='table' value='<?php echo $_GET['type'];?>'>
<?php
/*
$b='1,2';
 echo $button= getbutton($b);*/ ?>
<!--<input type='submit' name='submit'>!-->
</form>


<!-- <select name="videogallery" id='searchtext' onblur='suggest();' >
</select> -->
<!-- <input type="submit" name="exit_gallary" value="Back" class="btn btn-success" /> -->

	<?php
}?>