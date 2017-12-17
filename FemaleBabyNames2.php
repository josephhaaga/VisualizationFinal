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
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <?php include 'menu.php'; ?>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="callout">
            <div class="chart">
              <h2>Female Baby Name Popularity, NYC 2011</h2>

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

        var diameter = 960,
            format = d3.format(",d"),
            color = d3.scaleOrdinal(d3.schemeCategory20c);

        var bubble = d3.pack()
            .size([diameter, diameter])
            .padding(1.5);

        var svg = d3.select(".chart").append("svg")
            .attr("width", diameter)
            .attr("height", diameter)
            .attr("class", "bubble");

        d3.json("BabyNames2.php", function(error, data) {
          if (error) throw error;

          var root = d3.hierarchy(classes(data))
              .sum(function(d) { return d.name_count; })
              .sort(function(a, b) { return b.name_count - a.name_count; });

          bubble(root);
          console.log(root)
          var node = svg.selectAll(".node")
              .data(root.children)
            .enter().append("g")
              .attr("class", "node")
              .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

          node.append("title")
              .text(function(d) { return d.data.name + ": " + format(d.name_count); });

          node.append("circle")
              .attr("r", function(d) { return d.r; })
              .style("fill", function(d) {
                return color(d.data.name);
              });

          node.append("text")
              .attr("dy", ".3em")
              .style("text-anchor", "middle")
              .text(function(d) { return d.data.name; }).style("font-size","10px");
        });

        // Returns a flattened hierarchy containing all leaf nodes under the root.
        function classes(root) {
          var classes = [];
          return {children: root};
        }

        d3.select(self.frameElement).style("height", diameter + "px");
    </script>

  </body>
</html>
