<?php 
	include './classes/movie.php';
	include './classes/genre.php';
 ?>

<div class="slider movie-items">
	<div class="container">
		<div class="row">
			<div class="social-link">
				<p>Follow us: </p>
				<a href="#"><i class="ion-social-facebook"></i></a>
				<a href="#"><i class="ion-social-twitter"></i></a>
				<a href="#"><i class="ion-social-googleplus"></i></a>
				<a href="#"><i class="ion-social-youtube"></i></a>
			</div>
	    	<div  class="slick-multiItemSlider">
	    		<?php 
	    			$movie_query = $movie->getMovieWithLimit(8);
	    			while($movie_data = mysqli_fetch_array($movie_query)){
	    		 ?>
	    		<div class="movie-item">
	    			<div class="mv-img">
	    				<a href="#"><img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>" width="285" height="437"></a>
	    			</div>
	    			<div class="title-in">
	    				<div class="cate">
	    					<span class="blue"><a href="index.php?movie_single=<?=$movie_data['id']; ?>"><?=$genre->getGenreName($movie_data['genre_id']); ?></a></span>
	    				</div>
	    				<h6><a href="index.php?movie_single=<?=$movie_data['id']; ?>"><?=$movie_data['title']; ?></a></h6>
	    			</div>
	    		</div>
	    	<?php } ?>
	    	</div>
	    </div>
	</div>
</div>
<div class="buster-light">
	<div class="movie-items">
		<div class="container">
			<div class="row">
				<?php
					// $dbConfig->setMessage('John Paul|alert-success');
					include 'messages.php';
				 ?>				
			</div>
		<?php 
 				$showing_now = $movie->getByTag('SHOWING NOW');
				$today = $movie->getByTag('TODAY');

				if(!empty($showing_now) || !empty($today)):
		 ?>
			<div class="row ipad-width">
				<div class="col-md-8">
					<div class="title-hd">
						<h2>IN THEATRE</h2>
						<a href="#" class="viewall">View all <i class="ion-ios-arrow-right"></i></a>
					</div>
					<?php
						if (mysqli_num_rows($showing_now) > 0): 
					?>
					<div class="tabs">
						<ul class="tab-links">
							<li class="active"><a href="#sowing-now"> #Showing Now</a></li>
						</ul>
				      <div class="tab-content">				        	
				        <div id="sowing-now" class="tab active">
			           <div class="row">
			            	<div class="slick-multiItem">
								      <?php
								      	while($movie_data = mysqli_fetch_assoc($showing_now)){
								       ?>
			            		<div class="slide-it">
			            			<div class="movie-item">
				            			<div class="mv-img">
				            				<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>" width="185" height="284">
				            			</div> 
				            			<div class="hvr-inner">
				            				<a  href="index.php?movie_single=<?=$movie_data['id']; ?>"> Details <i class="ion-android-arrow-dropright"></i> </a>
				            			</div>
				            			<div class="title-in">
				            				<h6><a href="index.php?movie_single=<?=$movie_data['id']; ?>"><?=$movie_data['title']; ?></a></h6>
				            			</div>
				            		</div>
			            		</div>
			       	 				<?php } ?>
			            	</div>
			            </div>
			       	 	</div>
				        </div>
					    </div>
					<!-- </div>								 -->
				<?php endif ?>

					<?php 
						if (mysqli_num_rows($today) > 0): 
					?>
					<div class="tabs">
						<ul class="tab-links">
							<li class="active"><a href="#today"> #Today</a></li>
						</ul>
				      <div class="tab-content">				        	
				        <div id="today" class="tab active">
			           <div class="row">
			            	<div class="slick-multiItem">
								      <?php
								      	while($movie_data = mysqli_fetch_assoc($today)){

								       ?>
			            		<div class="slide-it">
			            			<div class="movie-item">
				            			<div class="mv-img">
				            				<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>" width="185" height="284">
				            			</div> 
				            			<div class="hvr-inner">
				            				<a  href="index.php?movie_single=<?=$movie_data['id']; ?>"> Details <i class="ion-android-arrow-dropright"></i> </a>
				            			</div>
				            			<div class="title-in">
				            				<h6><a href="index.php?movie_single=<?=$movie_data['id']; ?>"><?=$movie_data['title']; ?></a></h6>
				            			</div>
				            		</div>
			            		</div>
			       	 				<?php } ?>
			            	</div>
			            </div>
			       	 	</div>
				        </div>
					    </div>
					<!-- </div>								 -->
				<?php endif ?>
			</div>
			<?php endif ?>
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
				</div>
			</div>
		</div>
		<?php 
 				$latest = $movie->getByTag('LATEST');
				$coming_soon = $movie->getByTag('COMING SOON');

				if(!empty($latest) || !empty($coming_soon)):
		 ?>
			<div class="row ipad-width">
				<div class="col-md-8">
					<div class="title-hd">
						<h2>MOVIES</h2>
						<a href="#" class="viewall">View all <i class="ion-ios-arrow-right"></i></a>
					</div>
					<?php
						if (mysqli_num_rows($latest) > 0): 
					?>
					<div class="tabs">
						<ul class="tab-links">
							<li class="active"><a href="#latest"> #Latest</a></li>
						</ul>
				      <div class="tab-content">				        	
				        <div id="latest" class="tab active">
			           <div class="row">
			            	<div class="slick-multiItem">
								      <?php
								      	while($movie_data = mysqli_fetch_assoc($latest)){
								       ?>
			            		<div class="slide-it">
			            			<div class="movie-item">
				            			<div class="mv-img">
				            				<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>" width="185" height="284">
				            			</div> 
				            			<div class="hvr-inner">
				            				<a  href="index.php?movie_single=<?=$movie_data['id']; ?>"> Details <i class="ion-android-arrow-dropright"></i> </a>
				            			</div>
				            			<div class="title-in">
				            				<h6><a href="index.php?movie_single=<?=$movie_data['id']; ?>"><?=$movie_data['title']; ?></a></h6>
				            			</div>
				            		</div>
			            		</div>
			       	 				<?php } ?>
			            	</div>
			            </div>
			       	 	</div>
				        </div>
					    </div>
					<!-- </div>								 -->
				<?php endif ?>

					<?php 
						if (mysqli_num_rows($coming_soon) > 0): 
					?>
					<div class="tabs">
						<ul class="tab-links">
							<li class="active"><a href="#coming-soon"> #Coming Soon</a></li>
						</ul>
				      <div class="tab-content">				        	
				        <div id="coming-soon" class="tab active">
			           <div class="row">
			            	<div class="slick-multiItem">
								      <?php
								      	while($movie_data = mysqli_fetch_assoc($coming_soon)){

								       ?>
			            		<div class="slide-it">
			            			<div class="movie-item">
				            			<div class="mv-img">
				            				<img src="images/movie_images/<?=$movie_data['image']; ?>" alt="<?=$movie_data['image']; ?>" width="185" height="284">
				            			</div> 
				            			<div class="hvr-inner">
				            				<a  href="index.php?movie_single=<?=$movie_data['id']; ?>"> Details <i class="ion-android-arrow-dropright"></i> </a>
				            			</div>
				            			<div class="title-in">
				            				<h6><a href="index.php?movie_single=<?=$movie_data['id']; ?>"><?=$movie_data['title']; ?></a></h6>
				            			</div>
				            		</div>
			            		</div>
			       	 				<?php } ?>
			            	</div>
			            </div>
			       	 	</div>
				        </div>
					    </div>
					<!-- </div>								 -->
				<?php endif ?>
			</div>
			<?php endif ?>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="sidebar">
					<div class="sb-facebook sb-it">
						<h4 class="sb-title">Find us on Facebook</h4>
						<iframe src="#" data-src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftemplatespoint.net%2F%3Ffref%3Dts&tabs=timeline&width=340&height=315px&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=true&appId"  height="315" style="width:100%;border:none;overflow:hidden" ></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--end of latest new v1 section-->
	</div>
</div>