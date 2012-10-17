<?
	include_once("lib/legal_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$legal_id = $_GET["legal_id"];
	$legal_name = $_GET["legal_name"];
	$legal_description = $_GET["legal_description"];
	$legal_disabled = $_GET["legal_disabled"];
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($legal_id)) {
		$legal_update = array(
			'legal_name' => $legal_name,
			'legal_description' => $legal_description
		);	
		update_legal($legal_update,$legal_id);
		add_system_records("organization","legal","$legal_id","","Update","");
	} elseif ($action == "update") {
		$legal_update = array(
			'legal_name' => $legal_name,
			'legal_description' => $legal_description
		);	
		add_legal($legal_update);
		add_system_records("organization","legal","$legal_id","","Insert","");
	}

	if ($action == "disable") {
		disable_legal($legal_id);
		add_system_records("organization","legal","$legal_id","","Disable","");
	}

	if ($action == "csv") {
		export_legal_csv();
		add_system_records("organization","legal","$legal_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>

	<section id="content-wrapper">
		<h3>Legal Constrains</h3>
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add new Legal
			</a>
			
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
echo "					<li><a href=\"downloads/legal_export.csv\">Dowload</a></li>";
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
					<th class="col-center"><input type="checkbox" name="check-all" class="checkAll" /></th>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
echo "					<th><a class=\"asc\" href=\"$base_url&sort=legal_name\">Legal name</a></th>";
?>
<?
echo "					<th><a href=\"$base_url&sort=legal_description\">Description</a></th>";
?>
				</tr>
			</thead>
	
			<tbody>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
	if ($sort == "legal_description" OR $sort == "legal_name") {
	$legal_list = list_legal(" WHERE legal_disabled = 0 ORDER by $sort");
	} else {
	$legal_list = list_legal(" WHERE legal_disabled = 0 ORDER by legal_name");
	}

	foreach($legal_list as $legal_item) {
echo "				<tr class=\"even\">";
echo "					<td class=\"col-center\"><input type=\"checkbox\" name=\"action\" class=\"check-elem\"/></td>";
echo "					<td class=\"action-cell\">";
echo "						<div class=\"cell-label\">";
echo "							$legal_item[legal_name]";
echo "						</div>";
echo "						<div class=\"cell-actions\">";
echo "							<a href=\"$base_url&action=edit&legal_id=$legal_item[legal_id]\" class=\"edit-action\">edit</a> ";
echo "							<a href=\"$base_url&action=disable&legal_id=$legal_item[legal_id]\" class=\"delete-action\">delete</a>";
echo "							<a href=\"?section=system&subsection=system_records&system_records_lookup_section=organization&system_records_lookup_subsection=legal&system_records_lookup_item_id=$legal_item[legal_id]\" class=\"edit-action delete-action\">records</a>";
echo "							<a href=\"?section=system&action=edit&subsection=system_records&system_records_lookup_section=organization&system_records_lookup_subsection=legal&system_records_lookup_item_id=$legal_item[legal_id]\" class=\"delete-action\">add notes</a>";
echo "						</div>";
echo "					</td>";
echo "					<td>$legal_item[legal_description]</td>";
echo "				</tr>";
	}

?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
