<?php
	session_start();

	include_once("lib/mysql_lib.php");
	include_once("lib/system_security_lib.php");

	if ( isset($_POST['login-submit']) ) {
		$system_users_login = $_POST['login'];
		# $system_users_password = sha1( $_POST['password'] );
		$system_users_password = $_POST['password'];

		#$query = runSmallQuery( 
		#	"SELECT * FROM `system_users_tbl` WHERE 
		#	`system_users_login`='" . $system_users_login . "' AND 
		#	`system_users_password`='" . $system_users_password . "' AND 
		#	`system_users_disabled`=0" 
		#);

		#if ($query != null) {
		#	$_SESSION['logged_user_id'] = $query['system_users_id'];
		#	header('Location: index.php');
		#}
		# i made this function to validate users against the right table (system_conf_pwd_tbl) !!
		# the idea is not to use the table system_users_tbl for validating passwords

		if($user_id = authenticate_user_credentials($system_users_login, $system_users_password)) {
			echo "good credentials for $user_id";
			$_SESSION['logged_user_id'] = $user_id; 
			header('Location: index.php');
		} else {
			echo "wrong credentials";
			exit;
		} 
	

	}

	$logged_user = isset( $_SESSION['logged_user_id'] ) ? true : false;

	if ( $logged_user ) {
		header('Location: index.php');
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ERAMBA LOGIN</title>
	<meta charset="UTF-8" />
			
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	      
	<meta name="author" content=""/>
	<meta name="Copyright" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="Pragma" content="no-cache" />
	
<?php
echo "	<script type=\"text/javascript\" src=\"js/jquery.min.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/jquery-ui.min.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/admin.scripts.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/chosen.jquery.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/accordion.js\"></script>";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/normalize.css\" />";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/styles.css\" />";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/chosen.css\" />";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/chosen.css\" />";
?>

	<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.2/themes/base/jquery-ui.css" />
	<script>
	</script>
	
	

</head>
<body>

	<div id="centerbox-page-wrapper" class="login">
		<div id="centerbox-page-overlay">
		</div>
		<img src="img/centerbox-login-top.png" id="centerbox-login-top" width="131" height="47" />

		<div id="centerbox-page-content">
			<form id="login" name="login" method="POST">
				<div class="centerbox-entry">
					<label for="login">Login</label>
					<input type="text" name="login" id="login" />
				</div>
				<div class="centerbox-entry">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" />
				</div>
				<div class="centerbox-entry">
					<input type="submit" name="login-submit" id="submit" value="Sign in" />
				</div>
				<!--<div class="centerbox-entry">
					<p><a href="#">Forgot password?</a><span> or </span><a href="#">Create New</a></p>
				</div>-->
			</form>
		</div>
	</div>

</body>
</html>
