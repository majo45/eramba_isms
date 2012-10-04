<?

date_default_timezone_set('Europe/Bratislava');

function show_menu_sub($section) {
	
	if ($section == "organization") {
		echo "<li><a href=\"$base_url?section=organization&subsection=bu\">Bussiness Units</a></li>";
		echo "<li><a href=\"$base_url?section=organization&subsection=legal\">Legal</a></li>";
	}
	
	if ($section == "asset") {
		echo "<li><a href=\"$base_url?section=asset&subsection=asset_classification\">Classification Scheme</a></li>";
		echo "<li><a href=\"$base_url?section=asset&subsection=asset_identification\">Asset Identification</a></li>";
	}
	
	if ($section == "risk") {
		echo "<li><a href=\"$base_url?section=risk&subsection=risk_classification\">Risk Classification Scheme</a></li>";
		echo "<li><a href=\"$base_url?section=risk&subsection=risk_management\">Risk Management</a></li>";
		echo "<li><a href=\"$base_url?section=risk&subsection=risk_exception\">Risk Exception</a></li>";
	}

	if ($section == "security_services") {
		echo "<li><a href=\"$base_url?section=security_services&subsection=security_catalogue\">Security Catalogue</a></li>";
		echo "<li><a href=\"$base_url?section=security_services&subsection=security_services_audit\">Audits & Reviews</a></li>";
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
