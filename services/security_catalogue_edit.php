	
<?

	include_once("lib/security_services_status_lib.php");
	include_once("lib/security_services_lib.php");
	include_once("lib/general_classification_lib.php");
	include_once("lib/bu_lib.php");
	include_once("lib/asset_type_lib.php");
	include_once("lib/asset_lib.php");
	include_once("lib/legal_lib.php");
	include_once("lib/asset_classification_lib.php");
	include_once("lib/site_lib.php");

	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	$security_services_id= $_GET["security_services_id"];
	
	$base_url = build_base_url($section,$subsection);

	if (is_numeric($security_services_id)) {
		$security_services_item = lookup_security_services("security_services_id",$security_services_id);
	}

?>

	<section id="content-wrapper">
		<h3>Edit or Create a Security Service</h3>
		<span class="description">Pretty much the same way a restaurant has a menu, a security program has a menu of services and even sometimes products. It's very important to know what security services your program has, since it's the core of it's delivery and must be well understood and managed.</span>
				
		<div class="tab-wrapper"> 
			<ul class="tabs">
				<li class="first active">
<?
#echo "					<a href=\"$base_url&action=edit&security_services_id=$security_services_item[security_services_id]\">General</a>";
?>
					<a href="tab1">General</a>
					<span class="right"></span>
				</li>
				<li>
<?
#echo "					<a href=\"$base_url&action=edit&security_services_id=$security_services_item[security_services_id]\">Classification</a>";
?>
					<a href="tab2">Classification</a>
					<span class="right"></span>
				</li>
			</ul>
			
			<div class="tab-content">
				<div class="tab" id="tab1">
<?
echo "					<form name=\"security_services_edit\" method=\"GET\" action=\"$base_url\">";
?>
						<label for="name">Name of the Service</label>
						<span class="description">Give a name to the service your program is intended to deliver. Examples: Internet Gateways, Encryption, Physical Lockers, Etc.</span>
<?
echo "						<input type=\"text\" name=\"security_services_name\" id=\"\" value=\"$security_services_item[security_services_name]\"/>";
?>
						
						<label for="description">Service Objective</label>
						<span class="description">Give a brief description on what this services does. It's sometimes usefull to answer, what happens if the service wouldnt be available?</span>
<?
echo "						<textarea id=\"\" name=\"security_services_objective\">$security_services_item[security_services_objective]</textarea>";
?>
						
						<label for="legalType">Service Status</label>
						<span class="description">The objective is to understand on what status this service is: Proposed (Just a good idea that needs to be validated and drafted), Design (there's budget and a business case, so it's time to design), Transition (the design is moving towards an implementation), Production (the service is working, metrics are being taken, etc), Retired (the service is no longer used)</span>
						<select name="security_services_status" id="" class="chzn-select">
						<option value="-1">Select the Service Status</option>
<?
						list_drop_menu_security_services_status($security_services_item[security_services_status],"security_services_status_id");	
?>
						</select>
						
						<label for="description">Service Documentation</label>
						<span class="description">Document the URLs or links where to find the documentation for each lifecycle phase: Proposed (business case, emails, etc), Design (design documents, budgets, costs, etc), Transition (operational manuals, etc).</span>
<?
echo "						<textarea id=\"\" name=\"security_services_documentation_url\">$security_services_item[security_services_documentation_url]</textarea>";
?>
						
						<label for="legalType">Service Metrics</label>
						<span class="description">You'll be asked to defined two things: how you will measure metrics and what is the criteria used to decide if the sample is representative of a service delivered as expected at previous stages</span>
<?
				if (empty($security_services_item[security_services_audit_metric])) { 
echo "				<textarea id=\"\" name=\"security_services_audit_metric\">Describe the metric</textarea>";
				} else {
echo "				<textarea id=\"\" name=\"security_services_audit_metric\">$security_services_item[security_services_audit_metric]</textarea>";
				}

echo "<br><br>";

				if (empty($security_services_item[security_services_audit_metric])) { 
echo "				<textarea id=\"\" name=\"security_services_audit_success_criteria\">Describe the metric success criteria</textarea>";
				} else {
echo "				<textarea id=\"\" name=\"security_services_audit_success_criteria\">$security_services_item[security_services_audit_success_criteria]</textarea>";
				}
?>
				<label for="name">Metric Regular Review (Audit)</label>
				<span class="description">Trust but control, that's my mother in law piece of advice. At regular intervals, it's very good idea to audit (internaly or by third parties) the security services by the use of their metrics. You must specify how often (in months) and starting when (YYYY-MM-DD) you plan to audit this service. By default, the date will be the date of creation (not update) of this control.</span>
<?
echo "				<input type=\"text\" name=\"security_services_audit_periodicity_start_date\" id=\"\" value=\"$security_services_item[security_services_audit_periodicity_start_date]\"/>";
echo "				<br><br>";	
echo "				<span class=\"description\">How often from that date you plan to review this control?</span>";
echo "				<input type=\"text\" name=\"security_services_audit_periodicity\" id=\"\" value=\"$security_services_item[security_services_audit_periodicity]\"/>";
#echo "				<input type=\"checkbox\" name=\"security_services_audit_periodicity_update\" value=\"1\"><br>";
?>

		<label for="name">Service Cost</label>
		<span class="description">For those of you who must keep budgets tidy, it's important to keep as clear as possible how much effort is required to operate the service in financial (OPEX, CAPEX) and human terms (operational resource utilization).</span>

<?
				if (empty($security_services_item[security_services_cost_opex])) { 
echo "				<input type=\"text\" name=\"security_services_cost_opex\" value=\"Example: 1000\"/>";
				} else {
echo "				<input type=\"text\" name=\"security_services_cost_opex\" value=\"$security_services_item[security_services_cost_opex]\"/>";
				}

echo "<br><br>";
				if (empty($security_services_item[security_services_cost_capex])) { 
echo "				<input type=\"text\" name=\"security_services_cost_capex\" value=\"Example: 600\"/>";
				} else {
echo "				<textarea id=\"\" name=\"security_services_cost_capex\">$security_services_item[security_services_cost_capex]</textarea>";
				}

echo "<br><br>";

				if (empty($security_services_item[security_services_cost_operational_resource])) { 
echo "				<input type=\"text\" name=\"security_services_cost_operational_resource\" value=\"Example: 1.5\"/>";
				} else {
echo "				<input type=\"text\" name=\"security_services_cost_operational_resource\" value=\"$security_services_item[security_services_cost_operational_resource]\"/>";
				}
?>

<?
#$security_services_classification_types = list_security_services_classification_distinct();
#
#foreach($security_services_classification_types as $security_services_classification_types_item) {
#	echo "<select name=\"security_services_classification[]\" class=\"chzn-select\">";
#	echo "<option value=\"-1\">Classification: $security_services_classification_types_item[security_services_classification_type]</option>";
#
#	$pre_selected_value = pre_selected_security_services_classification_values($security_services_classification_types_item[security_services_classification_type], $security_services_item[security_services_id]);	
#
#	# llamar una funcion que me liste un html drop menu por cada classification type que yo le diga										
#	list_drop_menu_security_services_classification($pre_selected_value,"security_services_classification_name","$security_services_classification_types_item[security_services_classification_type]");
#	echo "</select>";
#	echo "</br>";
#}
?>

				</div>
				
				<div class="tab" id="tab2">
					advanced tab
				</div>
			</div>
		</div>
		
		<div class="controls-wrapper">
				    <INPUT type="hidden" name="action" value="update">
				    <INPUT type="hidden" name="section" value="security_services">
				    <INPUT type="hidden" name="subsection" value="security_catalogue">
<? echo " 			    <INPUT type=\"hidden\" name=\"security_services_id\" value=\"$security_services_item[security_services_id]\">"; ?>

			    <INPUT type="submit" value="Send"> 
			
<?
echo "			<a href=\"$base_url\" class=\"cancel-btn\">";
?>
				Cancel
				<span class="select-icon"></span>
			</a>
</form>
		</div>
		
		<br class="clear"/>
		
	</section>
</body>
</html>
