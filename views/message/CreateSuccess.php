<?php

use yii\helpers\Html;

$this->title = 'Success!';
?>

<div class="site-message">
    <h1><?= Html::encode($this->title) ?></h1>
    <h5>
        Your message with id <b><?= $messageId ?></b>has been created. You can view it here:
        <a href="<?= $viewUrl ?>"><b><?= $viewUrl ?></b></a>.
    </h5>
</div>
