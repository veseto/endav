<?php
	include("includes/header.php");
	include("includes/connection.php");
?>

<div class="container">
			<div id="chart_div"> </div>
</div>
     <script type='text/javascript' src='https://www.google.com/jsapi'></script>
          <script type='text/javascript'>
            google.load('visualization', '1', {packages:['orgchart']});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
              $.ajaxSetup( { "async": false } );

              var json;
               $.getJSON('printBinar.php', function(data) {
                json = data;
              });
            
        // Create our data table out of JSON data loaded from server.
            var data = new google.visualization.DataTable(json);
                var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
                chart.draw(data, {allowHtml:true});
            }
          </script>
<?php
	include("includes/footer.php");
?>