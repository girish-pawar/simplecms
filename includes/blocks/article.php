<?php

$seotitle = $_GET['seotitle']	;
	$article = $db->get_row("SELECT * FROM article WHERE seotitle='$seotitle'");
	//print_r($article);
	
	?>
	<div class="span9">
	
	<h3><?php echo $article->title; ?></h3>	
	<p><?php  echo $article->description; ?></p>
	
	</div>