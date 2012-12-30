<?
	
	include_once("lib/risk_lib.php");

# WARNING! This is a TEMPLATE
# IF YOU WANT TO USE, YOU MUST RENAME FUNCTIONS!! :s/risk_dashboard/risk_dashboard/ - SAMEPLE

include_once("mysql_lib.php");

function risk_dashboard_data() {

	# i need to make sure i add data ONLY if this current month has no data already
	# otherwise i would collect too many samples for one month. I need to make sure i collect ONE SAMPLE PER MONTH!
	$month = give_me_this_month();
	$risk_dashboard_list = list_risk_dashboard(" WHERE MONTH(risk_dashboard_date) = $month");
	if (count($risk_dashboard_list)!=0) {
		#echo "no more updates for this month";
		return;
	}

	# now i start getting hte data for a new update on the dashaboards
	$risk_score=0;
	$risk_residual=0;
	
	$risk_list = list_risk(" WHERE risk_disabled=\"0\"");

	foreach($risk_list as $risk_item) {

		$risk_score=$risk_score+$risk_item[risk_classification_score];
		$risk_residual=$risk_residual+$risk_item[risk_residual_score];
	}	

	$date=give_me_date();
	
	$risk_update = array(
		'risk_dashboard_risk_score' => $risk_score,
		'risk_dashboard_risk_residual_score' => $risk_residual,
		'risk_dashboard_date' => $date,
	);	

	$risk_dashboard_id = add_risk_dashboard($risk_update);
}

function list_risk_dashboard($arguments) {
	# MUST EDIT
	$sql = "SELECT * FROM risk_dashboard_tbl".$arguments;
	$results = runQuery($sql);
	return $results;
}

function add_risk_dashboard($risk_dashboard_data) {
	$sql = "INSERT INTO
		risk_dashboard_tbl
		VALUES (
		\"$risk_dashboard_data[risk_dashboard_id]\",
		\"$risk_dashboard_data[risk_dashboard_risk_score]\",
		\"$risk_dashboard_data[risk_dashboard_risk_residual_score]\",
		\"$risk_dashboard_data[risk_dashboard_date]\",
		\"0\"
		)
		";	
	$result = runUpdateQuery($sql);
	return $result;
	
}

function update_risk_dashboard($risk_dashboard_data, $risk_dashboard_id) {
	$sql = "UPDATE risk_dashboard_tbl
		SET
		risk_dashboard_name=\"$risk_dashboard_data[risk_dashboard_name]\",
		risk_dashboard_description=\"$risk_dashboard_data[risk_dashboard_description]\"
		WHERE
		risk_dashboard_id=\"$risk_dashboard_id\"
		";	
	$result = runUpdateQuery($sql);
	return $result;
}

function lookup_risk_dashboard($search_parameter, $item_id) {
	if (!$item_id or !$search_parameter) {
		return;
	}

	# MUST EDIT
	$sql = "SELECT * from risk_dashboard_tbl WHERE $search_parameter = \"$item_id\""; 
	$result = runSmallQuery($sql);
	return $result;
}

# he needs to return a whole html ready to drop a menu
# he receives an array with an item of pre-selected items that must be pre-selected
# he receives a second argument which is the order by lookup
function list_drop_menu_risk_dashboard($pre_selected_items='', $order_clause='') {

	if ($order_clause) {
		$order_clause = " ORDER BY ".$order_clause."";
	}

	# MUST EDIT
	$sql = "SELECT * FROM risk_dashboard_tbl WHERE risk_dashboard_disabled = \"0\"".$order_clause."";
	$results = runQuery($sql);

	foreach($results as $results_item) {
		if (is_array($pre_selected_items)) { 
			$match = NULL;
			foreach($pre_selected_items as $preselected) {
				# MUST EDIT
				if ($results_item[risk_dashboard_id] == $preselected) {
					echo "<option selected=\"selected\" value=\"$results_item[risk_dashboard_id]\">$results_item[risk_dashboard_name]</option>\n";
					$match = 1;
				} 
			}

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[risk_dashboard_id]\">$results_item[risk_dashboard_name]</option>\n"; 
			}

		} elseif ($pre_selected_items) {
			$match = NULL;
			# MUST EDIT
			if ($results_item[risk_dashboard_id] == $pre_selected_items) {
				echo "<option selected=\"selected\" value=\"$results_item[risk_dashboard_id]\">$results_item[risk_dashboard_name]</option>\n";
				$match = 1;
			} 

			# MUST EDIT
			if (!$match) { 
				echo "<option value=\"$results_item[risk_dashboard_id]\">$results_item[risk_dashboard_name]</option>\n"; 
			}
		} else {
			# MUST EDIT
			echo "<option value=\"$results_item[risk_dashboard_id]\">$results_item[risk_dashboard_name]</option>\n"; 
		}
	}

}

function disable_risk_dashboard($item_id) {
	if (!is_numeric($item_id)) {
		return;
	}
	# MUST EDIT
	$sql = "UPDATE risk_dashboard_tbl SET risk_dashboard_disabled=\"1\" WHERE risk_dashboard_id = \"$item_id\""; 
	$result = runUpdateQuery($sql);
	return;
}

function export_risk_dashboard_csv() {

	# this will dump the table risk_dashboard_tbl on CSV format
	$sql = "SELECT * from risk_dashboard_tbl";
	$result = runQuery($sql);
	
	# open file
	$export_file = "downloads/risk_dashboard_export.csv";
	$handler = fopen($export_file, 'w');
	
	fwrite($handler, "risk_dashboard_id,risk_dashboard_name,risk_dashboard_description,risk_dashboard_disabled\n");
	foreach($result as $line) {
		fwrite($handler,"$line[risk_dashboard_id],$line[risk_dashboard_name],$line[risk_dashboard_descripion],$line[risk_dashboard_disabled]\n");
	}
	
	fclose($handler);

}

?>
