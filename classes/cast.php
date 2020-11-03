<?php 
	// require_once('../config/dbconfig.php');

	class Cast extends DBConfig {

		public function getAll($movie_id) {
			return $this->makeQuery("SELECT * FROM movie_casts WHERE movie_id='$movie_id'");
		}


		public function getOne($cast_id) {
			return $this->makeQuery("SELECT * FROM movie_casts WHERE id='$cast_id'");
		}


		public function getByMovie($movie_id) {
			return $this->makeQuery("SELECT * FROM movie_casts WHERE movie_id='$movie_id'");
		}


		public function deleteOne($cast_id, $movie_id) {
			$cast_delete = $this->makeQuery("DELETE FROM movie_casts WHERE id='$cast_id'");
			if($cast_delete)
      {
      	$this->setMessage('Cast Removed Successfully!|alert-success');
      }
      else
      {
				$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
      }

			echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";
			return;
		}

		public function insert() {
			if(isset($_POST['cast_insert']))
			{
				$movie_id = $this->checkData($_POST['movie_id']);
				$name = $this->checkData($_POST['name']);
				$role = $this->checkData($_POST['role']);

				$cast_check = $this->makeQuery("SELECT * FROM movie_casts WHERE name='$name' AND movie_id='$movie_id'");

				if(mysqli_num_rows($cast_check) > 0)
				{
					$this->setMessage('The cast \'' . $name . '\' has already been added to this movie!|alert-light');					
					$this->setMessage('Please add a new cast instead.|alert-light');					
				}
				else
				{
					$cast_query = $this->makeQuery("INSERT INTO movie_casts(name,role,movie_id) VALUES ('$name','$role','$movie_id')");

					if($cast_query)
	        {
	        	$this->setMessage('Cast Added To Movie Successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }					
				}
				// echo "<script>alert('$cast $movie_id')</script>";
				echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";
				return;
			}
		}
	}

	$cast = new Cast();
 ?>