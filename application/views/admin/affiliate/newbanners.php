<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        var count = 1;
        var template = $('.new-banner:first').clone();

        $('#add-banner').click(function() {
            var newbanner = template.clone();
            
            count = count + 1;
            
            newbanner.find('.bannercategory').attr('name', 'categories' + count + '[]');
            newbanner.find('.bannerfile').attr('name', 'file' + count);
            newbanner.find('.banneractive').attr('name', 'active' + count);
            newbanner.find('.bannercode').attr('name', 'code' + count);

            newbanner.insertAfter('.new-banner:last');

            $('.totalbanners').val(count);
            return false;
        })

        $('#add-banner-dupe').click(function() {
            var newbanner = $('.new-banner:last').clone();

            count = count + 1;
            
            newbanner.find('.bannercategory').attr('name', 'categories' + count + '[]');
            newbanner.find('.bannerfile').attr('name', 'file' + count);
            newbanner.find('.banneractive').attr('name', 'active' + count);
            newbanner.find('.bannercode').attr('name', 'code' + count);
            
            newbanner.insertAfter('.new-banner:last');
            
            $('.totalbanners').val(count);
            return false;
        })
    });
</script>
<h1>Add New Banner Ad(s)</h1>
<?= Form::open(NULL, array('enctype' => 'multipart/form-data')); ?>
<?= Form::hidden('total', '1', array('class' => 'totalbanners')); ?>
<div class="new-banner">
    <?= Form::select('categories1[]', $categories, NULL, array('class' => 'bannercategory', 'multiple' => 'multiple', 'size' => '13', 'style' => 'float: right; width: 150px;')); ?>
    <?= Form::label('File', 'File:', array('style' => 'vertical-align: middle;')); ?> <?= Form::file('file1', array('class' => 'bannerfile', 'style' => 'vertical-align: middle; width: 440px;')); ?><br /><br />
    <?= Form::label('active', 'Active:', array('style' => 'vertical-align: middle;')); ?> <?= Form::select('active1', array('Yes' => 'Yes', 'No' => 'No'), NULL, array('class' => 'banneractive','style' => 'verical-align: middle')); ?><br /><br />
    <?= Form::label('code', 'Code:', array('style' => 'vertical-align: top;')); ?> <?= Form::textarea('code1', NULL, array('class' => 'bannercode','style' => 'width: 430px; height: 100px;')); ?>
</div>
<center><?= HTML::anchor('#', 'Add Another Banner', array('id' => 'add-banner')); ?> <?= HTML::anchor('#', 'Add Another Banner w/ Same Settings', array('id' => 'add-banner-dupe')); ?></center><br />
<center><?= Form::submit('submit', 'Add Banner(s)', array('style' => 'vertical-align: middle;')); ?></center>
<?= Form::close(); ?>