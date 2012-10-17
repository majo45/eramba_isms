<?
	include_once("lib/risk_exception_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$risk_exception_id = $_GET["risk_exception_id"];
	$risk_exception_title = $_GET["risk_exception_title"];
	$risk_exception_description = $_GET["risk_exception_description"];
	$risk_exception_author = $_GET["risk_exception_author"];
	$risk_exception_status = $_GET["risk_exception_status"];

	$risk_exception_disabled = $_GET["risk_exception_disabled"];
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($risk_exception_id)) {
		$risk_exception_update = array(
			'risk_exception_title' => $risk_exception_title,
			'risk_exception_description' => $risk_exception_description,
			'risk_exception_author' => $risk_exception_author,
			'risk_exception_status' => $risk_exception_status
		);	
		update_risk_exception($risk_exception_update,$risk_exception_id);
		add_system_records("risk","risk_exception","$risk_exception_id","","Update","");
	} elseif ($action == "update") {
		$risk_exception_update = array(
			'risk_exception_title' => $risk_exception_title,
			'risk_exception_description' => $risk_exception_description,
			'risk_exception_author' => $risk_exception_author,
			'risk_exception_status' => $risk_exception_status
		);	
		add_risk_exception($risk_exception_update);
		add_system_records("risk","risk_exception","$risk_exception_id","","Insert","");
	}

	if ($action == "disable") {
		disable_risk_exception($risk_exception_id);
		add_system_records("risk","risk_exception","$risk_exception_id","","Disable","");
	}

	if ($action == "csv") {
		export_risk_exception_csv();
		add_system_records("risk","risk_exception","$risk_exception_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>

	<section id="content-wrapper">
		<h3>Risk Exception Management</h3>
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add a new Risk Exception 
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
echo "					<li><a href=\"downloads/risk_exception_export.csv\">Dowload</a></li>";
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
echo "					<th><a class=\"asc\" href=\"$base_url&sort=risk_exception_title\">Risk Exception Title</a></th>";
echo "					<th><a href=\"$base_url&sort=risk_exception_description\">Description</a></th>";
echo "					<th><center><a href=\"$base_url&sort=risk_exception_author\">Author</a></th>";
# echo "					<th><center><a href=\"$base_url&sort=risk_exception_status\">Status</a></th>";
?>
				</tr>
			</thead>
	
			<tbody>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
	if ($sort == "risk_exception_title" OR $sort == "risk_exception_description" OR $sort == "risk_exception_author" OR $sort == "risk_exception_status") {
	$risk_exception_list = list_risk_exception(" WHERE risk_exception_disabled = 0 ORDER by $sort");
	} else {
	$risk_exception_list = list_risk_exception(" WHERE risk_exception_disabled = 0 ORDER by risk_exception_title");
	}

	foreach($risk_exception_list as $risk_exception_item) {
echo "				<tr class=\"even\">";
echo "					<td class=\"col-center\"><input type=\"checkbox\" name=\"action\" class=\"check-elem\"/></td>";
echo "					<td class=\"action-cell\">";
echo "						<div class=\"cell-label\">";
echo "							$risk_exception_item[risk_exception_title]";
echo "						</div>";
echo "						<div class=\"cell-actions\">";
echo "					<a href=\"$base_url&action=edit&risk_exception_id=$risk_exception_item[risk_exception_id]\" class=\"edit-action\">edit</a> ";
echo "					<a href=\"$base_url&action=disable&risk_exception_id=$risk_exception_item[risk_exception_id]\" class=\"delete-action\">delete</a>";
echo "					<a href=\"?section=system&subsection=system_records&system_records_lookup_section=risk&system_records_lookup_subsection=risk_exception&system_records_lookup_item_id=$risk_exception_item[risk_exception_id]\" class=\"edit-action delete-action\">records</a>";
echo "					<a href=\"?action=edit&section=system&subsection=system_records&system_records_lookup_section=risk&system_records_lookup_subsection=risk_exception&system_records_lookup_item_id=$risk_exception_item[risk_exception_id]\" class=\"delete-action\">add a note</a>";
echo "						</div>";
echo "					</td>";
echo "					<td>$risk_exception_item[risk_exception_description]</td>";
echo "					<td><center>$risk_exception_item[risk_exception_author]</td>";
# echo "					<td><center>$risk_exception_item[risk_exception_status]</td>";
echo "				</tr>";
	}

?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
