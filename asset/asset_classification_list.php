<?
	include_once("lib/asset_classification_lib.php");
	include_once("lib/site_lib.php");
	include_once("lib/system_records_lib.php");

	# general variables - YOU SHOULDNT NEED TO CHANGE THIS
	$sort = $_GET["sort"];
	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	
	$base_url = build_base_url($section,$subsection);
	
	# local variables - YOU MUST ADJUST THIS! 
	$asset_classification_id = $_GET["asset_classification_id"];
	$asset_classification_name = $_GET["asset_classification_name"];
	$asset_classification_criteria = $_GET["asset_classification_criteria"];
	$asset_classification_type = $_GET["asset_classification_type"];
	$asset_classification_type_new = $_GET["asset_classification_type_new"];

	if ($asset_classification_type_new) {
		$asset_classification_type = $asset_classification_type_new;
	}

	$asset_classification_value = $_GET["asset_classification_value"];
	if (!is_numeric($asset_classification_value)) {
		$asset_classification_value = 1;
	}

	$asset_classification_disabled = $_GET["asset_classification_disabled"];
	 
	#actions .. edit, update or disable - YOU MUST ADJUST THIS!
	if ($action == "update" & is_numeric($asset_classification_id)) {
		$asset_classification_update = array(
			'asset_classification_name' => $asset_classification_name,
			'asset_classification_criteria' => $asset_classification_criteria,
			'asset_classification_type' => $asset_classification_type,
			'asset_classification_value' => $asset_classification_value
		);	
		update_asset_classification($asset_classification_update,$asset_classification_id);
		add_system_records("asset","asset_classification","$asset_classification_id","","Update","");
	} elseif ($action == "update") {
		$asset_classification_update = array(
			'asset_classification_name' => $asset_classification_name,
			'asset_classification_criteria' => $asset_classification_criteria,
			'asset_classification_type' => $asset_classification_type,
			'asset_classification_value' => $asset_classification_value
		);	
		add_asset_classification($asset_classification_update);
		add_system_records("asset","asset_classification","$asset_classification_id","","Insert","");
	}

	if ($action == "disable") {
		disable_asset_classification($asset_classification_id);
		add_system_records("asset","asset_classification","$asset_classification_id","","Disable","");
	}

	if ($action == "csv") {
		export_asset_classification_csv();
		add_system_records("asset","asset_classification","$asset_classification_id","","Export","");
	}

	# ---- END TEMPLATE ------

?>

	<section id="content-wrapper">
		<h3>Asset Classification Scheme</h3>
		<div class="controls-wrapper">
<?
echo "			<a href=\"$base_url&action=edit\" class=\"add-btn\">";
?>
				<span class="add-icon"></span>
				Add new Classification 
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
echo "					<li><a href=\"downloads/asset_classification_export.csv\">Dowload</a></li>";
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
echo "					<th><a class=\"asc\" href=\"$base_url&sort=asset_classification_name\">Classification Name</a></th>";
echo "					<th><a href=\"$base_url&sort=asset_classification_criteria\">Classification Criteria</a></th>";
echo "					<th><center><a href=\"$base_url&sort=asset_classification_type\">Type</a></th>";
echo "					<th><center><a href=\"$base_url&sort=asset_classification_value\">Value</a></th>";
?>
				</tr>
			</thead>
	
			<tbody>
<?
# -------- TEMPLATE! YOU MUST ADJUST THIS ------------
	if ($sort == "asset_classification_criteria" OR $sort == "asset_classification_name" OR $sort == "asset_classification_type" OR $sort == "asset_classification_value") {
	$asset_classification_list = list_asset_classification(" WHERE asset_classification_disabled = 0 ORDER by $sort");
	} else {
	$asset_classification_list = list_asset_classification(" WHERE asset_classification_disabled = 0 ORDER by asset_classification_type");
	}

	foreach($asset_classification_list as $asset_classification_item) {
echo "				<tr class=\"even\">";
echo "					<td class=\"col-center\"><input type=\"checkbox\" name=\"action\" class=\"check-elem\"/></td>";
echo "					<td class=\"action-cell\">";
echo "						<div class=\"cell-label\">";
echo "							$asset_classification_item[asset_classification_name]";
echo "						</div>";
echo "						<div class=\"cell-actions\">";
echo "							<a href=\"$base_url&action=edit&asset_classification_id=$asset_classification_item[asset_classification_id]\" class=\"edit-action\">edit</a> ";
echo "							<a href=\"$base_url&action=disable&asset_classification_id=$asset_classification_item[asset_classification_id]\" class=\"delete-action\">delete</a>";
echo "						</div>";
echo "					</td>";
echo "					<td>$asset_classification_item[asset_classification_criteria]</td>";
echo "					<td><center>$asset_classification_item[asset_classification_type]</td>";
echo "					<td><center>$asset_classification_item[asset_classification_value]</td>";
echo "				</tr>";
	}

?>
			</tbody>
		</table>
		
		<br class="clear"/>
		
	</section>
