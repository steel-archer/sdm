<?php

namespace app\models\frontend\sdm;

use Yii;
use yii\base\Model;

/**
 * Form for creating self-destructing messages.
 */
class CreateMessageForm extends Model
{
    /**
     * Message body.
     * @var string
     */
    public $messageText;

    /**
     * Password.
     * @var string
     */
    public $password;

    /**
     * Trigger which determines message destroying condition.
     * @var string
     */
    public $destroyTrigger = 'visit';

    /**
     * Max number of message views if "visit" trigger was chosen.
     * @var integer
     */
    public $maxVisits = 1;

    /**
     * Used time unit if "time" trigger was chosen.
     * @var string
     */
    public $timeUnit = 'hours';

    /**
     * Max number of specified time units for storing message if "time" trigger was chosen.
     * @var integer
     */
    public $maxTimeUnits = 1;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['messageText', 'password', 'destroyTrigger'], 'required'],
            ['messageText', 'string', 'max' => 65535],
            ['password', 'string', 'length' => [6, 20]],
            ['destroyTrigger', 'in', 'range' => ['time', 'visit']],
            [['maxVisits', 'maxTimeUnits'], 'integer', 'min' => 1],
            ['timeUnit', 'in', 'range' => ['seconds', 'minutes', 'hours']],
        ];
    }

    /**
     * Resets unused form fields basing on destroyTrigger field.
     * @return CreateMessageForm
     */
    public function resetUnusedData()
    {
        switch ($this->destroyTrigger) {
            case 'time':
                $this->maxVisits = 1;
                break;
            case 'visit':
                $this->timeUnit = 'hours';
                $this->maxTimeUnits = 1;
                break;
        }

        return $this;
    }
}
