<?php 
	require_once './includes/head.php';
 ?>
<?php
	
	if(!isset($_SESSION["user_email"]))
	{
		include 'login.php';
	}
	else
	{

		require_once './includes/nav.php';

 ?>
<!-- Start app main Content -->
<div class="main-content">

<?php
		if(isset($_SESSION['messages'])){
			$messages = $dbConfig->displayMessage();
			$i = 0;
			while ($i < count($messages)) {
			$words = explode('|', $messages[$i]);
			
	 ?>
	<div class="col-12 alert <?=$words[1] ?> alert-dismissible show fade" role="alert">
		<div class="alert-body">
	      <button class="close" data-dismiss="alert"><span>&times;</span></button>
	      <?=$words[0]; ?>
	  </div>
	</div>
	<?php 
				$i += 1;
		}
	}
?>


<?php
		if($dbConfig->checkUserActive() && $dbConfig->checkUserIsStaff())
		{
				if(isset($_GET['dashboard']))
				{
					include 'dashboard.php';
				}
				elseif(isset($_GET['movie_create']) || isset($_GET['movie_edit']))
				{
					include 'movie_create.php';
				}
				elseif(isset($_GET['movies']))
				{
					include 'movies.php';
				}
				elseif(isset($_GET['movie_single']) || isset($_GET['movie_delete']) || isset($_GET['tag_delete']) || isset($_GET['cast_delete']) || isset($_GET['crew_delete']))
				{
					include 'movie_single.php';
				}
				elseif(isset($_GET['genres']) || isset($_GET['genre_edit']) || isset($_GET['genre_delete']))
				{
					include 'genres.php';
				}
				elseif(isset($_GET['halls']) || isset($_GET['hall_edit']) || isset($_GET['hall_delete']))
				{
					include 'halls.php';
				}
				elseif(isset($_GET['bookings']))
				{
					include 'bookings.php';
				}
				elseif(isset($_GET['booking_single']))
				{
					include 'booking_single.php';
				}
				elseif(isset($_GET['customers']))
				{
					include 'customers.php';
				}
				// elseif(isset($_GET['customer_single']))
				// {
				// 	include 'customer_single.php';
				// }
				elseif(isset($_GET['staffs']) || isset($_GET['admins']))
				{
					include 'staffs.php';
				}
				elseif(isset($_GET['user_single']))
				{
					include 'user_single.php';
				}
				elseif(isset($_GET['logout']))
				{
					$auth->logout(1);
				}
				else
				{
					$dbConfig->setMessage("Please avoid malicious editing of the URL!|alert-light");
					include 'dashboard.php';
				}			
		}
		else
		{
			$auth->logout();
		}

	}
 ?>   
</div>     
        
<!-- Start app Footer part -->
<?php 
	require_once './includes/footer.php';
 ?>
<!-- General JS Scripts -->
<?php 
	require_once './includes/js.php';
 ?>