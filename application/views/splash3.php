<?php
	if (! isset($rand)) $rand = rand(1, 5);

	$girls[1] = 'SexyKatey24';
	$girls[2] = 'BellissimaXoX';
	$girls[3] = 'Sera4FWB';
	$girls[4] = 'StacePlayzToo';
	$girls[5] = 'XXXtina69';

  $users = ORM::factory('geoad');

  if (isset($_GET['d']))
  {
      $users = $users->where('type', '=', ($_GET['d'] == 'f') ? 'Female' : (($_GET['d'] == 'm') ? 'Male' : 'Both') );
  }
  else
  {
      $users = $users->where('type', '=', 'Both');
  }

  if(isset($from_afl) AND $from_afl == '21137') //21137
  {
      $users = $users->where('birthdate', '<=', strtotime('est today -25 years'));
  }

  $users = $users->order_by(new Database_Expression('RAND()'))->limit(5)->find_all();
/*
  $online = ORM::factory('online')->with('user')->where('last_seen', '>=', strtotime('-1 hours'));
  $online->where('user.gender', '=', 'Female');

  $this->template->online_now->users = $online->order_by('last_seen', 'DESC')->limit(5)->find_all();
*/
  //$geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->where('end_ip', '>=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->find();
  $geoloc = ORM::factory('geoip')->where('start_ip', '<=', sprintf("%u", ip2long($_SERVER['REMOTE_ADDR'])))->order_by('start_ip', 'DESC')->limit(1)->find();

  if ($geoloc->loaded() AND $geoloc->geolocation->loaded())
  {

      if (empty($geoloc->geolocation->metrocode) AND empty($geoloc->geolocation->areacode))
      {
          if (empty($geoloc->geolocation->city) OR empty($geoloc->geolocation->region))
          {
              $cities[] = '';
          }
          else
          {
              $cities[] = $geoloc->geolocation->city . ', ' . $geoloc->geolocation->region;
          }
      }
      else
      {
        $sql = 'select distinct city, region from iplocationdb_location where metrocode = \'' . $geoloc->geolocation->metrocode . '\' and areacode = \'' . $geoloc->geolocation->areacode . '\' group by city order by min(abs(' . $geoloc->geolocation->latitude . ' - latitude)) asc, min(abs(' . $geoloc->geolocation->longitude . ' - longitude)) asc limit 4';

        $locations = DB::query(Database::SELECT, $sql)->as_object('Model_GeoLocation')->execute();

        foreach($locations as $location)
        {
            $cities[] = $location->city . ', ' . $location->region;
        }
      }

      if ($geoloc->end_ip >= ip2long($_SERVER['REMOTE_ADDR']))
			{
      		if (! empty($location->city) AND ! empty($geoloc->geolocation->region))
      		{
      				$geolocation = $geoloc->geolocation->city. ', ' . $geoloc->geolocation->region;
          }
          else
          {
          		$geolocation = '';
          }
      }
      else
      {
	    		$geolocation = '';
	    }
  }
  else
	{
			$geolocation = '';
  }

$content->bind('geolocation', $geolocation);

  $sql = "SELECT r.id, r.name
          FROM regions r, countries c
          WHERE r.country_code = c.code AND c.id = '233'
          ORDER BY r.name ASC";

  $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

  $post['regions'] = array('' => 'Select A Region') + $data;

  $sql = "SELECT id, name
          FROM countries
          ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

  $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

  $post['countries'] = $data;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?= $head; ?>
				<style>
#male, #female {
    cursor: pointer;
}

#seeking {
    position: relative;
    margin-top: -25px;
    left: 120px;
    width: 400px;
    display: block;
}

#seeking li {
    float: left;
    width: 150px;
    font-size: 11px;
    line-height: 12px;
}

.clear {
    clear: both;
    padding-top: 10px;
}

#seeking input {
    width: 15px !important;
}

#tos {
    width: 25px !important;
}

h2 {
    font-size: 32px;
}

.pink {
    color: #a66ba6;
}

.blue {
    color: #10476c;
}

#geoprofiles {
    margin-left: 5px;
    width: 460px;
    text-align: center;
}

#geoprofiles li {
    float: left;
    display: block;
    width: 225px;
    height: 212px;
}

textarea {
    display: block;
    width: 440px;
    height: 100px;
}

#heightslider {
    width: 182px;
}

#heightdisplay {
    border:0;
    color:#000;
    font-size: 14px !important;
    background-color: #FAF5F9;
    font-weight: bold !important;
    width: 35px !important;
}

#slidercontainer {
    position: absolute;
    display: inline;
    margin-top: 8px;
}
h4 {
    margin-top: 3px !important;
}

small {
    font-size: 10px !important;
}

#tooltip {
	z-index: 100;
}
				</style>

				<link type="text/css" href="<?= Functions::src_file('/assets/css/jquery.rating.css'); ?>" rel="stylesheet" media="screen" />
				<script type="text/javascript" src="<?= Functions::src_file('/assets/js/jquery.rating.js'); ?>"></script>

        <script type="text/javascript" src="<?= Functions::src_file('/assets/js/swfobject.js'); ?>"></script>
        <script type="text/javascript">
            swfobject.registerObject("swurve-flash", "7.0.0", "/assets/img/splash/expressInstall.swf");
        </script>
        <script type="text/javascript" language="javascript">
            $(document).ready(function() {
                $('#splash-search').submit(function() {
                    $('#country_name').val($('#country option:selected').text());
                    $('#region_name').val($('#region option:selected').text());
                });

        				$('.rating').rating({
				            half: true,
				            callback: function(value, link){
				                location.href = '/user/register';
				            }
				        });
            });
        </script>
        <style>
						input, select {
							font-size: 12px;
						}

						.profile-button div {
							font-size: 9px !important;
						}
				</style>
    </head>
    <body>
        <div id="header">
            <p>
                Already Registered? <?= HTML::anchor('user/login', 'Login'); ?>
            </p>

            <div style="position: relative; height: 95px; z-index: -1;">
            <div style="position: absolute; margin-top: -53px; width: 518px; height: 317px; background: URL('/assets/img/headderlogo.png');"></div>
            <?= HTML::image('assets/img/headderpeople.png', array('alt' => '', 'style' => 'float: right; margin-right: 150px; margin-top: -15px;')); ?>
            </div>

            <div id="menu" style="clear: both;">
                <ul id="menu-options">
                    <li style="text-transform: inherit;">Join Swurve FREE and Start Interacting with REAL Users Right Now</li>
                    <li style="text-transform: inherit; font-size: 20px;" class="register">Get Your SWURVE On!</li>
                </ul>
            </div>
        </div>
        <div id="colmask">
            <div id="colmid">
                <div id="colright">
                    <div id="col1wrap">
                        <div id="col1pad">
                            <div id="col1">
															<?= $content; ?>
                            </div>
                        </div>
                    </div>
                    <div id="col2" style="text-align: center;">
                    		<div class="side-module" id="user-stats">
		                        <a href="/user/register"><?= HTML::image('assets/img/splash3/' . $girls[$rand] . '/'. $girls[$rand] . 'lrg.png', array('style' => 'width: 225px; height: 300px;')); ?></a>

								            <div id="rate">
								                <ul id="buttons">
								                    <li style="margin-left: 7px; padding-left: 0; margin: 3; padding-top: 5px; padding-bottom: 3px;"><span class="icon" style="padding-left: 0; margin-left: -8px;"><?=HTML::image('assets/img/icons/photo.png'); ?></span> <?= HTML::anchor('user/register ', 'Request More Photos'); ?></li>
								                </ul><br />

								                Rate <?= $girls[$rand]; ?>!<br />

								                <div style="width: 100px; margin: 0 auto; margin-top: 5px;">
								                    <input class="rating" type="radio" name="profile" value="0.5" />
								                    <input class="rating" type="radio" name="profile" value="1.0" />
								                    <input class="rating" type="radio" name="profile" value="1.5" />
								                    <input class="rating" type="radio" name="profile" value="2.0" />
								                    <input class="rating" type="radio" name="profile" value="2.5" />
								                    <input class="rating" type="radio" name="profile" value="3.0" />
								                    <input class="rating" type="radio" name="profile" value="3.5" />
								                    <input class="rating" type="radio" name="profile" value="4.0" />
								                    <input class="rating" type="radio" name="profile" value="4.5" />
								                    <input class="rating" type="radio" name="profile" value="5.0" />
								                </div><br />
								            </div>
								            <div class="clear"></div>
												</div>

												<div class="side-module" id="quicksearch">
				                    <h2 style="font-size: 18px;"><?= __('Quick Search'); ?></h2>
				                    <div id="quick-search">
				                        <?= Form::open(URL::site('user/register', 'https'), array('id' => 'splash-search')); ?>
				                        <?= Form::hidden('from', 'splash'); ?>
				                        <?= Form::hidden('country', NULL, array('id' => 'country_name')); ?>
				                        <?= Form::hidden('region', NULL, array('id' => 'region_name')); ?>

				                        Find sexy
				                        <?php
				                            $users_table = ORM::factory('user');

				                            echo Form::select((Core::$user) ? 'interested_in' : 'geo_interested_in', array('' => 'Select', 'Male' => 'Men', 'Female' => 'Women', 'Both' => 'Both'), NULL, array('id' => 'interested_in'));

				                        ?> <br /> located near<br />

				                        <?= Form::select((Core::$user) ? 'country_id' : 'geo_country_id', $post['countries'], NULL, array('id' => 'country', 'style' => 'width: 216px;')); ?>
				                        <?= Form::select((Core::$user) ? 'region_id' : 'geo_region_id', $post['regions'], (isset($post['region_id'])) ? $post['region_id'] : NULL, array('id' => 'region', 'style' => 'width: 216px;')); ?>
				                        <?= Form::input('city', 'Enter A City', array('id' => 'city', 'disabled' => 'disabled', 'style' => 'width: 216px;')); ?><br /><br />
				                        <?= Form::input('search', 'search', array('type' => 'image', 'src' => '/assets/img/button-search.png')); ?>
				                        <?= Form::close(); ?>
				                    </div>
												</div>
                    </div>
                    <div id="col3">
                    		<?= View::factory('module/splash3/online_now')->bind('users', $users)->bind('cities', $cities); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer-bg"></div>
        <div id="footer">
            <?= $footer; ?>
        </div>
    </body>
</html>
