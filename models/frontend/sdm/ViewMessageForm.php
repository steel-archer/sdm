<?php

namespace app\models\frontend\sdm;

use Yii;
use yii\base\Model;

/**
 * Form for viewing self-destructing messages.
 */
class ViewMessageForm extends Model
{
    /**
     * Message id.
     * @var string
     */
    public $messageId;

    /**
     * Password.
     * @var string
     */
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['messageId', 'password'], 'required'],
            [['messageId'],  'match', 'pattern' => '/^[0-9a-f]{32}$/'],
            ['password', 'string', 'length' => [6, 20]],
        ];
    }
}
