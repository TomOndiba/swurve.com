<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Index extends Controller_Master
{
    function before()
    {
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }

    function action_index()
    {
        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/index')->bind('pendingpayouts', $pendingpayouts)->bind('pendingfbpayouts', $pendingfbpayouts);

        $pendingpayouts = ORM::factory('affiliate')->where('pending_commission', '>=' , 50.00)->count_all();
        $pendingfbpayouts = ORM::factory('camgirl')->where('pending_commission', '>=' , 50.00)->count_all();
    }

    function action_chatlogs()
    {
        $this->template->head->stylesheets = array(
	        Functions::src_file('assets/css/layout2.css') => 'screen',
	        Functions::src_file('assets/css/swurve.affiliates.css') => 'screen',
	        Functions::src_file('assets/css/swurve.css') => 'screen'
        );

        $this->template->content = View::factory('admin/chatlogs');
    }
}