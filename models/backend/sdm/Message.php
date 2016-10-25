<?php

namespace app\models\backend\sdm;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class for working with Message entity.
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['messageId'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['messageId', 'messageText', 'passwordHash', 'destroyTrigger'], 'required'],
            [['messageId'],  'match', 'pattern' => '/^[0-9a-f]{32}$/'],
            ['passwordHash', 'string', 'length' => 60],
            ['messageText', 'string', 'max' => 65535],
            ['destroyTrigger', 'in', 'range' => ['time', 'visit']],
        ];
    }
}
