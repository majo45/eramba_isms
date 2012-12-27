<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/security_incident_classification/security_incident_classification/ - SAMEPLE

include_once("mysql_lib.php");

function pre_selected_security_incident_classification_values($security_incident_classification_type, $security_incident_id) {

	# i need to know all classification id's with the "security_incident_classification_type" value
	# i need to know all classifications made with the security_incident $security_incident_id
	# i need to mix those two
	
	# i need to know all classification id's with the "security_incident_classification_type" value
	$sql = "SELECT
		security_incident_classification_id
		FROM
		security_incident_classification_tbl
		WHERE
		security_incident_classification_type = \"$security_incident_classification_type\"
		AND
		security_incident_classification_disabled = \"0\"
		";
	# echo "sql1: $sql<br>";
	$classification_id = runQuery($sql);

	# i need to know all classifications made with the security_incident $security_incident_id
	$sql = "SELECT
		security_incident_classification_join_security_incident_classification_id
		FROM
		security_incident_classification_join	
		WHERE
		security_incident_classification_join_security_incident_id = \"$security_incident_id\"
		";
	# echo "sql2: $sql<br>";
	$security_incident_classifications = runQuery($sql);

	# i need to mix those two
	foreach($classification_id as $classification_item) {
		# i need to know if any of this is used by the security_incident id
		foreach($security_incident_classifications as $security_incident_classification_item) {
			if ($classification_item[security_incident_classification_id] == $security_incident_classification_item[security_incident_classification_join_security_incident_classification_id]) {
				return $security_incident_classification_item[security_incident_classification_join_security_incident_classification_id];
			}
		}	
	}
}

# this function inserts classifications for security_incidents
function lookup_security_incident_classification_join($security_incident_classification_join_security_incident_id) {
	if (!is_numeric($security_incident_classification_join_security_incident_id)) {
		return;
	}

	$sql = "SELECT
		*
		FROM
		security_incident_classification_join
		WHERE
		security_incident_classification_join_security_incident_id = \"$security_incident_classification_join_security_incident_id\"
		";
	$results = runQuery($sql);
	return $results;
}

# this function inserts classifications for security_incidents
function add_security_incident_classification_join($security_incident_classification_join_security_incident_id, $security_incident_classification_join_security_incident_classification_id) {

	if (!is_numeric($security_incident_classification_join_security_incident_id)) {
		return;
	}
	
	$sql = "INSERT INTO
		security_incident_classification_join
		VALUES (
		\"$security_incident_classification_join_security_incident_id\",
		\"$security_incident_classification_join_security_incident_classification_id\"
		)
		";	

	$result = runUpdateQuery($sql);
	return $result;
}

# this function deletes form the table security_incident_classification_join_id all asociated items with security_incident $security_incident_id
function delete_security_incident_classification_join($security_incident_id) {

	if (!is_numeric($security_incident_id)) {
		return;
	}
	
	$sql = "DELETE
		from
		security_incident_classification_join
		WHERE
		security_incident_classification_join_security_incident_id = \"$security_incident_id\"
		";
	
	$result = runUpdateQuery($sql);
	return $result;
}

# This functions returns the number of classifications (maximum 5) to list security_incidents in html
function list_security_incident_classification_distinct() {
	$sql = "SELECT
		DISTINCT
		security_incident_classification_type
		FROM
		security_incident_classification_tbl
		WHERE
		security_incident_classification_disabled = \"0\"
		LIMIT
		5
		"; 
	$results = runQuery($sql);
	return $results;
}

function list_security_incident_classification($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM security_incident_classification_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_security_incident_classification($security_incident_classification_data) {
	$sql = "INSERT INTO
		security_incident_classification_tbl
		VALUES (
		\"$security_incident_classification_data[security_incident_classification_id]\",
		\"$security_incident_classification_data[security_incident_classification_name]\",
		\"$security_incident_classification_data[security_incident_classification_criteria]\",
		\"$security_incident_classification_data[security_incident_classification_type]\",
		\"$security_incident_classification_data[security_incident_classification_value]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_security_incident_classification($security_incident_classification_data, $security_incident_classification_id) {
	$sql = "UPDATE security_incident_classification_tbl
		SET
		security_incident_classification_name=\"$security_incident_classification_data[security_incident_classification_name]\",
		security_incident_classification_criteria=\"$security_incident_classification_data[security_incident_classification_criteria]\",
		security_incident_classification_type=\"$security_incident_classification_data[security_incident_classification_type]\",
		security_incident_classification_value=\"$security_incident_classification_data[security_incident_classification_value]\"
		WHERE
		security_incident_classification_id=\"$security_incident_classification_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_security_incident_classification($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from security_incident_classification_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_security_incident_classification($pre_selected_items='', $order_clause='', $security_incident_classification_type) {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM security_incident_classification_tbl WHERE security_incident_classification_type = \"$security_incident_classification_type\"".$order_clause;
	echo "PUTA: $sql";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[security_incident_classification_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[security_incident_classification_id]\">$results_item[security_incident_classification_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_incident_classification_id]\">$results_item[security_incident_classification_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[security_incident_classification_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[security_incident_classification_id]\">$results_item[security_incident_classification_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[security_incident_classification_id]\">$results_item[security_incident_classification_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[security_incident_classification_id]\">$results_item[security_incident_classification_name]</option>\n"; 
		}
	}

}

function disable_security_incident_classification($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE security_incident_classification_tbl SET security_incident_classification_disabled=\"1\" WHERE security_incident_classification_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_security_incident_classification_csv() {

	# this will dump the table security_incident_classification_tbl on CSV format
	$sql = "SELECT * from security_incident_classification_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/security_incident_classification_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "security_incident_classification_id,security_incident_classification_name,security_incident_classification_description,security_incident_classification_type, security_incident_classification_value, security_incident_classification_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[security_incident_classification_id],$line[security_incident_classification_name],$line[security_incident_classification_descripion],$line[security_incident_classification_type], $line[security_incident_classification_value],$line[security_incident_classification_disabled]\n");
	}
	
	fclose($handler);

}

?>




