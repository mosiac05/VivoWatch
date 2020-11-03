<?php 
	// require_once('../config/dbconfig.php');

	class Tag extends DBConfig {

		public function getAll($movie_id) {
			return $this->makeQuery("SELECT * FROM movie_tags WHERE movie_id='$movie_id'");
		}


		public function getOne($tag_id) {
			return $this->makeQuery("SELECT * FROM movie_tags WHERE id='$tag_id'");
		}


		public function deleteOne($tag_id, $movie_id) {
			$tag_delete = $this->makeQuery("DELETE FROM movie_tags WHERE id='$tag_id'");
			if($tag_delete)
      {
      	$this->setMessage('Tag Removed Successfully!|alert-success');
      }
      else
      {
				$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
      }

			echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";
			return;
		}

		public function insert() {
			if(isset($_POST['tag_insert']))
			{
				$movie_id = $this->checkData($_POST['movie_id']);
				$tag = $this->checkData($_POST['tag']);

				$tag_check = $this->makeQuery("SELECT * FROM movie_tags WHERE tag='$tag' AND movie_id='$movie_id'");

				if(mysqli_num_rows($tag_check) > 0)
				{
					$this->setMessage('The tag \'' . $tag . '\' has already been added to this movie!|alert-light');					
					$this->setMessage('Please select a different tag.|alert-light');					
				}
				else
				{
					$tag_query = $this->makeQuery("INSERT INTO movie_tags(tag,movie_id) VALUES ('$tag','$movie_id')");

					if($tag_query)
	        {
	        	$this->setMessage('Tag Added To Movie successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }					
				}
				// echo "<script>alert('$tag $movie_id')</script>";
				echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";
				return;
			}
		}
	}

	$tag = new Tag();
 ?>