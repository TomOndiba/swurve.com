<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Flirtbucks_Requirements extends Controller_Master
{
    public $template = 'flirtbucks';
    
    public function action_index()
    {
        $this->template->content = View::factory('flirtbucks/requirements');
    }
}