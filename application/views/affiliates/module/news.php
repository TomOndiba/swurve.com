<?php foreach($news as $article): ?>
<div style="padding: 10px; border-bottom: 1px solid #DFE0E1;">
    <strong><?= Text::auto_p($article->title); ?></strong>
    <i><?= date('F jS Y', $article->added_date); ?></i><br /><br />

    <?= Text::auto_p($article->short); ?>
    <div align="right"><?= HTML::anchor('affiliates/news/' . $article, '›› Full Article'); ?></div>
</div>
<?php endforeach; ?>