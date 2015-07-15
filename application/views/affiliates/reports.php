<script type="text/javascript" src="/assets/js/highcharts.js"></script>
<!--[if IE]>
<script type="text/javascript" src="/assets/js/excanvas.compiled.js"></script>
<![endif]-->
<script type="text/javascript">
    $(document).ready(function() {
        var dates = $('#datepicker1, #datepicker2').datepicker({
            dateFormat: 'yy-mm-dd'/*,
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
            }*/
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
    Filter: <?= Form::input('date_from', isset($_POST['date_from']) ? $_POST['date_from'] : date('Y-m-d', $range->start), array('maxlength' => '10', 'id' => 'datepicker1', 'style' => 'font-size: 12px; font-weight: bold; width: 105px;', 'readonly' => 'readonly')); ?> to <?= Form::input('date_to', isset($_POST['date_to']) ? $_POST['date_to'] : date('Y-m-d', $range->end), array('maxlength' => '10', 'id' => 'datepicker2', 'style' => 'font-size: 12px; font-weight: bold; width: 105px;', 'readonly' => 'readonly')); ?><br />
    Show: <?= Form::select('graph1', $graphOptions, ! isset($post['graph1']) ? NULL : $post['graph1']); ?><br />
    
    <?= Form::button('reset', 'Reset', array('id' => 'reset-button', 'class' => 'form-stats-button')); ?>&nbsp;<?= Form::submit('submit', 'Get Stats', array('class' => 'form-stats-button')); ?>
    
    <?php if (isset($data)): ?>
        <br /><br />
        <?php if (count($data) == 0): ?>
        No Results Found
        <?php else: ?>
        Found <?= count($data); ?> Result(s)<br /><br />
        <?php endif; ?>
        <?php foreach ($data as $user): ?>
            <?= $user->tracking_id; ?><br />
        <?php endforeach; ?>
    <?php endif; ?>
</p>
<?= Form::close(); ?>