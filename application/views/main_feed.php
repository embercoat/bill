<?php foreach($ads as $ad) { ?>
    <div class="ad">
    <div class="ad_title"><?php echo $ad['title']; ?></div>
    <div class="ad_description"><?php echo $ad['title']; ?></div>
    <div class="ad_images">
    <?php

    if (isset($media[$ad['id']])) {
        foreach ($media[$ad['id']] as $m) {
            echo Model::factory('media')->render_media_element($m, 100);
        }
    }

        ?>
        </div>
    </div>
<? }