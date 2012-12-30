<?
	
# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/asset_dashboard/asset_dashboard/ - SAMEPLE

include_once("mysql_lib.php");
include_once("asset_lib.php");

function asset_dashboard_data() {

	# i need to make sure i add data ONLY if this current month has no data already
	# otherwise i would collect too many samples for one month. I need to make sure i collect ONE SAMPLE PER MONTH!
	$month = give_me_this_month();
	$asset_dashboard_list = list_asset_dashboard(" WHERE MONTH(asset_dashboard_date) = $month");
	if (count($asset_dashboard_list)!=0) {
		#echo "no more updates for this month";
		return;
	}

	# now i start getting hte data for a new update on the dashaboards
	$asset_dashboard_type_data_asset=0;
	$asset_dashboard_type_human_asset=0;
	$asset_dashboard_type_information=0;
	
	$asset_list = list_asset(" WHERE asset_disabled=\"0\"");

	foreach($asset_list as $asset_item) {

		if ($asset_item[asset_media_type_id] == "1") {
			$asset_dashboard_type_data_asset++;
		} elseif ($asset_item[asset_media_type_id] == "2") {
			$asset_dashboard_type_information++;
		} elseif ($asset_item[asset_media_type_id] == "3") {
			$asset_dashboard_type_human_asset++;
		}
	}	

	$date=give_me_date();
	
	$asset_update = array(
		'asset_dashboard_type_data_asset' => $asset_dashboard_type_data_asset,
		'asset_dashboard_type_human_asset' => $asset_dashboard_type_human_asset,
		'asset_dashboard_type_information' => $asset_dashboard_type_information,
		'asset_dashboard_date' => $date
	);	

	$asset_dashboard_id = add_asset_dashboard($asset_update);
}

function list_asset_dashboard($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM asset_dashboard_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_asset_dashboard($asset_dashboard_data) {
	$sql = "INSERT INTO
		asset_dashboard_tbl
		VALUES (
		\"$asset_dashboard_data[asset_dashboard_id]\",
		\"$asset_dashboard_data[asset_dashboard_type_data_asset]\",
		\"$asset_dashboard_data[asset_dashboard_type_human_asset]\",
		\"$asset_dashboard_data[asset_dashboard_type_information]\",
		\"$asset_dashboard_data[asset_dashboard_date]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_asset_dashboard($asset_dashboard_data, $asset_dashboard_id) {
	$sql = "UPDATE asset_dashboard_tbl
		SET
		asset_dashboard_name=\"$asset_dashboard_data[asset_dashboard_name]\",
		asset_dashboard_description=\"$asset_dashboard_data[asset_dashboard_description]\"
		WHERE
		asset_dashboard_id=\"$asset_dashboard_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_asset_dashboard($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from asset_dashboard_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_asset_dashboard($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM asset_dashboard_tbl WHERE asset_dashboard_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[asset_dashboard_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[asset_dashboard_id]\">$results_item[asset_dashboard_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[asset_dashboard_id]\">$results_item[asset_dashboard_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[asset_dashboard_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[asset_dashboard_id]\">$results_item[asset_dashboard_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[asset_dashboard_id]\">$results_item[asset_dashboard_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[asset_dashboard_id]\">$results_item[asset_dashboard_name]</option>\n"; 
		}
	}

}

function disable_asset_dashboard($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE asset_dashboard_tbl SET asset_dashboard_disabled=\"1\" WHERE asset_dashboard_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_asset_dashboard_csv() {

	# this will dump the table asset_dashboard_tbl on CSV format
	$sql = "SELECT * from asset_dashboard_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/asset_dashboard_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "asset_dashboard_id,asset_dashboard_name,asset_dashboard_description,asset_dashboard_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[asset_dashboard_id],$line[asset_dashboard_name],$line[asset_dashboard_descripion],$line[asset_dashboard_disabled]\n");
	}
	
	fclose($handler);

}

?>
