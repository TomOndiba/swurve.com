<h1>Get Affiliate Stats</h1>
<?= Form::open(); ?>
  Affiliate: <?= Form::select('id', $affiliates, (isset($_POST['id'])) ? $_POST['id'] : NULL); ?> 
  Site:
  <select name="site" id="site-select">
    <option value="">All Sites</option>
    <option <?php if (isset($_POST['site']) AND $_POST['site'] == 'Swurve') echo 'selected="selected"'; ?> value="Swurve">Swurve</option>
    <option <?php if (isset($_POST['site']) AND $_POST['site'] == 'Kruze') echo 'selected="selected"'; ?> value="Kruze">Kruze</option>
  </select>

  <?= Form::submit('submit', 'Get Stats'); ?>
<?= Form::close(); ?>
<br /><br /><br />
<?php if (isset($affiliate)): ?>
<script type="text/javascript" src="/assets/js/highcharts.js"></script>
<!--[if IE]>
<script type="text/javascript" src="/assets/js/excanvas.compiled.js"></script>
<![endif]-->
<script type="text/javascript">
function roundNumber(num, dec) {
    var result = Math.round( Math.round( num * Math.pow( 10, dec + 1 ) ) / Math.pow( 10, 1 ) ) / Math.pow(10,dec);
    return result;
}
    $(window).load(function() {
        var oldDefault = {
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
            chart: {
                backgroundColor: {
                    linearGradient: [0, 0, 500, 500],
                    stops: [
                        [0, 'rgb(255, 255, 255)'],
                        [1, 'rgb(240, 240, 255)']
                    ]
                }
                ,
                borderWidth: 2,
                borderColor: '#95999C',
                plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                plotShadow: true,
                plotBorderWidth: 1
            },
            title: {
                style: { 
                    color: '#000',
                    font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            subtitle: {
                style: { 
                    color: '#666666',
                    font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                }
            },
            xAxis: {
                gridLineWidth: 1,
                lineColor: '#000',
                tickColor: '#000',
                labels: {
                    style: {
                        color: '#000',
                        font: '11px Trebuchet MS, Verdana, sans-serif'
                    }
                },
                title: {
                    style: {
                        color: '#333',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        fontFamily: 'Trebuchet MS, Verdana, sans-serif'

                    }                
                }
            },
            yAxis: {
                alternateGridColor: null,
                minorTickInterval: 'auto',
                lineColor: '#000',
                lineWidth: 1,
                tickWidth: 1,
                tickColor: '#000',
                labels: {
                    style: {
                        color: '#000',
                        font: '11px Trebuchet MS, Verdana, sans-serif'
                    }
                },
                title: {
                    style: {
                        color: '#333',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        fontFamily: 'Trebuchet MS, Verdana, sans-serif'
                    }                
                }
            },
            legend: {
                itemStyle: {
                    font: '9pt Trebuchet MS, Verdana, sans-serif',
                    color: 'black'

                },
                itemHoverStyle: {
                    color: '#039'
                },
                itemHiddenStyle: {
                    color: 'gray'
                }
            },
            credits: {
                style: {
                    right: '10px'
                }
            },
            labels: {
                style: {
                    color: '#99b'
                }
            }
        };

        var highchartsOptions = Highcharts.setOptions(oldDefault);
        <?php if ($affiliate->program != 'Revshare'): ?>
        var chart = new Highcharts.Chart({
           chart: {
              width: '720',
              height: '400',
              renderTo: 'graph',
              margin: [75, 120, 30, 60],
              zoomType: 'xy'
           },
           title: {
              text: 'Pay Period <?= min(array_keys($data['Clicks'])); ?> to <?= max(array_keys($data['Clicks'])); ?> for <?= (isset($_POST['site']) AND ! empty($_POST['site'])) ? $_POST['site'] : 'All Sites'; ?>',
              style: {
                 fontSize: '20px',
                 margin: '10px 0 0 0' // center it
              }
           },
           subtitle: {
              text: 'Note: Select a series in the legend to toggle hide/show, highlight an area to zoom',
              style: {
                 margin: '0 0 0 0' // center it
              }
           },
           xAxis: [{
              categories: [<?= "'" . str_replace(date('Y') . '-', '', implode("','", array_keys($data['Clicks'])))  . "'"; ?>],
              labels: {
                 style: {
                    fontSize: '10px'
                 }
              }
           }],
           yAxis: [{ // Primary yAxis
              labels: {
                 formatter: function() {
                    return roundNumber(this.value, 3);
                 },
                 style: {
                    color: '#89A54E',
                    fontSize: '10px',
                    marginBottom: '-2px'
                 }
              },
              title: {
                 text: 'Registrants',
                 style: {
                    color: '#89A54E'
                 },
                 margin: 40
              },
              opposite: true
              
           }, { // Secondary yAxis
              title: {
                 text: 'Clicks',
                 margin: 35,
                 style: {
                    color: '#4572A7'
                 }
              },
              labels: {
                 formatter: function() {
                    return roundNumber(this.value, 3);
                 },
                 style: {
                    color: '#4572A7',
                    fontSize: '10px',
                    marginBottom: '-2px'
                 }
              }
              
           }, { // Tertiary yAxis
              title: {
                 text: 'Members',
                 margin: 40,
                 style: {
                    color: '#AA4643'
                 }
              },
              labels: {
                 formatter: function() {
                    return roundNumber(this.value, 3);
                 },
                 style: {
                    color: '#AA4643',
                    fontSize: '10px',
                    marginBottom: '-2px'
                 }
              },
              opposite: true,
              offset: 60
           }],
           tooltip: {
              formatter: function() {
                 return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y;
              }
           },
           legend: {
              layout: 'horizontal',
              style: {
                 left: '50%',
                 bottom: 'auto',
                 right: 'auto',
                 top: '60px',
                 marginLeft: '-150px'
              },
              backgroundColor: '#FFFFFF'
           },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        style: {
                            marginBottom: '-5px'
                        },
                        formatter: function() {
                            return this.y + '';
                        }
                    }
                },
                spline: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return this.y + '';
                        }
                    }
                }
            },
           series: [{
              name: 'Clicks',
              color: '#4572A7',
              type: 'column',
              yAxis: 1,
              data: [<?= implode(",", array_values($data['Clicks'])); ?>]
           
           }, {
              name: 'Registrants',
              color: '#89A54E',
              type: 'spline',
              data: [<?= implode(",", array_values($data['Registrations'])); ?>]
           }, {
              name: 'Members',
              type: 'spline',
              color: '#AA4643',
              yAxis: 2,
              data: [<?= implode(",", array_values($data['Memberships'])); ?>]
           
           }]
        });
        <?php else: ?>
        var chart = new Highcharts.Chart({
           chart: {
              width: '720',
              height: '400',
              renderTo: 'graph',
              margin: [75, 120, 30, 60],
              zoomType: 'xy'
           },
           title: {
              text: 'Pay Period <?= min(array_keys($data['Clicks'])); ?> to <?= max(array_keys($data['Clicks'])); ?> for <?= (isset($_POST['site']) AND ! empty($_POST['site'])) ? $_POST['site'] : 'All Sites'; ?>',
              style: {
                 fontSize: '20px',
                 margin: '10px 0 0 0' // center it
              }
           },
           subtitle: {
              text: 'Note: Select a series in the legend to toggle hide/show, highlight an area to zoom',
              style: {
                 margin: '0 0 0 0' // center it
              }
           },
           xAxis: [{
              categories: [<?= "'" . str_replace(date('Y') . '-', '', implode("','", array_keys($data['Clicks'])))  . "'"; ?>],
              labels: {
                 style: {
                    fontSize: '10px'
                 }
              }
           }],
           yAxis: [{ // Primary yAxis
              labels: {
                 formatter: function() {
                    return roundNumber(this.value, 3);
                 },
                 style: {
                    color: '#89A54E',
                    fontSize: '10px',
                    marginBottom: '-2px'
                 }
              },
              title: {
                 text: 'Rebillings',
                 style: {
                    color: '#89A54E'
                 },
                 margin: 40
              },
              opposite: true
              
           }, { // Secondary yAxis
              title: {
                 text: 'Clicks',
                 margin: 35,
                 style: {
                    color: '#4572A7'
                 }
              },
              labels: {
                 formatter: function() {
                    return roundNumber(this.value, 3);
                 },
                 style: {
                    color: '#4572A7',
                    fontSize: '10px',
                    marginBottom: '-2px'
                 }
              }
              
           }, { // Tertiary yAxis
              title: {
                 text: 'Members',
                 margin: 40,
                 style: {
                    color: '#AA4643'
                 }
              },
              labels: {
                 formatter: function() {
                    return roundNumber(this.value, 3);
                 },
                 style: {
                    color: '#AA4643',
                    fontSize: '10px',
                    marginBottom: '-2px'
                 }
              },
              opposite: true,
              offset: 60
           }],
           tooltip: {
              formatter: function() {
                 return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y;
              }
           },
           legend: {
              layout: 'horizontal',
              style: {
                 left: '50%',
                 bottom: 'auto',
                 right: 'auto',
                 top: '60px',
                 marginLeft: '-150px'
              },
              backgroundColor: '#FFFFFF'
           },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        style: {
                            marginBottom: '-5px'
                        },
                        formatter: function() {
                            return this.y + '';
                        }
                    }
                },
                spline: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return this.y + '';
                        }
                    }
                }
            },
           series: [{
              name: 'Clicks',
              color: '#4572A7',
              type: 'column',
              yAxis: 1,
              data: [<?= implode(",", array_values($data['Clicks'])); ?>]
           }, {
              name: 'Rebillings',
              color: '#89A54E',
              type: 'spline',
              data: [<?= implode(",", array_values($data['Rebillings'])); ?>]
           }, {
              name: 'Members',
              type: 'spline',
              color: '#AA4643',
              yAxis: 2,
              data: [<?= implode(",", array_values($data['Memberships'])); ?>]
           
           }]
        });
        <?php endif; ?>
    });
</script>
<h3>Performance Overview for <?= $affiliate->first_name . ' ' . $affiliate->last_name; ?></h3>
<div style="float: right;">
    <div id="graph" ></div>
</div>
<br />
<ul id="affiliate-info">
    <li><strong>Account</strong><br /><?= ( ! empty($affiliate->company)) ? $affiliate->company : $affiliate->first_name . ' ' . $affiliate->last_name; ?></li>
    <li><strong>Total Clicks</strong><br /><?= number_format($totals['Clicks']); ?></li>
    <?php if ($affiliate->program != 'Revshare'): ?>
    <li><strong>Total Registrants</strong><br /><?= number_format($totals['Registrations']); ?></li>
    <?php else: ?>
    <li><strong>Total Registrants</strong><br /><?= number_format($totals['Registrations']); ?></li>
    <li><strong>Total Rebillings</strong><br /><?= number_format($totals['Rebillings']); ?></li>
    <?php endif; ?>
    <li><strong>Total Members</strong><br /><?= number_format($totals['Memberships']); ?></li>
    <li><strong>Webmaster Referrals</strong><br />0</li>
    <li><strong>Reward Point Balance</strong><br /><?= $affiliate->reward_points; ?> Points</li>
    <li><strong>Pending Commission</strong><br />$<?= number_format($commission, 2); ?> USD</li>
    <!--li><strong>Paid Commission</strong><br />$<?= ''; //number_format(Core::$affiliate->total_commission, 2); ?> USD</li-->
</ul>
<div class="clear"></div>
<?php endif; ?>