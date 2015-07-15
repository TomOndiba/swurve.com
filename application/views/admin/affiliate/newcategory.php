<h1>Create New Banner Ad Category</h1>
<p>List of active categories: <?= Functions::ImplodeToEnglish(array_values($active)); ?> </p>
<p>List of disabled categories: <?= Functions::ImplodeToEnglish(array_values($disabled)); ?> </p>
<?= Form::open(); ?>
<?= Form::label('name', 'Name:', array('style' => 'vertical-align: middle;')); ?> <?= Form::input('name', NULL, array('style' => 'vertical-align: middle;')); ?> <?= Form::label('active', 'Active:', array('style' => 'vertical-align: middle;')); ?> <?= Form::select('active', array('Yes' => 'Yes', 'No' => 'No'), NULL, array('style' => 'verical-align: middle')); ?> <?= Form::submit('submit', 'Create Category', array('style' => 'vertical-align: middle;')); ?>
<?= Form::close(); ?>