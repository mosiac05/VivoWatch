<?php 
	// require_once('../config/dbconfig.php');

	class Crew extends DBConfig {

		public function getAll($movie_id) {
			return $this->makeQuery("SELECT * FROM movie_crews WHERE movie_id='$movie_id'");
		}


		public function getOne($crew_id) {
			return $this->makeQuery("SELECT * FROM movie_crews WHERE id='$crew_id'");
		}

		public function getByMovie($movie_id) {
			return $this->makeQuery("SELECT * FROM movie_crews WHERE movie_id='$movie_id'");
		}

		public function deleteOne($crew_id, $movie_id) {
			$crew_delete = $this->makeQuery("DELETE FROM movie_crews WHERE id='$crew_id'");
			if($crew_delete)
      {
      	$this->setMessage('Crew Member Removed Successfully!|alert-success');
      }
      else
      {
				$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
      }

			echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";
			return;
		}

		public function insert() {
			if(isset($_POST['crew_insert']))
			{
				$movie_id = $this->checkData($_POST['movie_id']);
				$name = $this->checkData($_POST['name']);
				$role = $this->checkData($_POST['role']);

				$crew_check = $this->makeQuery("SELECT * FROM movie_crews WHERE name='$name' AND movie_id='$movie_id'");

				if(mysqli_num_rows($crew_check) > 0)
				{
					$this->setMessage('The crew member \'' . $name . '\' has already been added to this movie!|alert-light');					
					$this->setMessage('Please add a new crew member instead.|alert-light');					
				}
				else
				{
					$crew_query = $this->makeQuery("INSERT INTO movie_crews(name,role,movie_id) VALUES ('$name','$role','$movie_id')");

					if($crew_query)
	        {
	        	$this->setMessage('Crew Member Added To Movie Successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }					
				}
				// echo "<script>alert('$crew $movie_id')</script>";
				echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";
				return;
			}
		}
	}

	$crew = new Crew();
 ?>