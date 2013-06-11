<?php
if($_GET['logo']=='yes')
{
?><label>
Logo Location:<select name='location'>
<option value='TR'>Top Right</option>
<option value='TL'>Top Left</option>
<option value='BR'>Bottom Right</option>
<option value='BL'>Bottom Left</option>
</select></label>
<label>
Upload Logo<input type='file' name='logo'></label>
<label>
Folder Name :<input type='text' name='folder'></label>
<?php
}
else
{

}
?>