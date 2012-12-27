<?
	include_once("lib/security_incident_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url_list = build_base_url($section,"security_incident_list");
	$base_url_edit  = build_base_url($section,"security_incident_edit");
	
	# local variables - YOU MUST ADJUST THIS! 
	$security_incident_id = $_GET["security_incident_id"];
	$security_incident_owner_id = $_GET["security_incident_owner_id"];
	$security_incident_title = $_GET["security_incident_title"];
	$security_incident_open_date = $_GET["security_incident_open_date"];
	$security_incident_description = $_GET["security_incident_description"];
	$security_incident_compromised_asset_id = $_GET["security_incident_compromised_asset_id"];
	$security_incident_closure_date = $_GET["security_incident_closure_date"];
	$security_incident_classification_id = $_GET["security_incident_classification_id"];
	$security_incident_status_id = $_GET["security_incident_status_id"];
	$security_incident_disabled = $_GET["security_incident_disabled"];
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" && is_numeric($security_incident_id)) {
		$security_incident_update = array(
			'security_incident_owner_id' => $security_incident_description,
			'security_incident_title' => $security_incident_title,
			'security_incident_open_date' => $security_incident_open_date,
			'security_incident_description' => $security_incident_description,
			'security_incident_compromised_asset_id' => $security_incident_compromised_asset_id,
			'security_incident_closure_date' => $security_incident_closure_date,
			'security_incident_classification_id' => $security_incident_classification_id,
			'security_incident_status_id' => $security_incident_status_id
		);	
		update_security_incident($security_incident_update,$security_incident_id);
		add_system_records("operations","security_incident","$security_incident_id","","Update","");
	} elseif ($action == "update") {
		$security_incident_update = array(
			'security_incident_owner_id' => $security_incident_description,
			'security_incident_title' => $security_incident_title,
			'security_incident_open_date' => $security_incident_open_date,
			'security_incident_description' => $security_incident_description,
			'security_incident_compromised_asset_id' => $security_incident_compromised_asset_id,
			'security_incident_closure_date' => $security_incident_closure_date,
			'security_incident_classification_id' => $security_incident_classification_id,
			'security_incident_status_id' => $security_incident_status_id
		);	
		add_security_incident($security_incident_update);
		add_system_records("operations","security_incident","$security_incident_id","","Insert","");
	}

	if ($action == "disable") {
		disable_security_incident($security_incident_id);
		add_system_records("operations","security_incident","$security_incident_id","","Disable","");
	}

	if ($action == "csv") {
		export_security_incident_csv();
		add_system_records("operations","security_incident","$security_incident_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>

	<section id="content-wrapper">
		<h3>Security Incidents</h3>
		<span class=description>Records for all reported Security Incidents</span>
		<br>
		<br>
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url_edit&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add new Incident 
			</a>
			
			<div class="actions-wraper">
				<a href="#" class="actions-btn">
					Actions
					<span class="select-icon"></span>
				</a>
				<ul class="action-submenu">
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
if ($action == "csv") {
echo "					<li><a href=\"downloads/security_incident_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url_list&action=csv\">Export All</a></li>";
}
?>
				</ul>
			</div>
		</div>
		<br class="clear"/>
		
		<table class="main-table">
			<thead>
				<tr>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
echo "					<th><a class=\"asc\" href=\"$base_url_list&sort=security_incident_name\">Incident Title</a></th>";
echo "					<th><a href=\"$base_url_list&sort=security_incident_classification_id\">Classification</a></th>";
echo "					<th><a href=\"$base_url_list&sort=security_incident_date\">Date</a></th>";
echo "					<th><a href=\"$base_url_list&sort=security_incident_status_id\">Status</a></th>";
echo "					<th><a href=\"$base_url_list&sort=security_incident_owner_id\">Owner</a></th>";
echo "					<th><a href=\"$base_url_list&sort=security_incident_compromised_asset_id\">Compromised Asset</a></th>";
?>
				</tr>
			</thead>
	
			<tbody>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
	if ($sort == "security_incident_description" OR $sort == "security_incident_name") {
	$security_incident_list = list_security_incident(" WHERE security_incident_disabled = 0 ORDER by $sort");
	} else {
	$security_incident_list = list_security_incident(" WHERE security_incident_disabled = 0 ORDER by security_incident_open_date");
	}

	foreach($security_incident_list as $security_incident_item) {
echo "				<tr class=\"even\">";
echo "					<td class=\"action-cell\">";
echo "						<div class=\"cell-label\">";
echo "							$security_incident_item[security_incident_name]";
echo "						</div>";
echo "						<div class=\"cell-actions\">";
echo "							<a href=\"$base_url_edit&action=edit&security_incident_id=$security_incident_item[security_incident_id]\" class=\"edit-action\">edit</a> ";
echo "						&nbsp;|&nbsp;";
echo "							<a href=\"$base_url_list&action=disable&security_incident_id=$security_incident_item[security_incident_id]\" class=\"delete-action\">delete</a>";
echo "						&nbsp;|&nbsp;";
echo "							<a href=\"?section=system&subsection=system_records&system_records_lookup_section=operations&system_records_lookup_subsection=security_incident&system_records_lookup_item_id=$security_incident_item[security_incident_id]\" class=\"delete-action\">records</a>";
echo "						&nbsp;|&nbsp;";
echo "							<a href=\"?section=operations&subsection=project_improvements&system_records_lookup_section=operations&system_records_lookup_subsection=security_incident&system_records_lookup_item_id=$security_incident_item[security_incident_id]\" class=\"delete-action\">improve</a>";
echo "						</div>";
echo "					</td>";
echo "					<td>$security_incident_item[security_incident_description]</td>";
echo "				</tr>";
	}

?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
