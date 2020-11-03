<?php 
	include '../classes/booking.php';
	include '../classes/user.php';
	include '../classes/movie.php';

	$booking->updateBookingStatus();
 ?>
    <section class="section">
        <div class="section-header">
            <h1>All Bookings</h1>
        </div>
        <div class="section-body">        	
	        <div class="row">
	            <div class="col-12">
	                <div class="card">
	                    <div class="card-header">
	                        <h4>All Bookings</h4>
	                    </div>
	                    <div class="card-body">
	                        <div class="table-responsive">
                            <table class="table table-striped v_center" id="table-2">
                              <thead>
                                  <tr>
                                  <th>Ref. No.</th>
                                  <th>Customer Name</th>
                                  <th>Movie Title</th>
                                  <th>No. of Seats</th>
                                  <th>Status</th>
                                  <th>Created At</th>
                                  <th>Modified At</th>
                                  </tr>
                              </thead>
                              <tbody>
                              	<?php 
                              		$booking_query = $booking->getAll();

                              		while($booking_data = mysqli_fetch_assoc($booking_query)){
                              			$customer_name = $user->getUserName($booking_data['customer_id']);
                              			$movie_title = $movie->getMovieTitle($booking_data['movie_id']);

                              	 ?>
                                <tr>
                                  <td><?=$booking_data['ref_number']; ?></td>
                                  <td><?=$customer_name; ?></td>
                                  <td><?=$movie_title; ?></td>
                                  <td><?=$booking_data['num_of_seats']; ?></td>
                                  <td>                                  	
	                                  <?php 
	                                  	switch ($booking_data['status']) {
	                                  		case 'BOOKED':
	                                  			$booking_id = $booking_data['id'];
	                                  			echo "<form method='post' action=''>
	                                  							<input type='hidden' name='booking_id' value='$booking_id'>
	                                  							<button type='submit' name='arrived_btn' class='badge badge-warning' data-toggle='tooltip' data-placement='top' title='Change to Arrived'>Booked</button>
	                                  						</form>";
	                                  			break;
	                                  		case 'ARRIVED':
	                                  			echo "<div class='badge badge-success'>Arrived</div>";
	                                  			break;
	                                  		case 'CLOSED':
	                                  			echo "<div class='badge badge-danger'>Closed</div>";
	                                  			break;
	                                  	}
	                                   ?>
                                  </td>
                                  <td><?=$booking_data['created_at']; ?></td>
                                  <td><?=$booking_data['modified_at']; ?></td>
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