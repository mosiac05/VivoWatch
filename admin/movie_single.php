<?php 
    include '../classes/movie.php';
    include '../classes/tag.php';
    include '../classes/cast.php';
    include '../classes/crew.php';

    if(isset($_GET['movie_delete']))
    {
      $movie->deleteOne($_GET['movie_delete']);
    }
    $movie_data = mysqli_fetch_assoc($movie->getOne($_GET['movie_single']));

    /***************************************************************/
    $tag->insert();
    if(isset($_GET['tag_delete']))
    {
      $tag_query = $tag->getOne($_GET['tag_delete']);
      $tag_data = mysqli_fetch_assoc($tag_query);

      $movie_id = $tag_data['movie_id'];
      $tag->deleteOne($_GET['tag_delete'], $movie_id);
    }
    /***************************************************************/

    /***************************************************************/
    $cast->insert();
    if(isset($_GET['cast_delete']))
    {
      $cast_query = $cast->getOne($_GET['cast_delete']);
      $cast_data = mysqli_fetch_assoc($cast_query);

      $movie_id = $cast_data['movie_id'];
      $cast->deleteOne($_GET['cast_delete'], $movie_id);
    }
    /***************************************************************/

    /***************************************************************/
    $crew->insert();
    if(isset($_GET['crew_delete']))
    {
      $crew_query = $crew->getOne($_GET['crew_delete']);
      $crew_data = mysqli_fetch_assoc($crew_query);

      $movie_id = $crew_data['movie_id'];
      $crew->deleteOne($_GET['crew_delete'], $movie_id);
    }
 ?>
     <section class="section">
        <div class="section-header">
            <h1>Movie Details</h1>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>Movie Details: <?=$movie_data['title']; ?></h4>
                      </div>
                      <div class="card-body">
                          <table class="table table-striped table-bordered m-auto col-md-8 col-lg-8">
                              <!-- <thead>
                              <tr>
                                  <th scope="col">Last</th>
                                  <th scope="col">Handle</th>
                              </tr>
                              </thead> -->
                              <tbody>
                              <tr>
                                  <th>Title:</th>
                                  <td><?=$movie_data['title']; ?></td>
                              </tr>
                              <tr>
                                  <th>Description:</th>
                                  <td><?=$movie_data['description']; ?></td>
                              </tr>
                              <tr>
                                  <?php
                                      $genre_id = $movie_data['genre_id'];
                                    $genre_query = $dbConfig->makeQuery("SELECT * FROM genres WHERE id='$genre_id'");
                                    $genre_data = mysqli_fetch_assoc($genre_query);
                                   ?>
                                  <th>Genre:</th>
                                  <td><?=$genre_data['genre']; ?></td>
                              </tr>
                              <tr>
                                  <th>Release Date:</th>
                                  <td><?=date('l jS F\, Y', strtotime($movie_data['release_date'])); ?></td>
                              </tr>
                              <tr>
                                  <th>Plot Keywords:</th>
                                  <td><?=$movie_data['plot_keywords']; ?></td>
                              </tr>
                              <tr>
                                  <th>Image:</th>
                                  <td><img src="../images/movie_images/<?=$movie_data['image']; ?>" width="150" alt="<?=$movie_data['image']; ?>"> </td>
                              </tr>
                              <tr>
                                  <th>Director:</th>
                                  <td><?=$movie_data['director']; ?></td>
                              </tr>
                              <tr>
                                  <th>Writer:</th>
                                  <td><?=$movie_data['writer']; ?></td>
                              </tr>
                              <tr>
                                  <th>Stars:</th>
                                  <td><?=$movie_data['stars']; ?></td>
                              </tr>
                              <tr>
                                  <th>PG Rating:</th>
                                  <td><?=$movie_data['pg_rating']; ?></td>
                              </tr>
                              <tr>
                                  <th>Trailer Link:</th>
                                  <td><a href="<?=$movie_data['trailer_link']; ?>" target="_blank"><?=$movie_data['trailer_link']; ?></a></td>
                              </tr>
                              <tr>
                                  <th>Writer:</th>
                                  <td><?=$movie_data['writer']; ?></td>
                              </tr>
                              <tr>
                                  <th>Run Time:</th>
                                  <td><?=$movie_data['run_time']; ?></td>
                              </tr>
                              <tr>
                                  <th>Fee:</th>
                                  <td><?=$movie_data['fee']; ?></td>
                              </tr>
                              <tr>
                                  <th>Viewing Date:</th>
                                  <td><?=date('l jS F\, Y', strtotime($movie_data['viewing_date'])); ?></td>
                              </tr>
                              <tr>
                                  <th>Viewing Time:</th>
                                  <td><?=date('g:iA', strtotime($movie_data['viewing_time'])); ?></td>
                              </tr>
                              <tr>
                                  <?php
                                      $hall_id = $movie_data['hall_id'];
                                    $hall_query = $dbConfig->makeQuery("SELECT * FROM halls WHERE id='$hall_id'");
                                    $hall_data = mysqli_fetch_assoc($hall_query);
                                   ?>
                                  <th>Hall:</th>
                                  <td><?=$hall_data['hall']; ?></td>
                              </tr>
                              <tr>
                                  <th>Number of Seats:</th>
                                  <td><?=$movie_data['num_available_seats']; ?></td>
                              </tr>
                              <tr>
                                <td colspan="2" class="text-center buttons">
                                  <a href="index.php?movie_edit=<?=$movie_data['id']; ?>" class="btn btn-icon btn-warning mt-2"><i class="fas fa-edit"></i> Edit</a>
                                  <a href="index.php?movie_delete=<?=$movie_data['id']; ?>" class="btn btn-icon btn-danger mt-2"><i class="fas fa-trash"></i> Delete</a>
                                </td>                              
                              </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
	            </div>
	        </div>

	        <hr>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                  	<form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>Add New Tag</h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Select Tag:</label>
                              <div class="col-sm-12 col-md-12">
                                  <select class="form-control selectric" name="tag" required="">
                                      <option value="SHOWING NOW">Showing Now</option>
                                      <option value="TODAY">Today</option>
                                      <option value="LATEST">Latest</option>
                                      <option value="COMING SOON">Coming Soon</option>
                                  </select>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                <input type="hidden" name="movie_id" value="<?=$movie_data['id']; ?>">
                                <input class="btn btn-primary" type="submit" name="tag_insert" value="Add Tag">
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>              
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                      <div class="card-header">
                          <h4>Tags</h4>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Tag</th>
                                      <th>Action</th>
                                  </tr>                                  
                                </thead>

                                <tbody>                                
                                  <?php 
                                    $tag_query = $tag->getAll($movie_data['id']);
                                    
                                    $i = 0;
                                    while($tag_data = mysqli_fetch_assoc($tag_query)){
                                      $i += 1;
                                   ?>
                                  <tr>
                                      <td><?=$i; ?></td>
                                      <td><?=$tag_data['tag']; ?></td>
                                      <td><a href="index.php?tag_delete=<?=$tag_data['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <hr>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                  	<form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>Add New Cast</h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Name:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="name" required="">
                                  <span class="invalid-feedback">What's the name of the cast?</span>
                              </div>
                          </div>
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Role:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="role" required="">
                                  <span class="invalid-feedback">What is the cast's role?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                <input type="hidden" name="movie_id" value="<?=$movie_data['id']; ?>">
                                <input class="btn btn-primary" type="submit" name="cast_insert" value="Add Cast">
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>              
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                      <div class="card-header">
                          <h4>Casts</h4>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                  </tr>                                  
                                </thead>

                                <tbody>                                
                                  <?php 
                                    $cast_query = $cast->getAll($movie_data['id']);
                                    
                                    if(mysqli_num_rows($cast_query) < 1)
                                    {
                                  ?>
                                    <tr>
                                      <td colspan="4">No cast added yet!</td>
                                    </tr>
                                  <?php
                                    }
                                    $i = 0;
                                    while($cast_data = mysqli_fetch_assoc($cast_query)){
                                      $i += 1;
                                   ?>
                                  <tr>
                                      <td><?=$i; ?></td>
                                      <td><?=$cast_data['name']; ?></td>
                                      <td><?=$cast_data['role']; ?></td>
                                      <td><a href="index.php?cast_delete=<?=$cast_data['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <hr>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                  	<form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>Add New Crew Member</h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Name:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="name" required="">
                                  <span class="invalid-feedback">What's the name of the crew memeber?</span>
                              </div>
                          </div>
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Role:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="role" required="">
                                  <span class="invalid-feedback">Whats is the role of the crew member?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group mb-4">
                              <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                                <input type="hidden" name="movie_id" value="<?=$movie_data['id']; ?>">
                                <input class="btn btn-primary" type="submit" name="crew_insert" value="Add Crew Member">
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>              
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                      <div class="card-header">
                          <h4>Crew Members</h4>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                  </tr>                                  
                                </thead>

                                <tbody>                                
                                  <?php 
                                    $crew_query = $crew->getAll($movie_data['id']);

                                    if(mysqli_num_rows($crew_query) < 1)
                                    {
                                  ?>
                                    <tr>
                                      <td colspan="4">No crew member added yet!</td>
                                    </tr>
                                  <?php
                                    }
                                    $i = 0;
                                    while($crew_data = mysqli_fetch_assoc($crew_query)){
                                      $i += 1;
                                   ?>
                                  <tr>
                                      <td><?=$i; ?></td>
                                      <td><?=$crew_data['name']; ?></td>
                                      <td><?=$crew_data['role']; ?></td>
                                      <td><a href="index.php?crew_delete=<?=$crew_data['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </section>