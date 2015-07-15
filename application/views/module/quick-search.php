<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="side-module" id="user-stats">
    <h2><?= __('Quick Search'); ?></h2>
    Find a sexy
    <?php
        $users_table = ORM::factory('user'); 

        echo Form::select('interested_in', array('' => 'Select', 'Male' => 'Men', 'Female' => 'Women', 'Both' => 'Both'), NULL, array('id' => 'interested_in'));

    ?> within <?php
        echo Form::select('miles', array('' => 'Select', '10' => '10', '25' => '25', '50' => '50', '75' => '75', '100' => '100'), NULL, array('id' => 'miles'));
    ?><br />
    <span class="spacing">miles of</span><?= Form::select('country_id', array(), NULL, array('id' => 'country')); ?><br />
    <span class="spacing">&nbsp;</span><?= Form::select('region_id', array('Select A Region'), (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region', 'disabled' => 'disabled')); ?><br />
    <span class="spacing">&nbsp;</span><?= Form::select('city_id', array('Select A City'), (isset($post['city_id'])) ? $post['city_id'] : NULL, array('id' => 'city', 'disabled' => 'disabled')); ?><br />
    <span class="spacing">&nbsp;</span><?= Form::input('search', 'search', array('type' => 'image', 'src' => '/assets/img/button-search.png')); ?>
</div>