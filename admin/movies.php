<?php 
		include '../classes/movie.php';
 ?>
    <section class="section">
        <div class="section-header">
            <h1>All Movies</h1>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
	                <div class="card">
	                    <div class="card-header">
	                        <h4>All Movies</h4>
	                    </div>
	                    <div class="card-body">
	                        <div class="table-responsive">
	                            <table class="table table-striped v_center" id="table-2">
	                                <thead>
	                                    <tr>
	                                    <th>#</th>
	                                    <th>Title</th>
	                                    <th>Viewing Date | Time</th>
	                                    <th>Fee</th>
	                                    <th>Hall</th>
	                                    <th>Details</th>
	                                    <th>Edit</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php 
	                                		$movies = $movie->getAll();

	                                		$i = 0;
	                                		while($row = mysqli_fetch_array($movies)){
	                                			$i += 1;

	                                			$hall_id = $row['hall_id'];
	                                			$hall_query = $dbConfig->makeQuery("SELECT hall FROM halls WHERE id='$hall_id'");
	                                			$hall = mysqli_fetch_assoc($hall_query);

	                                	 ?>
	                                    <tr>
	                                    <td><?=$i; ?></td>
	                                    <td><?=$row['title'];  ?></td>
	                                    <td><?php echo date('l jS F\, Y', strtotime($row['viewing_date'])) . ' | ' . date('g:iA', strtotime($row['viewing_time']));  ?></td>
	                                    <td>$<?=$row['fee'];  ?></td>
	                                    <td><?=$hall['hall'];  ?></td>
	                                    <td><a href="index.php?movie_single=<?=$row['id'] ?>" class="btn btn-sm btn-primary"data-toggle="tooltip" data-placement="top" title="Details"><i class="fas fa-eye"></i></a></td>
	                                    <td><a href="index.php?movie_edit=<?=$row['id'] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a></td>
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