<script type="text/javascript">
    $(window).load(function() {
        var chart2 = new Highcharts.Chart({
            chart: {
                width: '925',
                height: '200',
                renderTo: 'graph-totalregistrants',
                margin: [40, 25, 25, 45],
                zoomType: 'xy'
            },
            title: {
                text: 'Total Registrants',
                style: {
                    fontSize: '20px',
                    margin: '10px 0 0 0' // center it
                }
            },
            xAxis: [{
                categories: [<?= "'" . str_replace(date('Y') . '-', '', implode("','", array_keys($data['Registrations'])))  . "'"; ?>]
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
                    this.x +': '+ this.y + ' Registrants';
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
                name: 'Registrants',
                color: '#89A54E',
                type: 'column',
                data: [<?= implode(",", array_values($data['Registrations'])); ?>]
            }]
        });
    });
</script>

<br /><div id="graph-totalregistrants"></div>