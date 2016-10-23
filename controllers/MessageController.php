<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\frontend\sdm\CreateMessageForm;
use app\models\frontend\sdm\ViewMessageForm;

/**
 * Controller for working with self-destructing messages.
 */
class MessageController extends Controller
{
    /**
     * Creates messages.
     * @return string Html code of page.
     */
    public function actionCreate()
    {
        $model = new CreateMessageForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->resetUnusedData();

            if ($model->validate()) {
                switch ($model->destroyTrigger) {
                    case 'time':
                        $destroyAfter = [
                            'num'  => $model->maxTimeUnits,
                            'unit' => $model->timeUnit,
                        ];
                        break;
                    case 'visit':
                        $destroyAfter = $model->maxVisits;
                        break;
                }
                $result = \Yii::$app->sdm->createMessage(
                    $model->messageText,
                    md5($model->password),
                    $model->destroyTrigger,
                    $destroyAfter
                );

                if (isset($result['id'])) {
                    return $this->render(
                        'CreateSuccess.php',
                        [
                            'messageId' => $result['id'],
                            'viewUrl'   => Url::toRoute("/message/view?messageId={$result['id']}"),
                            'newUrl'    => Url::toRoute('/message/create'),
                        ]
                    );
                }
            }

            $model->addError('messageText', 'Unknown error. What have you done? o_O');
        }

        return $this->render('CreateMessage', [
            'model' => $model,
        ]);
    }

    /**
     * Shows message.
     * @param  string $id Message id.
     * @return string Html code of page.
     */
    public function actionView($messageId = null)
    {
        $messageText = null;
        $model       = new ViewMessageForm();

        if (!empty($messageId)) {
            $model->messageId = $messageId;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $message = \Yii::$app->sdm->viewMessage(
                    $model->messageId,
                    md5($model->password)
                );

                if (isset($message['message'])) {
                    $messageText = $message['message'];
                    $model->password = '';
                } elseif (isset($message['error'])) {
                    $model->addError('messageId', $message['error']);
                } else {
                    $model->addError('messageId', 'Unknown error. What have you done? o_O');
                }
            }
        }

        return $this->render('ViewMessage', [
            'messageText' => $messageText,
            'model'       => $model,
        ]);
    }
}
