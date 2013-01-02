<?php
include_once("header.php");
?>

	<section id="content-wrapper">
		<div id="widgets-area-wrap">
			<div id="main-area">
				<div class="widget">
					<div class="widget-header">Resource Utilization</div>
					<div class="widget-content">

<script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['x', 'Cats', 'Blanket 1', 'Blanket 2'],
          ['A',   1,       1,           0.5],
          ['B',   2,       0.5,         1],
          ['C',   4,       1,           0.5],
          ['D',   8,       0.5,         1],
          ['E',   7,       1,           0.5],
          ['F',   7,       0.5,         1],
          ['G',   8,       1,           0.5],
          ['H',   4,       0.5,         1],
          ['I',   2,       1,           0.5],
          ['J',   3.5,     0.5,         1],
          ['K',   3,       1,           0.5],
          ['L',   3.5,     0.5,         1],
          ['M',   1,       1,           0.5],
          ['N',   1,       0.5,         1]
        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
                        width: 800, height: 200,
                        vAxis: {maxValue: 10}}
                );
      }

      google.setOnLoadCallback(drawVisualization);

    </script>
  </head>

  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 500px; height: 400px;"></div>
  </body>


						<p>This chart represent current (and projected) OPEX, CAPEX and Resource utilization. You can download the data on excel format as well.</p>
					</div>
					<div class="widget-header">Service Audit Compliance</div>
					<div class="widget-content">
						<img src="img/widget-graph.jpg" style="width:100%;"/>
						<p>This chart represent current (and projected) OPEX, CAPEX and Resource utilization. You can download the data on excel format as well.</p>
					</div>
				</div>

			</div>

		
			<div id="side-area">
				<div class="widget">
					<div class="widget-header">Recent posts</div>
					<div class="widget-content">
						<ul>
							<li>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit.<a href="#" class="more">more</a></li>
							<li>This is Photoshop's version  of Lorem Ipsum.<a href="#" class="more">more</a></li>
							<li>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit.of Lorem Ipsum. <a href="#" class="more">more</a></li>
							<li>This is Photoshop's version  of Lorem Ipsum.<a href="#" class="more">more</a></li>
							<li>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit. This is Photoshop's version  of Lorem Ipsum.<a href="#" class="more">more</a></li>
							<li>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit.<a href="#" class="more">more</a></li>
							<li>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit.<a href="#" class="more">more</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

<?
include_once("footer.php");
?>
