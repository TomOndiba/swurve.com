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
      $('#site-select').change(function() {
        $(this).parent('form').submit();
      })

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
        <?php if (Core::$affiliate->program != 'Revshare'): ?>
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
<?php
/*
    for($i = 1; $i <= 1000; $i++)
    {
        Stats::add_click(1, rand(0, 2), ' -' . rand(0, 3) . ' days');
    }

    for($i = 1; $i <= 100; $i++)
    {
        Stats::add_registration(1, rand(0, 2), ' -' . rand(0, 3) . ' days');
    }

    for($i = 1; $i <= 10; $i++)
    {
        Stats::add_member(1, rand(0, 2), ' -' . rand(0, 3) . ' days');
    }

    for($i = 1; $i <= 10; $i++)
    {
        switch(rand(1, 4))
        {
            case 1:
                $amount = '25.95';
                break;

            case 2:
                $amount = '29.95';
                break;

            case 3:
                $amount = '35.95';
                break;

            case 4:
                $amount = '65.95';
                break;
        }

        Stats::add_rebilling(1, rand(0, 2), $amount, ' -' . rand(0, 3) . ' days');
    }
*/
?>
<?php if (1 == 2): ?>
<div class="alert" style="background-color: #FFFFE1; height: 65px;"><?=HTML::image('assets/img/icons/megaphone.png', array('style' => 'vertical-align: middle; display: inline-block;', 'align' => 'left')); ?> <span style="margin-top: 15px; padding-left: 88px; display: block;">Program anncouncements, new tools, promo info goes here. Like “Add this top converting landing page to your arsenal.” “Make more money with our new flash banner ads” stuff like that</span></div><br />
<?php endif; ?>
<div style="float: right">
  View Stats for:
  <form method="post">
    <select name="site" id="site-select">
      <option value="">All Sites</option>
      <option <?php if (isset($_POST['site']) AND $_POST['site'] == 'Swurve') echo 'selected="selected"'; ?> value="Swurve">Swurve</option>
      <option <?php if (isset($_POST['site']) AND $_POST['site'] == 'Kruze') echo 'selected="selected"'; ?> value="Kruze">Kruze</option>
      <option <?php if (isset($_POST['site']) AND $_POST['site'] == 'Russian Desire') echo 'selected="selected"'; ?> value="Russian Desire">Russian Desire</option>
    </select>
  </form>
</div>

<h1>Performance Overview</h1>
<div style="float: right;">
    <div id="graph" ></div>
    <center><small><?= HTML::anchor('affiliates/stats2/', 'Click Here for Detailed Reports') ?></small></center>
    <?php if (Core::$affiliate->id == 1 OR Core::$affiliate->id == 21136): ?>
    <center><small><?= HTML::anchor('affiliates/reports/', 'Click Here for Custom ID Reports') ?></small></center>
    <?php endif; ?>
</div>
<br />
<ul id="affiliate-info">
    <li><strong>Account</strong><br /><?= ( ! empty(Core::$affiliate->company)) ? Core::$affiliate->company : Core::$affiliate->first_name . ' ' . Core::$affiliate->last_name; ?></li>
    <li><strong>Total Clicks</strong><br /><?= number_format($totals['Clicks']); ?></li>
    <?php if (Core::$affiliate->program != 'Revshare'): ?>
    <li><strong>Total Registrants</strong><br /><?= number_format($totals['Registrations']); ?></li>
    <?php else: ?>
    <li><strong>Total Registrants</strong><br /><?= number_format($totals['Registrations']); ?></li>
    <li><strong>Total Rebillings</strong><br /><?= number_format($totals['Rebillings']); ?></li>
    <?php endif; ?>
    <li><strong>Total Members</strong><br /><?= number_format($totals['Memberships']); ?></li>
    <li><strong>Webmaster Referrals</strong><br />0</li>
    <li><strong>Reward Point Balance</strong><br /><?= Core::$affiliate->reward_points; ?> Points (<?= HTML::anchor('affiliates/account/rewards', 'Redeem'); ?>)</li>
    <li><strong>Pending Commission</strong><br />$<?= number_format($commission, 2); ?> USD</li>
    <!--li><strong>Paid Commission</strong><br />$<?= ''; //number_format(Core::$affiliate->total_commission, 2); ?> USD</li-->
</ul>
<div class="clear"></div>
<?php if (Core::$affiliate->have_w9 == 'No' AND Core::$affiliate->country_id == 233): ?>
<div class="alert" style="padding-top: 20px; padding-bottom: 0;">We have not recieved your W-9.  A completed W-9 form is required for all US affiliates.  <?= HTML::anchor('/affiliates/account/support/w9', 'Click Here'); ?> for details.</div>
<?php endif; ?>