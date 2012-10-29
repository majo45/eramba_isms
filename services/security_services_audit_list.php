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
	
	$base_url = build_base_url($section,$subsection);
	$service_catalogue_url = build_base_url($section,"security_catalogue");
	
	# local variables - YOU MUST ADJUST THIS! 
	$bu_id = $_GET["bu_id"];
	$bu_name = $_GET["bu_name"];
	$bu_description = $_GET["bu_description"];
	$bu_disabled = $_GET["bu_disabled"];
	
	$process_id = $_GET["process_id"];
	$process_name = $_GET["process_name"];
	$process_description = $_GET["process_description"];
	$process_rto = $_GET["process_rto"];
	if (!is_numeric($process_rto)) {
		$process_rto = 360;
	}
	$process_disabled = $_GET["process_disabled"];


	# PROCEDURE
	# store_procedure_generate_security_services_audit();
	
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update_security_services_audit" & is_numeric($bu_id)) {
		$bu_update = array(
			'bu_name' => $bu_name,
			'bu_description' => $bu_description
		);	
		update_security_services_audit($bu_update,$bu_id);
		add_system_records("organization","bu","$bu_id","","Update","");
	} elseif ($action == "update_security_services_audit") {
		$bu_update = array(
			'bu_name' => $bu_name,
			'bu_description' => $bu_description
		);	
		add_security_services_audit($bu_update);
		add_system_records("organization","bu","$bu_id","","Insert","");
	 }

	if ($action == "update_process" & is_numeric($process_id)) {
		$process_update = array(
			'process_name' => $process_name,
			'bu_id' => $bu_id,
			'process_description' => $process_description,
			'process_rto' => $process_rto
		);	
		update_process($process_update,$process_id);
		add_system_records("organization","bu-process","$process_id","","Update","");
	} elseif ($action == "update_process") {
		$process_update = array(
			'process_name' => $process_name,
			'bu_id' => $bu_id,
			'process_description' => $process_description,
			'process_rto' => $process_rto
		);	
		add_process($process_update);
		add_system_records("organization","bu-process","$process_id","","Insert","");
	}


	if ($action == "disable_security_services_audit" & is_numeric($bu_id)) {
		disable_security_services_audit($bu_id);
		add_system_records("organization","bu","$bu_id","","Disable","");
	}
	if ($action == "disable_process" & is_numeric($process_id)) {
		disable_process($process_id);
		add_system_records("organization","bu-process","$process_id","","Disable","");
	}

	if ($action == "csv") {
		export_security_services_audit_csv();
		add_system_records("organization","bu","","","Export","");
	}

	# ---- END TEMPLATE ------

?>


	<section id="content-wrapper">
		<h3>Security Services Reviews</h3>
		
			<div class="actions-wraper">
				<a href="#" class="actions-btn">
					Actions
					<span class="select-icon"></span>
				</a>
				<ul class="action-submenu">
<?
echo "					<li><a href=\"$base_url&sort=this_month\">This Month Audits</a></li>";
echo "					<li><a href=\"$base_url&sort=future_months\">Comming Audits</a></li>";
echo "					<li><a href=\"$base_url&sort=past_months\">Past Audits</a></li>";
?>
				</ul>
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
	$this_month++;
	$three_months = $this_month+3;

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
	echo "end";
	}
	
?>

