<?php 
  ob_start();
  require_once ("includes/security.php");
  sec_session_start();
  require_once ("includes/common.php");
#	include("includes/header.php");
	include("includes/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  </head>

  <body>
      <h1 style="text-align: center;">Free</h1>
      <h4>Note: Double-click a node to expand/collapse.</h4>
      <div id="chart_div"> </div>
      <script type='text/javascript' src='https://www.google.com/jsapi'></script>
          <script type='text/javascript'>
            google.load('visualization', '1', {packages:['orgchart']});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
              $.ajaxSetup( { "async": false } );

              var json;
               $.getJSON('includes/printFree.php', function(data) {
                json = data;
              });
            var options = {'allowHtml':true,
                            'allowCollapse':true,
                            'size':'small'};
        // Create our data table out of JSON data loaded from server.
            var data = new google.visualization.DataTable(json);
                var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
          </script>
  </body>
</html>