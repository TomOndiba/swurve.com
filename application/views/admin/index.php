<h1>Swurve Admin</h1>

<h3>Customer Service</h3>
<?= HTML::anchor('admin/check', 'Check Photos'); ?><br />
<?= HTML::anchor('admin/manage/emails', 'Manage Emails'); ?><br />
<?= HTML::anchor('admin/manage/users', 'Manage Users'); ?><br />
<?= HTML::anchor('admin/manage/active', 'Last Active Users In 10 Minutes'); ?><br />

<br /><br />

<h3>Community</h3>
<?= HTML::anchor('admin/blast/', 'Manage Community'); ?><br />
<?= HTML::anchor('admin/blast/filter/1', 'Melissa Community Accounts'); ?><br />
<?= HTML::anchor('admin/blast/filter/2', 'Michelle Community Accounts'); ?><br />
<?= HTML::anchor('admin/blast/filter/3', 'Mikey Community Accounts'); ?><br />
<?= HTML::anchor('admin/blast/filter/4', 'Tiffany Community Accounts'); ?><br />
<?= HTML::anchor('admin/blast/filter/5', 'Ryan Community Accounts'); ?><br />
<?= HTML::anchor('admin/blast/filter/6', 'Megan Community Accounts'); ?><br />

<br /><br />

<h3>Affiliate</h3>
<?= HTML::anchor('admin/affiliate/getstats', 'View Affiliate Stats'); ?><br />
<?= HTML::anchor('admin/affiliate/pendingpayouts', 'Payouts (' . $pendingpayouts . ' Pending)'); ?><br />
<?= HTML::anchor('admin/affiliate/newcategory', 'New Banner Ad Category'); ?><br />
<?= HTML::anchor('admin/affiliate/newbanners', 'New Banner Ad(s)'); ?><br />

<br /><br />

<h3>Flirtbucks</h3>
<?= HTML::anchor('admin/flirtbucks/pending', 'Pending Camgirls'); ?><br />
<?= HTML::anchor('admin/flirtbucks/pendingpayouts', 'Payouts (' . $pendingfbpayouts . ' Pending)'); ?><br />

<br /><br />

<h3>Server Stats</h3>
<a target="_blank" href="http://www.swurve.com/awstats/awstats.pl">AWStats</a><br />
<a target="_blank" href="http://www.swurve.com/jawstats/">JAWStats (Prettier version of AWStats)</a><br />

<br /><br />

<h3>Development</h3>
<a target="_blank" href="http://www.swurve.com/phpmyadmin/">PHPMyAdmin</a><br />

<br />
