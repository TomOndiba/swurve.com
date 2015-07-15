<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<?php
    $sql = "SELECT r.id, r.name
            FROM regions r, countries c
            WHERE r.country_code = c.code AND c.id = '233'
            ORDER BY r.name ASC";

    $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

    $locations['regions'] = array('' => 'Select A Region') + $data;
    
    $sql = "SELECT id, name
            FROM countries
            ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

    $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

    $locations['countries'] = $data;
?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    $('#quick-search').submit(function() {
        $('#country_id').val($('#QScountry').val());
        $('#region_id').val($('#QSregion').val());
        //$('#city_id').val($('#QScity').val());
    });
});
</script>
<div class="side-module" id="user-stats">
    <h2><?= __('Quick Search'); ?></h2>
    <?php
    echo Form::open('user/search/results', array('id' => 'quick-search', 'method' => 'get'));
    echo Form::hidden('country_id', NULL, array('id' => 'country_id'));
    echo Form::hidden('region_id', NULL, array('id' => 'region_id'));
    echo Form::hidden('city_id', NULL, array('id' => 'city_id'));
    ?>
    Find sexy
    <?php
        $users_table = ORM::factory('user'); 

        echo Form::select('gender', array('' => 'Select', 'Male' => 'Men', 'Female' => 'Women', '' => 'Both'), Core::$user ? Core::$user->interested_in : NULL, array('id' => 'QSinterested_in'));

    ?> located <!--?php
        echo Form::select('miles', array('' => 'Select', '10' => '10', '25' => '25', '50' => '50', '75' => '75', '100' => '100'), NULL, array('id' => 'QSmiles'));
    ?--><br />
    <span class="spacing">near</span><?= Form::select('country', $locations['countries'], NULL, array('id' => 'QScountry')); ?><br />
    <span class="spacing">&nbsp;</span><?= Form::select('region', $locations['regions'], (isset($post['region'])) ? $post['region'] : NULL, array('id' => 'QSregion')); ?><br />
    <span class="spacing">&nbsp;</span><?= Form::input('city', 'Enter A City', array('id' => 'QScity', 'disabled' => 'disabled'));  //Form::select('city', array('Select A City'), (isset($post['city'])) ? $post['city'] : NULL, array('id' => 'QScity', 'disabled' => 'disabled')); ?><br />
    <center><?= Form::input('search', 'search', array('type' => 'image', 'src' => '/assets/img/button-search.png', 'id' => 'QSsubmit')); ?></center>
<?php
echo Form::close();
?>
</div>