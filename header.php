<?php
	include_once("lib/site_lib.php");
	$base_url = build_base_url("main","land_site");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
			
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	      
	<meta name="author" content=""/>
	<meta name="Copyright" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="Pragma" content="no-cache" />
	
<?php
echo "	<script type=\"text/javascript\" src=\"js/jquery.min.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/jquery-ui.min.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/admin.scripts.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/chosen.jquery.js\"></script>";
echo "	<script type=\"text/javascript\" src=\"js/accordion.js\"></script>";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/normalize.css\" />";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/styles.css\" />";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/chosen.css\" />";
echo "	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/chosen.css\" />";
?>

	<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.2/themes/base/jquery-ui.css" />
	<script>
		$(function() {
			$( "#datepicker" ).datepicker();
		});
	</script>
	
	<title>ERAMBA</title>
	
	<script>
	$(document).ready(function(){
		$("#search-field").hide();
		$("#add-control-items").hide();

		$("#search-control-icon").click(function(){
			$("#search-field").animate({
			    left: 'toggle',
			}, 200);
			$("#search-field input:visible").focus();
		});
		
		$('#search-field').keypress(function (e) {
			  if (e.which == 13) {
			    $(this).parents('form').submit();
			  }
		});
		
		$("#add-control-icon").click(function(){
			$("#add-control-items").toggle();
		});
	});
	
	$(document).ready(function() {
		$("#accordion").accordion();
	});
		
	
	$(document).ready(function(){
			$(".chzn-select").chosen({
				no_results_text: "No results matched",
				placeholder_text: "Select Some Options..."
			});
			
			$(".tab-wrapper > ul li a").click(function(event) {
				event.preventDefault();
				$(".tab-wrapper > ul li").each(function() {
				    $(this).removeClass("active");
				});
				$(this).parent().addClass("active");

				$(".tab-content > div").hide();
				var content = "#" + $(this).attr("href");
				$(content).show();
			});
	
			$(".tab-content div.tab").hide();
			$(".tab-content div.tab:first").show();
			
		}); 
	</script>
</head>
<body>
	<section id="header-wrapper">
		<div id="header-inner">
			<a href="/" id="logo">
				<img src="img/logo.png" alt="Admin logo" />
			</a>
			<!--<div id="user-box">
				<div id="user-links">
					<a href="#" id="user-profile">Esteban Ribicic</a>
					<a href="#" id="user-sign-out">Sign out</a>
				</div>
<?php
echo "				<img src=\"img/profile-pic.png\" alt=\"Profile pic\"/>";
?>
			</div>-->

			<div id="login-box">
				<form name="login" method="POST" action="<?echo "$base_url"?>">
					<div class="login-form">
						
							<span>Login <input type="text" name="system_login" /></span>
							<span>Password <input type="password" name="system_passwd" /></span>
						
					</div>
						
					<input type="submit" class="login-button" value="Log in" />
				</form>
			</div>


		</div>
	</section>
	<section id="menu-wrapper">
		<nav id="menu-top">
			<ul id="menu-items">
				<li><a href="?section=organization&subsection=dashboard" <?php is_this_menu_active($_GET["section"], "organization")?>>Organization</a></li>
				<li><a href="?section=asset&subsection=dashboard" <?php is_this_menu_active($_GET["section"], "asset")?>>Asset Management</a></li>
				<li><a href="?section=risk&subsection=dashboard" <?php is_this_menu_active($_GET["section"], "risk")?>>Risk Management</a></li>
				<li><a href="?section=security_services&subsection=dashboard" <?php is_this_menu_active($_GET["section"], "security_services")?>>Security Services</a></li>
				<li><a href="?section=compliance&subsection=dashboard" <?php is_this_menu_active($_GET["section"], "compliance")?>>Compliance</a></li>
				<li><a href="?section=system&subsection=dashboard" <?php is_this_menu_active($_GET["section"], "system")?>>System</a></li>
			</ul>
			
		</nav>
		<nav id="menu-sub">
			<ul>
			<?php
				show_menu_sub($_GET["section"]);
			?>
			</ul>
		</nav>
	</section>
