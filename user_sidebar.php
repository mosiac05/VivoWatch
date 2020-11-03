<div class="col-md-3 col-sm-12 col-xs-12">
	<div class="user-information">
		<div class="user-img">
			<a href="#"><img style="border-radius: 100% !important;" src="images/user_images/<?=$user_data['profile_photo']; ?>" alt="<?=$user_data['profile_photo']; ?>" width="100"><br></a>
			<a href="#" class="redbtn">Change avatar</a>
		</div>
		<div class="user-fav">
			<p>Account Details</p>
			<ul>
				<li  class="<?php if(isset($_GET['profile'])) { echo 'active'; } ?>"><a href="index.php?profile">Profile</a></li>
				<li class="<?php if(isset($_GET['bookings'])) { echo 'active'; } ?>"><a href="index.php?bookings">My Bookings</a></li>
			</ul>
		</div>
		<div class="user-fav">
			<p>Others</p>
			<ul>
				<li><a href="index.php?logout">Log out</a></li>
			</ul>
		</div>
	</div>
</div>