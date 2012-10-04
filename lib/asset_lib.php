<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/asset/asset/ - SAMEPLE

include_once("mysql_lib.php");

function list_asset($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM asset_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_asset($asset_data) {
	$sql = "INSERT INTO
		asset_tbl
		VALUES (
		\"$asset_data[asset_id]\",
		\"$asset_data[asset_name]\",
		\"$asset_data[asset_description]\",
		\"$asset_data[asset_media_type_id]\",
		\"$asset_data[asset_legal_id]\",
		\"$asset_data[asset_owner_id]\",
		\"$asset_data[asset_guardian_id]\",
		\"$asset_data[asset_user_id]\",
		\"$asset_data[asset_container_id]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_asset($asset_data, $asset_id) {
	$sql = "UPDATE asset_tbl
		SET
		asset_name = \"$asset_data[asset_name]\",
		asset_description = \"$asset_data[asset_description]\",
		asset_media_type_id = \"$asset_data[asset_media_type_id]\",
		asset_legal_id = \"$asset_data[asset_legal_id]\",
		asset_owner_id = \"$asset_data[asset_owner_id]\",
		asset_guardian_id = \"$asset_data[asset_guardian_id]\",
		asset_user_id = \"$asset_data[asset_user_id]\",
		asset_container_id = \"$asset_data[asset_container_id]\"
		WHERE
		asset_id=\"$asset_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_asset($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from asset_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_asset($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM asset_tbl WHERE asset_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[asset_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[asset_id]\">$results_item[asset_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[asset_id]\">$results_item[asset_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[asset_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[asset_id]\">$results_item[asset_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[asset_id]\">$results_item[asset_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[asset_id]\">$results_item[asset_name]</option>\n"; 
		}
	}

}

function disable_asset($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE asset_tbl SET asset_disabled=\"1\" WHERE asset_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_asset_csv() {

	
	# open file
	$export_file = "downloads/asset_export.csv";
	$handler = fopen($export_file, 'w');
	
	# now i need to add the classifications to the header of the csv
	$stack = array();
	$classification_names = list_asset_classification_distinct();
	foreach ($classification_names as $classification_items) {
		array_push($stack, $classification_items[asset_classification_type]);
	}
	$comma_separated = implode(",", $stack);

	$header = "asset_id,asset_name,asset_description,asset_media_type, asset_legal_constrains, asset_owner, asset_guardian, asset_user, asset_container, asset_disabled, $comma_separated\n";
	fwrite($handler, $header);
	
	# now i need to add lines with the data
	$sql = "SELECT * from asset_tbl";
	$result = runQuery($sql);

	foreach($result as $asset_item) {

		$asset_owner_id = lookup_bu("bu_id",$asset_item[asset_owner_id]);
		$asset_guardian_id = lookup_bu("bu_id",$asset_item[asset_guardian_id]);
		$asset_user_id = lookup_bu("bu_id",$asset_item[asset_user_id]);

		$asset_media_type_id = lookup_asset_media_type("asset_media_type_id",$asset_item[asset_media_type_id]);
		$asset_legal_id = lookup_legal("legal_id",$asset_item[asset_legal_id]);
		$asset_container_id = lookup_asset("asset_id",$asset_item[asset_container_id]);
	
		$asset_classification_list = list_asset_classification_distinct();
		foreach($asset_classification_list as $asset_classification_item) {
			$value = pre_selected_asset_classification_values($asset_classification_item[asset_classification_type], $asset_item[asset_id]);	
			$name = lookup_asset_classification("asset_classification_id", $value);
			array_push($classification_values, $name);
		}

		$comma_separated = implode(",", $classification_values);

		$line = "$asset_item[asset_id],$asset_item[asset_name],$asset_item[asset_descripion],$asset_media_type_id, $asset_legal_id, $asset_owner_id, $asset_guardian_id, $asset_user_id, $comma_separated";
		fwrite($handler,$line);
	}
	
	fclose($handler);

}

?>




