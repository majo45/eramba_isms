<?
	include_once("lib/tp_lib.php");
	include_once("lib/compliance_package_lib.php");
	include_once("lib/tp_type_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	$tp_url = build_base_url("organization","tp");
	
	# local variables - YOU MUST ADJUST THIS! 
	$tp_id = $_GET["tp_id"];
	$tp_name = $_GET["tp_name"];
	$tp_description = $_GET["tp_description"];
	$tp_type_id = $_GET["tp_type_id"];
	$tp_disabled = $_GET["tp_disabled"];
	 
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

?>

	<section id="content-wrapper">
		<h3>Compliance Package Database</h3>
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add new Third Party 
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
echo "					<li><a href=\"downloads/tp_export.csv\">Dowload</a></li>";
} else { 
echo "					<li><a href=\"$base_url&action=csv\">Export All</a></li>";
}
?>
				</ul>
			</div>
		</div>
		
		<ul id="accordion">
<?
		$compliance_package_provider_name_list = list_compliance_package_unique();

		foreach($compliance_package_provider_name_list as $compliance_package_provider_name_item) {

			$provider_id = lookup_tp("tp_id",$compliance_package_provider_name_item[compliance_package_tp_id]);

echo "			<li>";
echo "				<div class=\"header\">";
echo "					1. Regulator or Compliance Authority: $provider_id[tp_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$tp_url&sort=$provider_id[tp_id]\">view this third party regulator</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"edit\" href=\"$base_url&service_contracts_id=$tp_item[tp_id]&action=edit_service_contracts\">add a new compliance package</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "";
echo "				<div class=\"content table\">";
echo "";

			$compliance_package_list = list_compliance_package(" WHERE compliance_package_tp_id = \"$compliance_package_provider_name_item[compliance_package_tp_id]\" 
									AND compliance_package_original_id IS NOT NULL
									AND compliance_package_item_id IS NULL
									");

			foreach($compliance_package_list as $compliance_package_item) {

echo "					<table>";
echo "						<tr>";
echo "							<th><center>Package ID</th>";
echo "							<th>Compliance package name</th>";
echo "							<th>Description</th>";
echo "						</tr>";
echo "";
echo "						<tr>";
echo "							<td class=\"center\">$compliance_package_item[compliance_package_original_id]</td>";
echo "							<td class=\"action-cell\">";
echo "								<div class=\"cell-label\">";
echo "									$compliance_package_item[compliance_package_name]";
echo "								</div>";
echo "								<div class=\"cell-actions\">";
echo "	<a href=\"$base_url&action=compliance_package_original_id&compliance_package_id=$compliance_package_item[compliance_package_id]\" class=\"edit_action\">edit</a> ";
echo "						&nbsp;|&nbsp;";
echo "	<a href=\"$base_url&action=compliance_package_original_id&compliance_package_id=$compliance_package_item[compliance_package_id]\" class=\"delete_action\">delete</a>";
echo "						&nbsp;|&nbsp;";
echo "	<a href=\"$base_url&action=compliance_package_original_id&compliance_package_id=$compliance_package_item[compliance_package_id]\" class=\"delete_action\">add compliance package item</a>";
echo "								</div>";
echo "							</td>";
echo "							<td>$compliance_package_item[compliance_package_text]</td>";
echo "						</tr>";
echo "";
echo "					</table>";
echo "";
echo "					<div class=\"rounded\">";

			$compliance_package_item_list = list_compliance_package(" WHERE compliance_package_tp_id = \"$compliance_package_provider_name_item[compliance_package_tp_id]\" 
									AND compliance_package_original_id = \"$compliance_package_item[compliance_package_original_id]\" 
									AND compliance_package_item_id IS NOT NULL
									");
	
			if ( count($compliance_package_item_list) != 0 ) {
					
echo "						<table class=\"sub-table\">";
echo "							<tr>";
echo "								<th><center>Item ID</th>";
echo "								<th>Item name</th>";
echo "								<th>Item description</th>";
echo "							</tr>";

			foreach($compliance_package_item_list as $compliance_package_item_item) {
			

echo "							<tr>";
echo "								<td class=\"center\">$compliance_package_item_item[compliance_package_item_id]</td>";
echo "								<td class=\"action-cell\">";
echo "									<div class=\"cell-label\">";
echo "										$compliance_package_item_item[compliance_package_item_name]";
echo "									</div>";
echo "									<div class=\"cell-actions\">";
echo "										<a href=\"$base_url&action=edit_compliance_package_item_item&compliance_package_id=\" class=\"edit-action\">edit</a> ";
echo "										<a href=\"$base_url&action=edit_compliance_package_item_item&compliance_package_id=\" class=\"delete-action\">delete</a>";
echo "									</div>";
echo "								</td>";
echo "								<td>$compliance_package_item_item[compliance_package_item_description]</td>";
echo "							</tr>";
			}

echo "						</table>";
			}
echo "					</div>				";

					}

echo "				</div>";
echo "			</li>";
			
			}
?>
		</ul>
		
		<br class="clear"/>
		
	</section>
</body>
</html>
