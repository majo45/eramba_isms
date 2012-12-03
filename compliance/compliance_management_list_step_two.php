<?
	include_once("lib/tp_lib.php");
	include_once("lib/tp_type_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");
	include_once("lib/compliance_management_lib.php");
	include_once("lib/compliance_package_lib.php");
	include_once("lib/compliance_package_item_lib.php");
	include_once("lib/compliance_response_strategy_lib.php");
	include_once("lib/compliance_status_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$tp_id = $_GET["tp_id"];
	$compliance_management_item_id = $_GET["compliance_management_item_id"];
	$compliance_management_id = $_GET["compliance_management_id"];
	$compliance_management_response_id = $_GET["compliance_management_response_id"];
	$compliance_management_status_id = $_GET["compliance_management_status_id"];
	$compliance_security_services_join_security_services_id = $_GET["compliance_security_services_join_security_services_id"];

	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($compliance_management_id)) {
		$compliance_management_update = array(
			'compliance_management_response_id' => $compliance_management_response_id,
			'compliance_management_status_id' => $compliance_management_status_id
		);	
		update_compliance_management($compliance_management_update,$compliance_management_id);
		add_system_records("compliance","compliance_management","$compliance_management_id","","Update","");
	} elseif ($action == "update") {
		$compliance_management_update = array(
			'compliance_management_item_id' => $compliance_management_item_id,
			'compliance_management_response_id' => $compliance_management_response_id,
			'compliance_management_status_id' => $compliance_management_status_id
		);	
		$compliance_management_id = add_compliance_management($compliance_management_update);
		add_system_records("compliance","compliance_management","$compliance_management_id","","Insert","");
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
echo "	<th>$compliance_package_item[compliance_package_original_id] - $compliance_package_item[compliance_package_name] ($compliance_package_item[compliance_package_description])</th>";
echo " </table>";

	$compliance_package_item_list = list_compliance_package_item(" WHERE compliance_package_id = \"$compliance_package_item[compliance_package_id]\" 
	AND compliance_package_item_disabled = \"0\"
									");
	if ( count($compliance_package_item_list) != 0 ) {

echo "	<table class=\"main-table\">";
echo "			<thead>";
echo "				<tr>";
echo "					<th>Item Name & Id</th>";
echo "					<th>Item Description</th>";
echo "					<th>Response</th>";
echo "					<th>Compensating Controls</a></th>";
echo "					<th><center>Regulator Status</center></a></th>";
echo "				</tr>";
echo "			</thead>";
echo "			<tbody>";
			
		foreach($compliance_package_item_list as $compliance_package_item_item) {
	
		# load the ocmpliance_management_item data
		$compliance_management_item = lookup_compliance_management("compliance_management_item_id", $compliance_package_item_item[compliance_package_item_id]);
		$lookup_response_id = lookup_compliance_response_strategy("compliance_response_strategy_id",$compliance_management_item[compliance_management_response_id]);
		$lookup_status_id = lookup_compliance_status("compliance_status_id",$compliance_management_item[compliance_management_status_id]);

echo "	<tr class=\"even\">";
echo "		<td class=\"action-cell\">";
echo "			<div class=\"cell-label\">";
echo "			$compliance_package_item_item[compliance_package_item_original_id] - $compliance_package_item_item[compliance_package_item_name]";
echo "			</div>";
echo "			<div class=\"cell-actions\">";
echo "			<a href=\"$base_url&action=edit&tp_id=$tp_id&compliance_package_item=$compliance_package_item_item[compliance_package_item_id]\" class=\"edit-action\">edit</a> ";
echo "			&nbsp;|&nbsp;";
echo "			<a href=\"?section=system&subsection=system_records&system_records_lookup_section=compliance&system_records_lookup_subsection=compliance_management&system_records_lookup_item_id=$compliance_package_item_item[compliance_package_item_name]\" class=\"delete-action\">records</a>";
echo "			&nbsp;|&nbsp;";
echo "			<a href=\"?section=system&subsection=system_records&system_records_lookup_section=organization&system_records_lookup_subsection=tp&system_records_lookup_item_id=$tp_item[tp_id]\" class=\"delete-action\">improve</a>";
echo "			</div>";
echo "		</td>";
echo "			<td>$compliance_package_item_item[compliance_package_item_description]</td>";
echo "			<td>$lookup_response_id[compliance_response_strategy_name]</td>";
echo "			<td></td>";
echo "			<td>$lookup_status_id[compliance_status_name]</td>";
echo "		</tr>";

		}

	}
	}
?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
