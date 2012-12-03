<?
	include_once("lib/tp_lib.php");
	include_once("lib/tp_type_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");
	include_once("lib/compliance_package_lib.php");
	include_once("lib/compliance_package_item_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$tp_id = $_GET["tp_id"];
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($tp_id)) {
		$tp_update = array(
			'tp_name' => $tp_name,
			'tp_description' => $tp_description,
			'tp_type_id' => $tp_type_id
		);	
		update_tp($tp_update,$tp_id);
		add_system_records("organization","tp","$tp_id","","Update","");
	} elseif ($action == "update") {
		$tp_update = array(
			'tp_name' => $tp_name,
			'tp_description' => $tp_description,
			'tp_type_id' => $tp_type_id
		);	
		$tp_id = add_tp($tp_update);
		add_system_records("organization","tp","$tp_id","","Insert","");
	}

	if ($action == "disable") {
		disable_tp($tp_id);
		add_system_records("organization","tp","$tp_id","","Disable","");
	}

	if ($action == "csv") {
		export_tp_csv();
		add_system_records("organization","tp","$tp_id","","Export","");
	}

	# ---- END TEMPLATE ------

	$tp_item = lookup_tp("tp_id", $tp_id);

?>

	<section id="content-wrapper">
	<?
		echo "<h3>Compliance Management: $tp_item[tp_name]</h3>";
	?>
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
echo "					<li><a href=\"downloads/tp_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url&action=csv\">Export</a></li>";
}
?>
				</ul>
			</div>
		</div>
		<br class="clear"/>

<?
	$compliance_package_list = list_compliance_package(" WHERE compliance_package_tp_id = \"$tp_id\" AND compliance_package_disabled = \"0\"");
	
	foreach($compliance_package_list as $compliance_package_item) {
		
echo "	<table class=\"main-table\">";
echo "	<th><a href=\"$base_url&sort=tp_description\">$compliance_package_item[compliance_package_original_id] - $compliance_package_item[compliance_package_name] ($compliance_package_item[compliance_package_description])</a></th>";
echo " </table>";

	$compliance_package_item_list = list_compliance_package_item(" WHERE compliance_package_id = \"$compliance_package_item[compliance_package_id]\" 
	AND compliance_package_item_disabled = \"0\"
									");
	if ( count($compliance_package_item_list) != 0 ) {

echo "	<table class=\"main-table\">";
echo "			<thead>";
echo "				<tr>";
echo "					<th><a class=\"asc\" href=\"$base_url&sort=tp_name\">Item Name & Id</a></th>";
echo "					<th><a class=\"asc\" href=\"$base_url&sort=tp_name\">Item Description</a></th>";
echo "					<th><a href=\"$base_url&sort=tp_description\">Response</a></th>";
echo "					<th><a href=\"$base_url&sort=tp_description\">Compensating Controls</a></th>";
echo "					<th><a href=\"$base_url&sort=tp_type_id\"><center>Regulator Status</center></a></th>";
echo "				</tr>";
echo "			</thead>";
echo "			<tbody>";
			
		foreach($compliance_package_item_list as $compliance_package_item_item) {

echo "	<tr class=\"even\">";
echo "		<td class=\"action-cell\">";
echo "			<div class=\"cell-label\">";
echo "			$compliance_package_item_item[compliance_package_item_original_id] - $compliance_package_item_item[compliance_package_item_name]";
echo "			</div>";
echo "			<div class=\"cell-actions\">";
echo "			<a href=\"$base_url&action=edit&compliance_package_item=$compliance_package_item_item[compliance_package_item_id]\" class=\"edit-action\">edit</a> ";
echo "			&nbsp;|&nbsp;";
echo "			<a href=\"?section=system&subsection=system_records&system_records_lookup_section=compliance&system_records_lookup_subsection=compliance_management&system_records_lookup_item_id=$compliance_package_item_item[compliance_package_item_name]\" class=\"delete-action\">records</a>";
echo "			&nbsp;|&nbsp;";
echo "			<a href=\"?section=system&subsection=system_records&system_records_lookup_section=organization&system_records_lookup_subsection=tp&system_records_lookup_item_id=$tp_item[tp_id]\" class=\"delete-action\">improve</a>";
echo "			</div>";
echo "		</td>";
echo "			<td>$compliance_package_item_item[compliance_package_item_description]</td>";
echo "			<td></td>";
echo "			<td></td>";
echo "			<td></td>";
echo "		</tr>";

		}

	}
	}
?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
