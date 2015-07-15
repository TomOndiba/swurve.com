<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Flirtbucks_Confidentiality  extends Controller_Master
{
    public $template = 'flirtbucks';
    
    public function action_agreement()
    {
        $this->template->content = View::factory('flirtbucks/confidentiality');

        if ($_POST)
        {
            $post = $_POST;
            
            if ( ! isset($post['agree']))
            {
                Notify::set('fail', 'You have not agreed to the confidentiality agreement.');
                Request::instance()->redirect(Request::$referrer);
            }
            
            if ( ! isset($post['signature']) OR ! isset($post['date']))
            {
                Notify::set('fail', 'You did not fill out all the required e-signature fields.');
                Request::instance()->redirect(Request::$referrer);
            }
            
            if ( ! (bool)preg_match('/[0-1][0-9]\/[0-3][0-9]\/[0-9]{4}/', $post['date']) OR ! Validate::date($post['date']))
            {
                Notify::set('fail', 'Please enter a valid date in the format MM/DD/YYYY');
                Request::instance()->redirect(Request::$referrer);
            }
            
            if ( $post['date'] != date('m/d/Y'))
            {
                Notify::set('fail', 'Invalid date entered, please enter todays date.');
                Request::instance()->redirect(Request::$referrer);
            }
            
            Core::$camgirl->e_name = $post['signature'];
            Core::$camgirl->e_date = $post['date'];
            Core::$camgirl->disclosure_agreement = 'Yes';
            
            Core::$camgirl->save();
            
            Request::instance()->redirect('/profile/create');
        }
    }
}