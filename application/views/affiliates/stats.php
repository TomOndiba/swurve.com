<script type="text/javascript" src="/assets/js/highcharts.js"></script>
<!--[if IE]>
<script type="text/javascript" src="/assets/js/excanvas.compiled.js"></script>
<![endif]-->
<script type="text/javascript">
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
    });

    $(document).ready(function() {
        var dates = $('#datepicker1, #datepicker2').datepicker({
            dateFormat: 'yy-mm-dd',
            beforeShow: customRange,
            onSelect: function(selectedDate) {
                if (this.id == 'datepicker1')
                {
                    $('#datepicker2').attr('disabled', '');
                    var d = $("#datepicker1").datepicker("getDate");
                    d.setDate(d.getDate()+20);
                    $('#datepicker2').val(d.getYear()+"-"+(d.getMonth()+1)+"-"+d.getDate());
                }

                var option = this.id == "datepicker1" ? "minDate" : "maxDate";
                var instance = $(this).data("datepicker");
                var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
        
        function customRange(input)  
        {  
            var dateMin = null; 
            var dateMax = null; 
     
            if (input.id == "datepicker1" && $("#datepicker2").datepicker("getDate") != null) 
            { 
                    dateMax = $("#datepicker2").datepicker("getDate"); 
                    //dateMin = $("#datepicker2").datepicker("getDate"); 
                    //dateMin.setDate(dateMin.getDate() - 17); 
            } 
            else if (input.id == "datepicker2" && $("#datepicker1").datepicker("getDate") != null) 
            { 
                    dateMin = $("#datepicker1").datepicker("getDate"); 
                    dateMax = $("#datepicker1").datepicker("getDate"); 
                    dateMax.setDate(dateMax.getDate() + 30);  
            } 
        
            return { 
                minDate: dateMin,  
                maxDate: dateMax 
            };
        } 

        $('#reset-button').click(function() {
            $('#datepicker1, #datepicker2').val('');
            $('#datepicker2').attr('disabled', 'disabled');
            return false;
        });
        
        $('#stats-form').submit(function() {
            if ($('#datepicker1').val() == '' || $('#datepicker2').val() == '')
            {
                alert('Please select a "start" and "end" date');
                
                return false;
            }
            
            return true;
        });
    });
</script>

<h1>Your Affiliate Stats</h1>
<?= Form::open(NULL, array('id' => 'stats-form')); ?>
<p>
    Filter: <?= Form::input('date_from', min(array_keys($data['Memberships'])), array('maxlength' => '10', 'id' => 'datepicker1', 'style' => 'font-size: 12px; font-weight: bold; width: 105px;', 'readonly' => 'readonly')); ?> to <?= Form::input('date_to', max(array_keys($data['Memberships'])), array('maxlength' => '10', 'id' => 'datepicker2', 'style' => 'font-size: 12px; font-weight: bold; width: 105px;', 'readonly' => 'readonly')); ?><br />
    Show: <?= Form::select('graph1', $graphOptions, ! isset($post['graph1']) ? 'Total Clicks' : $post['graph1']); ?> <?= Form::select('graph2', $graphOptions, ! isset($post['graph2']) ? 'Total Registrants' : $post['graph2']); ?> <?= Form::select('graph3', $graphOptions, ! isset($post['graph3']) ? 'Total Members' : $post['graph3']); ?><br />
    For Campaign/Sub ID: <?= Form::select('subcampaign', array('Select Campaign/Sub ID', '  Sub IDs with No Campaigns' => $subs, '  Campaigns' => $campaigns), $post['subcampaign']); ?><br />
    
    <?= Form::button('reset', 'Reset', array('id' => 'reset-button', 'class' => 'form-stats-button')); ?>&nbsp;<?= Form::submit('submit', 'Get Stats', array('class' => 'form-stats-button')); ?>
</p>
<?= Form::close(); ?>