<?
	include_once("lib/site_lib.php");
	include_once("lib/system_users_lib.php");
	include_once("lib/project_improvements_lib.php");
	include_once("lib/project_improvements_status_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$asset_id = $_GET["asset_id"];
	$project_improvements_id = $_GET["project_improvements_id"];

	$project_improvements_mitigation_strategy_id = $_GET["project_improvements_mitigation_strategy_id"];
	$security_services_id = $_GET["security_services_id"];
	$project_improvements_exception_id = $_GET["project_improvements_exception_id"];

	$project_improvements_periodicity_review = $_GET["project_improvements_periodicity_review"];
	if (!is_numeric($project_improvements_periodicity_review) OR $project_improvements_periodicity_review>12 OR $project_improvements_periodicity_review<0) {
		$project_improvements_periodicity_review = 12;
	}
	$project_improvements_residual_score = $_GET["project_improvements_residual_score"];
	if (!is_numeric($project_improvements_residual_score)) {
		$project_improvements_residual_score = $project_improvements_classification_score;
	}

	$security_services_id = $_GET["security_services_id"];
	$project_improvements_exception_id = $_GET["project_improvements_exception_id"];
	
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($project_improvements_id)) {
		$project_improvements_update = array(
			'project_improvements_title' => $project_improvements_title,
			'project_improvements_goal' => $project_improvements_goal,
			'project_improvements_start' => $project_improvements_start,
			'project_improvements_deadline' => $project_improvements_deadline,
			'project_improvements_deadline' => $project_improvements_deadline,
			'project_improvements_status_id' => $project_improvements_status_id,
			'project_improvements_owner_id' => $project_improvements_owner_id
		);	
		update_project_improvements($project_improvements_update,$project_improvements_id);
		add_system_records("operations","project_improvements","$project_improvements_id","","Update","");


	} elseif ($action == "update" & !empty($asset_id)) {

		$project_improvements_update = array(
			'project_improvements_title' => $project_improvements_title,
			'project_improvements_goal' => $project_improvements_goal,
			'project_improvements_start' => $project_improvements_start,
			'project_improvements_end' => $project_improvements_end,
			'project_improvements_deadline' => $project_improvements_deadline,
			'project_improvements_status_id' => $project_improvements_status_id,
			'project_improvements_owner_id' => $project_improvements_owner_id
		);	

		$id = add_project_improvements_asset_join($project_improvements_asset_join_update);
		add_system_records("operations","project_improvements","$id","","Insert","");
		
	 }

	if ($action == "disable" & is_numeric($project_improvements_id)) {
		disable_project_improvements($project_improvements_id);
		add_system_records("operations","project_improvements","$project_improvements_id","","Disable","");
	}

	if ($action == "csv") {
		export_project_improvements_csv();
		add_system_records("operations","project_improvements","$project_improvements_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>


	<section id="content-wrapper">
		<h3>Project Management</h3>
		<span class=description>Manage your projects priorities, assignations, etc.</span>
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
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
if ($action == "csv") {
echo "					<li><a href=\"downloads/project_improvements_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url&action=list&sort=1\">Just an Idea Projects</a></li>";
echo "					<li><a href=\"$base_url&action=list&sort=2\">On-Going Projects</a></li>";
echo "					<li><a href=\"$base_url&action=list&sort=3\">Completed Projects</a></li>";
echo "					<li><a href=\"$base_url&action=csv\">Export All</a></li>";
}
?>
				</ul>
			</div>

		</div>
			
		
		<ul id="accordion">

	<br>
	<span class=description>On-going Projects</span>
	<br>
			
<?
	if ($sort) {
		$project_improvements_list = list_project_improvements(" WHERE project_improvements_disabled=\"0\" AND project_improvements_status_id =\"$sort\"");
	} else {
		$project_improvements_list = list_project_improvements(" WHERE project_improvements_disabled=\"0\" AND project_improvements_status_id =\"2\"");
	}

	foreach($project_improvements_list as $project_improvements_item) {

echo "			<li>";
echo "				<div class=\"header\">";
echo "					$project_improvements_item[project_improvements_title]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$base_url&action=edit&project_improvements_id=$project_improvements_item[project_improvements_id]\">edit</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?section=system&subsection=system_records&system_records_lookup_section=project_improvements&system_records_lookup_subsection=project_improvements_management&system_records_lookup_item_id=$project_improvements_item[project_improvements_id]\">records</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"edit\" href=\"$base_url&action=disable&project_improvements_id=$project_improvements_item[project_improvements_id]\">delete</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th class=\"center\">Status</th>";
echo "							<th class=\"center\">Start</th>";
echo "							<th class=\"center\">Planned End</th>";
echo "							<th class=\"center\">Owner</th>";
echo "							<th class=\"center\">Origin</th>";
echo "						</tr>";

echo "						<tr>";
				$status_item = lookup_project_improvements_status("project_improvements_status_id",$project_improvements_item[project_improvements_status_id]);
echo "							<td><center>$status_item[project_improvements_status_name]</td>";
echo "							<td><center>$project_improvements_item[project_improvements_start]</td>";
echo "							<td><center>$project_improvements_item[project_improvements_deadline]</td>";
				$owner_item = lookup_system_users("system_users_id",$project_improvements_item[project_improvements_owner_id]);
echo "							<td><center>$owner_item[system_users_name]</td>";
echo "							<td><center></td>";
echo "						</tr>";
	#}
echo "					</table>";
echo "<br>";
echo "					<div class=\"rounded\">";
echo "						<table class=\"sub-table\">";
echo "							<tr>";
echo "							</tr>";
echo " 					<th>Project Goal</th>";
echo "							<tr>";
echo " 					<td>$project_improvements_item[project_improvements_goal]</td>";
echo "							</tr>";
echo "						</table>";
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
