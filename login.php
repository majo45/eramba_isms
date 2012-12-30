<?php
	session_start();

	include_once("lib/mysql_lib.php");
	include_once("lib/system_security_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/security_services_dashboard_lib.php");
	include_once("lib/system_records_lib.php");

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

		$login_error=0;
		if($user_id = authenticate_user_credentials($system_users_login, $system_users_password)) {
			# echo "good credentials for $user_id";
			$_SESSION['logged_user_id'] = $user_id; 

			# make a record
			add_system_records("system","system_authorization","$user_id","$system_users_login","Login","");

			# everytime someone logs in the system, i need to make sure i add all the dashboard statistics
			security_services_dashboard_data();
	
			header('Location: index.php');
		} else {
			# echo "wrong credentials";
			add_system_records("system","system_authorization","$user_id","$system_users_login","Wrong Login","");
			$login_error=1;	
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
	<title>eramba security manager</title>
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


<? 

	if ($login_error) {
		error_message("Wrong Credentials", "A01");	
	} else {
		
echo "	<div id=\"centerbox-page-wrapper\" class=\"login\">";
echo "		<div id=\"centerbox-page-overlay\">";
echo "		</div>";
echo "		<img src=\"img/centerbox-login-top.png\" id=\"centerbox-login-top\" width=\"131\" height=\"47\" />";
echo "		<div id=\"centerbox-page-content\">";
echo "			<form id=\"login\" name=\"login\" method=\"POST\">";
echo "				<div class=\"centerbox-entry\">";
echo "					<label for=\"login\">Login</label>";
echo "					<input type=\"text\" name=\"login\" id=\"login\" />";
echo "				</div>";
echo "				<div class=\"centerbox-entry\">";
echo "					<label for=\"password\">Password</label>";
echo "					<input type=\"password\" name=\"password\" id=\"password\" />";
echo "				</div>";
echo "				<div class=\"centerbox-entry\">";
echo "					<input type=\"submit\" name=\"login-submit\" id=\"submit\" value=\"Sign in\" />";
echo "				</div>";
echo "				<!--<div class=\"centerbox-entry\">";
echo "					<p><a href=\"#\">Forgot password?</a><span> or </span><a href=\"#\">Create New</a></p>";
echo "				</div>-->";
echo "			</form>";
echo "		</div>";
echo "	</div>";
echo "</body>";

	}
?>

</html>
