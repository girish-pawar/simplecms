<?php
if($_GET['step']!='2' && $_GET['step']!='3')
{
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
document.getElementById("photogallary").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','./component/photogallary/new_gallary.php?types='+document.getElementById('gallary').value,true);
xmlhttp.send();
}
</script>

<script type="text/javascript">
var xmlhttp;
function search_folder()
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
document.getElementById("folder").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','./component/photogallary/new_gallary.php?folder='+document.getElementById('find_folder').value,true);
xmlhttp.send();
}
</script>

<br />
<form method='POST' action=''>
<h3>Create Gallery</h3>
Gallary :<select name='userid' id='gallary' onblur='suggest();'>
<option value='existing_use'>Existing Use</option>
<option value='new_gallary'>NEw Gallary</option>
</select>
<div id='photogallary'>

</div>

<div id='folder'>

</div>
<input type='hidden' name='seo_table' value=''>
<!--<input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>!-->
<input type='hidden' name='table' value='gallery'>


<input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>
<input type='hidden' name='type_id' value='<?php echo $_GET['id'];?>'>

</form>
<?php
}
?>

<?php
	if(isset($_GET['step']))
	{
	if($_GET['step']=='1')
	{
	
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/add.php');
	
	}
	}
	?>
	
		<?php
	if(isset($_GET['step']))
	{
	if($_GET['step']=='2')
	{
	
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/upload.php');
	
	}
	}
	?>
	
	
		<?php
	if(isset($_GET['step']))
	{
	if($_GET['step']=='3')
	{
	
	include_once('./'.$_GET['option'].'/'.$_GET['kind'].'/'.$_GET['method'].'/view.php');
	
	}
	}
	?>