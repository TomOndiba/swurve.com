<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Check extends Controller_Master
{
    function action_index()
    {
        $this->template->head->meta_title = 'Home';
        $this->template->content = View::factory('check');
    }
}