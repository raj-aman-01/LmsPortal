<?php
$image = $data['image'];
$lazy_load = $data['lazy_load'];
?>
<img class="asq-image<?php if ( $lazy_load ): ?> lazy-load<?php endif; ?>" <?php if ( $lazy_load ): ?>src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $image->url; ?>"<?php else: ?>src="<?php echo $image->url; ?>"<?php endif; ?> alt="" />
<?php
    if ( $image->description ):
?>
    <div class="quiz-image-credit"><?php echo $image->description; ?></div>
<?php
    endif;
?>