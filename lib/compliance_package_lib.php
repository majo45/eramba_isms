<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/compliance_package/compliance_package/ - SAMEPLE

include_once("mysql_lib.php");
include_once("tp_lib.php");

function list_compliance_package($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM compliance_package_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function list_compliance_package_unique() {
	# MUST EDIT
	$sql = "SELECT distinct compliance_package_tp_id FROM compliance_package_tbl";
	$results = runQuery($sql);
	return $results;
}

function add_compliance_package($compliance_package_data) {
	$sql = "INSERT INTO
		compliance_package_tbl
		VALUES (
		\"\",
		\"$compliance_package_data[compliance_package_tp_id]\",
		\"$compliance_package_data[compliance_package_original_id]\",
		\"$compliance_package_data[compliance_package_name]\",
		\"$compliance_package_data[compliance_package_description]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_compliance_package($compliance_package_data, $compliance_package_id) {
	$sql = "UPDATE compliance_package_tbl
		SET
		compliance_package_original_id=\"$compliance_package_data[compliance_package_original_id]\",
		compliance_package_name=\"$compliance_package_data[compliance_package_name]\",
		compliance_package_description=\"$compliance_package_data[compliance_package_description]\"
		WHERE
		compliance_package_id=\"$compliance_package_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_compliance_package($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from compliance_package_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_compliance_package($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM compliance_package_tbl WHERE compliance_package_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[compliance_package_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[compliance_package_id]\">$results_item[compliance_package_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[compliance_package_id]\">$results_item[compliance_package_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[compliance_package_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[compliance_package_id]\">$results_item[compliance_package_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[compliance_package_id]\">$results_item[compliance_package_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[compliance_package_id]\">$results_item[compliance_package_name]</option>\n"; 
		}
	}

}

function disable_compliance_package($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE compliance_package_tbl SET compliance_package_disabled=\"1\" WHERE compliance_package_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_compliance_package_csv() {

	# this will dump the table compliance_package_tbl on CSV format
	# $sql = "SELECT * from compliance_package_tbl";
	# this query merges both tables
	$sql = "select * from compliance_package_tbl left join compliance_package_item_tbl on compliance_package_item_tbl.compliance_package_id = compliance_package_tbl.compliance_package_id";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/compliance_package_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "compliance_package_third_party_name,compliance_package_tp_id, compliance_package_original_id, compliance_package_name,compliance_package_description,compliance_package_disabled, compliance_package_item_original_id, compliance_package_item_name, compliance_package_item_description, compliance_package_item_disabled\n");

	foreach($result as $line) {

		$compliance_package_tp_item = lookup_tp("tp_id", $line[compliance_package_tp_id]);

		fwrite($handler,"$compliance_package_tp_item[tp_name], $line[compliance_package_tp_id],$line[compliance_package_original_id],$line[compliance_package_name],$line[compliance_package_descripion],$line[compliance_package_disabled]\n");

	}
	
	fclose($handler);

}

function parse_compliance_package_csv($filename) {

	# just make sure you can read the tmp file
	$file_handle = fopen($filename, "r");
	if (!$file_handle) {
		echo "Cant open csv file";
	}

	# right .. now parse it and create the structure in the db

	fclose($file_handle);

}

?>




