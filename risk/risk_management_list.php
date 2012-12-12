<?
	include_once("lib/bu_lib.php");
	include_once("lib/risk_lib.php");
	include_once("lib/legal_lib.php");
	include_once("lib/risk_classification_lib.php");
	include_once("lib/risk_exception_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/asset_lib.php");
	include_once("lib/risk_security_services_join_lib.php");
	include_once("lib/security_services_lib.php");
	include_once("lib/security_services_status_lib.php");
	include_once("lib/risk_risk_exception_join_lib.php");
	include_once("lib/risk_mitigation_strategy_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$asset_id = $_GET["asset_id"];
	$risk_id = $_GET["risk_id"];
	$risk_threat = $_GET["risk_threat"];
	$risk_vulnerabilities = $_GET["risk_vulnerabilities"];
	$risk_classification = $_GET["risk_classification"];
	$risk_classification_score = $_GET["risk_classification_score"];
	if (!is_numeric($risk_classification_score)) {
		$risk_classification_score = 0;
	}

	$risk_mitigation_strategy_id = $_GET["risk_mitigation_strategy_id"];
	$security_services_id = $_GET["security_services_id"];
	$risk_exception_id = $_GET["risk_exception_id"];

	$risk_periodicity_review = $_GET["risk_periodicity_review"];
	if (!is_numeric($risk_periodicity_review)) {
		$risk_periodicity_review = 12;
	}
	$risk_residual_score = $_GET["risk_residual_score"];
	if (!is_numeric($risk_residual_score)) {
		$risk_residual_score = $risk_classification_score;
	}

	$security_services_id = $_GET["security_services_id"];
	$risk_exception_id = $_GET["risk_exception_id"];
	
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($risk_id)) {
		$risk_update = array(
			'risk_threat' => $risk_threat,
			'risk_vulnerabilities' => $risk_vulnerabilities,
			'risk_classification_score' => $risk_classification_score,
			'risk_mitigation_strategy_id' => $risk_mitigation_strategy_id,
			'risk_periodicity_review' => $risk_periodicity_review,
			'risk_residual_score' => $risk_residual_score
		);	
		update_risk($risk_update,$risk_id);
		add_system_records("risk","risk_management","$risk_id","","Update","");

		# delete all security services for this risk
		delete_risk_security_services_join($risk_id);
		# add all selected security services for this risk
		if (is_array($security_services_id)) {
			$count_security_services_id_item = count($security_services_id);
			for($count = 0 ; $count < $count_security_services_id_item ; $count++) {
				# now i insert this stuff
				add_risk_security_services_join($risk_id, $security_services_id[$count]);
			}
		}
		
		# delete all risk_exceptions for this risk
		delete_risk_risk_exception_join($risk_id);
		# add all selected security services for this risk
		if (is_array($risk_exception_id)) {
			$count_risk_exception_id_item = count($risk_exception_id);
			for($count = 0 ; $count < $count_risk_exception_id_item ; $count++) {
				# now i insert this stuff
				add_risk_risk_exception_join($risk_id, $risk_exception_id[$count]);
			}
		}

		# 1) delete all classifications for this risk
		delete_risk_classification_join($risk_id);
		# 2) insert all classification for this risk
		if (is_array($risk_classification)) {
			$count_risk_classification_item = count($risk_classification);
			for($count = 0 ; $count < $count_risk_classification_item ; $count++) {
				# now i insert this stuff
				add_risk_classification_join($risk_id, $risk_classification[$count]);
			}
		}

	} elseif ($action == "update" & !empty($asset_id)) {

		$risk_update = array(
			'risk_threat' => $risk_threat,
			'risk_vulnerabilities' => $risk_vulnerabilities,
			'risk_classification_score' => $risk_classification_score,
			'risk_mitigation_strategy_id' => $risk_mitigation_strategy_id,
			'risk_periodicity_review' => $risk_periodicity_review,
			'risk_residual_score' => $risk_residual_score
		);	
		$risk_id = add_risk($risk_update);

		$risk_asset_join_update = array(
			'risk_asset_join_risk_id' => $risk_id,
			'risk_asset_join_asset_id' => $asset_id
		);	

		add_risk_asset_join($risk_asset_join_update);

		add_system_records("risk","risk_management","$risk_id","","Insert","");
		
		# delete all security services for this risk
		delete_risk_security_services_join($risk_id);
		# add all selected security services for this risk
		if (is_array($security_services_id)) {
			$count_security_services_id_item = count($security_services_id);
			for($count = 0 ; $count < $count_security_services_id_item ; $count++) {
				# now i insert this stuff
				add_risk_security_services_join($risk_id, $security_services_id[$count]);
			}
		}
		
		# delete all risk_exceptions for this risk
		delete_risk_risk_exception_join($risk_id);
		# add all selected security services for this risk
		if (is_array($risk_exception_id)) {
			$count_risk_exception_id_item = count($risk_exception_id);
			for($count = 0 ; $count < $count_risk_exception_id_item ; $count++) {
				# now i insert this stuff
				add_risk_risk_exception_join($risk_id, $risk_exception_id[$count]);
			}
		}

		# 1) delete all classifications for this risk
		delete_risk_classification_join($risk_id);
		# 2) insert all classification for this risk
		if (is_array($risk_classification)) {
			$count_risk_classification_item = count($risk_classification);
			for($count = 0 ; $count < $count_risk_classification_item ; $count++) {
				# now i insert this stuff
				add_risk_classification_join($risk_id, $risk_classification[$count]);
			}
		}
		
	 }

	if ($action == "disable" & is_numeric($risk_id)) {
		disable_risk($risk_id);
		add_system_records("risk","risk_management","$risk_id","","Disable","");
		#i should also disable all risk asociated items
	}

	if ($action == "csv") {
		export_risk_csv();
		add_system_records("risk","risk_management","$risk_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>


	<section id="content-wrapper">
		<h3>Risk Management</h3>
		<span class=description>Identifying and analysing Risks can be usefull if executed in a simple and practical way. For each asset identify and analyse risks.</span>
		<br>
		<br>
		<div class="controls-wrapper">
			
			<div class="actions-wraper">
				<a href="#" class="actions-btn">
					Actions
					<span class="select-icon"></span>
				</a>
				<ul class="action-submenu">
					<li><a href="#">Delete</a></li>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
if ($action == "csv") {
echo "					<li><a href=\"downloads/risk_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url&action=csv\">Export All</a></li>";
}
?>
				</ul>
			</div>

		</div>
			
		
		<ul id="accordion">
			
<?
	$asset_list = list_asset(" WHERE asset_disabled=\"0\"");
	foreach($asset_list as $asset_item) {

	$risk_item = lookup_risk_asset_join("$asset_item[asset_id]");
	$risk_data = lookup_risk("risk_id",$risk_item[risk_asset_join_risk_id]);
	$risk_mitigation = lookup_risk_mitigation_strategy("risk_mitigation_strategy_id",$risk_data[risk_mitigation_strategy_id]); 


echo "			<li>";
echo "				<div class=\"header\">";
echo "					Asset being Risk Analysed: $asset_item[asset_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$base_url&action=edit&risk_id=$risk_data[risk_id]&asset_id=$asset_item[asset_id]\">edit</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?section=system&subsection=system_records&system_records_lookup_section=risk&system_records_lookup_subsection=risk_management&system_records_lookup_item_id=$risk_data[risk_id]\">records</a>";
echo "						&nbsp;|&nbsp;";
# echo "						<a class=\"edit\" href=\"$base_url&action=disable&risk_id=$risk_data[risk_id]&asset_id=$asset_item[asset_id]\">delete</a>";
# echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?action=edit&section=ciso&subsection=ciso_pmo&ciso_pmo_lookup_section=risk&ciso_pmo_lookup_subsection=risk_management&ciso_pmo_lookup_item_id=$risk_data[risk_id]\">improve</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th>Threats</th>";
echo "							<th>Vulnerabilities</th>";
echo "							<th class=\"center\">Risk Score</th>";
echo "							<th class=\"center\">Mitigation Strategy</th>";
echo "							<th class=\"center\">Review Periodicity</th>";
echo "							<th class=\"center\">Residual Risk</th>";
echo "						</tr>";

echo "						<tr>";
echo "							<td class=\"action-cell\">";
echo "								 	$risk_data[risk_threat]";
echo "							</td>";
echo "							<td>$risk_data[risk_vulnerabilities]</td>";
echo "							<td><center>$risk_data[risk_classification_score]</td>";
echo "							<td><center>$risk_mitigation[risk_mitigation_strategy_name]</td>";
echo "							<td><center>$risk_data[risk_periodicity_review]</td>";
echo "							<td><center>$risk_data[risk_residual_score]</td>";
echo "						</tr>";
	#}

echo "					</table>";
echo "<br>";
### INJERTO STARTS
echo "					<div class=\"rounded\">";
echo "						<table class=\"sub-table\">";
echo "							<tr>";
	# first i create columns for each category .. no more than 5!
	$risk_classification_list = list_risk_classification_distinct();
	foreach($risk_classification_list as $risk_classification_item) {
		echo "<th><center>$risk_classification_item[risk_classification_type]</th>";
	}
echo "							</tr>";
echo "							<tr>";
	# now i put the values 
	$risk_classification_list = list_risk_classification_distinct();
	foreach($risk_classification_list as $risk_classification_item) {
		# echo "Trola: $risk_classification_item[risk_classification_type] risk: $risk_data[risk_id]";
		$value = pre_selected_risk_classification_values($risk_classification_item[risk_classification_type], $risk_data[risk_id]);	
		# echo "classification: $value";
		$name = lookup_risk_classification("risk_classification_id", $value);
		echo "<td><center>$name[risk_classification_name]</td>";
	}

echo "							</tr>";
echo "						</table>";
echo "					</div>";
echo "<br>";
echo "					<div class=\"rounded\">";
echo "			<table class=\"sub-table\">";
echo "				<tr>";
echo "					<th class=\"center\">Mitigation Control</th>";
echo "					<th class=\"center\">Objective</th>";
echo "					<th class=\"center\">Status</th>";
echo "					<th class=\"center\">Audit Results</th>";
echo "				</tr>";

$security_services_for_this_risk_list = list_risk_security_services_join(" WHERE risk_security_services_join_risk_id = \"$risk_data[risk_id]\""); 
foreach($security_services_for_this_risk_list as $security_services_for_this_risk_item) {
	$security_service_data = lookup_security_services("security_services_id",$security_services_for_this_risk_item[risk_security_services_join_security_services_id]);	
	$security_services_status_name = lookup_security_services_status("security_services_status_id",$security_service_data[security_services_status]);
echo "				<tr>";
	echo "<td class=\"left\">$security_service_data[security_services_name]</td>";
	echo "<td class=\"left\">$security_service_data[security_services_objective]</td>";
	echo "<td class=\"center\">$security_services_status_name[security_services_status_name]</td>";
	echo "<td class=\"center\">TBD</td>";
echo "				</tr>";
}
echo "			</table>";
echo "					</div>";
echo "<br>";
echo "					<div class=\"rounded\">";
echo "			<table class=\"sub-table\">";
echo "				<tr>";
echo "					<th class=\"center\">Risk Exceptions</th>";
echo "					<th class=\"center\">Description</th>";
echo "					<th class=\"center\">Author</th>";
echo "				</tr>";
$risk_exception_for_this_risk_list = list_risk_risk_exception_join(" WHERE risk_risk_exception_join_risk_id = \"$risk_data[risk_id]\""); 
foreach($risk_exception_for_this_risk_list as $risk_exception_for_this_risk_item) {
	$risk_exception_data = lookup_risk_exception("risk_exception_id",$risk_exception_for_this_risk_item[risk_risk_exception_join_risk_exception_id]);	
echo "				<tr>";
	echo "<td class=\"left\">$risk_exception_data[risk_exception_title]</td>";
	echo "<td class=\"left\">$risk_exception_data[risk_exception_description]</td>";
	echo "<td class=\"center\">$risk_exception_data[risk_exception_author]</td>";
echo "				</tr>";
}
echo "			</table>";
echo "					</div>";
echo "<br>";

### INJERTO ENDS
echo "				</div>";
echo "			</li>";
	}
?>
		</ul>
		
		<br class="clear"/>
		
	</section>
