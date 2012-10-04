<?
	include_once("lib/system_records_lib.php");
	include_once("lib/site_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$system_records_id = $_GET["system_records_id"];
	$system_records_name = $_GET["system_records_name"];
	$system_records_description = $_GET["system_records_description"];
	$system_records_disabled = $_GET["system_records_disabled"];


	# this will get called often ...
	# if i have any of this items, then i need to show that! .. there might be a need to add
	$system_records_lookup_section = $_GET["system_records_lookup_section"];
	$system_records_lookup_subsection = $_GET["system_records_lookup_subsection"];
	$system_records_lookup_item_id = $_GET["system_records_lookup_item_id"];
	$system_records_lookup_action = $_GET["system_records_lookup_action"];
	$system_records_lookup_author = $_GET["system_records_lookup_author"];
	$system_records_notes = $_GET["system_records_notes"];

	# if i have all this values, then i can search for something specific ...
	if (!empty($system_records_lookup_section) AND !empty($system_records_lookup_subsection) AND !empty($system_records_lookup_item_id)) {
		$specific_query = " WHERE system_records_section=\"$system_records_lookup_section\" AND system_records_subsection=\"$system_records_lookup_subsection\" AND system_records_item_id=\"$system_records_lookup_item_id\"";
	} 
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($system_records_lookup_action == "add_note") {
		add_system_records($system_records_lookup_section, $system_records_lookup_subsection, $system_records_lookup_item_id, $system_records_lookup_author, "Note", $system_records_notes);
	}

	if ($action == "csv") {
		export_system_records_csv();
	}
	# ---- END TEMPLATE ------

?>

	<section id="content-wrapper">
		<h3>System Records</h3>
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add a New Note	
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
echo "					<li><a href=\"downloads/system_records_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url&action=csv\">Export All</a></li>";
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
echo "					<th><a href=\"$base_url&sort=system_records_date\">When</a></th>";
echo "					<th><a href=\"$base_url&sort=system_records_action\">What</a></th>";
echo "					<th><a href=\"$base_url&sort=system_records_section\">To Whom</a></th>";
echo "					<th><a href=\"$base_url&sort=system_records_author\">By whom</a></th>";
echo "					<th><a href=\"$base_url&sort=NULL\"></a>Notes</th>";
?>
				</tr>
			</thead>
	
			<tbody>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
	if ($sort == "system_records_description" OR $sort == "system_records_section" OR $sort == "system_records_action" OR $sort == "system_records_author") {
	$system_records_list = list_system_records(" $speficic_query ORDER by $sort");
	} else {
	$system_records_list = list_system_records(" $specific_query ORDER by system_records_date DESC");
	}

	foreach($system_records_list as $system_records_item) {
echo "				<tr class=\"even\">";
echo "					<td>$system_records_item[system_records_date]</td>";
echo "					<td>$system_records_item[system_records_action]</td>";
echo "					<td>$system_records_item[system_records_section] / $system_records_item[system_records_subsection] / #$system_records_item[system_records_item_id]</td>";
echo "					<td>$system_records_item[system_records_author]</td>";
echo "					<td>$system_records_item[system_records_notes]</td>";
echo "				</tr>";
	}

?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
