<header class="ht-header">
	<div class="container">
		<nav class="navbar navbar-default navbar-custom">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header logo">
				    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					    <span class="sr-only">Toggle navigation</span>
					    <div id="nav-icon1">
							<span></span>
							<span></span>
							<span></span>
						</div>
				    </div>
				    <a href="index_light.html"><img class="logo" src="images/logo1.png" alt="" width="119" height="58"></a>
			    </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav flex-child-menu menu-left">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li><a href="index.php">Home</a></li>
						<li><a href="index.php?movies">Movies</a></li>
						<li class="dropdown first">
                            <?php if (!isset($_SESSION['user_email'])): ?>
                                <a class="btn btn-default lv1 loginLink">
                                    My Account
                                </a>
                            <?php else: ?>
                                <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                                    My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu level1">
                                    <li><a href="index.php?profile">Profile</a></li>
                                    <li><a href="index.php?bookings">My Bookings</a></li>
                                    <!-- <li><a href="index.php?favorite_movies">My Favorite Movies</a></li> -->
                                    <!-- <li class="it-last"><a href="userrate_light.html">user rate</a></li> -->
                                </ul>
                            <?php endif ?>
						</li>
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
						<!-- <li><a href="#">Help</a></li> -->
                        <?php if (!isset($_SESSION['user_email'])): ?>
                            <li class="loginLink"><a href="#">LOG In</a></li>
                            <li class="btn signupLink"><a href="#">sign up</a></li>
                        <?php else: ?>
                            <?php if ($dbConfig->checkUserIsStaff()): ?>
                                <li><a href="admin/index.php">Dashboard</a></li>
                            <?php endif ?>
                            <li class="btn"><a href="index.php?logout">Logout</a></li>
                        <?php endif ?>
					</ul>
				</div>
			<!-- /.navbar-collapse -->
	    </nav>
	    
	    <!-- top search form -->
	    <!-- <form action="index.php?search" method="get">
		    <div class="top-search">
                <input type="hidden" name="search">
                <input type="hidden" name="genre_id">
                <input type="hidden" name="release_date">
				<input type="text" name="title" placeholder="Search for a movie" required="">
				<br>	    		
	    		<input type="submit" name="" value=" ">		    
	    	</div>
	    </form> -->
	</div>
</header>

	<!--login form popup-->
<div class="login-wrapper" id="login-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Login</h3>
        <form method="post">
        	<div class="row">
        		 <label for="username">
                    Email:
                    <input type="email" name="email" placeholder="Enter your email..." required="required" />
                </label>
        	</div>
           
            <div class="row">
            	<label for="password">
                    Password:
                    <input type="password" name="password" placeholder="Enter your password" required="required" />
                </label>
            </div>
            <div class="row">
            	<div class="remember">
					<div>
						<input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
					</div>
            		<a href="#">Forgot password ?</a>
            	</div>
            </div>
           <div class="row">
           	 <button type="submit" name="login_btn">Login</button>
           </div>
        </form>
<!--         <div class="row">
        	<p>Or via social</p>
            <div class="social-btn-2">
            	<a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
            	<a class="tw" href="#"><i class="ion-social-twitter"></i>twitter</a>
            </div>
        </div> -->
    </div>
</div>
<!--end of login form popup-->
<!--signup form popup-->
<div class="login-wrapper"  id="signup-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form method="post">
            <div class="row">
                 <label for="username-2">
                    FullName:
                    <input type="text" name="first_name" placeholder="Enter your first name..." required="required" />
                    <input type="text" name="last_name" placeholder="Enter your last name..." required="required" />
                </label>
            </div>

            <div class="row">
                 <label for="username-2">
                    Username:
                    <input type="text" name="username" placeholder="Enter a username..." required="required" />
                </label>
            </div>
           
            <div class="row">
                <label for="email-2">
                    your email:
                    <input type="email" name="email" placeholder="Type your email address..." required="required" />
                </label>
            </div>
             <div class="row">
                <label for="password-2">
                    Password:
                    <input type="password" name="password" placeholder="Choose your password..." required="required" />
                </label>
            </div>
             <div class="row">
                <label for="repassword-2">
                    re-type Password:
                    <input type="password" name="confirm_password" placeholder="...and type it again to confirm" required="required" />
                </label>
            </div>
           <div class="row">
             <button type="submit" name="user_insert">sign up</button>
           </div>
        </form>
    </div>
</div>
<!--end of signup form popup-->
