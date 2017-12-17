<?php include 'database.php'; ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Project - Joseph Haaga</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>
    <style media="screen">
      .axis--x .tick text{
        transform: translate(15px,45px)rotate(90deg);

      }
    </style>
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <?php include 'menu.php'; ?>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="callout">
            <div class="chart">
              <h2>Hydropower Gigawatt Hours by State</h2>
              <svg width="960" height="550"></svg>
            </div>
          </div>
        </div>
      </div>

    </div>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script>

      var svg = d3.select("svg"),
        margin = {top: 20, right: 20, bottom: 30, left: 40},
        width = +svg.attr("width") - margin.left - margin.right,
        height = +500 - margin.top - margin.bottom;

      var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
        y = d3.scaleLinear().rangeRound([height, 0]);

      var g = svg.append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      d3.json("EnergyData.php", function(d) {
        d.hydropower_GWh = +d.hydropower_GWh;
        x.domain(d.map(function(d) { return d.State; }));
        y.domain([0, d3.max(d, function(d) { return d.hydropower_GWh; })]);

        g.append("g")
            .attr("class", "axis axis--x")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x));


        g.append("g")
            .attr("class", "axis axis--y")
            .call(d3.axisLeft(y).ticks(10, ""))
          .append("text")
            .attr("transform", "rotate(-s90)")
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("text-anchor", "end")
            .text("Frequency");

        g.selectAll(".bar")
          .data(d)
          .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x(d.State); })
            .attr("y", function(d) { return y(d.hydropower_GWh); })
            .attr("width", x.bandwidth())
            .attr("height", function(d) { return height - y(d.hydropower_GWh); });


      }, function(error, data) {
        if (error) throw error;
      });
    </script>

  </body>
</html>
