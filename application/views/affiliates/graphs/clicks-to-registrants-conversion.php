<script type="text/javascript">
    $(window).load(function() {
        var chart2 = new Highcharts.Chart({
            chart: {
                width: '925',
                height: '200',
                renderTo: 'graph-clickstoregistrantsconversion',
                margin: [40, 25, 25, 45],
                zoomType: 'xy'
            },
            title: {
                text: 'Clicks to Registrants Conversion %',
                style: {
                    fontSize: '20px',
                    margin: '10px 0 0 0' // center it
                }
            },
            xAxis: [{
                categories: [<?= "'" . str_replace(date('Y') . '-', '', implode("','", array_keys($data['Clicks'])))  . "'"; ?>]
            }],
            yAxis: [{
                title: {
                    text: '',
                    margin: 40
                },
                labels: {
                    formatter: function() {
                        return this.value + '%';
                    }
                }
            }],
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y + '%';
                }
            },
            plotOptions: {
                spline: {
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return this.y + '%';
                        }
                    }
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Conversion %',
                color: '#89A54E',
                type: 'spline',
                data: [<?php
                $count = 0;

                foreach($data['Registrations'] as $day => $value)
                {
                    $count++;
                    
                    if ($count == 1)
                    {
                        echo number_format(@($value / $data['Clicks'][$day] * 100), 2);
                    }
                    else
                    {
                        echo ', ' . number_format(@($value / $data['Clicks'][$day] * 100), 2);
                    }
                }
              ?>]
            }]
        });
    });
</script>

<br /><div id="graph-clickstoregistrantsconversion"></div>