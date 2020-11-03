<?php 
	include './classes/movie.php';
	include './classes/genre.php';
 ?>
<div class="buster-light">
	<div class="hero common-hero">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="hero-ct">
						<h1> Search Results</h1>
						<ul class="breadcumb">
							<li class="active"><a href="index.php">Home</a></li>
							<li> <span class="ion-ios-arrow-right"></span> Search Results</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="page-single">
		<div class="container">
			<div class="row ipad-width">
				<?php 
					include 'messages.php';
				 ?>
				<div class="col-md-8 col-sm-12 col-xs-12">
					<div class="topbar-filter">
						<?php 
							$movie_query = $movie->searchMovies($_GET['title'], $_GET['genre_id'], $_GET['release_date']);

							$num_search = mysqli_num_rows($movie_query);
						 ?>
						<p style="color: #dd003f !important;">Found <?php echo $num_search; ?> movies!</p>
						
					</div>
					<div class="flex-wrap-movielist">
						<?php

							if($num_search < 1)
							{
							?>
							 <p style="color: #dd003f !important;">No movie match your search. Please try again with new search parameters</p>
						<?php
							}
							while($movie_data = mysqli_fetch_assoc($movie_query)){

						 ?>
						<div class="movie-item-style-2 movie-item-style-1">
							<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="">
							<div class="hvr-inner">
        				<a  href="index.php?movie_single=<?=$movie_data['id']; ?>"> Details <i class="ion-android-arrow-dropright"></i> </a>
        			</div>
							<div class="mv-item-infor">
								<h6 class="text-center"><a href="#"><?=$movie_data['title']; ?></a></h6>
								<div class="cate">
		    					<span class="blue col-md-12 col-sm-12 col-xs-12 text-center"><a href="index.php?movie_single=<?=$movie_data['id']; ?>">View Details</a></span>
	    				</div>
							</div>
						</div>
					<?php } ?>
					</div>		
					<div class="topbar-filter">
						<hr>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="sidebar">
						<div class="searh-form">
							<h4 class="sb-title">Search for movie</h4>
							<form class="form-style-1" action="index.php?search" method="get">
										<input type="hidden" name="search">

								<div class="row">
									<div class="col-md-12 form-it">
										<label>Movie name</label>
										<input type="text" placeholder="Enter keywords" name="title" required="">
									</div>
									<div class="col-md-12 form-it">
										<label>Genres</label>
										<div class="group-ip">
											<select name="genre_id" class="ui fluid dropdown" required="">
												<option selected="">Select genre:</option>
												<?php 
                          $genre_query = $genre->getAll();
                          while($genre_data = mysqli_fetch_assoc($genre_query)){
                        ?>
                          <option value="<?=$genre_data['id']; ?>"><?=$genre_data['genre']; ?></option>
                        <?php } ?>
											</select>
										</div>	
									</div>
									<div class="col-md-12 form-it">
										<label>Release Year</label>
										<input type="text" name="release_date" placeholder="Enter keywords" required="">
									</div>
									<div class="col-md-12 ">
										<input class="submit" type="submit" value="submit">
									</div>
								</div>
							</form>
						</div>
						<div class="ads">
							<img src="images/uploads/ads1.png" alt="">
						</div>
						<div class="sb-facebook sb-it">
							<h4 class="sb-title">Find us on Facebook</h4>
							<iframe src="#" data-src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftemplatespoint.net%2F%3Ffref%3Dts&tabs=timeline&width=340&height=315px&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=true&appId"  height="315" style="width:100%;border:none;overflow:hidden" ></iframe>
						</div>
						<div class="sb-twitter sb-it">
							<h4 class="sb-title">Tweet to us</h4>
							<div class="slick-tw">
								<div class="tweet item" id=""><!-- Put your twiter id here -->
								</div>
								<div class="tweet item" id=""><!-- Put your 2nd twiter account id here -->
								</div>
							</div>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>