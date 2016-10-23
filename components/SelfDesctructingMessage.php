<?php

namespace app\components;

use yii\base\Object;
use app\models\backend\sdm\Message;
use app\models\backend\sdm\TimeLimitMessage;
use app\models\backend\sdm\VisitLimitMessage;

/**
 * Class for work with self-desctructing messages.
 */
class SelfDesctructingMessage extends Object
{
    /**
     * Creates message.
     * @param  string        $messageText    Message text.
     * @param  string        $passwordHash   Password hash.
     * @param  string        $destroyTrigger 'time' || 'visit'
     * @param  array|integer $destroyAfter   If $destroyTrigger is 'time': array ['num' => integer, 'unit' => string]
     *                                       'unit' can be 'seconds', 'minutes' etc.
     *                                       If $destroyTrigger is 'visit': integer
     * @return array                         ['id' => message id (string)] if everything is ok.
     *                                       [errors] otherwise.
     */
    public function createMessage($messageText, $passwordHash, $destroyTrigger, $destroyAfter)
    {
        $message                 = new Message();
        $message->messageId      = uuid();
        $message->messageText    = $messageText;
        $message->passwordHash   = $passwordHash;
        $message->destroyTrigger = $destroyTrigger;

        if (!$message->validate()) {
            return $message->errors;
        }

        switch ($destroyTrigger) {
            case 'time':
                $limitMessage            = new TimeLimitMessage();
                $limitMessage->destroyAt = date(
                    'Y-m-d H:i:s',
                    strtotime("+{$destroyAfter['num']} {$destroyAfter['unit']}")
                );
                break;
            case 'visit':
                $limitMessage             = new VisitLimitMessage();
                $limitMessage->visitsLeft = $destroyAfter;
                break;
            default:
                return $message->errors;
        }

        $limitMessage->messageId = $message->messageId;

        if (!$limitMessage->validate()) {
            return $message->errors;
        }

         $message->save();
         $limitMessage->save();

         return ['id' => $message->messageId];
    }

    /**
     * Returns message for viewing if this is possible.
     * @param  string        $messageText    Message text.
     * @param  string        $passwordHash   Password hash.
     * @return array         ['message' => message text (string)] if everything is ok.
     *                       ['error' => error text (string)] otherwise.
     */
    public function viewMessage($messageId, $passwordHash)
    {
        $errors = [
            'existError'    => 'Message with such id does not exist',
            'passwordError' => 'Wrong password',
            'unknownError'  => 'Unknown error',
        ];

        $message = Message::find()->where(['messageId' => $messageId])->one();

        if (empty($message)) {
            return ['error' => $errors['existError']];
        }

        if ($message->passwordHash !== $passwordHash) {
            return ['error' => $errors['passwordError']];
        }

        switch ($message->destroyTrigger) {
            case 'time':
                $limitMessage = TimeLimitMessage::find()->where(['messageId' => $messageId])->one();

                if (empty($limitMessage)) {
                    return ['error' => $errors['unknownError']];
                }

                if ($limitMessage->isExpired()) {
                    $limitMessage->delete();
                    $message->delete();

                    return ['error' => $errors['existError']];
                }

                break;
            case 'visit':
                $limitMessage = VisitLimitMessage::find()->where(['messageId' => $messageId])->one();

                if (empty($limitMessage)) {
                    return ['error' => $errors['unknownError']];
                }

                if ($limitMessage->isLastView()) {
                    $limitMessage->delete();
                    $message->delete();
                } else {
                    $limitMessage->decrementVisitsLeft();
                }
                break;
            default:
                return ['error' => $errors['unknownError']];
        }

        return ['message' => $message->messageText];
    }
}
