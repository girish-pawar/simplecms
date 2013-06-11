<?php
$getmenu = $db->get_row("SELECT * FROM moduleparams WHERE md_id='$topmodule->md_id' ");
//echo $topmodule->md_id;

$getartcat = $db->get_row("SELECT md_param_data FROM moduleparams WHERE md_id = '$topmodule->md_id' AND md_param_name = 'artcat'");
$getartlimit = $db->get_row("SELECT md_param_data FROM moduleparams WHERE md_id = '$topmodule->md_id' AND md_param_name = 'artlimit'");
//echo $getartcat->md_param_data;
//echo $getartlimit->md_param_data;
?>

 <div>
<h3>Recent Blogs</h3>
</div>

<?php 
if($getartlimit->md_param_data > 1)
{
$limit = $getartlimit->md_param_data;
$getnames = $db->get_results("SELECT * FROM article WHERE category = '$getartcat->md_param_data' LIMIT 0 , $limit ");
$count = count($getnames);
if($count != 0)
{
foreach($getnames as $getname)
{
?>
	
<h5>
<?php echo $getname->title; ?></h5>

 <?php
$length = $getname->wordcount; // 80 words max
$phrase = $getname->description; // populate this with the text you want to display
$abody = (str_word_count($phrase,2));
$c = count($abody);

if($c >= $length)
{ 
// gotta cut
 $tbody = array_keys($abody);			?>
<p><?php echo substr($phrase,0,$tbody[$length]); ?></p>

<?php	} else {				// put the whole thing 
?>
<p><?php echo $phrase; ?></p>

			<?php } ?>
<a href="<?php echo '/newsite/article'; ?>/<?php echo $getname->seotitle ?>/" ><h6>read more...</h6></a>

<!-- <p><?php echo $getname->description; ?></p> -->
 
<?php } //foreach $getnames close
}//if close check count
else{
echo 'no recent blogs ';	
	
	}

	}else{
$getname = $db->get_row("SELECT * FROM article WHERE category = '$getartcat->md_param_data' "); ?>

<h5>
<?php echo $getname->title; ?></h5>
 <?php
$length = $getname->wordcount; // 80 words max
$phrase = $getname->description; // populate this with the text you want to display
$abody = (str_word_count($phrase,2));
$c = count($abody);

if($c >= $length)
{ 
// gotta cut
 $tbody = array_keys($abody);			?>
<p><?php echo substr($phrase,0,$tbody[$length]); ?></p>

<?php	} else {				// put the whole thing 
?>
<p><?php echo $phrase; ?></p>

			<?php } ?>


<a href="<?php echo '/newsite/article'; ?>/<?php echo $getname->seotitle ?>/" ><h6>read more...</h6></a>
<!-- <?php echo $getname->description; ?></p> -->
 <?php }
?>