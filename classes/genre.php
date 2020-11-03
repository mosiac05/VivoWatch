<?php 
	// require_once('../config/dbconfig.php');
	
	class Genre extends DBConfig {

		public function getAll() {
			return $this->makeQuery("SELECT * FROM genres");
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM genres WHERE id = '$id'");
		}


		public function getGenreName($id) {
			$genre_query = $this->getOne($id);
			$genre_data = mysqli_fetch_assoc($genre_query);
			return $genre_data['genre'];
		}


		public function insert() {
			if(isset($_POST['genre_insert']))
			{
				$genre = $this->checkData($_POST['genre']);

				$genre_insert = $this->makeQuery("INSERT INTO genres(genre) VALUES ('$genre')");

				if($genre_insert)
				{
					$this->setMessage('Genre added successfully!|alert-success');			
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}

				echo "<script>window.open('index.php?genres', '_self')</script>";						
				return;
			}
		}


		public function update() {
			if(isset($_POST['genre_edit']))
			{
				$genre = $_POST['genre'];
				$id = $_POST['genre_id'];

				$genre_update = $this->makeQuery("UPDATE genres SET genre='$genre' WHERE id='$id'");
				if($genre_update)
				{
					$this->setMessage('Genre updated successfully!|alert-success');			
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}

				echo "<script>window.open('index.php?genres', '_self')</script>";						
				return;	
			}
		}

		public function deleteOne($id) {
				$genre_delete = $this->makeQuery("DELETE FROM genres WHERE id='$id'");
				if($genre_delete)
				{
					$this->setMessage('Genre deleted successfully!|alert-success');			
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
				}

				echo "<script>window.open('index.php?genres', '_self')</script>";						
				return;	
		}
	}

	$genre = new Genre();
 ?>