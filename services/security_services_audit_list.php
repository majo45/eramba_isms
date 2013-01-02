<?
	include_once("lib/bu_lib.php");
	include_once("lib/process_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");
	include_once("lib/security_services_audit_lib.php");
	include_once("lib/security_services_audit_status_lib.php");
	include_once("lib/security_services_audit_calendar_lib.php");
	include_once("lib/security_services_audit_audit_result_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url_list  = build_base_url($section,"security_services_audit_list");
	$base_url_edit  = build_base_url($section,"security_services_audit_edit");
	$service_catalogue_url = build_base_url($section,"security_catalogue_list");
	
	# local variables - YOU MUST ADJUST THIS! 
	$security_services_audit_id = $_GET["security_services_audit_id"];
	$security_services_audit_status = $_GET["security_services_audit_status"];
	$security_services_audit_disabled = $_GET["security_services_audit_disabled"];
	$security_services_audit_auditor = $_GET["security_services_audit_auditor"];
	$security_services_audit_start_audit_date = $_GET["security_services_audit_start_audit_date"];
	$security_services_audit_end_audit_date = $_GET["security_services_audit_end_audit_date"];
	$security_services_audit_result = $_GET["security_services_audit_result"];
	$security_services_audit_result_description = $_GET["security_services_audit_result_description"];
	
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "change_status" & is_numeric($security_services_audit_status) & is_numeric($security_services_audit_id)) {

		# today's audit
		$today = give_me_date();		

		# if they want to close this audit, i need to make sure the audit response is there! if theres no response, then i need to set it to "Inconclusive"
		$audit_item = lookup_security_services_audit("security_services_audit_id", $security_services_audit_id);

		if (empty($audit_item[security_services_audit_result]) and $security_services_audit_status == "3") {
			$security_services_audit_result = 4;	
			$audit_end = $today;
			$audit_start = $audit_item[security_services_audit_start_audit_date];
			$status_name = lookup_security_services_audit_status("security_services_audit_status_id","3"); 	
		# if they want to close and audit which had a result choosen...
		} elseif ($security_services_audit_status == "3") {
			$audit_end = $today;
			$audit_start = $audit_item[security_services_audit_start_audit_date];
			$security_services_audit_result = $audit_item[security_services_audit_result];
			$status_name = lookup_security_services_audit_status("security_services_audit_status_id","3"); 	
		# i'm not sure why this is here...
		} elseif ($security_services_audit_status == "2") {
			$security_services_audit_result = 2;	
			$security_services_audit_result = $audit_item[security_services_audit_result];	
			$audit_start = $today;
			$audit_end = $audit_item[security_services_audit_start_audit_date];
			$status_name = lookup_security_services_audit_status("security_services_audit_status_id","2"); 	
		}

		# echo "ready to change status to: $security_services_audit_status";
		$security_services_audit_update = array(
			'security_services_audit_status' => $security_services_audit_status,
			'security_services_audit_start_audit_date' => $audit_start,
			'security_services_audit_end_audit_date' => $audit_end,
			'security_services_audit_auditor' => $audit_item[security_services_audit_auditor],
			'security_services_audit_result' => $security_services_audit_result,
			'security_services_audit_result_description' => $audit_item[security_services_audit_result_description],
		);	

		update_security_services_audit($security_services_audit_update,$security_services_audit_id);
		add_system_records("security_services","security_services_audit","$security_services_audit_id","","Review Status Changed to: $status_name[security_services_audit_status_name]","");
	}

	if ($action == "update" & is_numeric($security_services_audit_id)) {
		
		# echo "ready to change status to: $security_services_audit_status";
		$security_services_audit_update = array(
			'security_services_audit_status' => $security_services_audit_status,
			'security_services_audit_start_audit_date' => $security_services_audit_start_audit_date,
			'security_services_audit_end_audit_date' => $security_services_audit_end_audit_date,
			'security_services_audit_auditor' => $security_services_audit_auditor,
			'security_services_audit_result' => $security_services_audit_result,
			'security_services_audit_result_description' => $security_services_audit_result_description,
		);	

		update_security_services_audit($security_services_audit_update,$security_services_audit_id);
		$status_name = lookup_security_services_audit_status("security_services_audit_status_id",$audit_item[security_services_audit_status]); 	
		add_system_records("security_services","security_services_audit","$security_services_audit_id","","Evidence Addition","");
	}

	if ($action == "disable_security_services_audit" & is_numeric($security_services_audit_id)) {
		disable_security_services_audit($security_services_audit_id);
		add_system_records("security_services","security_services_audit","$security_services_audit_id","","Disable","");
	}

	if ($action == "csv") {
		export_security_services_audit_csv();
		add_system_records("security_services","security_services_audit","$security_services_audit_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>


	<section id="content-wrapper">
		<h3>Security Services Reviews</h3>
		<span class=description>It's really important to keep Security Controls well audited in order to ensure any error or deviation is spotted out. It will provide inmediate  visibility of what other components of the program might be affected (Risks, Regulators, Compliance, Etc) and give plenty of work to your team.</span>
		<br>
		<br>
	<div class="controls-wrapper">
		
			<div class="actions-wraper">
				<a href="#" class="actions-btn">
					Actions
					<span class="select-icon"></span>
				</a>
				<ul class="action-submenu">
<?
echo "					<li><a href=\"$base_url_list&sort=this_month\">This Month Audits</a></li>";
echo "					<li><a href=\"$base_url_list&sort=future_months\">Comming Audits</a></li>";
echo "					<li><a href=\"$base_url_list&sort=past_months\">Past Audits</a></li>";
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
if ($action == "csv") {
echo "					<li><a href=\"downloads/security_services_audit_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url_list&action=csv\">Export All</a></li>";
}
?>
				</ul>
			</div>
			</div>
		
		<ul id="accordion">
	
<br>
			
<?

	### ATTENTION ###
	if ($sort=="this_month" or !$sort) {

	echo "<h4>Planned Audits for this Month</h4>";

	$this_month = give_me_this_month();

	$list_of_planned_audits = list_security_services_audit_unique(" WHERE security_services_audit_disabled =\"0\" and security_services_audit_calendar_id = \"$this_month\"");

	if ( !count($list_of_planned_audits) ) { 
		echo "<span class=\"description\">Good! No planned audits for this month</span>";
	} else {
		echo "<span class=\"description\">This is the list of planned audits</span>";

	foreach($list_of_planned_audits as $planned_audit) {

			$security_service_data = lookup_security_services("security_services_id",$planned_audit[security_services_audit_security_service_id]);

echo "			<li>";
echo "				<div class=\"header\">";
echo "					Service Name: $security_service_data[security_services_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$service_catalogue_url&sort=$security_service_data[security_services_id]\">view this service</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th><center>Status</th>";
echo "							<th>Review Metric</th>";
echo "							<th>Success Criteria</th>";
echo "							<th><center>Planned Actual Start</th>";
echo "							<th><center>Actual Start</th>";
echo "							<th><center>End</th>";
echo "							<th><center>Result</th>";
echo "						</tr>";

display_html_audit_items($security_service_data[security_services_id]);

echo "					</table>";
echo "				</div>";
echo "			</li>";
	}

	}

	### ATTENTION ###
	} elseif ($sort=="future_months") {
	
	echo "<h4>Planned Audits for the Comming Months</h4>";


	$this_month = give_me_this_month();
	$three_months = 12-($this_month+1);

	$list_of_planned_audits = list_security_services_audit_unique(" WHERE security_services_audit_disabled =\"0\" and security_services_audit_calendar_id > \"$this_month\" and security_services_audit_calendar_id < \"$three_months\"");

	if ( !count($list_of_planned_audits) ) { 
		echo "<span class=\"description\">Good! No planned audits for this month</span>";
	} else {
		echo "<span class=\"description\">This is the list of planned audits</span>";

	foreach($list_of_planned_audits as $planned_audit) {
			$security_service_data = lookup_security_services("security_services_id",$planned_audit[security_services_audit_security_service_id]);

echo "			<li>";
echo "				<div class=\"header\">";
echo "					Service Name: $security_service_data[security_services_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$service_catalogue_url&sort=$security_service_data[security_services_id]\">view this service</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th><center>Status</th>";
echo "							<th>Review Metric</th>";
echo "							<th>Success Criteria</th>";
echo "							<th><center>Planned Actual Start</th>";
echo "							<th><center>Actual Start</th>";
echo "							<th><center>End</th>";
echo "							<th><center>Result</th>";
echo "						</tr>";

display_html_audit_items($security_service_data[security_services_id]);

echo "					</table>";
echo "				</div>";
echo "			</li>";
	}

	}

	### ATTENTION ###
	} elseif ($sort=="past_months") {
	
	echo "<h4>Past Audits</h4>";

	$this_month = give_me_this_month();
	$list_of_planned_audits = list_security_services_audit_unique(" WHERE security_services_audit_disabled =\"0\" and security_services_audit_calendar_id <  \"$this_month\"");

	if ( !count($list_of_planned_audits) ) { 
		echo "<span class=\"description\">Good! No planned audits for this month</span>";
	} else {
		echo "<span class=\"description\">This is the list of planned audits</span>";

	foreach($list_of_planned_audits as $planned_audit) {
			$security_service_data = lookup_security_services("security_services_id",$planned_audit[security_services_audit_security_service_id]);

echo "			<li>";
echo "				<div class=\"header\">";
echo "					Service Name: $security_service_data[security_services_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$service_catalogue_url&sort=$security_service_data[security_services_id]\">view this service</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th><center>Status</th>";
echo "							<th>Review Metric</th>";
echo "							<th>Success Criteria</th>";
echo "							<th><center>Planned Actual Start</th>";
echo "							<th><center>Actual Start</th>";
echo "							<th><center>End</th>";
echo "							<th><center>Result</center></th>";
echo "						</tr>";

display_html_audit_items($security_service_data[security_services_id]);

echo "					</table>";
echo "				</div>";
echo "			</li>";
	}

	}

	} else {
	}
	
?>

