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
            <div id="thechart">

            </div>
          </div>
        </div>
      </div>

    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/tilemap.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>

      state_data = [];

      state_positions = [{name: 'Alabama',region: 'South',x: 6,y: 7,}, {name: 'Alaska',region: 'West',x: 0,y: 0,}, {name: 'Arizona',region: 'West',x: 5,y: 3,}, {name: 'Arkansas',region: 'South',x: 5,y: 6,}, {name: 'California',region: 'West',x: 5,y: 2,}, {name: 'Colorado',region: 'West',x: 4,y: 3,}, {name: 'Connecticut',region: 'Northeast',x: 3,y: 11,}, {name: 'Delaware',region: 'South',x: 4,y: 9,}, {name: 'District of Columbia',region: 'South',x: 4,y: 10,}, {name: 'Florida',region: 'South',x: 8,y: 8,}, {name: 'Georgia',region: 'South',x: 7,y: 8,}, {name: 'Hawaii',region: 'West',x: 8,y: 0,}, {name: 'Idaho',region: 'West',x: 3,y: 2,}, {name: 'Illinois',region: 'Midwest',x: 3,y: 6,}, {name: 'Indiana',region: 'Midwest',x: 3,y: 7,}, {name: 'Iowa',region: 'Midwest',x: 3,y: 5,}, {name: 'Kansas',region: 'Midwest',x: 5,y: 5,}, {name: 'Kentucky',region: 'South',x: 4,y: 6,}, {name: 'Louisiana',region: 'South',x: 6,y: 5,}, {name: 'Maine',region: 'Northeast',x: 0,y: 11,}, {name: 'Maryland',region: 'South',x: 4,y: 8,}, {name: 'Massachusetts',region: 'Northeast',x: 2,y: 10,}, {name: 'Michigan',region: 'Midwest',x: 2,y: 7,}, {name: 'Minnesota',region: 'Midwest',x: 2,y: 4,}, {name: 'Mississippi',region: 'South',x: 6,y: 6,}, {name: 'Missouri',region: 'Midwest',x: 4,y: 5,}, {name: 'Montana',region: 'West',x: 2,y: 2,}, {name: 'Nebraska',region: 'Midwest',x: 4,y: 4,}, {name: 'Nevada',region: 'West',x: 4,y: 2,}, {name: 'New Hampshire',region: 'Northeast',x: 1,y: 11,}, {name: 'New Jersey',region: 'Northeast',x: 3,y: 10,}, {name: 'New Mexico',region: 'West',x: 6,y: 3,}, {name: 'New York',region: 'Northeast',x: 2,y: 9,}, {name: 'North Carolina',region: 'South',x: 5,y: 9,}, {name: 'North Dakota',region: 'Midwest',x: 2,y: 3,}, {name: 'Ohio',region: 'Midwest',x: 3,y: 8,}, {name: 'Oklahoma',region: 'South',x: 6,y: 4,}, {name: 'Oregon',region: 'West',x: 4,y: 1,}, {name: 'Pennsylvania',region: 'Northeast',x: 3,y: 9,}, {name: 'Rhode Island',region: 'Northeast',x: 2,y: 11,}, {name: 'South Carolina',region: 'South',x: 6,y: 8,}, {name: 'South Dakota',region: 'Midwest',x: 3,y: 4,}, {name: 'Tennessee',region: 'South',x: 5,y: 7,}, {name: 'Texas',region: 'South',x: 7,y: 4,}, {name: 'Utah',region: 'West',x: 5,y: 4,}, {name: 'Vermont',region: 'Northeast',x: 1,y: 10,}, {name: 'Virginia',region: 'South',x: 5,y: 8,}, {name: 'Washington',region: 'West',x: 2,y: 1,}, {name: 'West Virginia',region: 'South',x: 4,y: 7,}, {name: 'Wisconsin',region: 'Midwest',x: 2,y: 5,}, {name: 'Wyoming',region: 'West',x: 3,y: 3,}]

      g = jQuery.ajax({
        url: "EnergyData.php",
        dataType: "JSON",
        success: function(json){
          for(var i=0;i<json.length;i++){
            pos = state_positions.find(function(g){
            	return g.name == json[i].State
            })
            state_data.push({
                'hc-a2': json[i].State,
                name: json[i].State,
                value: json[i].rooftopPV_GWh,
                x: pos.x,
                y: pos.y
            })
          }
          console.log(state_data)
          Highcharts.chart('thechart', {
            chart: {
                type: 'tilemap',
                inverted: true,
                height: '80%'
            },

            title: {
                text: 'U.S. states by solar energy generation potential'
            },

            subtitle: {
                text: 'Source: <a href="https://catalog.data.gov/dataset/united-states-renewable-energy-technical-potential">Dept of Energy</a>'
            },

            xAxis: {
                visible: false
            },

            yAxis: {
                visible: false
            },

            colorAxis: {
                dataClasses: [{
                    from: 0,
                    to: 10000,
                    color: '#F9EDB3',
                    name: '< 10k'
                }, {
                    from: 10000,
                    to: 50000,
                    color: '#FFC428',
                    name: '10k - 50k'
                }, {
                    from: 50000,
                    to: 200000,
                    color: '#FF7987',
                    name: '50k - 200k'
                }, {
                    from: 200000,
                    color: '#FF2371',
                    name: '> 200k'
                }]
            },

            tooltip: {
                headerFormat: '',
                pointFormat: 'The solar potential of <b> {point.name}</b> is <b>{point.value} GWh</b>'
            },

            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.hc-a2}',
                        color: '#000000',
                        style: {
                            textOutline: false
                        }
                    }
                }
            },

            series: [{
                name: '',
                data: state_data
            }]
          });
        }
      })


    </script>

  </body>
</html>
