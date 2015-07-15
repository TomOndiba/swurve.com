<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Affiliates_Programs extends Controller_Master
{
    public $template = 'affiliates';
    
    public function action_index()
    {
        $this->template->content = View::factory('affiliates/programs');
    }
}