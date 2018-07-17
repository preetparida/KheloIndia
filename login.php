<?php 
require_once ("methods/init.php");
require_once ("methods/session.php");

if(isset($_POST['sub'])){
	

	$username = $database->escape_string($_POST['username']);
	$password = $database->escape_string($_POST['password']);

	$user = Users::verify_user($username,$password);

	if ($user) {

		$session->login($user);

		if ($session->is_signed_in()) {
			
			if($user->ROLE == 'RETAILER'){
                                header("location:dashboard.php");
			}
		}
		else{
			$error_msg = "please check details";
		}
	}
	else{
		$error_msg = "Please check the information and try again.";
	}
}
else {
	$error_msg = "";
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

     
    <div class="container">
        <div class="card card-container">
            <span style="margin-left: 0px;color:red;"><?php echo $error_msg; ?></span>
            
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="login.php" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputUsername" class="form-control" name="username" placeholder="User Name" required autofocus>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <input type="submit" name="sub" value="Sign in" class="btn btn-lg btn-primary btn-block btn-signin">
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container --> 
    
    <?php require_once("style.php"); ?>
         
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
  
    
 <script>
  $( document ).ready(function() {
    // DOM ready

    // Load profile if it exits
    loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback){
    var profileImgSrc      = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName        = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if(profileName !== null
            && profileReAuthEmail !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src",profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("PROFILE_IMG_SRC", "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" );
    localStorage.setItem("PROFILE_NAME", "César Izquierdo Tello");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "oneaccount@gmail.com");
}
</script>
    
  </body>
</html>
