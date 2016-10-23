<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Create self-destructing message';

$script = <<< JS
    $('input[type=radio][name="CreateMessageForm[destroyTrigger]"]').change(function() {
        if (this.value == 'visit') {
            $("#visit").show();
            $("#time").hide();
        }
        else if (this.value == 'time') {
            $("#visit").hide();
            $("#time").show();
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

        <?= $form->field($model, 'messageText')->textarea(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'destroyTrigger')->radioList(['visit' => 'Visits', 'time' => 'Time']); ?>

        <div id="visit">
            <?= $form->field($model, 'maxVisits')->textInput() ?>
        </div>

        <div id="time" style="display: none;">
            <?= $form->field($model, 'timeUnit')->radioList(['seconds' => 'Seconds', 'minutes' => 'Minutes', 'hours' => 'Hours']); ?>

            <?= $form->field($model, 'maxTimeUnits')->textInput() ?>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Create message', ['class' => 'btn btn-primary', 'name' => 'message-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
