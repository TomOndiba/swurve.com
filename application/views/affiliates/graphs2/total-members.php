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
                renderTo: 'graph-totalmembers',
                margin: [40, 25, 25, 45],
                zoomType: 'xy'
            },
            title: {
                text: 'Total Members',
                style: {
                    fontSize: '20px',
                    margin: '10px 0 0 0' // center it
                }
            },
            xAxis: [{
                categories: [<?= "'" . str_replace(date('Y') . '-', '', implode("','", array_keys($data['Memberships'])))  . "'"; ?>],
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
                        return this.value;
                    }
                }
            }],
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y + ' Members';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        align: 'left',
                        x: 5,
                        y: 1,
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
                name: 'Members',
                color: '#AA4643',
                type: 'bar',
                data: [<?= implode(",", array_values($data['Memberships'])); ?>]
            }]
        });
    });
</script>

<div id="graph-totalmembers" style="display: inline-block;"></div>