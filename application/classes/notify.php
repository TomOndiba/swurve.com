<?php defined('SYSPATH') or die('No direct script access.'); 
/**
 * Notify helper class.
 * Used to display flash notifications on successful/failed events.
 *
 * @package    Notify
 * @author     Jeffrey Wilbert
 * @copyright  (c) 2009 Swurve
 */
class Notify
{
    /**
     * Sets a new flash data variable in the session array
     *
     * @param   string   type of notification (pass, fail, normal)
     * @param   string   value
     * @return  void
     */    
    public static function set($type, $msg)
    {
        $data = Core::$session->get('flash', array());

        if (isset($data[$type]))
        {
            $data[$type] .= '<br />' . $msg;
        }
        else
        {
            $data[$type] = $msg;
        }

        Core::$session->set('flash', $data);
    }
    
    /**
     * Gets the flash data variable from the session array
     *
     * @return  array
     */    
    public static function get()
    {
        if ( ! is_null($data = Core::$session->get('flash')))
        {
            Core::$session->delete('flash');
        }

        return $data;
    }
}