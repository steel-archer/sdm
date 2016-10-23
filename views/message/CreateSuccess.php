<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Success!';
?>

<div class="site-message">
    <h1><?= Html::encode($this->title) ?></h1>
    <h5>Your message with id <b><?= $messageId ?></b>has been created. You can view it here: <a href="<?= $viewUrl ?>"><?= $viewUrl ?></a>.</h5>
    <h5>You can create another message <a href="<?= $newUrl ?>"><b>here</b></a>.</h5>
</div>
