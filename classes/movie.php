<?php
	// require_once('../config/dbconfig.php');

	class Movie extends DBConfig {
		private $per_page = 12;
		private $page_no;

		public function getAll() {
			$movie_limit = $this->getMovieLimit();
			return $this->makeQuery("SELECT * FROM movies ORDER BY 1 DESC LIMIT $movie_limit, $this->per_page");
		}

		public function getNumberOfMovies() {
			$movie_query = $this->makeQuery("SELECT * FROM movies");
			$num_of_movies = mysqli_num_rows($movie_query);
			return ceil($num_of_movies / $this->per_page);
		}

		public function getMovieLimit() {
			if(empty($this->page_no) || $this->page_no <= 1){
				$movie_limit = 0;
			}
			else{
				$movie_limit = ($this->page_no * $this->per_page) - $this->per_page;
			}
			return $movie_limit;
		}

		public function setPageNumber($page_no) {
			$this->page_no = $page_no;
		}

		public function getPageNumber() {
			return $this->page_no;
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM movies WHERE id='$id'");
		}

		public function getByTag($tag) {
			return $this->makeQuery("SELECT * FROM movies WHERE id IN (SELECT movie_id FROM movie_tags WHERE tag = '$tag')");
		}

		public function getMovieWithLimit($limit) {
			return $this->makeQuery("SELECT * FROM movies ORDER BY RAND() LIMIT $limit");
		}


		public function getNameInitials($name) {
			$space_index = strpos($name, ' ');
			if(!$space_index) {
				$space_index = 0;
			}
			else {
				$space_index += 1;
			}
			$name_array = str_split($name);
			return strtoupper($name_array[0] . $name_array[$space_index]);
		}

		public function getRelatedMovies($genre_id, $plot_keywords, $movie_id) {
			return $this->makeQuery("SELECT * FROM movies WHERE genre_id='$genre_id' OR plot_keywords like('%$plot_keywords%') ORDER BY RAND() LIMIT 5");
		}

		public function searchMovies($title, $genre_id, $release_date) {
			return $this->makeQuery("SELECT * FROM movies WHERE genre_id='$genre_id' OR title like('%$title%') OR release_date like('%$release_date%') ORDER BY 1 DESC");			
		}

		public function getPlotKeywords($plot_keywords) {
			$plot_keywords_array = strstr($plot_keywords, ', ');
			return $plot_keywords;
		}


		public function getMovieTitle($movie_id) {
			$movie_query = $this->makeQuery("SELECT title FROM movies WHERE id='$movie_id'");
			$movie_data = mysqli_fetch_assoc($movie_query);
			return $movie_data['title'];
		}

		public function insert() {
			if(isset($_POST['movie_insert']))
			{
				$title = $this->checkData($_POST['title']);
				$release_date = $this->checkData($_POST['release_date']);
				$trailer_link = $this->checkData($_POST['trailer_link']);
				// $image = $this->checkData($_POST['image']);
				$description = $this->checkData($_POST['description']);
				$director = $this->checkData($_POST['director']);
				$writer = $this->checkData($_POST['writer']);
				$stars = $this->checkData($_POST['stars']);
				$run_time = $this->checkData($_POST['run_time']);
				$viewing_date = $this->checkData($_POST['viewing_date']);
				$viewing_time = $this->checkData($_POST['viewing_time']);
				$fee = $this->checkData($_POST['fee']);
				$pg_rating = $this->checkData($_POST['pg_rating']);
				$plot_keywords = $this->checkData($_POST['plot_keywords']);
				$genre_id = $this->checkData($_POST['genre_id']);
				$hall_id = $this->checkData($_POST['hall_id']);

				$num_available_seats = $this->checkData($_POST['num_available_seats']);
				if(empty($num_available_seats))
				{
					$hall_query = $this->makeQuery("SELECT num_of_seats FROM halls WHERE id='$hall_id'");
					$row = mysqli_fetch_assoc($hall_query);

					$num_available_seats = $row['num_of_seats'];
				}
				$user_id = $this->getUserId();

        $image = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(($image != '') || (in_array($extension, $accepted_extensions)))
        {
	        move_uploaded_file($temp_name,"../images/movie_images/$image");

	        $movie_insert = $this->makeQuery("INSERT INTO movies(title,release_date,trailer_link,image,description,director,writer,stars,run_time,viewing_date,viewing_time,fee,num_available_seats,pg_rating,plot_keywords,genre_id,user_id,hall_id,created_at,modified_at) VALUES ('$title','$release_date','$trailer_link','$image','$description','$director','$writer','$stars','$run_time','$viewing_date','$viewing_time','$fee','$num_available_seats','$pg_rating','$plot_keywords','$genre_id','$user_id','$hall_id',NOW(),NOW())");

	        if($movie_insert)
	        {
	        	$this->setMessage('Movie added successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }
        }
        else
        {
        	$this->setMessage('Select an image. Only JPG, JPEG, PNG are files allowed!|alert-light');

					echo "<script>window.open('index.php?movie_create', '_self')</script>";						
					return;
        }

				echo "<script>window.open('index.php?movies', '_self')</script>";						
				return;
			}
		}


		public function update() {
			if(isset($_POST['movie_edit']))
			{
				$movie_id = $this->checkData($_POST['movie_id']);
				$title = $this->checkData($_POST['title']);
				$release_date = $this->checkData($_POST['release_date']);
				$trailer_link = $this->checkData($_POST['trailer_link']);
				$description = $this->checkData($_POST['description']);
				$director = $this->checkData($_POST['director']);
				$writer = $this->checkData($_POST['writer']);
				$stars = $this->checkData($_POST['stars']);
				$run_time = $this->checkData($_POST['run_time']);
				$viewing_date = $this->checkData($_POST['viewing_date']);
				$viewing_time = $this->checkData($_POST['viewing_time']);
				$fee = $this->checkData($_POST['fee']);
				$pg_rating = $this->checkData($_POST['pg_rating']);
				$plot_keywords = $this->checkData($_POST['plot_keywords']);
				$genre_id = $this->checkData($_POST['genre_id']);
				$hall_id = $this->checkData($_POST['hall_id']);

				$num_available_seats = $this->checkData($_POST['num_available_seats']);
				if(empty($num_available_seats))
				{
					$hall_query = $this->makeQuery("SELECT num_of_seats FROM halls WHERE id='$hall_id'");
					$row = mysqli_fetch_assoc($hall_query);

					$num_available_seats = $row['num_of_seats'];
				}
				$user_id = $this->getUserId();

        $image = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(($image != '') || (in_array($extension, $accepted_extensions)))
        {
	        move_uploaded_file($temp_name,"../images/movie_images/$image");

	        $movie_update = $this->makeQuery("UPDATE `movies` SET `title`='$title', `release_date`='$release_date', `trailer_link`='$trailer_link', `image`='$image', `description`='$description', `director`='$director', `writer`='$writer', `stars`='$stars', `run_time`='$run_time', `viewing_date`='$viewing_date', `viewing_time`='$viewing_time', `fee`='$fee', `num_available_seats`='$num_available_seats', `pg_rating`='$pg_rating', `plot_keywords`='$plot_keywords', `genre_id`='$genre_id', `hall_id`='$hall_id', `modified_at`=NOW() WHERE id='$movie_id'");

	        if($movie_update)
	        {
	        	$this->setMessage('Movie Updated successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }
        }
        else
        {
        	$this->setMessage('Select an image. Only JPG, JPEG, PNG are files allowed!|alert-light');

					echo "<script>window.open('index.php?movie_edit=$movie_id', '_self')</script>";						
					return;
        }

				echo "<script>window.open('index.php?movie_single=$movie_id', '_self')</script>";						
				return;
			}
		}


		public function deleteOne($id) {
			$tag_query = $this->makeQuery("DELETE FROM movie_tags WHERE movie_id='$id'");
			$cast_query = $this->makeQuery("DELETE FROM movie_casts WHERE movie_id='$id'");
			$crew_query = $this->makeQuery("DELETE FROM movie_crews WHERE movie_id='$id'");

			if($tag_query && $cast_query && $crew_query)
      {
      	$movie_delete = $this->makeQuery("DELETE FROM movies WHERE id='$id'");
      	if($movie_delete)
	      {
	      	$this->setMessage('Movie Deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }
      }
      else
      {
				$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
      }

      echo "<script>window.open('index.php?movies', '_self')</script>";						
			return;
		}
	}

	$movie = new Movie();
 ?>