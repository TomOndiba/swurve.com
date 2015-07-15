<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Test extends Controller_Master
{
    function before() 
    {
        $this->secure = NULL;
        
        parent::before();

        $this->auto_render = FALSE;
    }
    
    public function action_index()
    {
        echo 'test';
    }
}