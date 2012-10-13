<?
	include_once("lib/bu_lib.php");
	include_once("lib/process_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
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
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update_bu" & is_numeric($bu_id)) {
		$bu_update = array(
			'bu_name' => $bu_name,
			'bu_description' => $bu_description
		);	
		update_bu($bu_update,$bu_id);
		add_system_records("organization","bu","$bu_id","","Update","");
	} elseif ($action == "update_bu") {
		$bu_update = array(
			'bu_name' => $bu_name,
			'bu_description' => $bu_description
		);	
		add_bu($bu_update);
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


	if ($action == "disable_bu" & is_numeric($bu_id)) {
		disable_bu($bu_id);
		add_system_records("organization","bu","$bu_id","","Disable","");
	}
	if ($action == "disable_process" & is_numeric($process_id)) {
		disable_process($process_id);
		add_system_records("organization","bu-process","$process_id","","Disable","");
	}

	if ($action == "csv") {
		export_bu_csv();
		add_system_records("organization","bu","","","Export","");
	}

	# ---- END TEMPLATE ------

?>


	<section id="content-wrapper">
		<h3>Security Audit Reviews</h3>
		
		<div class="controls-wrapper">
			<a href="#" class="actions-btn">
				Actions
				<span class="select-icon"></span>
			</a>
		</div>
		
		<ul id="accordion">
			
<?
	$bu_list = list_bu(" WHERE bu_disabled=\"0\"");
	foreach($bu_list as $bu_item) {
echo "			<li>";
echo "				<div class=\"header\">";
echo "					Business Unit: $bu_item[bu_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$base_url&action=edit_bu&bu_id=$bu_item[bu_id]\">edit</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"$base_url&action=disable_bu&bu_id=$bu_item[bu_id]\">delete</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"$base_url&action=edit_process&bu_id=$bu_item[bu_id]\">Add New Business Process Here</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?section=system&subsection=system_records&system_records_lookup_section=organization&system_records_lookup_subsection=bu&system_records_lookup_item_id=$bu_item[bu_id]\">records</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?section=system&subsection=system_records&action=edit&system_records_lookup_section=organization&system_records_lookup_subsection=bu&system_records_lookup_item_id=$bu_item[bu_id]\">add a note</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th><center><input type=\"checkbox\" name=\"check-all\" class=\"checkAll\" /></th>";
echo "							<th>Process Name</th>";
echo "							<th>Description</th>";
echo "							<th><center>RTO</th>";
echo "						</tr>";

	$process_list = list_process(" WHERE bu_id = $bu_item[bu_id] AND process_disabled = \"0\"");
	foreach($process_list as $process_item) {
echo "						<tr>";
echo "							<td><center><input type=\"checkbox\" name=\"action\" class=\"check-elem\"/></td>";
echo "							<td class=\"action-cell\">";
echo "								<div class=\"cell-label\">";
echo "								 	$process_item[process_name]";
echo "								</div>";
echo "								<div class=\"cell-actions\">";
echo "							<a href=\"$base_url&action=edit_process&process_id=$process_item[process_id]&bu_id=$bu_item[bu_id]\" class=\"edit-action\">edit</a> ";
echo "							<a href=\"$base_url&action=disable_process&process_id=$process_item[process_id]\" class=\"delete-action\">delete</a>";
echo "							<a href=\"?section=system&subsection=system_records&system_records_lookup_section=organization&system_records_lookup_subsection=bu-process&system_records_lookup_item_id=$process_item[process_id]\" class=\"delete-action\">records</a>";
echo "							<a href=\"?section=system&subsection=system_records&action=edit&system_records_lookup_section=organization&system_records_lookup_subsection=bu-process&system_records_lookup_item_id=$process_item[process_id]\" class=\"delete-action\">add a note</a>";

echo "								</div>";
echo "							</td>";
echo "							<td>$process_item[process_description]</td>";
echo "							<td><center>$process_item[process_rto] Days</td>";
echo "						</tr>";
	}

echo "					</table>";
echo "				</div>";
echo "			</li>";
	}
?>
		</ul>
		
		<br class="clear"/>
		
	</section>
