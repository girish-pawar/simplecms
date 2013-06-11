<script type="text/javascript">
var xmlhttp;
function suggest(set_id)
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
		
document.getElementById('test').innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','copyright_search.php?setid='+set_id,true);
xmlhttp.send();
}
</script>

<?php
head_set();
?>

<form method='POST' action='' enctype='multipart/form-data'>

<h3>Add Image<a href='./index.php?option=component&kind=slideshow&method=sets&process=add' class='btn btn-primary'>Add Sets</a></h3>

<?php
$set= $db->get_results("SELECT * FROM sets");
if($set)
{
?>
<b>Select Set </b><br />
<?php
foreach($set as $sets)
{
?>
<input type='radio' name='set_id' value='<?php echo $sets->set_id;?>' onclick="suggest('<?php echo $sets->set_id;?>')" ><?php echo $sets->set_title;?><br />
<?php
}

}
?>

<div id="test">

</div>

<label>Image Title :</label>
<input type='text' name='image_title'>

<label>Image Description</label>
<textarea name='desc'>
</textarea>

<label>Link To</label>
<input type='text' name='linkto'>
<label>Status</label>
<select name='status'>
<option name='publish'>Publish</option>
<option name='unpublish'>Unpublish</option>
</select>
<label>Choose Image</label><input type='file' name='image_upload'><br />
<input type='submit' name='add_set_image' class='btn btn-primary'>
</form>