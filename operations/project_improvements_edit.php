<?

	include_once("lib/project_improvements_lib.php");
	include_once("lib/project_improvements_status_lib.php");
	include_once("lib/site_lib.php");

	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	$project_improvements_id = $_GET["project_improvements_id"];
	
	$base_url = build_base_url($section,$subsection);

	if (is_numeric($project_improvements_id)) {
		$project_improvements_item = lookup_project_improvements("project_improvements_id",$project_improvements_id);
	}

?>


	<section id="content-wrapper">
		<h3>Edit or Create a Project</h3>
		<span class="description">Use this form to create or edit new improvement projects</span>
		<div class="tab-wrapper"> 
			<ul class="tabs">
				<li class="first active">
					<a href="tab1">General</a>
					<span class="right"></span>
				</li>
			</ul>
			
			<div class="tab-content">
				<div class="tab" id="tab1">
<?
echo "					<form name=\"edit\" method=\"GET\" action=\"$base_url\">";
?>
						<label for="name">Project Title</label>
						<span class="description">Give the project a title, name or code so it's easily identified on the project list menu</span>
<? echo "						<input type=\"text\" title=\"project_improvements_title\" id=\"project_improvements_title\" value=\"$project_improvements_item[project_improvements_title]\"/>";?>
						
	<label for="description">Goal</label>
	<span class="description">Describe the project Goal, it's roadmap and deliverables.</span>
<? echo "<textarea name=\"project_improvements_goal\">$project_improvements_item[project_improvements_goal]</textarea>";?>
						
	<label for="description">Project Start Date</label>
	<span class="description">Document the project kick-off date. The date format for this field is YYYY-MM-DD, the default is todays date.</span>
<? echo "<input type=\"text\" start=\"project_improvements_start\" id=\"project_improvements_start\" value=\"$project_improvements_item[project_improvements_start]\"/>";?>
						
	<label for="description">Project Deadline</label>
	<span class="description">Document the project deadline. The date format for this field is YYYY-MM-DD, the default is todays date.</span>
<? echo "<input type=\"text\" end=\"project_improvements_end\" id=\"project_improvements_end\" value=\"$project_improvements_item[project_improvements_end]\"/>";?>
						
	<label for="description">Project Owner</label>
	<span class="description">Document the project owner, someone who is responsible for make this project deliver what has been documented on the times specified above</span>
<? echo "<input type=\"text\" end=\"project_improvements_owner\" id=\"project_improvements_owner\" value=\"$project_improvements_item[project_improvements_owner]\"/>";?>
						
	<label for="legalType">Project Status</label>
	<span class="description"></span>
	<select name="tp_type_id" id="" class="chzn-select">
	<option value="-1">Select the Project Status</option>
<?
	list_drop_menu_project_improvements_status($project_improvements_item[project_improvements_status_id],"project_improvements_status_id");	
?>
	</select>

	<label for="description">Project Origin</label>
	<span class="description">If this project came from an existing object (Risk, Service, Compliance, Etc.) this field will show the exact place. This is sometimes useful to remember why you started this project in the first time, what was the driver of this intiative.</span>
<? echo "<input type=\"text\" name=\"\" disabled=\"disabled\" value=\"$project_improvements_item[project_improvements_source_section]/$project_improvements_source_section[project_improvements_source_subsection]/$project_improvements_source_subsection[project_improvements_source_item_id]\">";?>
			</div>
			<div class="tab" id="tab2">
				advanced tab
			</div>
		</div>
	</div>
		
		<div class="controls-wrapper">

				    <INPUT type="hidden" name="action" value="edit">
				    <INPUT type="hidden" name="section" value="operations">
				    <INPUT type="hidden" name="subsection" value="project_improvements">
<? echo " 			    <INPUT type=\"hidden\" name=\"project_improvements_id\" value=\"$project_improvements_item[project_improvements_id]\">"; ?>
			<a>
			    <INPUT type="submit" value="Submit" class="add-btn"> 
			</a>
			
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
