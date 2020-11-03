<?php 
  include '../classes/hall.php';
  include '../classes/genre.php';
  include '../classes/movie.php';


  $movie->insert();

  if(isset($_GET['movie_edit']))
  {
    $movie->update();
    $movie_query = $movie->getOne($_GET['movie_edit']);
    $movie_data = mysqli_fetch_assoc($movie_query);

    $id = $movie_data['id'];
    $title = $movie_data['title'];
    $release_date = $movie_data['release_date'];
    $trailer_link = $movie_data['trailer_link'];
    $image = $movie_data['image'];
    $description = $movie_data['description'];
    $director = $movie_data['director'];
    $writer = $movie_data['writer'];
    $stars = $movie_data['stars'];
    $run_time = $movie_data['run_time'];
    $viewing_date = $movie_data['viewing_date'];
    $viewing_time = $movie_data['viewing_time'];
    $fee = $movie_data['fee'];
    $pg_rating = $movie_data['pg_rating'];
    $plot_keywords = $movie_data['plot_keywords'];
    $genre_id = $movie_data['genre_id'];
    $hall_id = $movie_data['hall_id'];
    $user_id = $movie_data['user_id'];
    $num_available_seats = $movie_data['num_available_seats'];
  }
 ?>
  <section class="section">
      <div class="section-header">
          <h1>
            <?php if (isset($_GET['movie_edit'])): ?>
              Update Movie Details
            <?php else: ?>
              Add New Movie
            <?php endif ?>
          </h1>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                  	<form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                      <div class="card-header">
                          <h4>
                            <?php if (isset($_GET['movie_edit'])): ?>
                              Update Movie Details: <?php echo $title ?? ''; ?>
                            <?php else: ?>
                              Add New Movie
                            <?php endif ?>                              
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="title" class="form-control" value="<?php echo $title ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What's the title of the movie?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description:</label>
                              <div class="col-sm-12 col-md-7">
                                  <textarea name="description" class="summernote-simple" placeholder="Type some description for the movie..." required=""><?php echo $description ?? ''; ?></textarea>
                                  <span class="invalid-feedback">Type some description for the movie...</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Genre:</label>
                              <div class="col-sm-12 col-md-7">
                                  <select class="form-control selectric" name="genre_id" required="">
                                    <?php 
                                      $genre_query = $genre->getAll();
                                      while($row = mysqli_fetch_assoc($genre_query)){
                                    ?>
                                      <?php if(isset($_GET['movie_edit'])){ ?>
                                      <option value="<?=$row['id']; ?>" <?php if($row['id'] == $genre_id){ echo "selected='selected'";} ?>><?=$row['genre']; ?></option>
                                    <?php }else{ ?>
                                      <option value="<?=$row['id']; ?>"><?=$row['genre']; ?></option>
                                    <?php } } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Release Date:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="release_date" value="<?php echo $release_date ?? ''; ?>" class="form-control datepicker" required="">
                                  <span class="invalid-feedback">What is the release date?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Plot Keywords:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="plot_keywords" value="<?php echo $plot_keywords ?? ''; ?>" class="form-control" placeholder="Type a comma after each word e.g sci-fi, action, blockbuster" required="">
                                  <span class="invalid-feedback">What are the plot keywords of the movie?</span>
                              </div>
                          </div>

                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image:</label>
                              <div class="col-sm-12 col-md-7">
                                  <?php if (isset($_GET['movie_edit'])): ?>
                                    <img src="../images/movie_images/<?php echo $image ?? ''; ?>" width='100' alt="<?php echo $image ?? ''; ?>">
                                  <?php endif ?>
                                  <br>
                                  <input type="file" name="image" class="form-control" required="">
                                  <span class="invalid-feedback">Select an image for the movie</span>
                              </div>
                          </div>

                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Director:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="director" value="<?php echo $director ?? ''; ?>" class="form-control" required="">
                                  <span class="invalid-feedback">Who is the director of the movie?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Writer:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="writer" value="<?php echo $writer ?? ''; ?>" class="form-control" required="">
                                  <span class="invalid-feedback">Who are the writers of the movie?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Stars:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="stars" value="<?php echo $stars ?? ''; ?>" class="form-control" required="">
                                  <span class="invalid-feedback">Who are the stars of the movie?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">PG Rating:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="pg_rating" value="<?php echo $pg_rating ?? ''; ?>" class="form-control" required="">
                                  <span class="invalid-feedback">What is the PG Rating of the movie?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Trailer Link:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="url" name="trailer_link" value="<?php echo $trailer_link ?? ''; ?>" class="form-control" required="">
                                  <span class="invalid-feedback">Paste the link to the trailer of the movie here</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Run Time:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="run_time" value="<?php echo $run_time ?? ''; ?>" class="form-control" required="">
                                  <span class="invalid-feedback">What's the time duration of the movie?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Viewing Fee:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="number" min="1" name="fee" value="<?php echo $fee ?? ''; ?>" class="form-control" placeholder="How much will be charged for booking in Naira?" required="">
                                  <span class="invalid-feedback">How much will be charged for booking in Naira?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Viewing Date:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="viewing_date" value="<?php echo $viewing_date ?? ''; ?>" class="form-control datepicker" required="">
                                  <span class="invalid-feedback">What is the viewing date?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Viewing Time:</label>
                              <div class="col-sm-12 col-md-7">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        	<i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="viewing_time" value="<?php echo $viewing_time ?? ''; ?>" class="form-control timepicker" required="">
                                  </div>
                                  <span class="invalid-feedback">What is the viewing time?</span>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hall:</label>
                              <div class="col-sm-12 col-md-7">
                                  <select class="form-control selectric" name="hall_id" required="">
                                    <?php 
                                      $hall_query = $hall->getAll();
                                      while($row = mysqli_fetch_assoc($hall_query)){
                                    ?>
                                      <?php if(isset($_GET['movie_edit'])){ ?>
                                      <option value="<?=$row['id']; ?>" <?php if($row['id'] == $hall_id){ echo "selected='selected'";} ?>><?=$row['hall']; ?></option>
                                    <?php }else{ ?>
                                      <option value="<?=$row['id']; ?>"><?=$row['hall']; ?></option>
                                    <?php } } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Number of Available Seats:</label>
                              <div class="col-sm-12 col-md-7">
                                  <input type="text" name="num_available_seats" value="<?php echo $num_available_seats ?? ''; ?>" class="form-control" placeholder="Leave blank to use selected hall's number of seats">
                              </div>
                          </div>
                          <hr>
                          <div class="form-group row mb-4">
                              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                  <?php if (!isset($_GET['movie_edit'])): ?>
                                    <input class="btn btn-primary" type="submit" name="movie_insert" value="Submit">
                                  <?php else: ?>
                                    <input type="hidden" name="movie_id" value="<?php echo $id ?? ''; ?>">
                                    <input class="btn btn-primary" type="submit" name="movie_edit" value="Update">  
                                  <?php endif ?>
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>
          </div>
      </div>
  </section>
