<?

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/risk/risk/ - SAMEPLE

include_once("mysql_lib.php");
include_once("risk_classification_lib.php");

function list_risk($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM risk_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_risk_asset_join($risk_asset_join_data) {
	$sql = "INSERT INTO
		risk_asset_join	
		VALUES (
		\"$risk_asset_join_data[risk_asset_join_risk_id]\",
		\"$risk_asset_join_data[risk_asset_join_asset_id]\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
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
	$result_risk = runQuery($sql);

	# este es el join entre risks y assets
	$sql = "SELECT * FROM risk_asset_join";
	$risk_asset_join= runQuery($sql);

	# el header del archivo es "dinamico" porque depende el numero de classificciones que usne, etc..
	$header_static = "asset_name, asset_description, threats, vulnerabilities, risk review,";

	# i need to push all the classifictions available for risks in the header too!
	$risk_classification_list = list_risk_classification_distinct();
	$risk_classification_list_2 = array();
	foreach($risk_classification_list as $classification_item) {
		array_push($risk_classification_list_2, $classification_item[risk_classification_type]);
	}
	$header_dinamic = implode(",", $risk_classification_list_2);

	# ahora el header, pero la segunda parte
	$header_static_part_two = ",risk score, mitigation strategy, compensating controls name, compensating controls id, risk_exceptions, residual_risk";

	$full_header = "$header_static $header_dinamic $header_static_part_two";

	# open file
	$export_file = "downloads/risk_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "$full_header\n");

	foreach($risk_asset_join as $risk_asset_join_item) {

	$asset_data = lookup_asset("asset_id", $risk_asset_join_item[risk_asset_join_asset_id]);
	$risk_data = lookup_risk("risk_id", $risk_asset_join_item[risk_asset_join_risk_id]);

	$line_first_part = "$asset_data[asset_name], $asset_data[asset_description], $risk_data[risk_threat], $risk_data[risk_vulnerabilities], $risk_data[risk_periodicity_review]";
	
	# this inputs the values for the dinamyc part
	$risk_dinamyc_values = array();
	$risk_classification_list = list_risk_classification_distinct();
	foreach($risk_classification_list as $risk_classification_item) {
		$value = pre_selected_risk_classification_values($risk_classification_item[risk_classification_type], $risk_data[risk_id]);	
		$name = lookup_risk_classification("risk_classification_id", $value);
		array_push($risk_dinamyc_values, $name[risk_classification_name]);
	}

	$line_dinamyc_part = implode(",",$risk_dinamyc_values);
	$mitigation_strategy = lookup_risk_mitigation_strategy("risk_mitigation_strategy_id",$risk_data[risk_mitigation_strategy_id]); 
	
	#i try to gather security controls data
	$service_data_name=array();
	$service_data_id=array();
	$security_services_for_this_risk_list = list_risk_security_services_join(" WHERE risk_security_services_join_risk_id = \"$risk_data[risk_id]\""); 
	foreach($security_services_for_this_risk_list as $security_services_for_this_risk_item) {
		$security_service_data = lookup_security_services("security_services_id",$security_services_for_this_risk_item[risk_security_services_join_security_services_id]);	
		array_push($service_data_name, $security_service_data[security_services_name]);
		array_push($service_data_id, $security_service_data[security_services_id]);
	}

	$service_data_name_line=implode(";",$service_data_name);
	$service_data_id_line=implode(";",$service_data_id);

	# try to gather some sec exceptions data
	$risk_exception_data_information = array();
	$risk_exception_for_this_risk_list = list_risk_risk_exception_join(" WHERE risk_risk_exception_join_risk_id = \"$risk_data[risk_id]\""); 
	foreach($risk_exception_for_this_risk_list as $risk_exception_for_this_risk_item) {
		$risk_exception_data = lookup_risk_exception("risk_exception_id",$risk_exception_for_this_risk_item[risk_risk_exception_join_risk_exception_id]);	
		array_push($risk_exception_data_information, $risk_exception_data[risk_exception_title]);
	}

	$risk_exception_line = implode(";",$risk_exception_data_information);

	$line_third_part = "$risk_data[risk_classification_score], $mitigation_strategy[risk_mitigation_strategy_name], $service_data_name_line, $service_data_id_line,  $risk_exception_line, $risk_data[risk_residual_score]";
	
	fwrite($handler,"$line_first_part, $line_dinamyc_part, $line_third_part\n");

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




