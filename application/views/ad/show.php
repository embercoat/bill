<h1><?= $data['title']; ?></h1>
<div id="description"><?= $data['description']; ?></div>
<div id="imagelist">
    <?php
    $counter = 0;
    foreach ($images as $image) {
        ?>
        <div class="image_row">
            <div class="image_name"><?= $image['filename'] ?></div>
            <div class="image"><img src="/media/image/<?= $image['id'];?>/<?= $image['filename']; ?>?width=200" <?= ((++$counter == count($images)) ? 'onLoad="javascript:loaded()"' : ''); ?> /></div>
        </div>
    <? } ?>
</div>

<script type="text/javascript">
    function loaded(){
        $('#imagelist').masonry({
            // options
            itemSelector: '.image_row',
            isFitWidth: false,
            gutter: 10
        });
    };

</script>