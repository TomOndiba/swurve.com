<?php
    $width = 925;
    
    $calc_width = count(array_keys($data['Clicks'])) * 20;
    
    $final_width = ($calc_width > $width) ? $calc_width : $width; 
?>
<script type="text/javascript">
    $(window).load(function() {
        var chart2 = new Highcharts.Chart({
            chart: {
                width: '<?php echo $final_width; ?>',
                height: '200',
                renderTo: 'graph-totalclicks',
                margin: [40, 25, 25, 45],
                zoomType: 'xy'
            },
            title: {
                text: 'Total Clicks',
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
                        return this.value;
                    }
                }
            }],
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y + ' Clicks';
                }
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
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Clicks',
                color: '#4572A7',
                type: 'column',
                data: [<?= implode(",", array_values($data['Clicks'])); ?>]
            }]
        });
    });
</script>

<br /><div id="graph-totalclicks"></div>