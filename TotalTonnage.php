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
      .line{
        fill: none;
        stroke: steelblue;
        stroke-width: 2px;
      }
    </style>
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <?php include 'menu.php'; ?>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="callout">
            <h2>Total tonnage of commodites carried on commercial waterways</h2>
            <div class="chart">

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
      // set the dimensions and margins of the graph
      var margin = {top: 20, right: 20, bottom: 30, left: 150},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

      // parse the date / time
      var parseTime = d3.timeParse("%Y");
      // set the ranges
      // var x = d3.scaleTime().range([0, width]);
      var x = d3.scaleTime().range([0, width]);
      var y = d3.scaleLinear().range([height, 0]);
      // define the line
      var valueline = d3.line()
        .x(function(d) { return x(d.year); })
        .y(function(d) { return y(d.total_val); });


      // append the svg obgect to the body of the page
      // appends a 'group' element to 'svg'
      // moves the 'group' element to the top left margin
      var svg = d3.select(".chart").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
      .append("g")
        .attr("transform",
              "translate(" + margin.left + "," + margin.top + ")");

      // Get the data
      d3.json("CommerceData.php", function(error, data) {
        if (error) throw error;
        data.forEach(function(d) {
            d.date = parseTime(d.year);
            d.year = parseTime(d.year);
            d.total_val = +d.total_val;
        });

        // Scale the range of the data
        x.domain(d3.extent(data, function(d) { return d.date; }));
        y.domain([0, d3.max(data, function(d) { return d.total_val; })]);

        // Add the valueline path.
        svg.append("path")
            .data([data])
            .attr("class", "line")
            .attr("d", valueline);

        console.log(data)

        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x));

        svg.append("g")
            .call(d3.axisLeft(y));

      });
    </script>

  </body>
</html>
