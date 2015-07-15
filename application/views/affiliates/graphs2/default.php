<?php
    $height = 65;
    
    $calc_height = count(array_keys($data['Clicks'])) * 15;
    
    $final_height = $height + $calc_height; 
?>
<script type="text/javascript">
    $(window).load(function() {
        var chart = new Highcharts.Chart({
            colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
           chart: {
              width: '925',
              height: '<?php echo $final_height; ?>',
              renderTo: 'graph-totalclicks',
              margin: [135, 50, 30, 80],
              zoomType: 'xy'
           },
           title: {
              text: 'Total Clicks, Clicks to Registrants Conversion, and Clicks to Members Conversion',
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
                    y: 6                    
                }
           }],
           yAxis: [{ // Primary yAxis
                reversed: false,
              labels: {
                 formatter: function() {
                    return Math.floor(this.value) + '%';
                 },
                 style: {
                    color: '#89A54E'
                 }
              },
              title: {
                 text: '',
                 style: {
                    color: '#89A54E'
                 },
                 margin: 50
              },
              opposite: true
              
           }, { // Secondary yAxis
              title: {
                 text: 'Clicks',
                 margin: 50,
                 style: {
                    color: '#4572A7'
                 }
              },
              labels: {
                 formatter: function() {
                    return this.value;
                 },
                 style: {
                    color: '#4572A7'
                 }
              }
              
           }, { // Tertiary yAxis
           reversed: false,
              title: {
                 text: '',
                 margin: 50,
                 style: {
                    color: '#AA4643'
                 }
              },
              labels: {
                 formatter: function() {
                    return Math.floor(Math.abs(this.value)) + '%';
                 },
                 style: {
                    color: '#AA4643'
                 }
              },
              opposite: true,
              offset: 20
           }],
           tooltip: {
              formatter: function() {
                 return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y + (this.series.name == 'Clicks' ? ' Clicks' : '%');
              }
           },
           legend: {
              layout: 'horizontal',
              style: {
                 left: '50%',
                 bottom: 'auto',
                 right: 'auto',
                 top: '60px',
                 marginLeft: '-265px'
              },
              backgroundColor: '#FFFFFF'
           },
           series: [{
              name: 'Clicks',
              color: '#4572A7',
              type: 'bar',
              yAxis: 1,
              data: [<?= implode(",", array_values($data['Clicks'])); ?>]
           
           }, {
              name: 'Clicks to Registrants Conversion %',
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
           }, {
              name: 'Clicks to Members Conversion %',
              type: 'spline',
              color: '#AA4643',
              yAxis: 2,
              data: [<?php
                $count = 0;

                foreach($data['Memberships'] as $day => $value)
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
<div id="graph-totalclicks"></div>