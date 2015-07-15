<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1><?= $article->title; ?></h1>
<i><?= date('F jS Y', $article->added_date); ?></i><br /><br />
<div style="background-color: #fff; height: 5px; border: 1px solid #95999C;"></div><br />
<div class="news-article">
    <?= Text::auto_link(Text::auto_p($article->full)); ?>
    <p align="right"><?= HTML::anchor(Request::$referrer, '›› Back'); ?></p>
</div>
