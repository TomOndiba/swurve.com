<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<h1><?= __($article->title); ?></h1>
<div style="background-color: #fff; height: 5px; border: 1px solid #95999C;"></div><br />
<div class="news-article">
    <?= Text::auto_p($article->full); ?>
    <p align="right"><?= HTML::anchor('home', '›› Back'); ?></p>
</div>
