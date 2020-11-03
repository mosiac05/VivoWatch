<footer class="ht-footer">
	<div class="container">
		<div class="flex-parent-ft">
			<div class="flex-child-ft item1">
				 <a href="index-2.html"><img class="logo" src="images/logo1.png" alt=""></a>
				 <p>5th Avenue st, Tanke<br>
				Ilorin, Kwara State</p>
				<p>Call us: <a href="#">(+234) 802 342 6789</a></p>
			</div>
			<div class="flex-child-ft item2">
				<h4>Resources</h4>
				<ul>
					<li><a href="index.php">Home</a></li> 
					<li><a href="index.php?movies">Movies</a></li>
					<?php if (!isset($_SESSION['user_email'])): ?>
						<li><a href="#" class="signupLink">SignUp</a></li>
						<li><a href="#" class="loginLink">Login</a></li>
					<?php endif ?>
				</ul>
			</div>
			<div class="flex-child-ft item3">
				<h4>Legal</h4>
				<ul>
					<li><a href="#">Terms of Use</a></li> 
					<li><a href="#">Privacy Policy</a></li>	
					<li><a href="#">Security</a></li>
				</ul>
			</div>
			<div class="flex-child-ft item4">
				<h4>My Account</h4>
				<ul>
					<?php if (!isset($_SESSION['user_email'])): ?>
						<li><a href="#" class="loginLink">Profile</a></li> 
						<li><a href="#" class="loginLink">My Bookings</a></li>
					<?php else: ?>
            <?php if ($dbConfig->checkUserIsStaff()): ?>
                <li><a href="admin/index.php">Dashboard</a></li>
            <?php endif ?>
						<li><a href="index.php?profile">Profile</a></li> 
						<li><a href="index.php?bookings">My Bookings</a></li>	
					<?php endif ?>
				</ul>
			</div>
			<div class="flex-child-ft item5">
				<h4>Newsletter</h4>
				<p>Subscribe to our newsletter system now <br> to get latest news from us.</p>
				<form action="#">
					<input type="text" placeholder="Enter your email...">
				</form>
				<a href="#" class="btn">Subscribe now <i class="ion-ios-arrow-forward"></i></a>
			</div>
		</div>
	</div>
	<div class="ft-copyright">
		<div class="ft-left">
			<p><a target="_blank" href="index.php">Vivo Watch</a></p>
		</div>
		<div class="backtotop">
			<p><a href="#" id="back-to-top">Back to top  <i class="ion-ios-arrow-thin-up"></i></a></p>
		</div>
	</div>
</footer>