<?php
//phpinfo(); 
include_once($_SERVER['DOCUMENT_ROOT'].'/private/conn.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/private/functions.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/private/class.upload.php');
session_start();
if(!isset($_SESSION['username'])){
	header('location:index.php');
}
global $db;
?>
<?php
		
		if($_POST){		
				// start resizing
				 $foo = new Upload($_FILES['imgfile']); 
				 
 $insert = $db->query("INSERT INTO gallery VALUES ('','$_GET[id]','1')");
if($insert){
echo 'insert in db successful';

}

				 
 if ($foo->uploaded) {   
 $foo->image_resize = true;   
 $foo->image_convert = jpg;   
 $foo->image_x = 750;   
 $foo->image_ratio_y = true;  
 $foo->file_new_name_body   = $db->insert_id;

if($_POST['copyright'] == '1'){
$foo->image_text            = 'Aadyaa Originals';
$foo->image_text_background = '#000000';
$foo->image_text_background_opacity = 25;
$foo->image_text_x          = 25;
$foo->image_text_y          = 25;
$foo->image_text_padding    = 20;	
}



 $foo->Process('../images/products/'.$_GET['id'].'/full/');  
 if ($foo->processed) {   
 echo 'image renamed, resized x=600      
 and converted to JPG<br />';    
 
 }
 
  $foo->image_convert = jpg;   
$foo->image_resize          = true;
$foo->image_ratio_crop      = true;
$foo->image_y               = 200;
$foo->image_x               = 200;	
 $foo->file_new_name_body   = $db->insert_id;
if($_POST['copyright'] == '1'){
$foo->image_text            = 'Aadyaa Originals';
$foo->image_text_background = '#000000';
$foo->image_text_background_opacity = 25;
$foo->image_text_x          = 25;
$foo->image_text_y          = 25;
$foo->image_text_padding    = 20;	
}


 $foo->Process('../images/products/'.$_GET['id'].'/thumb/');  
 if ($foo->processed) {   
 echo 'image renamed, resized x=200      
 and converted to JPG<br />';    
 
 }
 
 }
 
 }
	



?>

<?php include_once('topinclude.php') ?>   
    <div class="row">
    <div class="span4"><?php include_once('leftcolumn.php') ?></div>
    <div class="span8">
	
<?php if($_GET) { 
$prodid = $_GET['id'];
$prin = ProdInfo($prodid);

?>
    <h1>Photo Gallery: <?php echo $prin->ptitle ?></h1>
<a type="button" class="btn btn-primary" href="#test_modal" data-toggle="modal">Add Image</a>

<div id="thumbcontainer">
<?php 
global $db;
$gphs = $db->get_results("SELECT * FROM gallery WHERE prid='".$_GET['id']."'");
foreach($gphs as $gph){
?>

<div class="thumb" style="float:left; margin:3px; text-align:center;">
<img src="../images/products/<?php echo $_GET['id'] ?>/thumb/<?php echo $gph->id ?>.jpg" class="img-polaroid"/><br />
<a href="gallery.php?imgid=<?php echo $gph->id ?>&process=delete"><i title="delete" class="icon-remove"></i></a>

</div>
<?php } ?>
</div>


<div class="modal fade" style="display:none;" id="test_modal">
<form name="imageUpload" id="imageUpload" method="post" enctype="multipart/form-data" >
  <div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3 style="color:#fff;">Upload New Photo</h3>
  </div>
  <div class="modal-body">

                <legend>Upload Image</legend>
                Image :<input type="file" name="imgfile" id="imgfile"/><br />
                <select name="copyright">
                <option value="0">No</option>
                <option value="1">Yes</option>
                </select>
               
        </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
     <input type="submit" class="btn btn-primary" name="createmark" id="createmark" value="Submit" />
  </div>
   </form>
</div>
            

            <?php
                if(!empty($demo_image)){
                   echo 'Image Uploaded Successfully!';
				} else {
				    echo '<h3>'.$msg.'</h3>';
				}?>


<?php } else { ?>


<?php } ?>
    </div>
    </div>
<?php include_once('bottominclude.php') ?>



