    	<?php
include_once('/includes/header.php');
?>
<div class='content'>
	<div class="container-fluid">        
        <div class="row-fluid">
					<div class="span12">
						<?php include_once('add/'.$_GET["type"].'/'.$_GET['tmpl'].'.php'); ?>				
					</div>
		</div>
	</div>
</div>
	<?php include_once('includes/footer.php'); ?>