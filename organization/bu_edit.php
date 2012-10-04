<?

	include_once("lib/bu_lib.php");
	include_once("lib/site_lib.php");

	$section = $_GET["section"];
	$subsection = $_GET["subsection"];
	$action = $_GET["action"];
	$bu_id = $_GET["bu_id"];
	
	$base_url = build_base_url($section,$subsection);

	if (is_numeric($bu_id)) {
		$bu_item = lookup_bu("bu_id",$bu_id);
	}

?>


	<section id="content-wrapper">
		<h3>Edit or Create a Business Unit</h3>
		<span class="description">This is the very first step to split your organization in to manageable bits for later analysis.</span>
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
echo "					<form name=\"bu_edit\" method=\"GET\" action=\"$base_url\">";
?>
						<label for="name">Name</label>
						<span class="description">Register the main business units for your organization. A organizational chart could be usefull. Examples for this are: Finance, Legal, Human Resources, Production, Infrastructure, Security, Etc.</span>
<? echo "						<input type=\"text\" name=\"bu_name\" id=\"bu_name\" value=\"$bu_item[bu_name]\"/>";?>
						
						<label for="description">Description</label>
						<span class="description">Give a brief description of what the BU does, so everyone is in the same page.</span>
<? echo "						<textarea name=\"bu_description\">$bu_item[bu_description]</textarea>";?>
				</div>
				
				<div class="tab" id="tab2">
					advanced tab
				</div>
			</div>
		</div>
		
		<div class="controls-wrapper">

				    <INPUT type="hidden" name="action" value="update_bu">
				    <INPUT type="hidden" name="section" value="organization">
				    <INPUT type="hidden" name="subsection" value="bu">
<? echo " 			    <INPUT type=\"hidden\" name=\"bu_id\" value=\"$bu_item[bu_id]\">"; ?>

			    <INPUT type="submit" value="Send"> 
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
