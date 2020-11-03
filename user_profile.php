<?php
	// if(!isset($_GET['profile']) || ($_GET['profile'] == '') || (mysqli_num_rows($user->getOne($_GET['profile'])) < 1))
	// {
	// 	$dbConfig->errorRedirect();
	// }

	$user_id = $dbConfig->getUserId();
	$user_query = $user->getOne($user_id);

	if(mysqli_num_rows($user_query) < 1)
	{
		$auth->logout();
	}

	$user_data = mysqli_fetch_assoc($user_query);


	$redirect_link = 'index.php?profile=' . $_GET['profile'];
	$user->update($redirect_link);
	$user->updatePassword($redirect_link);
 ?>

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1><?=$dbConfig->getUserFullName(); ?>’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
		<div class="buster-light">
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<?php 
				include 'user_sidebar.php';
			 ?>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="row">
					<?php 
						include 'messages.php';
					 ?>
				</div>
				<div class="form-style-1 user-pro" action="#">
					<form action="" class="user" method="post">
						<h4>01. Profile details</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Username</label>
								<input type="text" name="username" placeholder="<?=$user_data['username']; ?>" required="required">
							</div>
							<div class="col-md-6 form-it">
								<label>Email Address</label>
								<input type="email" name="email" placeholder="<?=$user_data['email']; ?>" required="required">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>First Name</label>
								<input type="text" name="first_name" placeholder="<?=$user_data['first_name']; ?>" required="required">
							</div>
							<div class="col-md-6 form-it">
								<label>Last Name</label>
								<input type="text" name="last_name" placeholder="<?=$user_data['last_name']; ?>" required="required">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input type="hidden" value="<?=$user_data['id']; ?>" name="user_id">
								<input class="submit" type="submit" name="user_edit" value="save">
							</div>
						</div>	
					</form>
					<form action="" class="password" method="post">
						<h4>02. Change password</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Old Password</label>
								<input type="password" name="old_password" placeholder="Enter your current password..." required="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>New Password</label>
								<input type="password" name="new_password" placeholder="Enter the new password..." required="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Confirm New Password</label>
								<input type="password" name="confirm_password" placeholder="Type new password to confirm..." required="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" name="password_update" value="change">
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
		</div>
<!-- footer section-->
<?php 
	require_once './includes/footer.php';
 ?>
<!-- end of footer section-->

<?php 
	require_once './includes/js.php';
 ?>