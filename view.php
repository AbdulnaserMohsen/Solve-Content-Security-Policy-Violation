<?php

use common\helpers\Content;
?>


<div class="col-lg-12">
    <div class=" text-center">
        <h3 class="text-white"> <?= $item->title ?> </h3>
        <div class="text-white"> <?= Content::inlineStyleToClasses($item->brief) ?> </div>
    </div>
</div>