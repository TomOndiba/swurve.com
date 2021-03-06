<?php
    $height = 65;
    
    $calc_height = count(array_keys($data['Clicks'])) * 15;
    
    $final_height = $height + $calc_height; 
?>
<script type="text/javascript">
    $(window).load(function() {
        var chart2 = new Highcharts.Chart({
            chart: {
                width: '305',
                height: '<?php echo $final_height; ?>',
                inverted: true,
                renderTo: 'graph-clickstoregistrantsconversion',
                margin: [40, 25, 25, 45],
                zoomType: 'xy'
            },
            title: {
                text: 'Clicks to Reg Conversion %',
                style: {
                    fontSize: '20px',
                    margin: '10px 0 0 0' // center it
                }
            },
            xAxis: [{
                categories: [<?= "'" . str_replace(date('Y') . '-', '', implode("','", array_keys($data['Clicks'])))  . "'"; ?>],
                labels: {
                    y: 6                    
                }
            }],
            yAxis: [{
                title: {
                    text: '',
                    margin: 40
                },
                labels: {
                    formatter: function() {
                        return Math.floor(this.value) + '%';
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
                        align: 'left',
                        x: 5,
                        y: 5,
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
<div id="graph-clickstoregistrantsconversion" style="display: inline-block;"></div>