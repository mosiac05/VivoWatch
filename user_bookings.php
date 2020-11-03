<?php 
	$user_id = $dbConfig->getUserId();
	$user_query = $user->getOne($user_id);

	if(mysqli_num_rows($user_query) < 1)
	{
		$auth->logout();
	}

	$user_data = mysqli_fetch_assoc($user_query);

 ?>

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1><?=$dbConfig->getUserFullName(); ?>’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>My Bookings</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
		<div class="buster-light">
<div class="page-single userfav_list">
	<div class="container">
		<div class="row ipad-width2">
			<?php
				include 'user_sidebar.php';
			 ?>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="row">
					<?php 
						include 'messages.php';
					 ?>
				</div>
				<div class="topbar-filter user">
					<hr>
				</div>
				<div class="flex-wrap-movielist user-fav-list">
					<?php 
						$movie_query = $booking->getUserBookings();

						if(mysqli_num_rows($movie_query) < 1)
						{
					?>
						<p style="color: #dd003f !important;">You have not booked for any movie yet. Click <a href="index.php?movies" class="btn btn-danger">here</a> to select a movie and book.</p>
					<?php
						}

						while($movie_data = mysqli_fetch_assoc($movie_query)){

					 ?>
					<div class="movie-item-style-2">
						<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>">
						<div class="mv-item-infor">
							<h6><a href="#"><?=$movie_data['title']; ?> <span>(<?=date('Y', strtotime($movie_data['release_date'])); ?>)</span></a></h6>
							<?php if (date('l jS F\, Y') == date('l jS F\, Y', strtotime($movie_data['viewing_date']))): ?>
								<div class="cate">
									<span style="background-color: #dd003f !important;" class="col-md-12 col-sm-12 col-xs-12 text-center"><a href="#">SHOWING TODAY</a></span>								
								</div>
							<?php endif ?>
							<p class="describe"><?=$movie_data['description']; ?></p>
							<p class="run-time"> Run Time: <?=$movie_data['run_time']; ?> . <span>MMPA: <?=$movie_data['pg_rating']; ?> </span> . <span>Date: <?=date('l jS F\, Y', strtotime($movie_data['viewing_date'])); ?> | Time: <?=date('g:iA', strtotime($movie_data['viewing_time'])); ?></span></p>
							<p>Director: <a href="#"><?=$movie_data['director']; ?></a></p>
							<p>Stars: <a href="#"><?=$movie_data['stars']; ?></a></p>
							<p>Your Reference Number: <a href="#"><?=$booking->displayRefNumber($movie_data['id']); ?></a></p>
							<div class="cate">
<!-- 		    				<span style="background-color: #dd003f !important;" class="col-md-12 col-xs-12 text-center"><a href="#">View Details</a></span>
		    				<br class="hidden-lg hidden-md">
		    				<br class="hidden-lg hidden-md"> -->
		    				<span class="blue col-md-4 col-xs-12 text-center pull-right"><a href="index.php?movie_single=<?=$movie_data['id']; ?>">View Details</a></span>
		    				<br class="hidden-lg hidden-md">
		    				<br class="hidden-lg hidden-md">
		    				<?php 
		    					$status = $booking->getBookingStatus($movie_data['id']);

		    					switch ($status) {
		    						case 'BOOKED':
		    							echo '<span class="yell col-md-4 col-xs-12 text-center"><a href="#">BOOKED</a></span>';
		    							break;
		    						case 'ARRIVED':
		    							echo '<span class="green col-md-4 col-xs-12 text-center"><a href="#">ARRIVED</a></span>';
		    							break;
		    						case 'CLOSED':
		    							echo '<span style="background-color: #dd003f !important;" class="col-md-4 col-xs-12 text-center"><a href="#">ARRIVED</a></span>';
		    							break;
		    					}
		    				 ?>
		    				<!-- <span class="blue col-md-4 col-xs-12 text-center"><a href="#">View Details</a></span> -->
	    				</div>
						</div>
					</div>
				<?php } ?>
				</div>		
				<div class="topbar-filter">
					<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		</div>