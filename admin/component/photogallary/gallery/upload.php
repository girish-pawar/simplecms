<form method='POST' action='' enctype='multipart/form-data'>

Zip Upload :<input type='file' name='zip_upload'><br />
<input type='hidden' name='g_id' value='<?php echo $_GET['g_id'];?>'>
<input type='hidden' name='type' value='<?php echo $_GET['type'];?>'>
<input type='hidden' name='type_id' value='<?php echo $_GET['id'];?>'>
<input type='submit' name='upload_zip' value='Upload Zip'>
 
</form>