  <?php
    $dbConfig->unauthorizedRedirect();
    include '../classes/hall.php';

    $hall->insert();
    $hall->update();

    if(isset($_GET['hall_edit']))
    {
      $hall_query = $hall->getOne($_GET['hall_edit']);
      $row = mysqli_fetch_assoc($hall_query);

      $hall_edit_value = $row['hall'];
      $seat_edit_value = $row['num_of_seats'];
      $id_edit_value = $row['id'];
    }

    if(isset($_GET['hall_delete']))
    {
      $hall->deleteOne($_GET['hall_delete']);
    }
   ?>

  <section class="section">
      <div class="section-header">
          <h1>
            <?php 
              if(isset($_GET['hall_edit']))
              {
                echo "Update Hall";
              }
              else
              {
                echo "Halls";
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
                              if(isset($_GET['hall_edit']))
                              {
                                echo "Update Hall";
                              }
                              else
                              {
                                echo "Add New Hall";
                              }
                             ?>
                          </h4>
                      </div>
                      <div class="card-body">
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Hall:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="text" class="form-control" name="hall" value="<?php echo $hall_edit_value ?? ''; ?>" required="">
                                  <span class="invalid-feedback">What's the name of the hall?</span>
                              </div>
                          </div>
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3">Number of Seats:</label>
                              <div class="col-sm-12 col-md-12">
                                  <input type="number" min="1" class="form-control" name="num_of_seats" value="<?php echo $seat_edit_value ?? ''; ?>" required="">
                                  <span class="invalid-feedback">How many seats are in the hall?</span>
                              </div>
                          </div>
                          <hr>
                          <div class="form-group mb-5">
                              <label class="col-form-label col-12 col-md-3 col-lg-3"></label>
                              <div class="col-sm-12 col-md-12 text-md-center">
                              <?php 
                                  if(!isset($_GET['hall_edit']))
                                  {
                                 ?>
                                <input type="submit" name="hall_insert" value="Submit" class="btn btn-primary">
                              <?php
                                  }
                                  else
                                  {
                              ?>
                                <input type="hidden" name="hall_id" value="<?=$id_edit_value; ?>">
                                <input type="submit" name="hall_edit" value="Update" class="btn btn-primary">
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
                          <h4>All Movie halls</h4>
                      </div>
                      <div class="card-body p-0">
                          <div class="table-responsive">
                              <table class="table table-striped table-md v_center">
                              <tr>
                                  <th>#</th>
                                  <th>Hall</th>
                                  <th>No. of Seats</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                              <?php
                                $i = 0;                               
                                $hall_query = $hall->getAll();
                                while($row = mysqli_fetch_assoc($hall_query)){
                                  $i += 1;
                               ?>
                              <tr>
                                  <td><?=$i; ?></td>
                                  <td><?=$row['hall']; ?></td>
                                  <td><?=$row['num_of_seats']; ?></td>
                                  <td><a href="index.php?hall_edit=<?=$row['id']; ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
                                  <td><a href="index.php?hall_delete=<?=$row['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a></td>
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
