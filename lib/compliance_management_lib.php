<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/compliance_management/compliance_management/ - SAMEPLE

include_once("mysql_lib.php");

function list_compliance_management($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM compliance_management_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_compliance_management($compliance_management_data) {
	$sql = "INSERT INTO
		compliance_management_tbl
		VALUES (
		\"$compliance_management_data[compliance_management_id]\",
		\"$compliance_management_data[compliance_management_name]\",
		\"$compliance_management_data[compliance_management_description]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_compliance_management($compliance_management_data, $compliance_management_id) {
	$sql = "UPDATE compliance_management_tbl
		SET
		compliance_management_name=\"$compliance_management_data[compliance_management_name]\",
		compliance_management_description=\"$compliance_management_data[compliance_management_description]\"
		WHERE
		compliance_management_id=\"$compliance_management_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_compliance_management($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from compliance_management_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_compliance_management($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM compliance_management_tbl WHERE compliance_management_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[compliance_management_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[compliance_management_id]\">$results_item[compliance_management_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[compliance_management_id]\">$results_item[compliance_management_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[compliance_management_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[compliance_management_id]\">$results_item[compliance_management_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[compliance_management_id]\">$results_item[compliance_management_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[compliance_management_id]\">$results_item[compliance_management_name]</option>\n"; 
		}
	}

}

function disable_compliance_management($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE compliance_management_tbl SET compliance_management_disabled=\"1\" WHERE compliance_management_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_compliance_management_csv() {

	# this will dump the table compliance_management_tbl on CSV format
	$sql = "SELECT * from compliance_management_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/compliance_management_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "compliance_management_id,compliance_management_name,compliance_management_description,compliance_management_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[compliance_management_id],$line[compliance_management_name],$line[compliance_management_descripion],$line[compliance_management_disabled]\n");
	}
	
	fclose($handler);

}

?>




