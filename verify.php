<?php
//check if request was made with the right data
if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){  
  die("Transaction reference not found");
}

//set reference to a variable @ref
$reference = $_POST['reference'];
$customer_id = $_POST['customer_id'];
$movie_id = $_POST['movie_id'];
$num_of_seats = $_POST['num_of_seats'];

//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$reference;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_d03ab0fcb14e591c7a10f18a5b94e011293ffed8']
);

//send request
$request = curl_exec($ch);
//close connection
curl_close($ch);
//declare an array that will contain the result 
$result = array();

if ($request) {
  $result = json_decode($request, true);
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

	// DB Connection
	$connection = mysqli_connect('localhost', 'root', '', 'movie_booking');
	if(mysqli_connect_error()){
		die("Connect failed");
	}
	// Update movie seats
	$movie_seat_query = mysqli_query($connection, "SELECT num_available_seats FROM movies WHERE id='$movie_id'");
	$movie_data = mysqli_fetch_assoc($movie_seat_query);
	$num_available_seats = $movie_data['num_available_seats'];
	$num_available_seats = $num_available_seats - $num_of_seats;
	$movie_seat_update = mysqli_query($connection, "UPDATE movies SET num_available_seats='$num_available_seats'");


	// Get ref_number
	$last_id_q = mysqli_query($connection, "SHOW TABLE STATUS WHERE Name = 'bookings'");
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
  $status = 'BOOKED';

  mysqli_query($connection, "INSERT INTO bookings(customer_id,movie_id,num_of_seats,status,ref_number,created_at,modified_at) VALUES ('$customer_id','$movie_id','$num_of_seats','$status','$ref_number',NOW(),NOW())");
  echo "success";
	//Perform necessary action
}else{
  echo "Transaction was unsuccessful";
}