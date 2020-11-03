<?php 
	include './classes/movie.php';
	include './classes/genre.php';
	include './classes/cast.php';
	include './classes/crew.php';

	// $booking->insert();

	if(!isset($_GET['movie_single']) || ($_GET['movie_single'] == '') || (mysqli_num_rows($movie->getOne($_GET['movie_single'])) < 1))
	{
		$dbConfig->errorRedirect();
	}

	$movie_query = $movie->getOne($_GET['movie_single']);
	$movie_data = mysqli_fetch_assoc($movie_query);
 ?>
<div class="buster-light">
	<div class="hero mv-single-hero">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- <h1> movie listing - list</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span> movie listing</li>
					</ul> -->
				</div>
			</div>
		</div>
	</div>
	<div class="page-single movie-single movie_single">
		<div class="container">
			<div class="row ipad-width2">
				<?php 
					include 'messages.php';
				 ?>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="movie-img">
						<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>">
						<div class="movie-btn">	
							<div class="btn-transform transform-vertical red">
								<div><a href="<?=$movie_data['trailer_link'] ?>" class="item item-1 redbtn"> <i class="ion-play"></i> Watch Trailer</a></div>
								<div><a href="<?=$movie_data['trailer_link']; ?>" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
							</div>
							<?php
								if(isset($_SESSION['user_email']))
								{
									$customer_id = $user->getUserId();

									if(!$booking->checkUserHasMovie($customer_id, $movie_data['id']))
									{
								 ?>
								<form action="" method="post" class="movie-btn">								
									<div class="btn-transform transform-vertical">
										<label style="color: #dd003f !important;">Number of Seats:</label>
										<input type="number" class="item" id="num_of_seats" min="1" name="num_of_seats" placeholder="Enter number of seats..." value="1" required="">
		<!-- 								<div><a href="#" class="item item-1 yellowbtn"> <i class="ion-card"></i> Buy ticket</a></div>
										<div><a href="#" class="item item-2 yellowbtn"><i class="ion-card"></i></a></div> -->
									</div>
									<br>
									<div class="btn-transform row">
										<input type="hidden" name="movie_id" id="movie_id" value="<?=$movie_data['id']; ?>">
										<div><button type="button" name="" onclick="payWithPaystack()" class="item item-2 yellowbtn col-md-12 col-sm-12 col-xs-12"> <i class="ion-card"></i> Buy ticket</button></div>
									</div>
								</form>
							<?php }else{ ?>
									<div class="btn-transform row">
										<div><button type="button" class="item item-2 yellowbtn col-md-12 col-sm-12 col-xs-12"> <i class="ion-card"></i> BOOKED</button></div>
									</div>
						<?php } } else{ ?>
									<div class="btn-transform row">
										<div><button type="button" class="item item-2 yellowbtn col-md-12 col-sm-12 col-xs-12 loginLink"> <i class="ion-card"></i> Login To Book</button></div>
									</div>
								<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="movie-single-ct main-content">
						<h1 class="bd-hd" style="color: #dd003f !important;"><?=$movie_data['title']; ?> <span> - <?=date('Y', strtotime($movie_data['release_date'])); ?></span></h1>
						<div class="social-btn">
							<a href="#" class="parent-btn"><i class="ion-heart"></i> Add to Favorite</a>
							<div class="hover-bnt">
								<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>share</a>
								<div class="hvr-item">
									<a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>
									<a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>
									<a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>
									<a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>
								</div>
							</div>		
						</div>
						<div class="movie-rate">
							<div class="rate">
								<!-- <i class="ion-android-star"></i>
								<p><span>8.1</span> /10<br>
									<span class="rv">56 Reviews</span>
								</p> -->
							</div>
							<div class="rate-star">
								<!-- <p>Rate This Movie:  </p>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star"></i>
								<i class="ion-ios-star-outline"></i> -->
							</div>
						</div>
						<div class="movie-tabs">
							<div class="tabs">
								<ul class="tab-links tabs-mv">
									<li class="active"><a href="#overview">Overview</a></li>
									<li><a href="#cast">  Cast & Crew </a></li>
									<li><a href="#moviesrelated"> Related Movies</a></li>                        
								</ul>
							    <div class="tab-content">
							        <div id="overview" class="tab active">
							            <div class="row">
							            	<div class="col-md-8 col-sm-12 col-xs-12">
							            		<p><?=$movie_data['description']; ?></p>
															<div class="title-hd-sm">
																<h4>cast</h4>
																<!-- <a href="#" class="time">Full Cast & Crew  <i class="ion-ios-arrow-right"></i></a> -->
															</div>
												<!-- movie cast -->
												<div class="mvcast-item">
												<?php 
													$cast_query = $cast->getByMovie($_GET['movie_single']);

													while($cast_data = mysqli_fetch_assoc($cast_query)){
														
												 ?>										
													<div class="cast-it">
														<div class="cast-left">
															<h4><?=$movie->getNameInitials($cast_data['name']); ?></h4>
															<a href="#"><?=$cast_data['name']; ?></a>
														</div>
														<p>...  <?=$cast_data['role']; ?></p>
													</div>
												<?php } ?>
												</div>
							        </div>
							            	<div class="col-md-4 col-xs-12 col-sm-12">
							            		<div class="sb-it">
							            			<h6>Director: </h6>
							            			<p><a href="#"><?=$movie_data['director']; ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Writer: </h6>
							            			<p><a href="#"><?=$movie_data['writer']; ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Stars: </h6>
							            			<p><a href="#"><?=$movie_data['stars']; ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Genre:</h6>
							            			<p><a href="#"><?=$genre->getGenreName($movie_data['genre_id']); ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Release Date:</h6>
							            			<p><a href="#"><?=date('l jS F\, Y', strtotime($movie_data['release_date'])); ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Run Time:</h6>
							            			<p><a href="#"><?=$movie_data['run_time']; ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Viewing Date:</h6>
							            			<p><a href="#"><?=date('l jS F\, Y', strtotime($movie_data['viewing_date'])); ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Viewing Time:</h6>
							            			<p><a href="#"><?=date('g:iA', strtotime($movie_data['viewing_time'])); ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>MMPA Rating:</h6>
							            			<p><a href="#"><?=$movie_data['pg_rating']; ?></a></p>
							            		</div>
							            		<div class="sb-it">
							            			<h6>Plot Keywords:</h6>
							            			<p class="tags">
							            				<span class="time"><a href="#"><?=$movie_data['plot_keywords']; ?></a></span>
							            			</p>
							            		</div>
							            		<div class="ads">
																<img src="images/uploads/ads1.png" alt="">
															</div>
							            	</div>
							            </div>
							        </div>
							        <div id="cast" class="tab">
							        	<div class="row">
							            	<h3>Cast & Crew of</h3>
							       	 			<h2>Avengers: Age of Ultron</h2>
														<!-- //== -->
							       	 			<div class="title-hd-sm">
															<h4>Directors</h4>
														</div>
														<div class="mvcast-item">											
															<div class="cast-it">
																<div class="cast-left">
																	<h4><?=$movie->getNameInitials($movie_data['director']); ?></h4>
																	<a href="#"><?=$movie_data['director']; ?></a>
																</div>
																<p>...  Director</p>
															</div>
														</div>
														<!-- //== -->
														<div class="title-hd-sm">
															<h4>Casts</h4>
														</div>
														<div class="mvcast-item">											
															<?php 
																$cast_query = $cast->getByMovie($_GET['movie_single']);

																while($cast_data = mysqli_fetch_assoc($cast_query)){
																	
															 ?>										
																<div class="cast-it">
																	<div class="cast-left">
																		<h4><?=$movie->getNameInitials($cast_data['name']); ?></h4>
																		<a href="#"><?=$cast_data['name']; ?></a>
																	</div>
																	<p>...  <?=$cast_data['role']; ?></p>
																</div>
															<?php } ?>
														</div>
														<!-- //== -->
														<div class="title-hd-sm">
															<h4>Crew Members</h4>
														</div>
														<div class="mvcast-item">											
															<?php 
																$crew_query = $crew->getByMovie($_GET['movie_single']);

																while($crew_data = mysqli_fetch_assoc($crew_query)){
																	
															 ?>										
																<div class="cast-it">
																	<div class="cast-left">
																		<h4><?=$movie->getNameInitials($crew_data['name']); ?></h4>
																		<a href="#"><?=$crew_data['name']; ?></a>
																	</div>
																	<p>...  <?=$crew_data['role']; ?></p>
																</div>
															<?php } ?>
														</div>
														<!-- //== -->
							            </div>
						       	 	</div>
						       	 	<div id="moviesrelated" class="tab">
						       	 		<div class="row">
						       	 			<h3>Related Movies To</h3>
						       	 			<h2><?=$movie_data['title']; ?></h2>
						       	 			<div class="topbar-filter">
												<hr>
											</div>
											<?php 
												$related_movies = $movie->getRelatedMovies($movie_data['genre_id'], $movie_data['plot_keywords'], $movie_data['id']);

												if(mysqli_num_rows($related_movies) < 1)
												{
												?>
												 <p style="color: #dd003f !important;">No movie related to this movie was found!</p>
											<?php
												}
												while($related_movie_data = mysqli_fetch_assoc($related_movies)){
													if($related_movie_data['id'] == $movie_data['id']):
														continue;
													endif

											 ?>
											<div class="movie-item-style-2">
												<img src="images/movie_images/<?=$related_movie_data['image']; ?>" alt="<?=$related_movie_data['image']; ?>">
												<div class="mv-item-infor">
													<h6><a href="#"><?=$related_movie_data['title']; ?> <span>(<?=date('Y', strtotime($movie_data['release_date'])); ?>)</span></a></h6>
													<p class="rate"><i class="ion-android-star"></i><span>8.1</span> /10</p>
													<p class="describe"><?=substr($related_movie_data['description'], 0, 160); ?></p>
													<p class="run-time"> Run Time: <?=$related_movie_data['run_time']; ?>    .     <span>MMPA: <?=$related_movie_data['pg_rating']; ?> </span>    .     <span>Release: <?=date('l jS F\, Y', strtotime($movie_data['release_date'])); ?></span></p>
													<p>Director: <a href="#"><?=$related_movie_data['director']; ?></a></p>
													<p>Stars: <a href="#"><?=$related_movie_data['stars']; ?></a></p>
												</div>
											</div>
										<?php } ?>
											<div class="topbar-filter">
												<hr>
											</div>
						       	 		</div>
						       	 	</div>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
	function payWithPaystack() {
    var movie_id = $('#movie_id').val();
    var num_of_seats = $('#num_of_seats').val();
    var customer_id = '<?=$dbConfig->getUserId(); ?>';

    alert('First alert ' + movie_id + ' ' + num_of_seats);
    var handler = PaystackPop.setup({ 
        key: 'pk_test_003a71629749485291b4e0b8a54d44041974a5de', //put your public key here
        email: '<?=$dbConfig->getUserEmail(); ?>', //put your customer's email here
        <?php 
        	$fee = $movie_data['fee'];
        	$fee = intval($fee);
         ?>
        amount: num_of_seats * <?=$fee; ?> * 100, //amount the customer is supposed to pay

        callback: function (response) {
            //after the transaction have been completed
            //make post call  to the server with to verify payment 
            //using transaction reference as post data
            alert('Second alert ' + movie_id + ' ' + num_of_seats);
            $.post("verify.php",
            	{
            		reference:response.reference,
            		customer_id:customer_id,
            		movie_id:movie_id,
            		num_of_seats:num_of_seats,
            	},

            	function(status){
                if(status == "success")
                {
                    //successful transaction
                    alert('Transaction was successful');
                    window.location = "index.php?bookings";

                }
                else
                {
                    //transaction failed
                    alert(response);

                }
            });
        },
        onClose: function () {
            //when the user close the payment modal
            alert('Transaction cancelled');
        }
    });
    handler.openIframe(); //open the paystack's payment modal
}
</script>