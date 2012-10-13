<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/system_records/system_records/ - SAMEPLE

include_once("mysql_lib.php");
include_once("site_lib.php");


function list_system_records($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM system_records_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_system_records($system_records_section, $system_records_subsection, $system_records_item_id, $system_records_author, $system_records_action, $system_records_notes) {

	$system_records_time = give_me_date_time();
		
	$sql = "INSERT INTO
		system_records_tbl
		VALUES (
		\"\",
		\"$system_records_section\",
		\"$system_records_subsection\",
		\"$system_records_item_id\",
		\"$system_records_author\",
		\"$system_records_action\",
		\"$system_records_notes\",
		\"$system_records_time\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function lookup_system_records($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from system_records_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_system_records($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM system_records_tbl WHERE system_records_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[system_records_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[system_records_id]\">$results_item[system_records_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[system_records_id]\">$results_item[system_records_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[system_records_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[system_records_id]\">$results_item[system_records_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[system_records_id]\">$results_item[system_records_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[system_records_id]\">$results_item[system_records_name]</option>\n"; 
		}
	}

}

function disable_system_records($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE system_records_tbl SET system_records_disabled=\"1\" WHERE system_records_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_system_records_csv() {

	# this will dump the table system_records_tbl on CSV format
	$sql = "SELECT * from system_records_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/system_records_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "system_records_id,system_records_name,system_records_description,system_records_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[system_records_id],$line[system_records_name],$line[system_records_descripion],$line[system_records_disabled]\n");
	}
	
	fclose($handler);

}

?>




