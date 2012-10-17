<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/security_services_audit/security_services_audit/ - SAMEPLE

include_once("mysql_lib.php");
include_once("security_services_lib.php");
include_once("site_lib.php");

function list_security_services_audit($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM security_services_audit_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

# the objective is to ensure that there's an audit record for future times starting today.
# so if i get called, i need to make sure that there will be an audit in the future for this service, when? well, the planned started date + periodicity.
# if the planned start date is after today, then i do nothing! i wait until the planned start date is in the PAST and then i will eventually create one
function add_security_services_audit_v2($security_services_id) {
	
	# first i need to know if this service is valid
	$service_information = lookup_security_services("security_services_id", $security_services_id); 
	if (empty($service_information[security_services_id])) {
		echo "DEBUG: Not a valid service<br>";
		return 1;
	}

	# then i need to check which audits i have PLANNED for this service (this will give me the list of months ids) for EVERY YEAR 
	$service_planned_audits_list = list_security_services_catalogue_audit_calendar_join( " WHERE security_service_catalogue_id = \"$service_information[security_services_id]\""); 
	if (!count($service_planned_audits_list)) {
		echo "DEBUG: no tiene audits planned ($service_information[security_services_id]) <br>";
		return;
	}
	
	# then i need to check which audits i have CREATED for this service THIS YEAR
	# then i need to make sure all what was planned is created
	$this_year = give_me_this_year();

	$service_created_audit_list = list_security_services_audit(" WHERE security_services_audit_security_service_id = \"$service_information[security_services_id]\" and security_services_audit_disabled = \"0\" and security_services_audit_planned_year = \"$this_year\""); 

	if (!count($service_created_audit_list)) {
		echo "DE  BUG: tenes que crear audits papa<br>";
		foreach($service_planned_audits_list as $planned_audit) {
			real_add_security_services_audit($service_information[security_services_id], $planned_audit[security_services_audit_calendar_id], $this_year, $service_information[security_services_audit_metric], $service_informatio[security_services_audit_success_criteria]);
		}
		return;
	}
	
	foreach($service_planned_audits_list as $planned_month_audit) {

		echo "DEBUG: stargin to compare what audits PLANNED against CREATED<br>";
		
		# here i search if i have an audit planned with that ID
		foreach($service_created_audit_list as $created_audit) {

			echo "DEBUG: Comparing .. $planned_month_audit[security_services_audit_calendar_id] == $created_audit[security_services_audit_calendar_id] <br>";
	
			if ($planned_month_audit[security_services_audit_calendar_id] == $created_audit[security_services_audit_calendar_id]) {
				$find = 1;
			}	
		}

		if (!$find) {
			echo "DEBUG: I need to create a new audit, for $this_year and calendarid = $planned_month_audit[security_services_audit_calendar_id]<br>";
			real_add_security_services_audit($service_information[security_services_id], $planned_audit[security_services_audit_calendar_id], $this_year, $service_information[security_services_audit_metric], $service_informatio[security_services_audit_success_criteria]);
		}

		empty($find);

	}

}


function real_add_security_services_audit($security_services_id, $plan_date, $year, $metric, $metric_success) {
	 $sql = "INSERT INTO
	security_services_audit_tbl
	VALUES (
	\"\",
	\"$security_services_id\",
		\"1\",
		\"$plan_date\",
		\"$year\",
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




