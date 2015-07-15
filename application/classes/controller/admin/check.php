<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Check extends Controller_Master
{
    function before() 
    {
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }

    function action_index()
    {
        $this->add_javascript(array(Functions::src_file('assets/js/jquery.hotkeys.js')));
        $this->template->head->meta_title = 'Home';
        $this->template->content = View::factory('admin/check')->bind('photos', $photos)->bind('pagination', $pagination);

        $post = $_POST;
        
        if ($post)
        {
            $delete_count = 0;
            $pg_count = 0;
            $adult_count = 0;
            $default_count = 0;
            
            if (isset($post['delete']))
            {
                foreach($post['delete'] as $photo) {
                    $photo = ORM::factory('photo', $photo);
                    
                    if ($photo->loaded())
                    {
                        @unlink(Content::factory($photo->user->username)->get_path('photo') . $photo->uniqueid . '_s.png');
                        @unlink(Content::factory($photo->user->username)->get_path('photo') . $photo->uniqueid . '_m.png');
                        @unlink(Content::factory($photo->user->username)->get_path('photo') . $photo->uniqueid . '_l.png');
                        @unlink(Content::factory($photo->user->username)->get_path('photo') . $photo->uniqueid . '_f.png');
                        @unlink(Content::factory($photo->user->username)->get_path('photo') . $photo->uniqueid . '_a.png');
                        @unlink(Content::factory($photo->user->username)->get_path('photo') . $photo->uniqueid . '.png');

                        if ($photo->user->avatar->id == $photo->id)
                        {
                            $photo->user->avatar_id = NULL;
                            $photo->user->save();
                        }

                        $photo->delete();

                        $delete_count++;
                    }
                }
            }
            
            if (isset($post['pg']))
            {
                foreach($post['pg'] as $photo) {
                    $photo = ORM::factory('photo', $photo);
                    
                    if ($photo->loaded())                                                                         
                    {
                        $photo->approved = 'PG-13';
                        $photo->review_date = time();
                        $photo->review_user_id = Core::$user->id;

                        $photo->save();

                        $pg_count++;
                    }
                }
            }

            if (isset($post['adult']))
            {
                foreach($post['adult'] as $photo) {
                    $photo = ORM::factory('photo', $photo);
                    
                    if ($photo->loaded())                                                                         
                    {
                        $photo->approved = 'Adult';
                        $photo->review_date = time();
                        $photo->review_user_id = Core::$user->id;

                        $photo->save();

                        $adult_count++;
                    }
                }
            }

            if (isset($post['default']))
            {
                foreach($post['default'] as $photo) {
                    $photo = ORM::factory('photo', $photo);
                    
                    if ($photo->loaded())                                                                         
                    {
                        $photo->user->avatar_id = $photo->id;
                        $photo->user->save();

                        $default_count++;
                    }
                }
            }

            Notify::set('info', 'Deleted: ' . $delete_count . ' Photo(s), PG Approved: ' . $pg_count . ' Photo(s), Adult Approved: ' . $adult_count . ' Photo(s), Defaulted: ' . $default_count . ' Photo(s)');

            Request::instance()->redirect('admin/check');
        }
        
        $total = ORM::factory('photo')->where('approved', '=', 'No')->find_all()->count();

        $pagination = Pagination::factory(
            array
            (
                'current_page'   => array('source' => 'query_string', 'key' => 'page'),
                'total_items' => $total,
                'items_per_page' => 30,
                'view'           => 'pagination/digg',
            )
        );

        $photos = ORM::factory('photo')->where('approved', '=', 'No')->order_by('user_id', 'DESC')->limit($pagination->items_per_page)->offset(($pagination->current_page - 1) * $pagination->items_per_page)->find_all();
    }
}