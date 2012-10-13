<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/security_services_audit/security_services_audit/ - SAMEPLE

include_once("mysql_lib.php");
include_once("security_services_lib.php");

function list_security_services_audit($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM security_services_audit_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

# this is a custom function, when called (security_service_id) will check on the list of audits
# which are not initiated and are due and will create audits according to the details provided
# IMPORTANT: the rule is i create as many audits as needed to ensure the next audit is AFTER todays date
# IMPORTANT: the metric and metric success is copied from the security service information so is not lost if this changes in the future. 

# EXAMPLES WHEN THE AUDIT IS AFTER TODAY's DATE
# example: if today is 2012-10-13, and i receive service id 1, start date 2012-08-01 (before 2012-10-13) and regular review 5
# example response: i should create audit reports for: 2013-01-01 (which is after today's date)

# EXAMPLES WHEN THE AUDIT IS BEFORE TODAY's DATE
# example: if today is 2012-10-13, and i receive service id 1, start date 2012-01-01 (before 2012-10-13) and regular review 5
# example response: i should create audit reports for: 2012-06-01 and another for 2012-11-01 (which is after today's date)

function add_security_services_audit($security_services_id) {
	
	# first i need information about this security_service
	if (is_numeric($security_services_id)) {	
	
		$service_information = lookup_security_services("security_services_id", $security_services_id);
		if ($service_information[security_services_id] == $security_services_id) {

			$today = give_me_date();

			# if we have this, it means we have the right service 
			# echo "add_security_services_audit: we have the right service id<br>";
			# echo "add_security_services_audit: Metric: $service_information[security_services_audit_metric]<br>";
			# echo "add_security_services_audit: Success Criteria: $service_information[security_services_audit_success_criteria]<br>";
			# echo "add_security_services_audit: Periodicity: $service_information[security_services_audit_periodicity]<br>";
			# echo "add_security_services_audit: Starting...: $service_information[security_services_audit_periodicity_start_date]<br>";
			# echo "add_security_services_audit: Today is: $today<br>"; 
			# echo "<br>";

			# if the date for the start of audit is after today, i just create an audit and leave all this messs
			if (strtotime($service_information[security_services_audit_periodicity_start_date]) > time()) {
					$date = date_create($service_information[security_services_audit_periodicity_start_date]);
					date_add($date, date_interval_create_from_date_string("$service_information[security_services_audit_periodicity] months"));
					$calculated_date = date_format($date, 'Y-m-d');
					# echo "this is the last audit after today: $calculated_date<br>";
					real_add_security_services_audit($service_information[security_services_id], $calculated_date, $service_information[security_services_audit_metric], $service_information[security_services_audit_success_criteria]);
			}

			# while the calculated date is before today, we create new audits
			while (!$stop) {
				if (!$calculated_date) {
					$date = date_create($service_information[security_services_audit_periodicity_start_date]);
				} else {
					$date = date_create($calculated_date);
				}	
			
				date_add($date, date_interval_create_from_date_string("$service_information[security_services_audit_periodicity] months"));
				$calculated_date = date_format($date, 'Y-m-d');
			
				# today + periodicity (in months)
				#$today_plus_periodicity = strtotime(give_me_date() +$service_information[security_services_audit_periodicity] months); 
				$today_plus_periodicity = strtotime("$today +$service_information[security_services_audit_periodicity] months"); 
				# echo "WEWFWE: $today_plus_periodicity";

				if (strtotime($calculated_date) < $today_plus_periodicity) {
					# echo "i need to create an adudit on: $calculated_date -- ".strtotime($calculated_date)." vs target: $today_plus_periodicity<br>";
					real_add_security_services_audit($service_information[security_services_id], $calculated_date, $service_information[security_services_audit_metric], $service_information[security_services_audit_success_criteria]);
				} else {
					$stop = 1;
				}
			}

		} else {
			# we couldnt find the service so we exit
			echo "add_security_services_audit: we have the WRONG right service id<br>";
			return 1;
		}
	
	# if i dont have a security_service then i need to scan all services and make this check ... not fun!
	# this might be needed when the checks are performed when a user logs in on the system
	} else {
		echo "for the time being, i need a security service";
	}

	return;
	
}

function real_add_security_services_audit($security_services_id, $plan_date, $metric, $metric_success) {
	 $sql = "INSERT INTO
	security_services_audit_tbl
	VALUES (
	\"\",
	\"$security_services_id\",
		\"1\",
		\"$plan_date\",
		\"$metric\",
		\"$metric_success\",
		\"\",
		\"\",
		\"\",
		\"\",
		\"\",
		\"0\"
		)
		";	

	echo "$sql<br>";
	$result = runUpdateQuery($sql);
}

function update_security_services_audit($security_services_audit_data, $security_services_audit_id) {
	$sql = "UPDATE security_services_audit_tbl
		SET
		security_services_audit_name=\"$security_services_audit_data[security_services_audit_name]\",
		security_services_audit_description=\"$security_services_audit_data[security_services_audit_description]\"
		WHERE
		security_services_audit_id=\"$security_services_audit_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_security_services_audit($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from security_services_audit_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_security_services_audit($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM security_services_audit_tbl WHERE security_services_audit_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[security_services_audit_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[security_services_audit_id]\">$results_item[security_services_audit_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_services_audit_id]\">$results_item[security_services_audit_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[security_services_audit_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[security_services_audit_id]\">$results_item[security_services_audit_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_services_audit_id]\">$results_item[security_services_audit_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[security_services_audit_id]\">$results_item[security_services_audit_name]</option>\n"; 
		}
	}

}

function disable_security_services_audit($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE security_services_audit_tbl SET security_services_audit_disabled=\"1\" WHERE security_services_audit_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_security_services_audit_csv() {

	# this will dump the table security_services_audit_tbl on CSV format
	$sql = "SELECT * from security_services_audit_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/security_services_audit_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "security_services_audit_id,security_services_audit_name,security_services_audit_description,security_services_audit_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[security_services_audit_id],$line[security_services_audit_name],$line[security_services_audit_descripion],$line[security_services_audit_disabled]\n");
	}
	
	fclose($handler);

}

?>




