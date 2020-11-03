<?php 
	class Booking extends DBConfig {
		public function getAll() {
			return $this->makeQuery("SELECT * FROM bookings ORDER BY 1 DESC");
		}
		public function getUserBookings() {
			$customer_id = $this->getUserId();
			return $this->makeQuery("SELECT * FROM movies WHERE id IN (SELECT movie_id FROM bookings WHERE customer_id='$customer_id')");
		}

		public function getBookingStatus($movie_id) {
			$customer_id = $this->getUserId();
			$booking_query = $this->makeQuery("SELECT status FROM bookings WHERE customer_id='$customer_id' AND movie_id='$movie_id'");
			// print_r($booking_query);
			$booking_data = mysqli_fetch_assoc($booking_query);
			return $booking_data['status'];
		}

		public function displayRefNumber($movie_id) {
			$customer_id = $this->getUserId();
			$booking_query = $this->makeQuery("SELECT ref_number FROM bookings WHERE customer_id='$customer_id' AND movie_id='$movie_id'");
			// print_r($booking_query);
			$booking_data = mysqli_fetch_assoc($booking_query);
			return $booking_data['ref_number'];
		}

		public function getRefNumber() {
			$last_id_q = $this->makeQuery("SHOW TABLE STATUS WHERE Name = 'bookings'");
      $id = mysqli_fetch_assoc($last_id_q);
      $next_req_id = $id['Auto_increment'];
      $today = date('dm');

      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $random_string = '';

      for($i = 0; $i < 3; $i++)
      {
        $index = rand(0, strlen($characters) - 1);
        $random_string .= $characters[$index];
      }
      $ref_number = '#'.$random_string.$today.'-'.$next_req_id;
      return $ref_number;
		}

		public function checkMovieAvailable($movie_id, $num_of_seats) {
			$movie_query = $this->makeQuery("SELECT num_available_seats FROM movies WHERE id='$movie_id' AND num_available_seats>0");
			if(mysqli_num_rows($movie_query))
			{
				$movie_data = mysqli_fetch_assoc($movie_query);
				$num_available_seats = $movie_data['num_available_seats'];

				if($num_of_seats > $num_available_seats)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return false;
			}
		}

		public function updateMovieSeats($movie_id, $num_of_seats) {	
			$movie_query = $this->makeQuery("SELECT num_available_seats FROM movies WHERE id='$movie_id'");
			$movie_data = mysqli_fetch_assoc($movie_query);
			$num_available_seats = $movie_data['num_available_seats'];
			$num_available_seats = $num_available_seats - $num_of_seats;
			$movie_seat_update = $this->makeQuery("UPDATE movies SET num_available_seats='$num_available_seats'");

			if($movie_seat_update)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function checkUserHasMovie($customer_id, $movie_id) {
			$booking_query = $this->makeQuery("SELECT * FROM bookings WHERE customer_id='$customer_id' AND movie_id='$movie_id'");
			if(mysqli_num_rows($booking_query) > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}


public function insert($movie_id, $num_of_seats) {
				$customer_id = $this->getUserId();
				// $staff_id = NULL;
    //     $movie_id = $_POST['movie_id'];
				// $num_of_seats = $_POST['num_of_seats'];
				$status = 'BOOKED';

				if($this->checkMovieAvailable($movie_id, $num_of_seats))
				{
					if($this->updateMovieSeats($movie_id, $num_of_seats))
					{
						if($this->checkUserHasMovie($customer_id, $movie_id))
						{
							$ref_number = $this->getRefNumber();
							$booking_insert = $this->makeQuery("INSERT INTO bookings(customer_id,movie_id,num_of_seats,status,ref_number,created_at,modified_at) VALUES ('$customer_id','$movie_id','$num_of_seats','$status','$ref_number',NOW(),NOW())");		
							if($booking_insert)
							{
								$this->setMessage('Movie booked successfully!|alert-success');
								// $this->redirect('index.php?bookings');
								return;
							}
							else
							{
								$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
								// $this->redirect('index.php?home');
								return;
							}	
						}
						else
						{
							$this->setMessage("You have already booked this movie. Please book another movie instead!|alert-danger");
							// $this->redirect('index.php?movie_single=' . $movie_id);
							return;
						}
					}
					else
					{
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
						// $this->redirect('index.php?home');
						return;
					}	
				}
				else
				{
					$this->setMessage('Sorry this movie has been fully booked. You can book another movie!|alert-danger');
					// $this->redirect('index.php?home');
					return;
				}
		}



		// public function insert() {
		// 	if(isset($_POST['booking_insert']))
		// 	{
		// 		$customer_id = $this->getUserId();
		// 		// $staff_id = NULL;
  //       $movie_id = $_POST['movie_id'];
		// 		$num_of_seats = $_POST['num_of_seats'];
		// 		$status = 'BOOKED';

		// 		if($this->checkMovieAvailable($movie_id, $num_of_seats))
		// 		{
		// 			if($this->updateMovieSeats($movie_id, $num_of_seats))
		// 			{
		// 				if($this->checkUserHasMovie($customer_id, $movie_id))
		// 				{
		// 					$ref_number = $this->getRefNumber();
		// 					$booking_insert = $this->makeQuery("INSERT INTO bookings(customer_id,movie_id,num_of_seats,status,ref_number,created_at,modified_at) VALUES ('$customer_id','$movie_id','$num_of_seats','$status','$ref_number',NOW(),NOW())");		
		// 					if($booking_insert)
		// 					{
		// 						$this->setMessage('Movie booked successfully!|alert-success');
		// 						$this->redirect('index.php?bookings');
		// 						return;
		// 					}
		// 					else
		// 					{
		// 						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
		// 					}	
		// 				}
		// 				else
		// 				{
		// 					$this->setMessage("You have already booked this movie. Please book another movie instead!|alert-danger");
		// 					$this->redirect('index.php?movie_single=' . $movie_id);
		// 					return;
		// 				}
		// 			}
		// 			else
		// 			{
		// 				$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
		// 			}	
		// 		}
		// 		else
		// 		{
		// 			$this->setMessage('Sorry this movie has been fully booked. You can book another movie!|alert-danger');
		// 		}

		// 		$this->redirect('index.php?home');
		// 		return;
		// 	}
		// }


		public function updateBookingStatus() {
			if(isset($_POST['arrived_btn']))
			{
				$staff_id = $this->getUserId();
				$booking_id = $_POST['booking_id'];
				$booking_status_update = $this->makeQuery("UPDATE bookings SET status='ARRIVED', staff_id='$staff_id', modified_at=NOW() WHERE id='$booking_id'");

				if($booking_status_update)
				{
					$this->setMessage('Booking status changed successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}	

				$this->redirect('index.php?bookings');
				return;
			}
		}

	}

	$booking = new Booking();
 ?>