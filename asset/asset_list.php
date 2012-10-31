<?
	include_once("lib/bu_lib.php");
	include_once("lib/asset_lib.php");
	include_once("lib/legal_lib.php");
	include_once("lib/asset_classification_lib.php");
	include_once("lib/asset_type_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$asset_id = $_GET["asset_id"];
	$asset_name = $_GET["asset_name"];
	$asset_description = $_GET["asset_description"];
	$asset_media_type_id = $_GET["asset_media_type_id"];
	$asset_legal_id = $_GET["asset_legal_id"];
	$asset_owner_id = $_GET["asset_owner_id"];
	$asset_guardian_id = $_GET["asset_guardian_id"];
	$asset_user_id = $_GET["asset_user_id"];
	$asset_container_id = $_GET["asset_container_id"];
	$asset_disabled = $_GET["asset_disabled"];
	$asset_classification = $_GET["asset_classification"];
	
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($asset_id)) {
		$asset_update = array(
			'asset_name' => $asset_name,
			'asset_description' => $asset_description,
			'asset_media_type_id' => $asset_media_type_id,
			'asset_legal_id' => $asset_legal_id,
			'asset_owner_id' => $asset_owner_id,
			'asset_guardian_id' => $asset_guardian_id,
			'asset_user_id' => $asset_user_id,
			'asset_container_id' => $asset_container_id
		);	
		update_asset($asset_update,$asset_id);
		add_system_records("asset","asset_identification","$asset_id","","Update","");

		# 1) delete all classifications for this asset
		delete_asset_classification_join($asset_id);
		# 2) insert all classification for this asset
		if (is_array($asset_classification)) {
			$count_asset_classification_item = count($asset_classification);
			for($count = 0 ; $count < $count_asset_classification_item ; $count++) {
				# now i insert this stuff
				add_asset_classification_join($asset_id, $asset_classification[$count]);
			}
		}

	} elseif ($action == "update") {
		$asset_update = array(
			'asset_name' => $asset_name,
			'asset_description' => $asset_description,
			'asset_media_type_id' => $asset_media_type_id,
			'asset_legal_id' => $asset_legal_id,
			'asset_owner_id' => $asset_owner_id,
			'asset_guardian_id' => $asset_guardian_id,
			'asset_user_id' => $asset_user_id,
			'asset_container_id' => $asset_container_id
		);	
		add_asset($asset_update);
		add_system_records("asset","asset_identification","$asset_id","","Insert","");
		
		# 1) delete all classifications for this asset
		delete_asset_classification_join($asset_id);
		# 2) insert all classification for this asset
		if (is_array($asset_classification)) {
			$count_asset_classification_item = count($asset_classification);
			for($count = 0 ; $count < $count_asset_classification_item ; $count++) {
				# now i insert this stuff
				add_asset_classification_join($asset_id, $asset_classification[$count]);
			}
		}
	 }

	if ($action == "disable" & is_numeric($asset_id)) {
		disable_asset($asset_id);
		add_system_records("asset","asset_identification","$asset_id","","Disable","");
	}

	if ($action == "csv") {
		export_asset_csv();
		add_system_records("asset","asset_identification","$asset_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>


	<section id="content-wrapper">
		<h3>Asset Identification</h3>
		
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add new Asset 
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
		
		<ul id="accordion">
			
<?
	$asset_list = list_asset(" WHERE asset_disabled=\"0\"");
	foreach($asset_list as $asset_item) {

		$asset_owner_id = lookup_bu("bu_id",$asset_item[asset_owner_id]);
		$asset_guardian_id = lookup_bu("bu_id",$asset_item[asset_guardian_id]);
		$asset_user_id = lookup_bu("bu_id",$asset_item[asset_user_id]);

		$asset_media_type_id = lookup_asset_media_type("asset_media_type_id",$asset_item[asset_media_type_id]);
		$asset_legal_id = lookup_legal("legal_id",$asset_item[asset_legal_id]);
		$asset_container_id = lookup_asset("asset_id",$asset_item[asset_container_id]);

echo "			<li>";
echo "				<div class=\"header\">";
echo "					Asset: $asset_item[asset_name]";
echo "					<span class=\"actions\">";
echo "						<a class=\"edit\" href=\"$base_url&action=edit&asset_id=$asset_item[asset_id]\">edit</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"$base_url&action=disable&asset_id=$asset_item[asset_id]\">delete</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?section=system&subsection=system_records&system_records_lookup_section=asset&system_records_lookup_subsection=asset_identification&system_records_lookup_item_id=$asset_item[asset_id]\">records</a>";
echo "						&nbsp;|&nbsp;";
echo "						<a class=\"delete\" href=\"?action=edit&section=system&subsection=ciso_pmo&ciso_pmo_lookup_section=asset&ciso_pmo_lookup_subsection=asset_identification&ciso_pmo_lookup_item_id=$asset_item[asset_id]\">improve</a>";
echo "					</span>";
echo "					<span class=\"icon\"></span>";
echo "				</div>";
echo "				<div class=\"content table\">";
echo "					<table>";
echo "						<tr>";
echo "							<th>Description</th>";
echo "							<th>Type</th>";
echo "							<th>Legal Constrains</th>";
echo "							<th>Container</th>";
echo "							<th><Owner</th>";
echo "							<th><Guardian</th>";
echo "							<th><User</th>";
echo "						</tr>";

echo "						<tr>";
echo "							<td class=\"action-cell\">";
echo "								<div class=\"cell-label\">";
echo "								 	$asset_item[asset_description]";
echo "								</div>";
echo "							</td>";
echo "							<td>$asset_media_type_id[asset_media_type_name]</td>";
echo "							<td>$asset_legal_id[legal_name]</td>";
echo "							<td>$asset_container_id[asset_name]</td>";
echo "							<td>$asset_owner_id[bu_name]</td>";
echo "							<td>$asset_guardian_id[bu_name]</td>";
echo "							<td>$asset_user_id[bu_name]</td>";
echo "						</tr>";
	#}

echo "					</table>";
echo "<br>";
### INJERTO STARTS
echo "					<div class=\"rounded\">";
echo "						<table class=\"sub-table\">";
echo "							<tr>";
	# first i create columns for each category .. no more than 5!
	$asset_classification_list = list_asset_classification_distinct();
	foreach($asset_classification_list as $asset_classification_item) {
		echo "<th><center>$asset_classification_item[asset_classification_type]</th>";
	}
echo "							</tr>";
echo "							<tr>";
	# now i put the values 
	$asset_classification_list = list_asset_classification_distinct();
	foreach($asset_classification_list as $asset_classification_item) {
		# echo "Trola: $asset_classification_item[asset_classification_type] asset: $asset_item[asset_id]";
		$value = pre_selected_asset_classification_values($asset_classification_item[asset_classification_type], $asset_item[asset_id]);	
		# echo "classification: $value";
		$name = lookup_asset_classification("asset_classification_id", $value);
		echo "<td><center>$name[asset_classification_name]</td>";
	}

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
