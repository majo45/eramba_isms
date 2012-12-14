<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/project_improvements/project_improvements/ - SAMEPLE

include_once("mysql_lib.php");

function list_project_improvements($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM project_improvements_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_project_improvements($project_improvements_data) {
	$sql = "INSERT INTO
		project_improvements_tbl
		VALUES (
		\"$project_improvements_data[project_improvements_id]\",
		\"$project_improvements_data[project_improvements_name]\",
		\"$project_improvements_data[project_improvements_description]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_project_improvements($project_improvements_data, $project_improvements_id) {
	$sql = "UPDATE project_improvements_tbl
		SET
		project_improvements_name=\"$project_improvements_data[project_improvements_name]\",
		project_improvements_description=\"$project_improvements_data[project_improvements_description]\"
		WHERE
		project_improvements_id=\"$project_improvements_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_project_improvements($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from project_improvements_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_project_improvements($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM project_improvements_tbl WHERE project_improvements_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[project_improvements_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[project_improvements_id]\">$results_item[project_improvements_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[project_improvements_id]\">$results_item[project_improvements_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[project_improvements_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[project_improvements_id]\">$results_item[project_improvements_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[project_improvements_id]\">$results_item[project_improvements_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[project_improvements_id]\">$results_item[project_improvements_name]</option>\n"; 
		}
	}

}

function disable_project_improvements($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE project_improvements_tbl SET project_improvements_disabled=\"1\" WHERE project_improvements_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_project_improvements_csv() {

	# this will dump the table project_improvements_tbl on CSV format
	$sql = "SELECT * from project_improvements_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/project_improvements_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "project_improvements_id,project_improvements_name,project_improvements_description,project_improvements_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[project_improvements_id],$line[project_improvements_name],$line[project_improvements_descripion],$line[project_improvements_disabled]\n");
	}
	
	fclose($handler);

}

?>




