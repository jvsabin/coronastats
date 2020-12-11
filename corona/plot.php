<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
  </head>
  <body>
    <div id="piechart_3dqewr" style="width: 500px; height: 300px;"></div>
  </body>
</html>



<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     21],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'Chart',
          colors: ['#453452', '#ec234e'],
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3dqewr'));
        chart.draw(data, options);
      }
    </script>