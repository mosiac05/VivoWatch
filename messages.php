<?php
	if(isset($_SESSION['messages'])){
			$messages = $dbConfig->displayMessage();
			$i = 0;
			while ($i < count($messages)) {
			$words = explode('|', $messages[$i]);
			
	 ?>
	<div class="col-md-10 col-md-offset-1 col-xs-8 col-xs-offset-2 alert <?=$words[1] ?> alert-dismissible">
		<button class="close" data-dismiss="alert"><span>&times;</span></button>
		<p><?=$words[0]; ?></p>
	</div>
	<?php 
				$i += 1;
		}
	}
 ?>