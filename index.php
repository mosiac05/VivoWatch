<?php
	require_once './includes/head.php';
 ?>


<?php 
	if(!isset($_SESSION['user_email']))
	{
		$user->insert(1,0,0);
		$auth->login();
	}
 ?>
<!-- BEGIN | Header -->
<?php 
	require_once './includes/nav.php';
 ?>
<!-- END | Header -->

<?php
		if(isset($_GET['home']))
		{
			include 'home.php';
		}
		elseif(isset($_GET['movies']))
		{
			include 'movies.php';
		}
		elseif(isset($_GET['movie_single']))
		{
			include 'movie_single.php';
		}
		elseif((isset($_GET['profile']) || isset($_GET['favorite_movies']) || isset($_GET['bookings'])) && !isset($_SESSION['user_email']))
		{
			$dbConfig->setMessage('Please Login to access your profile!|alert-danger');
			$dbConfig->errorRedirect();
		}
		elseif(isset($_GET['profile']))
		{
			include 'user_profile.php';
		}
		elseif(isset($_GET['bookings']))
		{
			include 'user_bookings.php';
		}
		elseif(isset($_GET['favorite_movies']))
		{
			include 'user_favorite_movies.php';
		}
		elseif(isset($_GET['search']))
		{
			include 'search.php';
		}	
		elseif(isset($_GET['logout']))
		{
			$auth->logout();
		}
		else
		{
			include 'home.php';
		}
 ?>

<!-- footer section-->
<?php 
	require_once './includes/footer.php';
 ?>
<!-- end of footer section-->

<?php 
	require_once './includes/js.php';
 ?>