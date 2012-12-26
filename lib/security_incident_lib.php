<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/security_incidents/security_incidents/ - SAMEPLE

include_once("mysql_lib.php");

function list_security_incidents($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM security_incidents_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_security_incidents($security_incidents_data) {
	$sql = "INSERT INTO
		security_incidents_tbl
		VALUES (
		\"$security_incidents_data[security_incidents_id]\",
		\"$security_incidents_data[security_incidents_name]\",
		\"$security_incidents_data[security_incidents_description]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_security_incidents($security_incidents_data, $security_incidents_id) {
	$sql = "UPDATE security_incidents_tbl
		SET
		security_incidents_name=\"$security_incidents_data[security_incidents_name]\",
		security_incidents_description=\"$security_incidents_data[security_incidents_description]\"
		WHERE
		security_incidents_id=\"$security_incidents_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_security_incidents($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from security_incidents_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_security_incidents($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM security_incidents_tbl WHERE security_incidents_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[security_incidents_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[security_incidents_id]\">$results_item[security_incidents_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_incidents_id]\">$results_item[security_incidents_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[security_incidents_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[security_incidents_id]\">$results_item[security_incidents_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_incidents_id]\">$results_item[security_incidents_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[security_incidents_id]\">$results_item[security_incidents_name]</option>\n"; 
		}
	}

}

function disable_security_incidents($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE security_incidents_tbl SET security_incidents_disabled=\"1\" WHERE security_incidents_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_security_incidents_csv() {

	# this will dump the table security_incidents_tbl on CSV format
	$sql = "SELECT * from security_incidents_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/security_incidents_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "security_incidents_id,security_incidents_name,security_incidents_description,security_incidents_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[security_incidents_id],$line[security_incidents_name],$line[security_incidents_descripion],$line[security_incidents_disabled]\n");
	}
	
	fclose($handler);

}

?>




