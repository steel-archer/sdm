<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'View self-destructing message';

$script = <<< JS
$(document).ready(function() {
    var messageText = $("#messageText").text().trim();

    if (typeof(messageText) != "undefined" && messageText != '') {
        var arr       = JSON.parse(messageText);
        var password  = $("#viewmessageform-password").val();
        var decrypted = aesDecrypt(arr, password, window.init);

        $("#messageText").text(decrypted);
    }
});
JS;
$this->registerJs($script);

?>

<div class="site-message">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields:</p>

    <?php $form = ActiveForm::begin([
        'id'     => 'message-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template'     => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'messageId')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('View message', ['class' => 'btn btn-primary', 'name' => 'message-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <?php if (isset($messageText)) : ?>
        <div>
            Message with id "<?= $model->messageId ?>" is:<br>
            <i id="messageText"><?= $messageText ?></i>
        </div>
    <?php endif; ?>
</div>
