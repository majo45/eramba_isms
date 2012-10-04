<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/risk/risk/ - SAMEPLE

include_once("mysql_lib.php");

function list_risk($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM risk_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_risk($risk_data) {
	$sql = "INSERT INTO
		risk_tbl
		VALUES (
		\"$risk_data[risk_id]\",
		\"$risk_data[risk_threat]\",
		\"$risk_data[risk_vulnerabilities]\",
		\"$risk_data[risk_classification_score]\",
		\"$risk_data[risk_mitigation_strategy_id]\",
		\"$risk_data[risk_periodicity_review]\",
		\"$risk_data[risk_residual_score]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_risk($risk_data, $risk_id) {
	$sql = "UPDATE risk_tbl
		SET
		risk_threat=\"$risk_data[risk_threat]\",
		risk_vulnerabilities=\"$risk_data[risk_vulnerabilities]\",
		risk_classification_score=\"$risk_data[risk_classification_score]\",
		risk_mitigation_strategy_id=\"$risk_data[risk_mitigation_strategy_id]\",
		risk_periodicity_review=\"$risk_data[risk_periodicity_review]\",
		risk_residual_score=\"$risk_data[risk_residual_score]\"
		WHERE
		risk_id=\"$risk_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_risk($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from risk_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_risk($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM risk_tbl WHERE risk_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[risk_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[risk_id]\">$results_item[risk_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[risk_id]\">$results_item[risk_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[risk_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[risk_id]\">$results_item[risk_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[risk_id]\">$results_item[risk_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[risk_id]\">$results_item[risk_name]</option>\n"; 
		}
	}

}

function disable_risk($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE risk_tbl SET risk_disabled=\"1\" WHERE risk_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_risk_csv() {

	# this will dump the table risk_tbl on CSV format
	$sql = "SELECT * from risk_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/risk_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "risk_id,risk_name,risk_description,risk_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[risk_id],$line[risk_name],$line[risk_descripion],$line[risk_disabled]\n");
	}
	
	fclose($handler);

}

function lookup_risk_asset_join($asset_id) {
	
	if (!is_numeric($asset_id)) {
		return;
	}
	# MUST EDIT
	$sql = "SELECT
		risk_asset_join_risk_id
		FROM
		risk_asset_join
		WHERE
		risk_asset_join_asset_id = \"$asset_id\"	
		";
	$result = runSmallQuery($sql);
	return $result;
}

?>




