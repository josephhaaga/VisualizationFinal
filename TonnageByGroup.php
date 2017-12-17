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
            <div class="chart" id="chart">

            </div>
          </div>
        </div>
      </div>

    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>

      years = []
      foreign = [];
      domestic = [];
      g = jQuery.ajax({
        url: "CommerceData.php",
        dataType: "JSON",
        success: function(json){
            //here inside json variable you've the json returned by your PHP
            for(var i=0;i<json.length;i++){
                years.push(json[i].year)
                foreign.push(parseInt(json[i].foreign_val))
                domestic.push(parseInt(json[i].domestic_val))
            }

            Highcharts.chart('chart', {
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Commodity tonnage carried on commercial waterways by type'
                },
                subtitle: {
                    text: 'Source: Department of Defense'
                },
                xAxis: {
                    categories: years,
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: false
                    }
                },
                yAxis: {
                    title: {
                        text: 'tons'
                    },
                    labels: {
                        formatter: function () {
                            // return this.value / 1000;
                            return this.value / 1000;
                        }
                    }
                },
                tooltip: {
                    split: true,
                    valueSuffix: ' tons'
                },
                plotOptions: {
                    area: {
                        stacking: 'normal',
                        lineColor: '#666666',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 1,
                            lineColor: '#666666'
                        }
                    }
                },
                series: [{
                    name: 'Foreign',
                    data: foreign
                }, {
                    name: 'Domestic',
                    data: domestic
                }]
            });






        }
      })

    </script>

  </body>
</html>
