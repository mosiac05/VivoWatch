<?php 
	// require_once('../config/dbconfig.php');
	
	class Hall extends DBConfig {

		public function getAll() {
			$hall_query = $this->makeQuery("SELECT * FROM halls");
			return $hall_query;
		}

		public function getOne($id) {
			$hall_query = $this->makeQuery("SELECT * FROM halls WHERE id='$id'");
			return $hall_query;
		}


		public function insert() {
			if(isset($_POST['hall_insert']))
			{
				$hall = $this->checkData($_POST['hall']);
				$num_of_seats = $this->checkData($_POST['num_of_seats']);

				$hall_insert = $this->makeQuery("INSERT INTO halls(hall,num_of_seats) VALUES ('$hall','$num_of_seats')");

				if($hall_insert)
				{
					$this->setMessage('Hall added successfully!|alert-success');			
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}

				echo "<script>window.open('index.php?halls', '_self')</script>";						
				return;
			}
		}


		public function update() {
			if(isset($_POST['hall_edit']))
			{
				$hall = $this->checkData($_POST['hall']);
				$num_of_seats = $this->checkData($_POST['num_of_seats']);
				$id = $_POST['hall_id'];

				$hall_update = $this->makeQuery("UPDATE halls SET hall='$hall', num_of_seats='$num_of_seats' WHERE id='$id'");
				if($hall_update)
				{
					$this->setMessage('Hall updated successfully!|alert-success');			
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}

				echo "<script>window.open('index.php?halls', '_self')</script>";						
				return;	
			}
		}

		public function deleteOne($id) {
				$hall_delete = $this->makeQuery("DELETE FROM halls WHERE id='$id'");
				if($hall_delete)
				{
					$this->setMessage('Hall deleted successfully!|alert-success');			
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}

				echo "<script>window.open('index.php?halls', '_self')</script>";						
				return;	
		}
	}

	$hall = new Hall();
 ?>