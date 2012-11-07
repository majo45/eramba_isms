<?

date_default_timezone_set('Europe/Bratislava');

function give_me_this_month() {
	
	$unix_time = time();	
	$date = date('m', $unix_time); 
	return $date;
}

function give_me_this_year() {
	
	$unix_time = time();	
	$date = date('Y', $unix_time); 
	return $date;
}

function give_me_date() {
	
	$unix_time = time();	
	$date = date('Y-m-d', $unix_time); 
	return $date;
}

function give_me_date_time() {
	
	$unix_time = time();	
	$datetime = date('Y-m-d H:i:s', $unix_time); 
	return $datetime;
}

function check_valid_date($date) {
	$split_date = explode("-"  , $date);
	#echo "DATE: $split_date[1] - $split_date[2] - $split_date[0]";
	if (!is_numeric($split_date[0]) or !is_numeric($split_date[1]) or !is_numeric($split_date[2])) {
		#echo "wrong date";
		return 1;
	}
	if( !checkdate($split_date[1], $split_date[2], $split_date[0]) ) {
		#echo "wrong date";
		return 1;
	}
	#echo "date ok";
	return;
}

function show_menu_sub($section) {
	
	if ($section == "organization") {
		echo "<li><a href=\"$base_url?section=organization&subsection=bu\">Bussiness Units</a></li>";
		echo "<li><a href=\"$base_url?section=organization&subsection=legal\">Legal</a></li>";
		echo "<li><a href=\"$base_url?section=organization&subsection=tp\">Third Parties</a></li>";
	}
	
	if ($section == "asset") {
		echo "<li><a href=\"$base_url?section=asset&subsection=asset_classification\">Classification Scheme</a></li>";
		echo "<li><a href=\"$base_url?section=asset&subsection=asset_identification\">Asset Identification</a></li>";
		echo "<li><a href=\"$base_url?section=asset&subsection=data_asset\">Data Asset Analysis</a></li>";
	}
	
	if ($section == "risk") {
		echo "<li><a href=\"$base_url?section=risk&subsection=risk_classification\">Risk Classification Scheme</a></li>";
		echo "<li><a href=\"$base_url?section=risk&subsection=risk_management\">Risk Management</a></li>";
		echo "<li><a href=\"$base_url?section=risk&subsection=risk_exception\">Risk Exception</a></li>";
	}

	if ($section == "security_services") {
		echo "<li><a href=\"$base_url?section=security_services&subsection=security_catalogue\">Security Catalogue</a></li>";
		echo "<li><a href=\"$base_url?section=security_services&subsection=security_services_audit\">Audits & Reviews</a></li>";
		echo "<li><a href=\"$base_url?section=security_services&subsection=service_contracts\">Support Contracts</a></li>";
	}
	
	if ($section == "compliance") {
		echo "<li><a href=\"$base_url?section=compliance&subsection=compliance_package\">Compliance Packages DB</a></li>";
		echo "<li><a href=\"$base_url?section=compliance&subsection=\">Compliance Management</a></li>";
	}

	if ($section == "system") {
		echo "<li><a href=\"$base_url?section=system&subsection=system_records\">System Records</a></li>";
	}
}

function is_this_menu_active($section_received, $section) {
	
	if ($section_received == $section) {
		echo "class=\"active\"";	
	}
	return;
}

function build_base_url($section,$subsection) {
	return "?section=".$section."&subsection=".$subsection."";	
}

function shorten_string($string, $limit = 100) {
    if(strlen($string) < $limit) {return $string;}
    $regex = "/(.{1,$limit})\b/";
    preg_match($regex, $string, $matches);
    return $matches[1];
}

function local_domain() {
	return "".$_SERVER["SERVER_NAME"]."/isms_v2";
}

?>
