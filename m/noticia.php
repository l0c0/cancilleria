<?php require("includes/header.php"); ?>
	<div class="main_wraper">
    	<?php 
			if (isset($_GET['id']))
				imprimirNoticia($_GET['id'], $result);	
		 ?>
    </div>
<?php require("includes/footer.php"); ?>