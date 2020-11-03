  <?php 
    include '../classes/genre.php';

    $genre->insert();
    $genre->update();

    if(isset($_GET['genre_edit']))
    {
      $genre_query = $genre->getOne($_GET['genre_edit']);
      $row = mysqli_fetch_assoc($genre_query);

      $genre_edit_value = $row['genre'];
      $id_edit_value = $row['id'];
    }

    if(isset($_GET['genre_delete']))
    {
      $genre->deleteOne($_GET['genre_delete']);
    }
   ?>

  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['genre_edit']))
              {
                echo "Update Genre";
              }
              else
              {
                echo "Genres";
              }
             ?>
          </h1>
      </div>

      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                  	<form class="needs-validation" novalidate="" method="post">
                      <div class="card-header">
                          <h4>
                            <?php 
                              if(isset($_GET['genre_edit']))
                              {
                                echo "Update Genre";
                              }
                              else
                              {
                                echo "Add New Genre";
                              }
                             ?>
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Genre:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="genre" value="<?php echo $genre_edit_value ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What genre?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                              <?php 
                                  if(!isset($_GET['genre_edit']))
                                  {
                                 ?>
                                <input type="submit" name="genre_insert" value="Submit" class="btn btn-primary">
                              <?php
                                  }
                                  else
                                  {
                              ?>
                                <input type="hidden" name="genre_id" value="<?=$id_edit_value; ?>">
                                <input type="submit" name="genre_edit" value="Update" class="btn btn-primary">
                              <?php
                                  }
                              ?>
                              </div>
                          </div>
                      </div>
                     </form>
                  </div>
              </div>              
              <div class="col-12 col-md-6 col-lg-6">
                  <div class="card">
                      <div class="card-header">
                          <h4>All Movie Genres</h4>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Genre</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php
                                $i = 0;                               
                                $genre_query = $genre->getAll();
                                while($row = mysqli_fetch_assoc($genre_query)){
                                  $i += 1;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$row['genre']; ?></td>
                                  <td><a href="index.php?genre_edit=<?=$row['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td><a href="index.php?genre_delete=<?=$row['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a></td>
                              </tr>
                            <?php } ?>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
