<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/security_incident/security_incident/ - SAMEPLE

include_once("mysql_lib.php");

function list_security_incident($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM security_incident_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_security_incident($security_incident_data) {
	$sql = "INSERT INTO
		security_incident_tbl
		VALUES (
		\"$security_incident_data[security_incident_id]\",
		\"$security_incident_data[security_incident_owner_id]\",
		\"$security_incident_data[security_incident_title]\",
		\"$security_incident_data[security_incident_open_date]\",
		\"$security_incident_data[security_incident_description]\",
		\"$security_incident_data[security_incident_compromised_asset_id]\",
		\"$security_incident_data[security_incident_closure_date]\",
		\"$security_incident_data[security_incident_classification_id]\",
		\"$security_incident_data[security_incident_status_id]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_security_incident($security_incident_data, $security_incident_id) {
	$sql = "UPDATE security_incident_tbl
		SET
		security_incident_owner_id=\"$security_incident_data[security_incident_owner_id]\",
		security_incident_title=\"$security_incident_data[security_incident_title]\",
		security_incident_open_date=\"$security_incident_data[security_incident_open_date]\",
		security_incident_description=\"$security_incident_data[security_incident_description]\",
		security_incident_compromised_asset_id=\"$security_incident_data[security_incident_compromised_asset_id]\",
		security_incident_closure_date=\"$security_incident_data[security_incident_closure_date]\",
		security_incident_classification_id=\"$security_incident_data[security_incident_classification_id]\",
		security_incident_status_id=\"$security_incident_data[security_incident_status_id]\"
		WHERE
		security_incident_id=\"$security_incident_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_security_incident($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from security_incident_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_security_incident($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM security_incident_tbl WHERE security_incident_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[security_incident_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[security_incident_id]\">$results_item[security_incident_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_incident_id]\">$results_item[security_incident_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[security_incident_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[security_incident_id]\">$results_item[security_incident_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_incident_id]\">$results_item[security_incident_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[security_incident_id]\">$results_item[security_incident_name]</option>\n"; 
		}
	}

}

function disable_security_incident($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE security_incident_tbl SET security_incident_disabled=\"1\" WHERE security_incident_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_security_incident_csv() {

	# this will dump the table security_incident_tbl on CSV format
	$sql = "SELECT * from security_incident_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/security_incident_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "security_incident_id,security_incident_name,security_incident_description,security_incident_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[security_incident_id],$line[security_incident_name],$line[security_incident_descripion],$line[security_incident_disabled]\n");
	}
	
	fclose($handler);

}

?>
