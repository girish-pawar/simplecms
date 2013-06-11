<?php

$seotitle = $_GET['seotitle']	;
$article = $db->get_row("SELECT * FROM article_category WHERE seotitle='$seotitle'");
$articlenames = $db->get_results("SELECT * FROM article WHERE category = '$article->acid'");
$count = count($articlenames);
	//print_r($article);
	
	?>
	<div class="span9">
		<h3><?php echo $article->title; ?></h3>	
	<p><?php  echo $article->description; ?></p>
	<?php  
	if($count != 0)
	{
foreach($articlenames as $articlename)
{
?>	
	<h6><li type="square"><?php echo $articlename->title; ?></li></h6>
<?php	}	 }
	?>
	
	
	
	</div>