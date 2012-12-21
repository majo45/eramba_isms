<?


include_once("mysql_lib.php");
include_once("system_conf_pwd_lib.php");
include_once("system_users_lib.php");

function authenticate_user_credentials($username,$password) {

	# first i need to get the user id
	$user_information = lookup_system_users("system_users_login", $username);
	if (!empty($user_information)) {
		# now i need to make sure it's not disabled
		if ($user_information[system_users_disabled] == "0") {
			# now i need to make sure the password is good
			$encrypted_password = sha1($password);
			#now i get the list of password for this user_id
			$list_of_passwords = list_system_conf_pwd(" WHERE system_conf_login_id = \"$user_information[system_users_id]\" and system_conf_pwd = \"$encrypted_password\""); 
			if (!empty($list_of_passwords)) {
				return $user_information[system_users_id];
			}
		}
	}

	return;
}

?>
